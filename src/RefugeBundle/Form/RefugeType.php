<?php

namespace RefugeBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefugeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')

            ->add('prenom')

            ->add('nationalite', ChoiceType::class, array(
                'choices' => json_decode(
                //if builder is in controller, this should work
                    file_get_contents(__DIR__.'/../../../web/index/nationalities.json'),
                    true) ,
                'attr' => [ 'class' => 'selectpicker ', 'data-style' => 'select-with-transition']
            ))
            ->add('birthD', DateType::class, [
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
                'widget' => 'choice' ,
                'input' => 'datetime' ,
                'format' => 'dd/MM/yyyy' ,

            ])

            ->add('birthLoc')

            ->add('sexe', ChoiceType::class, array(
                'choices' => json_decode(
                //if builder is in controller, this should work
                    file_get_contents(__DIR__.'/../../../web/index/gender.json'),
                    true) ,
                'attr' => [ 'class' => 'selectpicker', 'data-style' => 'select-with-transition']
            ))
            ->add('socialSit')
            ->add('Entreprise',EntityType::class,array(
                'class'=>'RefugeBundle:Entreprise',
                'choice_label'=>'nom',
                'multiple'=>false))
            ->add('img',FileType::class, array(
                'data_class' => null ,
                // unmapped means that this field is not associated to any entity property
                //'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,
                'attr' => ['class' => 'btn btn-primary ml-auto mr-auto'],

            ))
            ->add('camp',EntityType::class,array('class'=>'RefugeBundle:camp','choice_label'=>'libelle','multiple'=>false))

            ->add('Continuer',SubmitType::class,[
                'attr' => ['class' => 'btn btn-primary ml-auto mr-auto'],
            ]);
    }/**
     * {@inheritdoc}
     */



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RefugeBundle\Entity\Refuge'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'refugebundle_refuge';
    }


}
