<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Service\HelperUtility;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_DETAIL, Action::EDIT);
    }

    public function configureFields(string $pageName): iterable
    {
        //TODO use this in every crud
        $fields = HelperUtility::initIdData($pageName, [], self::getEntityFqcn());
        $fields[] = TextField::new('title');
        $fields[] = TextField::new('names');
        if ($pageName == Crud::PAGE_DETAIL)
            $fields[] = TextEditorField::new('description');

        $fields[] = BooleanField::new('isActive')
            ->setHelp('Това определя дали запитването е обработено')
            ->setLabel('Обработено запитване');

        $fields = HelperUtility::InitImageData($pageName, $fields, self::getEntityFqcn());

        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
                $fields[] = DateTimeField::new('createdAt');
                $fields[] = DateTimeField::new('updatedAt');
        }

        return $fields;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['createdAt' => 'DESC']);
    }
}
