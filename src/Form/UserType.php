<?php
/**
 * Created by PhpStorm.
 * User: Evgenya
 * Date: 26.11.2018
 * Time: 13:57
 */
declare(strict_types=1);

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array('label' => 'Your username'))
            ->add('email', EmailType::class, array('label' => 'Your email'))
            ->add('firstname', TextType::class, array('label' => 'Your name'))
            ->add('lastname', TextType::class, array('label' => 'Your lastname'))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Your password'),
                'second_options' => array('label' => 'Please confirm your password '),
            ))

            ->add('blogger', CheckboxType::class, array(
                'label' => 'I want to be a blogger',
                'mapped' => false,
                'constraints' => new IsTrue(),

            ))
        ;
    }
}