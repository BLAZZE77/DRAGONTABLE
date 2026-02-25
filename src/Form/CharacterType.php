<?php

namespace App\Form;


use App\Entity\Character;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use App\Entity\Race;
use App\Entity\Classe;
use App\Entity\Background;

class CharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('race', EntityType::class, [
            'class' => Race::class,
            'choice_label' => 'name',
        ])
        ->add('classe', EntityType::class, [
            'class' => Classe::class,
            'choice_label' => 'name',
        ])
        ->add('background', EntityType::class, [
            'class' => Background::class,
            'choice_label' => 'name',
        ])
        ->add('imageFile', FileType::class, [
            'label' => 'Image de votre personnage',
            'required' => false,
            'constraints' => [
                new File([
                    'maxSize' => '8M',
                    'mimeTypes' => [
                        'image/jpeg',
                        'image/png',
                        'image/gif',
                    ],
                    'mimeTypesMessage' => 'Veuillez uploader une image valide (JPEG,PNG,GIF).',
                ])
            ],
        ])
        ->add('physique', null,[
        'required' => false,
        ])
        ->add('name', null, [
        'required' => true,
        ])
         ->add('description', null,[
        'required' => false,
        ])
    ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Character::class,
        ]);
    }
}
