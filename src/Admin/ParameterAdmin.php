<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\AdminBundle\Form\Type\ModelHiddenType;


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
            ->tab('Général')
                ->with('', ['class' => 'col-md-12'])          
                    ->add('api', ModelType::class,['property'=>'ref', 'label' => 'Web Service', 'required' => true, 'disabled' => true])
                    ->add('inName', null, ['label'=> 'Nom en entré'])
                    ->add('outName', null, ['label'=> 'Nom en sortie'])
                    ->add('isStatic', null, ['label'=> 'Statique'])
                    ->add('valueStatic', null, ['label'=> 'Valeur statique'])
                    ->add('inUrl', null, ['label'=> 'Url'])
                    ->add('levelinUrl', null, ['label'=> 'Level'])
                    ->add('required', null, ['label'=> 'Requis'])
                    ->add('regex', null, ['label'=> 'Regex'])
                    ->add('flow', ChoiceType::class, ['label'=>'Type',
                        'choices' => [
                            'in' => 'in',
                            'out' => 'out',
                            'soapheader' => 'soapheader'
                    ]])
                ->end()
            ->end()
            ->tab('XML/SOAP')
            
            ->end()
            
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
