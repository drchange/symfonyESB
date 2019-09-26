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
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Sonata\Form\Type\CollectionType;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


final class ApiAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('category.name', null, ['label' => 'Produit'])
            ->add('partner.name', null, ['label' => 'Partenaire'])
            ->add('ref')
            ->add('endpoint')
            ->add('method')
            ->add('bodyFormat')
            ->add('status')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('ref')
            ->add('category',null,['label'=>'Produit', 'associated_property' => 'name'])
            ->add('partner',null,['label'=>'Partenaire', 'associated_property' => 'name'])
            ->add('techno',null,['label'=>'Technologie', 'associated_property' => 'name'])
            ->add('bodyFormat', null, ['label' => 'Format'])
            ->add('status')
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
                ->with('Classification', ['class' => 'col-md-9'])          
                    ->add('category', ModelType::class,['property'=>'name', 'label'=>'Produit', 'required' => false])
                    ->add('partner', ModelType::class,['property'=>'name', 'label'=>'Partenaire', 'required' => false])
                ->end()
                ->with('Activation', ['class' => 'col-md-3'])          
                    ->add('status', null, ['label'=>'Etat API'])
                ->end()
            ->end()
            ->tab('Configuration')
                ->with('Requête', ['class' => 'col-md-6'])
                    ->add('techno', ModelType::class,['property'=>'name', 'label'=>'WebServices'])
                    ->add('ref', null, ['label'=>'Référence API'])
                    ->add('endpoint', UrlType::class, ['label'=>'Url (Endpoint)'])
                    ->add('method', ChoiceType::class, ['label'=>'Method',
                    'choices' => [
                        'GET' => 'GET',
                        'POST' => 'POST',
                        'UPDATE' => 'UPDATE' 
                      ]])
                      ->add('bodyFormat', ChoiceType::class, ['label'=>'Format du Body',
                        'choices' => [
                            'json' => 'json',
                            'xml' => 'xml',
                            'soap' => 'soap' 
                        ]])
                ->end()
                ->with('Reponse', ['class' => 'col-md-6'])
                    
                    ->add('decisionParam', null, ['label'=>'Paramètre de décision'])
                    ->add('valueSuccess', null, ['label'=>'Valeurs de success'])
                    ->add('valueInfo', null, ['label'=>'Valeurs informatives'])
                    ->add('valueFailed', null, ['label'=>'Valeurs échec'])
                    ->add('messageParam', null, ['label'=>'Paramètre de méssage'])
                ->end()
            ->end()
            
            ->tab('Paramètres')
                ->with('Gestion des paramètres', ['class' => 'col-md-12'])          
                    ->add('parameters', CollectionType::class, [
                        'required' => false,
                        'action' => '',
                        'label' => 'paramètres',
                        'by_reference' => false // Use this because of reasons
                    ], [
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable' => 'position',
                    ])
                ->end()
                
            ->end()
            ->tab('XML/SOAP')
                ->with('Requête XML/SOAP', ['class' => 'col-md-6'])          
                    ->add('soapTemplate', TextareaType::class, [
                        'required' => false,
                        'label' => 'Requête XML/SOAP',
                        'trim' => true,
                        'attr' => ['class' => 'text-editor', 'rows' => '50']
                    ])
                ->end()
                ->with('Reponse XML/SOAP', ['class' => 'col-md-6'])          
                    ->add('xmltagversion', null, [
                        'required' => false,
                        'label' => 'Tag version XML',
                    ])
                ->end()
            ->end();
           /* ->add('techno', ModelType::class,['property'=>'name'])
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
            ->add('status')*/
            
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
