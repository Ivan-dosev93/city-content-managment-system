<?php

namespace App\Controller\Admin;

use App\Entity\HomepageSlider;
use App\Service\HelperUtility;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class HomepageSliderCrudController
 * @package App\Controller\Admin
 * @IsGranted("ROLE_ADMIN")
 */
class HomepageSliderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HomepageSlider::class;
    }

    public function configureFields(string $pageName): iterable
    {
        //TODO use this in every crud
        $fields = HelperUtility::initIdData($pageName, [], self::getEntityFqcn());

        //TODO use this if have urlTrait
        $fields = HelperUtility::initUrl($pageName, [], self::getEntityFqcn(), [Crud::PAGE_INDEX]);

        $fields[] = TextField::new('heading')
            ->setHelp("Това поле не е задължително. Използва се за да добавите заглавие-текст към слайдера.");
        $fields[] = TextEditorField::new('description')
            ->setHelp("Това поле не е задължително. Използва се за да добавите текст към слайдера.");


        //TODO use if need image
        $fields = HelperUtility::InitImageData($pageName, $fields, self::getEntityFqcn());

        $fields[] = BooleanField::new('isActive')->setHelp('Определя дали слайдера ще бъде видим(активен) в началната страница.');

        //TODO use this in every crud
        $fields = HelperUtility::initMetaCrudData($pageName, $fields, self::getEntityFqcn());

        return $fields;
    }
}
