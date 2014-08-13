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
          return $this->render('BrixCoreBundle:Default:block.html.twig', array('block' => $block));
        } else {
          return new Response("404 - Block not found");
        }
    }
}
