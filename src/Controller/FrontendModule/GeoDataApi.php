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
		$ch 		= null,
		$response	= null;


	protected function createApiRequest() {
		$this->ch = curl_init();

		curl_setopt($this->ch, CURLOPT_URL, 'https://wedec.post.ch/WEDECOAuth/authorization');
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

		//	
		curl_setopt($this->ch, CURLOPT_USERPWD, 'TEST_8f7a0338-d4e4-493b-b83c-733fe41cdd02:TEST_0b7f92ae-41af-4ba3-94bb-083c5016aa6e');

		//

		if (false)
			curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'GET');
		else
			curl_setopt($this->ch, CURLOPT_POST, true);

		return $this;
	}

	public function getResponse() {
		return $this->response;
	}

	protected function sendReuqest() {
		$this->response = json_decode(curl_exec($this->ch) );
		// curl_close($this->ch);

		return $this;
	}


	public function test() 
	{
		$this
			->createApiRequest()
			->sendReuqest();

		var_dump(
			curl_getinfo($this->ch),
			$this->getResponse()
		);
	}
}
