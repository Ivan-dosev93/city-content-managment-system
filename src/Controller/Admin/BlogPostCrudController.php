<?php

namespace App\Controller\Admin;

use App\Entity\BlogPost;
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
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Security;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
 * Class BlogPostCrudController
 * @package App\Controller\Admin
 * @IsGranted("ROLE_BLOG_REDACTOR")
 */
class BlogPostCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return BlogPost::class;
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        $query = $this->get(EntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);

        if(!$this->isGranted('ROLE_ADMIN')) {
            $query->where('entity.createdBy = :userId')
                ->setParameter('userId', $this->getUser());
        }

        return $query;
    }


    public function configureFields(string $pageName): iterable
    {
        //TODO use this in every crud
        $fields = HelperUtility::initIdData($pageName, [], self::getEntityFqcn());

        $fields[] = TextField::new('title');
        $fields = HelperUtility::initSlug($pageName, $fields, self::getEntityFqcn());

        $fields[] = TextEditorField::new('text');
        $fields[] = AssociationField::new('category');
        $fields[] = BooleanField::new('isActive')->setHelp('Това определя дали поста да се визуализира в публичната част');

        $fields = HelperUtility::InitImageData($pageName, $fields, self::getEntityFqcn());

        //TODO use this in every crud
        $fields = HelperUtility::initMetaCrudData($pageName, $fields, self::getEntityFqcn());

        return $fields;
    }

}
