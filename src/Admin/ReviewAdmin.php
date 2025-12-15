<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Doctor;

final class ReviewAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('doctor', EntityType::class, [
                'class' => Doctor::class,
                'choice_label' => function($doctor) {
                    return $doctor->getFirstName() . ' ' . $doctor->getLastName();
                },
                'label' => 'Lekarz'
            ])
            ->add('rating', null, ['label' => 'Ocena (1-5)'])
            ->add('comment', null, ['label' => 'Komentarz'])
            ->add('authorName', null, ['label' => 'Imię autora'])
            ->add('authorEmail', null, ['label' => 'Email autora'])
            ->add('isApproved', null, ['label' => 'Zatwierdzona', 'required' => false]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid
            ->add('doctor', null, ['label' => 'Lekarz'])
            ->add('rating', null, ['label' => 'Ocena'])
            ->add('isApproved', null, ['label' => 'Zatwierdzona'])
            ->add('authorName', null, ['label' => 'Autor']);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('doctor', null, ['label' => 'Lekarz'])
            ->add('rating', null, ['label' => 'Ocena'])
            ->add('authorName', null, ['label' => 'Autor'])
            ->add('isApproved', null, ['label' => 'Zatwierdzona', 'editable' => true])
            ->add('createdAt', null, ['label' => 'Data utworzenia'])
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
            ->add('doctor', null, ['label' => 'Lekarz'])
            ->add('rating', null, ['label' => 'Ocena'])
            ->add('comment', null, ['label' => 'Komentarz'])
            ->add('authorName', null, ['label' => 'Imię autora'])
            ->add('authorEmail', null, ['label' => 'Email autora'])
            ->add('isApproved', null, ['label' => 'Zatwierdzona'])
            ->add('createdAt', null, ['label' => 'Data utworzenia']);
    }
}
