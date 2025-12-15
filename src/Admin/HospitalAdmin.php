<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class HospitalAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('name', null, ['label' => 'Nazwa'])
            ->add('address', null, ['label' => 'Adres'])
            ->add('city', null, ['label' => 'Miasto'])
            ->add('phone', null, ['label' => 'Telefon', 'required' => false]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('name', null, ['label' => 'Nazwa'])
            ->add('city', null, ['label' => 'Miasto']);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('name', null, ['label' => 'Nazwa'])
            ->add('city', null, ['label' => 'Miasto'])
            ->add('address', null, ['label' => 'Adres'])
            ->add('phone', null, ['label' => 'Telefon'])
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
            ->add('name', null, ['label' => 'Nazwa'])
            ->add('address', null, ['label' => 'Adres'])
            ->add('city', null, ['label' => 'Miasto'])
            ->add('phone', null, ['label' => 'Telefon']);
    }

    public function __toString(): string
    {
        return $this->name ?? '';
    }
}
