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
      return $this->go404($url);
      return $this->forward('BrixCoreBundle:Page:forofour', array(
        'url'  => $url,
      ));
    }

  }

  public function loadHomePageAction(){

    $em = $this->getDoctrine()->getManager();
    if($page = $em->getRepository("BrixCoreBundle:Page")->findOneBy(array('url'=>null))){
      $pageType = $page->getType();

      if($pageType->getModel() && $entity = $em->getRepository($pageType->getModel())->find($page->getEntity())){

        return $this->render($pageType->getTemplate(),array('page'=>$page,'entity'=>$entity));
      }

      return $this->render($pageType->getTemplate(),array('page'=>$page));
    } else{
      return $this->go404();
    }
  }

  private function go404($url = null){
    if (false === $this->get('security.context')->isGranted('ROLE_ADMIN') || !class_exists('Brix\AdminBundle\BrixAdminBundle')) {
      return $this->forward('BrixCoreBundle:Page:forofour', array("url"=>$url));
    }
    return $this->forward('BrixAdminBundle:Page:newPage', array("url"=>$url));
  }

  public function forofourAction($url = null){
    return $this->render('BrixCoreBundle:Default:404.html.twig');
  }
}
