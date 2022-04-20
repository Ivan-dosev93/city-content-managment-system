<?php

namespace App\Entity;

use App\Repository\InternalLinkRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InternalLinkRepository::class)
 */
class InternalLink
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $absoluteUrl;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAbsoluteUrl(): ?string
    {
        return $this->absoluteUrl;
    }

    public function setAbsoluteUrl(string $absoluteUrl): self
    {
        $this->absoluteUrl = $absoluteUrl;

        return $this;
    }

    public function __toString():string
    {
        return $this->absoluteUrl;
    }


}
