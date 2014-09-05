<?php

namespace Brix\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class WidgetController extends Controller
{
    public function renderWidgetAction($widget)
    {
        $em = $this->getDoctrine()->getManager();
        $widgetType = $widget->getType();


        if($widget->getEntity() && $entity = $em->getRepository($widgetType->getModel())->find($widget->getEntity())){

            return $this->render($widgetType->getTemplate(),array('entity'=>$entity));
          } else {
            return new Response("404 - Entity not found");
          }

    }

    public function renderRepeaterWidgetAction($widget,$entity)
    {

            return $this->render($widget->getTemplate(),array('entity'=>$entity));


    }
}
