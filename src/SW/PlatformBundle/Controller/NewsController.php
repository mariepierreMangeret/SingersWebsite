<?php

namespace SW\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SW\PlatformBundle\Entity\News;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\Tools\Pagination\Paginator;

class NewsController extends Controller
{
      public function newsAction(Request $request,$page) 
      {
          if ($page < 1) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
          }

          $nbPerPage = 5;

          $news = $this
              ->getDoctrine()
              ->getManager()
              ->getRepository('SWPlatformBundle:News')
              ->myNews($page, $nbPerPage);
          
          $nbPages = ceil(count($news)/$nbPerPage);

          if ($page > $nbPages) {
            throw $this->createNotFoundException("La page ".$page." n'existe pas.");
          }

          return $this->render('SWPlatformBundle::news.html.twig', array(
              'news'      => $news, 
              'nbPages'   => $nbPages,
              'page'      => $page,  
          ));
      }

      public function viewAction(News $news) 
      {

          return $this->render('SWPlatformBundle::news_info.html.twig', array(
              'news' =>  $news,   
          ));
      }
}
