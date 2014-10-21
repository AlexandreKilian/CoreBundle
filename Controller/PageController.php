<?php

namespace Brix\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{

    public function loadPageAction(Request $request, $url)
    {
        $locale = $request->getLocale();
        $em = $this->getDoctrine()->getManager();

        if($request->get('adminmode')){
            $session = $request->getSession();
            $session->set('adminmode',($request->get('adminmode')=="true"));
        }


        if(!$url){
            return $this->forward('BrixCoreBundle:Page:loadHomePage');
        }


        $language = $em->getRepository('BrixCoreBundle:Language')->findOneBy(array('locale'=>$locale));
        $repo = $em->getRepository("BrixCoreBundle:Page");
        $repo->setLocale($language);



        if($page = $repo->findOneBy(array('url'=>$url))){

            return $this->renderPage($page);


        } else{
            return $this->go404($url);
            return $this->forward('BrixCoreBundle:Page:forofour', array(
                'url'  => $url,
            ));
        }



    }

    private function renderPage($page){
        $pageType = $page->getType();

        if($pageType->getModel() && $entity = $em->getRepository($pageType->getModel())->find($page->getEntity())){

            return $this->render($pageType->getTemplate(),array('page'=>$page,'entity'=>$entity));
        }
        return $this->render($pageType->getTemplate(),array('page'=>$page));
    }

    public function loadHomePageAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $locale = $request->getLocale();
        $language = $em->getRepository('BrixCoreBundle:Language')->findOneBy(array('locale'=>$locale));

        $repo = $em->getRepository("BrixCoreBundle:Page");
        $repo->setLocale($language);


        if($page = $repo->findOneBy(array('url'=>null))){
            return $this->renderPage($page);
        }else{
            return $this->go404();
        }
    }

    private function go404($url = ""){
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN') || !class_exists('Brix\AdminBundle\BrixAdminBundle')) {
            return $this->forward('BrixCoreBundle:Page:forofour', array("url"=>$url));
        }
        return $this->forward('BrixAdminBundle:Page:newPage', array("url"=>$url));
    }

    public function forofourAction($url = ""){
        return $this->render('BrixCoreBundle:Default:404.html.twig', array("url"=>$url));
    }
}
