<?php

namespace Brix\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BlockController extends Controller
{
    public function renderBlockAction($page, $blockname)
    {
        $em = $this->getDoctrine()->getManager();
        if($block = $em->getRepository('BrixCoreBundle:Block')->findOneBy(array('page'=>$page,'name'=>$blockname))){
          return $this->renderBlock($block);


        } else {
          return new Response("404 - Block not found");
        }
    }

    public function renderBlockElementAction($block){
        return $this->renderBlock($block);
    }

    public function renderBlock($block){
      $em = $this->getDoctrine()->getManager();

      if($block->getRepeater()){

        $qb = $repository = $em->getRepository($block->getRepeaterWidget()->getModel())->createQueryBuilder('w');
        $query = $qb->setMaxResults($block->getRepeaterLimit())->getQuery();
        $entities = $query->getResult();

        return $this->render('BrixCoreBundle:Default:repeater_block.html.twig', array('widget'=>$block->getRepeaterWidget(),'entities' => $entities));
      }

      $widgets = $block->getWidgets();
      $subblocks = $block->getSubblocks();

      return $this->render('BrixCoreBundle:Default:block.html.twig', array('widgets' => $widgets,'subblocks'=>$subblocks));
    }

    public function renderRepeaterAction($widget, $limit, $settings = null)
    {
        $em = $this->getDoctrine()->getManager();

        $widget = $em->getRepository("BrixCoreBundle:WidgetType")->findOneBy(array('name'=>$widget));

        $qb = $repository = $em->getRepository($widget->getModel())->createQueryBuilder('w');
        $query = $qb->setMaxResults($limit)->getQuery();
        $entities = $query->getResult();

        return $this->render('BrixCoreBundle:Default:repeater_block.html.twig', array('widget'=>$widget,'entities' => $entities));
    }
}
