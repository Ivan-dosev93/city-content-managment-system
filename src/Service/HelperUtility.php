<?php

namespace App\Service;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class HelperUtility
{
    public static function initMetaCrudData(string $pageName, array $fields, string $entity): array
    {
        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            if (method_exists((new $entity()), 'getUpdatedAt')) {
                $fields[] = DateTimeField::new('updatedAt');
            }
            if (method_exists((new $entity()), 'getUpdatedBy')) {
                $fields[] = AssociationField::new('updatedBy');
            }
        }

        return $fields;
    }

    public static function initIdData(string $pageName, array $fields, string $entity): array
    {
        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            $fields[] = IdField::new('id');
        }

        return $fields;
    }

    public static function InitImageData(string $pageName, array $fields, string $entity): array
    {
        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            if (method_exists((new $entity()), 'getThumbnail')) {
                $fields[] = ImageField::new('thumbnail')->setBasePath('images/thumbnails');
            }
        } else {
            if (method_exists((new $entity()), 'getThumbnailFile')) {
                $fields[] = Field::new('thumbnailFile')->setFormType(VichImageType::class);
            }
        }

        return $fields;
    }

    public static function initSlug(string $pageName, array $fields, string $entity): array
    {
        if (method_exists((new $entity()), 'getSlug')) {
            $fields[] = TextField::new('slug')->setHelp('Попълнете същото, като заглавието или името. Това е помощно поле, което ще се самообработи. (ще се показва в адресната лента в публичната част.)');
        }

        return $fields;
    }

    public static function initUrl(string $pageName, array $fields, string $entity, array $excludePages = []): array
    {
        if (method_exists((new $entity()), 'getInternalLink')
        && method_exists((new $entity()), 'getExternalLink')
            && method_exists((new $entity()), 'getUrlText')) {
            if (array_search($pageName, $excludePages) === false) {
                $fields[] = AssociationField::new('internalLink')
                    ->setHelp("Това поле не е задължително. Използва се за да добавите вътрешна връзка за препратка. Това поле е с приоритет");
                $fields[] = TextField::new('externalLink')
                    ->setHelp("Това поле не е задължително. Използва се за да добавите външна връзка за препратка.");
                $fields[] = TextField::new('urlText')
                    ->setHelp("Това поле не е задължително. Използва се за да добавите бутон и неговия текст.");
            }
        }

        return $fields;
    }
}
