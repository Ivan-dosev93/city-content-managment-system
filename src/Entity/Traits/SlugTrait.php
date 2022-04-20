<?php
namespace App\Entity\Traits;

use App\Entity\InternalLink;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait SlugTrait
 * @package App\Entity\Traits
 * Use it in combination with EntityBaseURLInterface. And in SlugSubscriber you can modify links.
 */
trait SlugTrait
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToOne(targetEntity=InternalLink::class, cascade={"persist", "remove"})
     */
    private $selfUrl;

    public function getSelfUrl(): ?InternalLink
    {
        return $this->selfUrl;
    }

    public function setSelfUrl(?InternalLink $selfUrl): self
    {
        $this->selfUrl = $selfUrl;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
