<?php

namespace Supsign\ContaoAttendanceListBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contao", defaults={
 *     "_scope" = "backend",
 *     "_token_check" = true,
 *     "_backend_module" = "attendance-list"
 * })
 */
class BackendController extends AbstractController
{
    /**
     * @Route("/attendancelist", name="supsign.attendancelist")
     */
    public function backendRouteAction()
    {
        return (new Response)->setContent('I hate Contao');
    }
}