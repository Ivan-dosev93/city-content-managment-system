<?php

namespace App\Twig;

use App\Entity\HeaderMenuItem;
use App\Service\BreadcrumbsManager;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getFilters()
    {
        return [
//            new TwigFilter('price', [$this, 'formatPrice']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('getImageUrl', [$this, 'getImageUrl']),
            new TwigFunction('getBaseUrl', [$this, 'getBaseUrl']),
            new TwigFunction('getBreadcrumbs', [$this, 'getBreadcrumbs']),
            new TwigFunction('getMegaMenuItems', [$this, 'getMegaMenuItems']),
        ];
    }

    //FUNCTIONS
    public function getImageUrl(?string $imageName)
    {
        return $_ENV['VICH_URI_PREFIX'] . '/' . $imageName;
    }

    public function getBaseUrl()
    {
        return $_ENV['BASE_URL'];
    }

    public function getBreadcrumbs()
    {
        return BreadcrumbsManager::getBreadcrumbs();
    }

    public function getMegaMenuItems()
    {
        return $this->entityManager->getRepository(HeaderMenuItem::class)->findByIsActive(true);
    }

    //FILTERS
}