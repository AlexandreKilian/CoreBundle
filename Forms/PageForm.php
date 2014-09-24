<?php

namespace Brix\CoreBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class PageForm extends AbstractType{

  public function buildForm(FormBuilderInterface $builder, array $options){

    $builder
        ->add('type',null,array('required'=>false))
        ->add('name')
        ->add('url')
        ->add('entity',null,array('required'=>false))
        ->add('parent',null,array('required'=>false))
        ->add('original',null,array('required'=>false))
        ->add('language',null,array('required'=>false))
        ;

  }

  public function getName(){
    return null;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
{
    $resolver->setDefaults(array(
        'data_class' => 'Brix\CoreBundle\Entity\Page',
        'csrf_protection' => false
    ));
  }


}
