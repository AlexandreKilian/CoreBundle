<?php

namespace Brix\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Brix\CoreBundle\Entity\Block;
use Brix\CoreBundle\Entity\Widget;

class NavigationController extends Controller
{
    public function renderNavigationAction(Request $request, $name)
    {

        $locale = $request->getLocale();
        $em = $this->getDoctrine()->getManager();

        $language = $em->getRepository('BrixCoreBundle:Language')->findOneBy(array('locale'=>$locale));

        if($navigation = $em->getRepository("BrixCoreBundle:Navigation")->findOneBy(array('name'=>$name,'language'=>$language))){

            return $this->renderNavigation($navigation);


        } elseif($navigation = $em->getRepository("BrixCoreBundle:Navigation")->findOneBy(array('name'=>$name,'original'=>null))){
            return $this->renderNavigation($navigation);
        } else{
            return new Response();

        }
    }

    private function renderNavigation($navigation){
        return $this->render('BrixCoreBundle:Default:navigation.html.twig',array('navigation'=>$navigation));
    }

}
