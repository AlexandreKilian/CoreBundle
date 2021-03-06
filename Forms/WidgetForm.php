<?php

namespace Brix\CoreBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class WidgetForm extends AbstractType{

  public function buildForm(FormBuilderInterface $builder, array $options){

    $builder
        ->add('block',null,array('required'=>false))
        ->add('type',null,array('required'=>false))
        ->add('order',null,array('required'=>false))
        // ->add('entity',null,array('required'=>false))
        ;

  }

  public function getName(){
    return null;
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
{
    $resolver->setDefaults(array(
        'data_class' => 'Brix\CoreBundle\Entity\Widget',
        'csrf_protection' => false
    ));
  }


}
