<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 27.11.2018
 * Time: 9:38
 */

declare(strict_types=1);

namespace App\Controller;


use App\Entity\Post;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class BlogController extends AbstractController
{
    /**
     *
     * @Route("/",name="app_index", methods={"GET"})
     */

    function index() : Response
    {
        $articles = $this->getDoctrine()->getRepository(Post::class)->findAll();
        return $this->render('blog/index.html.twig', array (
            'posts'=>$articles
        ));
    }


 /*   /**
     * @Route("/post/{id}", name="post_show")
     */
    public function show($id){
        $article = $this->getDoctrine()->getRepository(Post::class)->find($id);
        return $this->render('blog/show.html.twig', array('article'=>$article));
    }


    /**
     * @Route ("post/delete/{id}", methods={"DELETE"})
     */
    public function deletePost(Request $request, $id){
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($post);
        $entityManager->flush();

        $response = new Response();
        $response->send();

    }





    /**
     * @Route("/post/new", name="new_post")
     */
    public function newPost(Request $request)
    {
        $post = new Post();

        $form = $this->createFormBuilder($post)
            ->add('title', TextType::class, array('label' => 'title'))
            ->add('slug', TextType::class, array('label' => 'slug'))
            ->add('content', TextareaType::class, array('label' => 'content'))
            ->add('pulbishedAt', DateTimeType::class, array('label' => 'Date'))
            ->add('author', TextType::class, array('label' => 'Author'))
            ->add('save', SubmitType::class, array('label' => 'Create', 'attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('/');
        }

        return $this->render('post/postnew.html.twig', array('form' => $form->createView()));
    }
//
//    /**
//     * @Route("blog/save")
//     */
//    public function save() : Response
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//        $post = new Post();
//        $post->setTitle("ArticleTwo");
//        $post->setContent('Body');
//
//        $entityManager->persist($post);
//        $entityManager->flush();
//
//        return new Response('Saves an article with id of'.$post->getId());
//    }
}