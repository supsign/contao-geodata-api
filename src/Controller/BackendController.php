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
use Contao\MemberModel;
use Contao\MemberGroupModel;
use Supsign\ContaoAttendanceListBundle\Entity\AttendanceList;

/**
 * @Route("/contao", defaults={
 *     "_scope" = "backend",
 *     "_token_check" = false,
 *     "_backend_module" = "attendance-list"
 * })
 */
class BackendController extends AbstractController
{

    /**
     * @Route("/attendancelist", name="supsign.attendancelist")
     */

    public function default()
    {

    	// $query = MemberModel::findOneById(16);

    	// var_dump($query);

    	// $query = MemberModel::findOneById(35);

    	// var_dump($query);

    	// var_dump($_POST);

    	$submit = extract($_POST) > 0;

    	if ($submit) {
	    	// $query = MemberModel::findByGroups($selectedMemberGroups);

    		// // $query = MemberModel::findBy()


	    	// var_dump($query);

	    	// foreach ($selectedMemberGroups AS $selectedMemberGroup) {
		    // 	$query = MemberModel::findOneByGroups($selectedMemberGroup);
		    // 	var_dump($query);
	    	// }
    	}


    	$data = [
    		'memberGroups' => MemberGroupModel::findAll()
    	];

        return new Response(
            $this->get('twig')->render('@ContaoAttendanceList/default.html.twig', $data)
        );
    }


    /**
     * @Route("/attendancelist/new", name="supsign.attendancelist.archive")
     */

    public function archive()
    {




        return new Response(
            $this->get('twig')->render('@ContaoAttendanceList/archive.html.twig', $data)
        );
    }


}
