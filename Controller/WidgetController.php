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

        if(!$widgetType->getModel()){
            return $this->render($widgetType->getTemplate(),array('widget'=>$widget,'admin'=>$this->isAdminMode()));
        }
        elseif($widget->getEntity() && $entity = $em->getRepository($widgetType->getModel())->find($widget->getEntity())){

            return $this->render($widgetType->getTemplate(),array('widget'=>$widget,'entity'=>$entity,'admin'=>$this->isAdminMode()));
        } else {
            return new Response("");
        }

    }

    public function renderRepeaterWidgetAction($widget,$entity)
    {

        return $this->render($widget->getTemplate(),array('widget'=>$widget,'entity'=>$entity,'admin'=>$this->isAdminMode()));


    }

    private function isAdminMode(){
        $session = $this->getRequest()->getSession();

        $admin = $this->get('security.context')->isGranted('ROLE_ADMIN');
        $adminsession = $session->get('adminmode',false);

        return ($admin && $adminsession);
    }
}
