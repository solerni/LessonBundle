<?php
/**
 * Created by JetBrains PhpStorm.
 * User: gaetan
 * Date: 28/06/13
 * Time: 15:31
 * To change this template use File | Settings | File Templates.
 */
namespace Icap\LessonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MoveChapterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = array();
        $root = true;
        foreach ($options['chapters'] as $child) {
            if($root){
                $choices[$child->getId()] = 'Racine';
                $root = false;
            }else{
                $choices[$child->getId()] = $child->getTitle();
            }
        }

        $builder
            ->add('title', 'text', array('disabled' => true))
            ->add('choiceChapter', 'choice', array(
                'mapped' => false,
                'choices' => $choices
            ));
        $builder ->add('brother', 'checkbox', array(
            'required' => false,
            'mapped' => false
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Icap\LessonBundle\Entity\Chapter',
            'chapters' => array()
        ));
    }

    public function getName()
    {
        return 'icap_lesson_movechaptertype';
    }
}