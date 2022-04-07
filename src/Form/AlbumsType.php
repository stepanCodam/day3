<?php

namespace App\Form;

use App\Entity\Albums;
use App\Entity\Status;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;




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
            ->add('fk_status',EntityType::class,[
                'class'=> Status::class,
                'choice_label'=> 'name',
            ])
           
            ->add('image', FileType::class, [
                'label' => 'Upload Image',
 //unmapped means that is not associated to any entity property
                'mapped' => false,
 //not mandatory to have a file
                'required' => false,
 
 //in the associated entity, so you can use the PHP constraint classes as validators
                'constraints' => [
                    new File([
                        'maxSize' => '10024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file',
                    ])
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create todo',
                'attr' => ['class' => 'btn-primary', 'style' => 'margin-top:15px']
            ]);
            
    }
    
    public function configureOptions(OptionsResolver $resolver): void{
        $resolver->setDefaults([
            'data_class' => Albums::class,
        ]);
    }
}


?>