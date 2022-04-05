<?php

namespace App\Form;

use App\Entity\Albums;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class AlbumsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'attr' => ['class'=> 'form-control', 'style' => 'margin-bottom:15px']
            ])
            ->add('description', TextType::class,[
                'attr'=>['class'=> 'form-control','style' => 'margin-bottom:15px']
            ])
            ->add('price',NumberType::class,[
                'attr'=>['class'=>'form-control','style'=>
                'margin-bottom:15px']
            ])
            ->add('year',NumberType::class,[
                'attr'=>['class'=>'form-control','style'=>
                'margin-bottom:15px']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create album',
                'attr' => ['class' => 'btn-primary', 'style' => 'margin-bottom:15px']
            ]);
            

    }
    public function configureOptions(OptionsResolver $resolver): void{
        $resolver->setDefaults([
            'data_class' => Albums::class,
        ]);
    }
}


?>