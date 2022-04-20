<?php

namespace App\DataFixtures;

use App\Entity\Constants\RouteConstants;
use App\Entity\ContactType;
use App\Entity\InternalLink;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordHasherInterface
     */
    private $passwordHasher;

    /**
     * AppFixtures constructor.
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        //Load admin user
        $this->loadUsers($manager);

        //Load static routes link
        $this->loadHomepageInternalLink($manager);

        //Load contact types
        $this->loadContactTypes($manager);
    }

    /**
     * @param ObjectManager $manager
     */
    public function loadUsers(ObjectManager $manager): void
    {
        $user = (new User())
            ->setEmail("admin@dolna.com")
            ->setNickname("Administrator")
            ->setRoles(["ROLE_USER", "ROLE_ADMIN"])
            ->setIsActive(true);
        $user->setPassword($this->passwordHasher->hashPassword($user, "*-+abdcd2022"));

        $manager->persist($user);

        //Load redactor user
        $user = (new User())
            ->setEmail("blog-redactor@dolna.com")
            ->setNickname("Blog redactor")
            ->setRoles(["ROLE_USER", "ROLE_BLOG_REDACTOR"])
            ->setIsActive(true);
        $user->setPassword($this->passwordHasher->hashPassword($user, "*-+2022abcd"));

        $user = (new User())
            ->setEmail("business-redactor@dolna.com")
            ->setNickname("Business redactor")
            ->setRoles(["ROLE_USER", "ROLE_BLOG_REDACTOR"])
            ->setIsActive(true);
        $user->setPassword($this->passwordHasher->hashPassword($user, "*-+20abcd"));

        $manager->persist($user);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @return InternalLink
     */
    public function loadHomepageInternalLink(ObjectManager $manager)
    {
        $internalLink = (new InternalLink())
            ->setAbsoluteUrl($_ENV['BASE_URL'] . RouteConstants::INDEX_ROUTE);

        $manager->persist($internalLink);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    public function loadContactTypes(ObjectManager $manager): void
    {
        $internalLink = (new InternalLink())
            ->setAbsoluteUrl($_ENV['BASE_URL'] . RouteConstants::CONTACT_ROUTE . 'complaint');
        $manager->persist($internalLink);
        $contactType = (new ContactType())
            ->setName("Оплакване")
            ->setSelfUrl($internalLink)
            ->setSlug("complaint");
        $manager->persist($contactType);

        $internalLink = (new InternalLink())
            ->setAbsoluteUrl($_ENV['BASE_URL'] . RouteConstants::CONTACT_ROUTE . 'proposal');
        $manager->persist($internalLink);
        $contactType = (new ContactType())
            ->setName("Предложение")
            ->setSelfUrl($internalLink)
            ->setSlug("proposal");
        $manager->persist($contactType);

        $internalLink = (new InternalLink())
            ->setAbsoluteUrl($_ENV['BASE_URL'] . RouteConstants::CONTACT_ROUTE . 'signal');
        $manager->persist($internalLink);
        $contactType = (new ContactType())
            ->setName("Сигнал")
            ->setSelfUrl($internalLink)
            ->setSlug("signal");
        $manager->persist($contactType);

        $internalLink = (new InternalLink())
            ->setAbsoluteUrl($_ENV['BASE_URL'] . RouteConstants::BUSINESS_ROUTE . 'list');
        $manager->persist($internalLink);

        $manager->flush();
    }
}
