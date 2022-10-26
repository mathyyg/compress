<?php

namespace App\Form;

use App\Entity\Resource;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\ResourceRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\HttpFoundation\Request;

class ResourceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options ): void
    {
        $builder
            ->add('url')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Resource::class,
        ]);
    }
}
