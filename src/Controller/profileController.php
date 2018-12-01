<?php
/**
 * Created by PhpStorm.
 * User: Evgenya
 * Date: 27.11.2018
 * Time: 13:05
 */
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class profileController extends AbstractController
{

    /**
     * @Route("profile/{id}" )
     */

    public function indexAction(Request $request, $id,  UserPasswordEncoderInterface $passwordEncoder,UserRepository $userRepository)
    {

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        if(NULL === $user) {
            throw $this->createNotFoundException('could not find this user.');
        }
        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('firstname', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('lastname', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description', TextareaType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
            ->add('email', EmailType::class, array('attr' => array('class' => 'form-control')))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Your password'),
                'second_options' => array('label' => 'Please confirm your password '),
            ))


            ->getForm();


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();


            $entityManager->flush();
            return $this->redirectToRoute('admin', array(
                'user' => $user,
            ));
        }
        return $this->render('profile/profile.html.twig', ['form' => $form->createView()]);
    }

}