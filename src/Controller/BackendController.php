<?php

namespace Supsign\ContaoAttendanceListBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/contao", defaults={
 *     "_scope" = "backend",
 *     "_token_check" = true,
 *     "_backend_module" = "my-modules"
 * })
 */
class BackendController extends AbstractController
{
    /**
     * @Route("/my-backend-route", name="app.backend-route")
     * @Template("my_backend_route.html.twig")
     */
    public function backendRouteAction()
    {
        return [];
    }
}