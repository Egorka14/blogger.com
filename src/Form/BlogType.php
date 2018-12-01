<?php
/**
 * Created by PhpStorm.
 * User: Evgenya
 * Date: 01.12.2018
 * Time: 17:55
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('label' => 'title'))
            ->add('slug', EmailType::class, array('label' => 'slug'))
            ->add('content', TextareaType::class, array('label' => 'content'))
            ->add('pulbishedAt', DateTimeType::class, array('label' => 'Date'))
            ->add('author', TextType::class, array('label' => 'Author'))
        ;
    }
}