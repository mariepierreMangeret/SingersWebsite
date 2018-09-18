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
    public function indexAction(Request $request, $page, $year=null, $month=null, $search=null) {
        if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 5;

        $repositoryBlog = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('SWBlogBundle:Blog');

        if ( $request->request->get('search') != null ) {
            $search = $request->request->get('search');
        }

        if ($year != null && $month != null) {
            $blogs = $repositoryBlog->getArchive($year, $month, $page, $nbPerPage);
            $type_page = 'archive';
        } else if ($search != null) {
            $blogs = $repositoryBlog->getSearch($search, $page, $nbPerPage);
            $type_page = 'search';
        } else if ($year == null && $month == null && $search == null) {
            $blogs = $repositoryBlog->myBlogs($page, $nbPerPage);
            $type_page = 'home';
        };

        $datesArchive = $repositoryBlog->getDateArchive();

        $nbPages = ceil(count($blogs)/$nbPerPage);

        if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        return $this->render('SWBlogBundle::index.html.twig', array(
            'blogs'         => $blogs, 
            'nbPages'       => $nbPages,
            'page'          => $page, 
            'datesArchive'  => $datesArchive,
            'search'        => $search,
            'type_page'     => $type_page, 
            'year'          => $year,
            'month'         => $month,
        ));
    }

    public function showAction($id, $page, Request $request) {
        if (intval($page) < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
        }

        $nbPerPage = 5;

        $comments = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('SWBlogBundle:Comment')
            ->myComments($id, $page, $nbPerPage);

        $nbPages = ceil(count($comments)/$nbPerPage);

        $nbPages = $nbPages == 0 ? 1: $nbPages;

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
                'id' => $comment->getBlog()->getId(),'page' => $page)) .
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