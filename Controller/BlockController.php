<?php

namespace Brix\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Brix\CoreBundle\Entity\Block;
use Brix\CoreBundle\Entity\Widget;

class BlockController extends Controller
{
    public function renderBlockAction($page, $blockname)
    {
        $em = $this->getDoctrine()->getManager();


        if($block = $em->getRepository('BrixCoreBundle:Block')->findOneBy(array('page'=>$page,'name'=>$blockname))){

        } else {

            $block = new Block();
            $block->setPage($page);
            $block->setName($blockname);
            $em->persist($block);
            $em->flush();

            // return new Response("");
        }
        return $this->renderBlock($block);
    }

    public function renderBlockElementAction($block){
        return $this->renderBlock($block);
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



    private function renderBlock($block){
        $em = $this->getDoctrine()->getManager();

        if($block->getRepeater()){

            $qb = $repository = $em->getRepository($block->getRepeaterWidget()->getModel())->createQueryBuilder('w');
            $query = $qb->setMaxResults($block->getRepeaterLimit())->getQuery();
            $entities = $query->getResult();

            return $this->render('BrixCoreBundle:Default:repeater_block.html.twig', array('widget'=>$block->getRepeaterWidget(),'entities' => $entities));
        }

        $widgets = $block->getWidgets();
        $subblocks = $block->getSubblocks();

        if($block->getType()){
            return $this->render($block->getType()->getTemplate(), array('subblock'=>false,'block'=>$block,'children' => $block->getChildren(), 'ngAdmin'=>$this->isAdminMode()));
        }

        return $this->render('BrixCoreBundle:Default:block.html.twig', array('block'=>$block,'children' => $block->getChildren(), 'ngAdmin'=>$this->isAdminMode()));
    }

    private function isAdminMode(){
        $session = $this->getRequest()->getSession();

        $admin = $this->get('security.context')->isGranted('ROLE_ADMIN');
        $adminsession = $session->get('adminmode',false);

        return ($admin && $adminsession);
    }
}
