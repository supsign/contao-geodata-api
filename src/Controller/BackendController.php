<?php

namespace Supsign\ContaoAttendanceListBundle\Controller;

// use Contao\BackendAlerts;
// use Contao\BackendConfirm;
// use Contao\BackendFile;
// use Contao\BackendHelp;
// use Contao\BackendIndex;
// use Contao\BackendMain;
// use Contao\BackendPage;
// use Contao\BackendPassword;
// use Contao\BackendPopup;
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
        return new Response(
        	$this->get('twig')->render('@ContaoAttendanceList/my_backend_route.html.twig', [])
        );    
    }
}
