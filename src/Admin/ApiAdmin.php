<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelType;

final class ApiAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('ref')
            ->add('headers')
            ->add('endpoint')
            ->add('method')
            ->add('soapTemplate')
            ->add('decisionParam')
            ->add('valueSuccess')
            ->add('valueInfo')
            ->add('valueFailed')
            ->add('messageParam')
            ->add('bodyFormat')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('techno',null,['label'=>'Technology', 'associated_property' => 'name'])
            ->add('ref')
            ->add('endpoint')
            ->add('method')
            ->add('decisionParam')
            ->add('valueSuccess')
            ->add('bodyFormat')
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
            ->add('techno', ModelType::class,['property'=>'name'])
            ->add('ref')
            ->add('headers')
            ->add('endpoint')
            ->add('method')
            ->add('soapTemplate')
            ->add('decisionParam')
            ->add('valueSuccess')
            ->add('valueInfo')
            ->add('valueFailed')
            ->add('messageParam')
            ->add('bodyFormat')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('ref')
            ->add('headers')
            ->add('endpoint')
            ->add('method')
            ->add('soapTemplate')
            ->add('decisionParam')
            ->add('valueSuccess')
            ->add('valueInfo')
            ->add('valueFailed')
            ->add('messageParam')
            ->add('bodyFormat')
            ;
    }
}
