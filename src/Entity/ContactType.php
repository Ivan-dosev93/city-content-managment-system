<?php

namespace App\Entity;

use App\Entity\Constants\RouteConstants;
use App\Entity\Interfaces\EntityBaseURLInterface;
use App\Entity\Traits\SlugTrait;
use App\Repository\ContactTypeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactTypeRepository::class)
 */
class ContactType implements EntityBaseURLInterface
{
    use SlugTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    function getEntityBaseUrl()
    {
        return $_ENV['base_url'].RouteConstants::CONTACT_ROUTE;
    }

    public function __toString():string
    {
        return $this->name;
    }
}
