<?php
/**
 * Created by PhpStorm.
 * User: Evgenya
 * Date: 28.11.2018
 * Time: 2:05
 */
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\CallbackTransformer;

class settingProfile extends AbstractController
{

    /**
     * @Route("settingprofile/{id}")
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
            ->add('description', TextareaType::class, array('required' => false))
            ->add('email', EmailType::class, array('attr' => array('class' => 'form-control')))
            ->add('roles', ChoiceType::class, array(
                'choices' => [
                    'ADMIN'  => 'ROLE_ADMIN',
                    'MODER'  => 'ROLE_MODER',
                    'BLOGGER'  => 'ROLE_BLOGGER',
                    'USER'  => 'ROLE_USER',
                    'BLOCKED' => 'ROLE_BLOGGER',
                ],
                'expanded'  => false, // liste déroulante
                'multiple'  => true, // choix multiple
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
        return $this->render('admin/settingprofile.html.twig', ['form' => $form->createView()]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'plainPassword' => false,
        ));
    }

}