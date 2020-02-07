<?php

namespace Supsign\ContaoGeoDataApiBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\ServiceAnnotation\FrontendModule;
use Contao\ModuleModel;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 * @FrontendModule(category="Bottom")
 */


class GeoDataApi
{
	protected
		$ch 				= null,
		$clientId   		= 'cb81e3cc263c36c6bb556aa0ded12903',
		$clientSecret 		= '8a38730e72986202c29ce76f3cf6822d',
		$endpoints			= ['authorization' => 'https://wedec.post.ch/WEDECOAuth/authorization/', 'address' => 'https://wedec.post.ch/api/address/v1/'],
		$inputData 			= null,
		$parameterData		= null,
		$parameterString 	= null,
		$response			= null,
		$accessToken		= null,
		$accessTokenType	= null;

	public function __construct() {
		$this->endpoints = (object)$this->endpoints;

		return $this->createAccessToken();
	}

	protected function addInputData($key, $value) {
		if (!isset($this->inputData) )
			$this->newInputData();

		$this->inputData->$key = $value;

		return $this;
	}

	protected function addParameterData($key, $value) {
		if (!isset($this->parameterData) )
			$this->newParameterData();
			
		$this->parameterData->$key = $value;

		return $this;
	}

	protected function clearInputData() {
		$this->inputData = new \stdClass;

		return $this;
	}

	protected function clearParameterData() {
		$this->parameterData   = new \stdClass;
		$this->parameterString = null;

		return $this;
	}

	public static function convertUmlauts(string $string) {
		$string = str_replace(['ä', 'ö', 'ü', 'Ä', 'Ö', 'Ü', 'ß'], ['ae', 'oe', 'ue', 'Ae', 'Oe', 'Ue', 'ss'], $string);
		$string = str_replace(['ê', 'è', 'é'], 'e', $string);
		$string = str_replace(['É', 'È', 'Ê'], 'E', $string);
		$string = str_replace(['ô', 'ó', 'ò'], 'o', $string);
		$string = str_replace(['Ô', 'Ó', 'Ò'], 'O', $string);
		$string = str_replace(['à', 'â', 'á'], 'a', $string);
		$string = str_replace(['À', 'Â', 'Á'], 'A', $string);

		return $string;
	}

	protected function createAccessToken() {
		$this
			->createAuthRequest()
			->sendRequest();

		if (!$this->getResponse()->access_token)
			throw new \Exception('Couldn\'t fetch access token', 1);
			
		$this->accessToken 		= $this->getResponse()->access_token;
		$this->accessTokenType 	= $this->getResponse()->token_type;

		return $this;
	}

	protected function createAddressRequest(string $type = 'zips') {
		$this
			->createApiRequest('GET')
			->setParameterData($this->inputData);

		curl_setopt($this->ch, CURLOPT_URL, $this->endpoints->address.$type.$this->getParameterString() );

		return $this;
	}

	protected function createApiRequest(string $method = null) {
		$this->ch = curl_init();

		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

		if ($this->accessToken)
			curl_setopt($this->ch, CURLOPT_HTTPHEADER, ['Authorization: '.$this->getAccessTokenType().' '.$this->getAccessToken()]);

		if ($method)
			curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, strtoupper($method) );
		else
			curl_setopt($this->ch, CURLOPT_POST, true);

		return $this;
	}

	protected function createAuthRequest() {
		$this->createApiRequest();

		curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded') );
		curl_setopt($this->ch, CURLOPT_URL, $this->endpoints->authorization);

		$data = [
			'grant_type' 	=> 'client_credentials',
			'scope' 		=> 'WEDEC_AUTOCOMPLETE_ADDRESS',
			'client_id'		=> $this->clientId,
			'client_secret' => $this->clientSecret
		];

		$this->setParameterData($data);

        curl_setopt($this->ch, CURLOPT_POSTFIELDS, ltrim($this->getParameterString(), '?') );

        return $this;
	}

	protected function createParameterString() {
		$this->parameterString = '?';

		foreach ($this->parameterData AS $key => $value)
			$this->parameterString .= $key.'='.$value.'&';

		$this->parameterString = rtrim($this->parameterString, '&');

		return $this;
	}

	protected function getAccessToken() {
		if (!$this->accessToken)
			$this->createAccessToken();

		return $this->accessToken;
	}

	protected function getAccessTokenType() {
		if (!$this->accessTokenType)
			$this->createAccessToken();

		return $this->accessTokenType;
	}

	public function getCityOrZip(string $input, int $limit = 30) {
		$results = new \stdClass;

		if (strlen($input) < 2)
			return $results;

		$this
			->setInputData(['zipCity' => self::convertUmlauts($input), 'limit' => $limit, 'type' => 'DOMICILE'])
			->createAddressRequest('zips')
			->sendRequest();

		$results = new \stdClass;

		if (!$this->getResponse() )
			return $results;

		foreach ($this->getResponse()->zips AS $result)
			if (!isset($results->{$result->zip}) )
				$results->{$result->zip} = $result->city18;

		return $results;
	}

	public function getCityOrZipJson(string $input, int $limit = 30) {
		return json_encode($this->getCityOrZip($input, $limit) );
	}

	protected function getParameterString() {
		if (!$this->parameterData)
			return $this->parameterString ?: '';
		else
			$this->createParameterString();

		return $this->parameterString;
	}

	public function getResponse() {
		return $this->response;
	}

	protected function newInputData() {
		return $this->clearInputData();
	}

	protected function newParameterData() {
		return $this->clearParameterData();
	}

	protected function sendRequest() {
		$this->response = json_decode(curl_exec($this->ch) );

		curl_close($this->ch);

		return $this;
	}

	protected function setInputData($data) {
		$this->clearInputData();

		foreach ($data AS $key => $value)
			$this->addInputData($key, $value);

		return $this;
	}

	protected function setParameterData($data) {
		$this->clearParameterData();

		foreach ($data AS $key => $value)
			$this->addParameterData($key, $value);

		return $this;
	}
}
