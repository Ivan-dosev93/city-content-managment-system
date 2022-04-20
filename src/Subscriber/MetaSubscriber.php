<?php


namespace App\Subscriber;


use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PreUpdate;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class MetaSubscriber implements EventSubscriberInterface
{
    /**
     * @var Security
     */
    private $security;

    /**
     * MetaSubscriber constructor.
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['initCreation'],
            BeforeEntityUpdatedEvent::class => ['initUpdate'],
        ];
    }

    public function initCreation(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (method_exists($entity, 'setCreatedBy')) {
            $entity->setCreatedBy($this->security->getUser());
        }
        if (method_exists($entity, 'setUpdatedBy')) {
            $entity->setUpdatedBy($this->security->getUser());
        }
//        if (method_exists($entity, 'setCreatedAt')) {
//            $entity->setCreatedAt(new \DateTime());
//        }
//        if (method_exists($entity, 'setUpdatedAt')) {
//            $entity->setUpdatedAt(new \DateTime());
//        }
    }

    public function initUpdate(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (method_exists($entity, 'setUpdatedBy')) {
            $entity->setUpdatedBy($this->security->getUser());
        }
//        if (method_exists($entity, 'setUpdatedAt')) {
//            $entity->setUpdatedAt(new \DateTime());
//        }
    }
}