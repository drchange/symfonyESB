<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelType;


final class ParameterAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('inName')
            ->add('outName')
            ->add('isStatic')
            ->add('valueStatic')
            ->add('soapTree')
            ->add('flow')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('api',null,['label'=>'API', 'associated_property' => 'ref'])
            ->add('id')
            ->add('inName')
            ->add('outName')
            ->add('isStatic')
            ->add('valueStatic')
            ->add('soapTree')
            ->add('flow')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('api', ModelType::class,['property'=>'ref'])
            ->add('inName')
            ->add('outName')
            ->add('isStatic')
            ->add('valueStatic')
            ->add('soapTree')
            ->add('flow')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('inName')
            ->add('outName')
            ->add('isStatic')
            ->add('valueStatic')
            ->add('soapTree')
            ->add('flow')
            ;
    }
}
