<?php

namespace App\Controller\Admin;

use App\Entity\BlogCategory;
use App\Service\HelperUtility;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class BlogCategoryCrudController
 * @package App\Controller\Admin
 * @IsGranted("ROLE_BLOG_REDACTOR")
 */
class BlogCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogCategory::class;
    }


    public function configureFields(string $pageName): iterable
    {
        //TODO use this in every crud
        $fields = HelperUtility::initIdData($pageName, [], self::getEntityFqcn());

        $fields[] = TextField::new('name');
        $fields = HelperUtility::initSlug($pageName, $fields, self::getEntityFqcn());
        $fields[] = TextEditorField::new('description');

        //TODO use this in every crud
        $fields = HelperUtility::initMetaCrudData($pageName, $fields, self::getEntityFqcn());

        return $fields;
    }

}
