<?php

namespace App\Form;

use App\Entity\Salida;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;

class SalidaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('locacion', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Elige una opción',
                'choices'  => [
                    'Talent Garden - Madrid' => 'Madrid',
                    'Factoría F5 - Barcelona' => 'Barcelona',
                    'Teletrabajo' => 'Teletrabajo'
                ],
            ])
            ->add('comentario')
            ->add('INICIAR', SubmitType::class);

        $builder->get('locacion')
            ->addModelTransformer(new CallbackTransformer(
                function ($locacionArray) {
                    // transform the array to a string
                    return count($locacionArray) ? $locacionArray[0] : null;
                },
                function ($locacionString) {
                    // transform the string back to an array
                    return [$locacionString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Salida::class,
        ]);
    }
}
