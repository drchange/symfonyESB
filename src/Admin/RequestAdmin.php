<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

final class RequestAdmin extends AbstractAdmin
{


    /**
     * Default Datagrid values
     *
     * @var array
     */
    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'DESC', // reverse order (default = 'ASC')
        '_sort_by' => 'id'  // name of the ordered field
                                 // (default = the model's id field, if any)
    );

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('status')
            ->add('date')
            ->add('origin')
            ->add('iporigin')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('api',null,['label'=>'API', 'associated_property' => 'ref'])
            ->add('status')
            ->add('date')
            ->add('origin')
            ->add('iporigin', null, ['label' => 'Adresse IP'])
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
            ->add('id')
            ->add('status')
            ->add('date')
            ->add('origin')
            ->add('iporigin')
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('status')
            ->add('date')
            ->add('origin')
            ->add('iporigin')
            ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create')
        ->remove('edit');
    }
}
