<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Service\HelperUtility;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 * Class UserCrudController
 * @package App\Controller\Admin
 * @IsGranted("ROLE_ADMIN")
 */
class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        //TODO use this in every crud
        $fields = HelperUtility::initIdData($pageName, [], self::getEntityFqcn());

        $fields[] = TextField::new('nickname')->setHelp('Това е псевдонима, който ще се визуализира, при добавяне на информация в сайта. (Блогове, бизнеси и т.н.)');
        $fields[] = TextField::new('email');
        $fields[] = ArrayField::new('roles')
            ->setHelp('Ролите определят какъв достъп има текущият потребител в админ панела.
            ROLE_USER - задължителна, добавя се сама.
            ROLE_ADMIN - достъп до всичко.
            ROLE_BLOG_REDACTOR - има достъп до блог статиите.
            ROLE_BUSINESS_REDACTOR - има достъп до бизнесите.');


        if ($pageName == Crud::PAGE_EDIT || $pageName == Crud::PAGE_NEW) {
            $fields[] = TextField::new('passwordContainer')->
            setFormType(PasswordType::class)->
            setLabel('Password')->setHelp("Ако не въведеш никаква парола при промяна на потребител, по подразбиране остава старата парола.
            Препоръчително е паролата да съдържа главна, малка буква, символ и цифра.");
        }

        $fields[] = BooleanField::new('isActive')->setHelp('Потребителя може да изпозва акаунта си, единствено ако е активен. Иначе няма да може да влезе в него');

        //TODO use this in every crud
        $fields = HelperUtility::initMetaCrudData($pageName, $fields, self::getEntityFqcn());

        return $fields;
    }
}
