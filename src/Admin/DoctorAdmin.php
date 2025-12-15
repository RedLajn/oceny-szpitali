<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Hospital;

final class DoctorAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('firstName', null, ['label' => 'Imię'])
            ->add('lastName', null, ['label' => 'Nazwisko'])
            ->add('specialization', null, ['label' => 'Specjalizacja'])
            ->add('hospital', EntityType::class, [
                'class' => Hospital::class,
                'choice_label' => 'name',
                'label' => 'Szpital'
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('firstName', null, ['label' => 'Imię'])
            ->add('lastName', null, ['label' => 'Nazwisko'])
            ->add('specialization', null, ['label' => 'Specjalizacja'])
            ->add('hospital', null, ['label' => 'Szpital']);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('lastName', null, ['label' => 'Nazwisko'])
            ->add('firstName', null, ['label' => 'Imię'])
            ->add('specialization', null, ['label' => 'Specjalizacja'])
            ->add('hospital.name', null, ['label' => 'Szpital'])
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
                'label' => 'Akcje'
            ]);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('firstName', null, ['label' => 'Imię'])
            ->add('lastName', null, ['label' => 'Nazwisko'])
            ->add('specialization', null, ['label' => 'Specjalizacja'])
            ->add('hospital.name', null, ['label' => 'Szpital']);
    }

}
