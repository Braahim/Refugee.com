<?php

namespace RefugeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class campType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libelle', TextType::class, array(
            'attr' => ['class' => 'form-control'],
        ))
            ->add('location', TextType::class, array(
                'attr' => ['class' => 'form-control'],
            ))
            ->add('capacity', TextType::class, array(
                'attr' => ['class' => 'form-control'],
            ))
            ->add('Continuer', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary ml-auto mr-auto'],
            ]);
    }
        /* ->addEventListener(
     FormEvents::PRE_SET_DATA,
     array($this, 'onPreSetData')
);
}/**
* {@inheritdoc}
*/
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RefugeBundle\Entity\camp'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'refugebundle_camp';
    }


}
