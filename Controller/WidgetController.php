<?php

namespace Brix\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class WidgetController extends Controller
{
    public function renderWidgetAction($widget)
    {


        $em = $this->getDoctrine()->getManager();
        // $widget = $em->getRepository("BrixCoreBundle:Widget")->find($id);
        $widgetType = $widget->getType();
        if($entity = $em->getRepository($widgetType->getModel())->find($widget->getEntity())){

            return $this->render($widgetType->getTemplate(),array('entity'=>$entity));
          } else {
            return new Response("404 - Entity not found");
          }




    }
}
