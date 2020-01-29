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


class TestSupsign extends AbstractFrontendModuleController
{

	public function test() 
	{

		var_dump(
			'we have contact!'
		);
	}

    protected function getResponse(Template $template, ModuleModel $model, Request $request): ?Response
    {
        return $template->getResponse();
    }
}
