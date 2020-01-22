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
     * @Route("/attendancelist", name="supsign.attendancelist.default")
     */

    public function view()
    {
        // $token = $_COOKIE['csrf_contao_csrf_token'];

        $entityManager = $this->getDoctrine()->getManager();

        $attendanceList = (new AttendanceList)
            ->setTitle('Titel')
            ->setTstamp(time() )
            ->setDescription('Description');

        $entityManager->persist($attendanceList);
        // $entityManager->flush();                                        //  This does the save

        $attendanceList = null;

        var_dump(AttendanceList::class);

        $attendanceList = $this->getDoctrine()
            ->getRepository(AttendanceList::class)
            ->find(1);                                                      // This does the query


        var_dump($attendanceList);


        $submit  = extract($_POST) > 0;
        $query   = MemberModel::findOneByEmail($email);
        $exists  = $query !== null;

        if (!$exists AND $email) {
            $member = new MemberModel;

            $member->firstname = $firstname;
            $member->lastname  = $lastname;
            $member->email     = $email;
            $member->dateAdded = time();

            $member->save();
        }

        $data = [
            'members' => MemberModel::findAll(),
            'submit' => $submit,
            'exists'  => $exists,
            'tests'   => $tests
        ];

        return new Response(
            $this->get('twig')->render('@ContaoAttendanceList/view.html.twig', $data)
        );
    }


    /**
     * @Route("/attendancelist/new", name="supsign.attendancelist.create")
     */

    public function create()
    {


        $data = [
            'members' => MemberModel::findAll(),
            'success' => true,
            'exists'  => $exists
        ];

        return new Response(
            $this->get('twig')->render('@ContaoAttendanceList/view.html.twig', $data)
        );
    }


}
