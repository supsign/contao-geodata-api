<?php

namespace Supsign\ContaoAttendanceListBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @twig->generate("my_backend_route.html.twig")
     */
    public function backendRouteAction()
    {
        return (new Response)->setContent('I hate Contao');
    }
}