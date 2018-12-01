<?php
/**
 * Created by PhpStorm.
 * User: Evgenya
 * Date: 27.11.2018
 * Time: 2:39
 */

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class adminController extends Controller
{
    /**
     * @Route("/admin", name="admin_page")
     */

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $allOurUser = $em->getRepository(User::class)->findAll();

        $paginator  = $this->get('knp_paginator');

        $users = $paginator->paginate(
            $allOurUser,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)
         );

        return $this->render('admin/admin.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * @Route ("delete/{id}", methods={"DELETE"})
     */
    public function deleteUser(Request $request, $id){
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        $response = new Response();
        $response->send();

    }


    /**
     * @Route ("block/{id}", methods={"BLOCK"})
     */
    public function blockUser(Request $request, $id){
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $user->setRoles('ROLE_BLOCKED');
        $entityManager->flush();

        $response = new Response();
        $response->send();

    }


    /**
     * @Route ("unlock/{id}", methods={"UNLOCK"})
     */
    public function unlockUser(Request $request, $id){
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $user->setRoles(array('ROLE_USER'));
        $entityManager->flush();

        $response = new Response();
        $response->send();

    }


    /**
     * @Route ("accomplish/{id}", methods={"ACCOMPLISH"})
     */
    public function accomplishUser(Request $request, $id){
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $user->setRoles(array('ROLE_BLOGGER'));
        $entityManager->flush();

        $response = new Response();
        $response->send();

    }

}