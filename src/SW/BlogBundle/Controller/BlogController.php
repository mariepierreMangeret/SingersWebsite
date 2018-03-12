<?php

namespace SW\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\Tools\Pagination\Paginator;

use SW\BlogBundle\Entity\Comment;
use SW\BlogBundle\Entity\Blog;
use SW\BlogBundle\Form\CommentType;
use SW\UserBundle\Entity\User;

class BlogController extends Controller {
    public function indexAction(Request $request,$page) {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 5;

        $blogs = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('SWBlogBundle:Blog')
            ->myBlogs($page, $nbPerPage);
          
        $nbPages = ceil(count($blogs)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('SWBlogBundle::index.html.twig', array(
            'blogs'     => $blogs, 
            'nbPages'   => $nbPages,
            'page'      => $page,  
        ));
    }

    public function showAction($id, $page, Request $request) {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 5;

        $comments = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('SWBlogBundle:Comment')
            ->myComments($page, $nbPerPage);

        $nbPages = ceil(count($comments)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        /*creation du formulaire*/
        $blog = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('SWBlogBundle:Blog')
            ->find($id);

        $comment = new Comment();
        $comment->setBlog($blog);
        $comment->setUser($this->get('security.token_storage')->getToken()->getUser());

        $form = $this->createForm('SW\BlogBundle\Form\CommentType',$comment,array(
            'action' => $this->generateUrl('sw_blog_show', array('id' => $comment->getBlog()->getId(),
            'page' => $page)),
            'method' => 'POST'
        ));

        /*validation du formulaire*/
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('sw_blog_show', array(
                'id' => $comment->getBlog()->getId())) .
                '#comment-' . $comment->getId()
            );
        }

        return $this->render('SWBlogBundle::show.html.twig', array(
            'blog'      => $blog,
            'comments'  => $comments,
            'form'      => $form->createView(),
            'nbPages'   => $nbPages,
            'page'      => $page, 
        ));
    }
}