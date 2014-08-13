<?php

namespace Brix\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    public function loadPageAction($url)
    {
        $em = $this->getDoctrine()->getManager();
        if($page = $em->getRepository("BrixCoreBundle:Page")->findOneBy(array('url'=>$url))){

        $pageType = $page->getType();

        if($pageType->getModel() && $entity = $em->getRepository($pageType->getModel())->find($page->getEntity())){

            return $this->render($pageType->getTemplate(),array('page'=>$page,'entity'=>$entity));
        }

        return $this->render($pageType->getTemplate(),array('page'=>$page));
      } else{
        return new Response("404 - Page not found");
      }

    }
}
