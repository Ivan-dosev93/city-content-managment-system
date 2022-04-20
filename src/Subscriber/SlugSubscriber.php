<?php


namespace App\Subscriber;


use App\Entity\Interfaces\EntityBaseURLInterface;
use App\Entity\InternalLink;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\AbstractLifecycleEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class SlugSubscriber implements EventSubscriberInterface
{
    /**
     * @var SluggerInterface
     */
    private $slugger;
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * SlugSubscriber constructor.
     * @param SluggerInterface $slugger
     */
    public function __construct(SluggerInterface $slugger, EntityManagerInterface $manager)
    {
        $this->slugger = $slugger;
        $this->manager = $manager;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => [['slugify', 2], ['generateInternalLinkOnPersist', 1]],
            BeforeEntityUpdatedEvent::class => [['slugify', 2], ['generateInternalLinkOnUpdate', 1]],
        ];
    }

    public function slugify(AbstractLifecycleEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof EntityBaseURLInterface) {
            $slug = $entity->getSlug();
            $slug = $this->slugger->slug($slug);
            $slug = strtolower($slug);
            $slug = substr($slug, 0, 120);

            $entity->setSlug($slug);
        }
    }

    public function generateInternalLinkOnPersist(AbstractLifecycleEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof EntityBaseURLInterface) {
            $internalLink = (new InternalLink())
                ->setAbsoluteUrl($entity->getEntityBaseUrl() . $entity->getSlug());

            $this->manager->persist($internalLink);
            $entity->setSelfUrl($internalLink);
        }
    }

    public function generateInternalLinkOnUpdate(AbstractLifecycleEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof EntityBaseURLInterface) {
            $selfUrl = $entity->getSelfUrl();
            $selfUrl->setAbsoluteUrl($entity->getEntityBaseUrl() . $entity->getSlug());
        }
    }
}