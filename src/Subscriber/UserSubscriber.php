<?php


namespace App\Subscriber;


use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\AbstractLifecycleEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserSubscriber implements EventSubscriberInterface
{
    /**
     * @var UserPasswordHasherInterface
     */
    private $passwordHasher;

    /**
     * UserSubscriber constructor.
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setPassword'],
            BeforeEntityUpdatedEvent::class => ['setPassword'],
        ];
    }

    public function setPassword(AbstractLifecycleEvent $event)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof User) {
            if ($entity->getPasswordContainer() != null) {
                $password = $this->passwordHasher->hashPassword($entity, $entity->getPasswordContainer());
                $entity->setPassword($password);
            }
        }
    }
}