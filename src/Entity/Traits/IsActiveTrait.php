<?php
namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait IsActiveTrait
{
    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive = true;

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}
