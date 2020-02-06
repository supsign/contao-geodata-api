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
		$clientId   		= 'TEST_8f7a0338-d4e4-493b-b83c-733fe41cdd02',
		$clientSecret 		= 'TEST_0b7f92ae-41af-4ba3-94bb-083c5016aa6e',
		$endpoints			= ['authorization' => 'https://wedec.post.ch/WEDECOAuth/authorization'],
		$parameterData		= null,
		$parameterString 	= null,
		$response			= null,
		$accessToken		= null,
		$accessTokenType	= null;

	public function __construct() {
		$this->endpoints = (object)$this->endpoints;
	}

	protected function createAccessToken() {
		$this
			->createAuthRequest()
			->sendRequest();

		if (!$this->getResponse()->access_token)
			throw new Exception('Couldn\'t fetch access token', 1);
			
		$this->accessToken 		= $this->getResponse()->access_token;
		$this->accessTokenType 	= $this->getResponse()->token_type;

		return $this;
	}

	protected function createApiRequest() {
		$this->ch = curl_init();

		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

		if ($this->getAccessToken() )
			curl_setopt($this->ch, CURLOPT_HTTPHEADER, ['Authorization: '.$this->getAccessTokenType().' '.$this->getAccessToken()]);

		if (false)
			curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'GET');
		else
			curl_setopt($this->ch, CURLOPT_POST, true);

		return $this;
	}

	protected function createAuthRequest() {
		$this->createApiRequest();

		curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded') );
		curl_setopt($this->ch, CURLOPT_URL, $this->endpoints->authorization);

        $this->parameterData = new \stdClass;

        $this->parameterData->grant_type	= 'client_credentials';
        $this->parameterData->scope 		= 'openid';
        $this->parameterData->client_id 	= $this->clientId;
        $this->parameterData->client_secret	= $this->clientSecret;

        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->getParameterString() );

        return $this;
	}

	protected function createParameterString() {
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

	protected function sendRequest() {
		$this->response = json_decode(curl_exec($this->ch) );
		curl_close($this->ch);

		return $this;
	}


	public function test() {


		// $this->getAccessToken();

		return 'test';
	}
}
