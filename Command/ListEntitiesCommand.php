<?php
namespace Brix\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Brix\CoreBundle\Entity\PageType;
use Brix\CoreBundle\Entity\WidgetType;

class ListEntitiesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('brix:setup')
            ->setDescription('List all configured Entitie')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = $this->getContainer()->getParameter('brix.config');

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        // die(var_dump($config['templates']));

        $entities = Array();

        foreach($config['entities'] as $name => $data){
          $entities[$name] = $data;
        }

        foreach($config['templates']['widgets'] as $name => $data){

          if(!$widget = $em->getRepository("BrixCoreBundle:WidgetType")->findOneBy(array("name"=>$name)))$widget = new WidgetType();

          $widget->setName($name);
          $widget->setTemplate($data['template']);

          $widget->setModel($entities[$data['entity']]['class']);
          $em->persist($widget);
        }

        foreach($config['templates']['pages'] as $name => $data){
          if(!$page = $em->getRepository("BrixCoreBundle:PageType")->findOneBy(array("name"=>$name)))$page = new PageType();
          $page->setName($name);
          $page->setTemplate($data['template']);

          if(isset($data['entity']))$page->setModel($entities[$data['entity']]['class']);
          if(isset($data['blocks']))$page->setBlocks($data['blocks']);

          $em->persist($page);
        }

        $em->flush();

    }
}
