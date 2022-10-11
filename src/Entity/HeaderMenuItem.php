<?php

namespace App\Entity;

use App\Entity\Traits\BlamableTrait;
use App\Entity\Traits\IsActiveTrait;
use App\Entity\Traits\TimestampableTrait;
use App\Entity\Traits\UrlTrait;
use App\Repository\HeaderMenuItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HeaderMenuItemRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class HeaderMenuItem
{
    use UrlTrait;
    use TimestampableTrait;
    use BlamableTrait;
    use IsActiveTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $faIcon;

    /**
     * @ORM\ManyToOne(targetEntity=HeaderMenuItem::class, inversedBy="headerMenuItems")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=HeaderMenuItem::class, mappedBy="parent")
     */
    private $headerMenuItems;

    public function __construct()
    {
        $this->headerMenuItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFaIcon(): ?string
    {
        return $this->faIcon;
    }

    public function setFaIcon(string $faIcon): self
    {
        $this->faIcon = $faIcon;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getHeaderMenuItems(): Collection
    {
        return $this->headerMenuItems;
    }

    /**
     * @return Collection|self[]
     */
    public function getActiveHeaderMenuItems(): array
    {
        $items = [];
        foreach ($this->headerMenuItems as $headerMenuItem) {
            if ($headerMenuItem->getIsActive())
                $items[] = $headerMenuItem;
        }
        return $items;
    }

    public function addHeaderMenuItem(self $headerMenuItem): self
    {
        if (!$this->headerMenuItems->contains($headerMenuItem)) {
            $this->headerMenuItems[] = $headerMenuItem;
            $headerMenuItem->setParent($this);
        }

        return $this;
    }

    public function removeHeaderMenuItem(self $headerMenuItem): self
    {
        if ($this->headerMenuItems->removeElement($headerMenuItem)) {
            // set the owning side to null (unless already changed)
            if ($headerMenuItem->getParent() === $this) {
                $headerMenuItem->setParent(null);
            }
        }

        return $this;
    }

    public function __toString(): ?string
    {
        if($this->getUrlText())
            return $this->getUrlText();
        return "";
    }
}
