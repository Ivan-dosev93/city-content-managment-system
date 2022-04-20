<?php

namespace App\Controller\Admin;

use App\Entity\Business;
use App\Service\HelperUtility;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
 * Class BusinessCrudController
 * @package App\Controller\Admin
 * @IsGranted("ROLE_BUSINESS_REDACTOR")
 */
class BusinessCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Business::class;
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        $query = $this->get(EntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);

        if (!$this->isGranted('ROLE_ADMIN')) {
            $query->where('entity.createdBy = :userId')
                ->setParameter('userId', $this->getUser());
        }

        return $query;
    }

    public function configureFields(string $pageName): iterable
    {
        //TODO use this in every crud
        $fields = HelperUtility::initIdData($pageName, [], self::getEntityFqcn());

        $fields[] = TextField::new('name');
        $fields = HelperUtility::initSlug($pageName, $fields, self::getEntityFqcn());
        $fields[] = TextField::new('location');
        $fields[] = TextEditorField::new('text');
        if ($pageName != Crud::PAGE_INDEX)
            $fields[] = TextField::new('googleMapIframe')->setHelp(
                'Тук си добавяте кода за google карти. https://www.maps.ie/create-google-map/ от този сайт е лесно да се генерира. Взема се iframe code.'
            );
        $fields[] = BooleanField::new('isActive')->setHelp('Това определя дали да се визуализира в публичната част');

        $fields = HelperUtility::InitImageData($pageName, $fields, self::getEntityFqcn());

        $entity = self::getEntityFqcn();
        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            if (method_exists((new $entity()), 'getThumbnail1')) {
                $fields[] = ImageField::new('thumbnail1')->setBasePath('images/thumbnails');
            }
        } else {
            if (method_exists((new $entity()), 'getThumbnailFile1')) {
                $fields[] = Field::new('thumbnailFile1')->setFormType(VichImageType::class);
            }
        }

        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            if (method_exists((new $entity()), 'getThumbnail2')) {
                $fields[] = ImageField::new('thumbnail2')->setBasePath('images/thumbnails');
            }
        } else {
            if (method_exists((new $entity()), 'getThumbnailFile2')) {
                $fields[] = Field::new('thumbnailFile2')->setFormType(VichImageType::class);
            }
        }

        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            if (method_exists((new $entity()), 'getThumbnail3')) {
                $fields[] = ImageField::new('thumbnail3')->setBasePath('images/thumbnails');
            }
        } else {
            if (method_exists((new $entity()), 'getThumbnailFile3')) {
                $fields[] = Field::new('thumbnailFile3')->setFormType(VichImageType::class);
            }
        }

        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            if (method_exists((new $entity()), 'getThumbnail4')) {
                $fields[] = ImageField::new('thumbnail4')->setBasePath('images/thumbnails');
            }
        } else {
            if (method_exists((new $entity()), 'getThumbnailFile4')) {
                $fields[] = Field::new('thumbnailFile4')->setFormType(VichImageType::class);
            }
        }

        //TODO use this in every crud
        $fields = HelperUtility::initMetaCrudData($pageName, $fields, self::getEntityFqcn());

        return $fields;
    }

}
