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



        if($page = $repo->findOneBy(array('url'=>$url,'language'=>$language))){ //CHECK IF THERE IS A PAGE WITH THIS URL IN THIS LANGUAGE
            return $this->renderPage($page);
        } else{
            if($page = $repo->findOneBy(array('url'=>$url))){ //LOOK FOR ANY PAGE WITH THIS URL

                if($page->getOriginal()){ //IF THIS IS A TRANSLATION, CHECK THE ORIGINAL
                    $page = $page->getOriginal();
                }

                $repo->setLocale($language);
                if($transpage = $repo->find($page->getId())){ //LOOK FOR TRANSLATION OF THIS PAGE
                    return  $this->redirect(
                    $this->generateUrl('brix_page',array(
                        'url' => $transpage->getUrl()
                        )
                    ));
                }
            }
            return $this->go404($url);

        }



    }

    private function renderPage($page){
        $pageType = $page->getType();

        if($pageType->getModel() && $entity = $em->getRepository($pageType->getModel())->find($page->getEntity())){

            return $this->render($pageType->getTemplate(),array('page'=>$page,'entity'=>$entity));
        }
        return $this->render($pageType->getTemplate(),array('page'=>$page,'admin'=>$this->isAdminMode()));
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

    private function isAdminMode(){
        $session = $this->getRequest()->getSession();

        $admin = $this->get('security.context')->isGranted('ROLE_ADMIN');
        $adminsession = $session->get('adminmode',false);

        return ($admin && $adminsession);
    }
}
