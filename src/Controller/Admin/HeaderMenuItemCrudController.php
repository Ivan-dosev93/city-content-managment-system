<?php

namespace App\Controller\Admin;

use App\Entity\HeaderMenuItem;
use App\Repository\HeaderMenuItemRepository;
use App\Service\HelperUtility;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HeaderMenuItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HeaderMenuItem::class;
    }

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * HeaderMenuItemCrudController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function configureFields(string $pageName): iterable
    {
        //TODO use this in every crud
        $fields = HelperUtility::initIdData($pageName, [], self::getEntityFqcn());

        //TODO use this if have urlTrait
        $fields = HelperUtility::initUrl($pageName, $fields, self::getEntityFqcn());

        $fields[] = AssociationField::new('parent')->setHelp("Ако искате това да е подменю изберете, родителско меню")
            ->setQueryBuilder(
                function (QueryBuilder $queryBuilder) {
                    return $queryBuilder->getEntityManager()->getRepository(HeaderMenuItem::class)->findById('0');
                }
            );

        $fields[] = TextField::new('faIcon')->setHelp('Тук се добавя иконка от https://fontawesome.com/search');
        $fields[] = BooleanField::new('isActive')->setHelp('Това определя дали да се показва линка в мега менюто');

        return $fields;
    }
}
