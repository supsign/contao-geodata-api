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


class TestSupsign
{

	public function test() 
	{
		var_dump(
			'we have contact!'
		);
	}
}
