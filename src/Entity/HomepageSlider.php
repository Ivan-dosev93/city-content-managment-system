<?php

namespace App\Entity;

use App\Entity\Traits\BlamableTrait;
use App\Entity\Traits\ImageTrait;
use App\Entity\Traits\IsActiveTrait;
use App\Entity\Traits\TimestampableTrait;
use App\Entity\Traits\UrlTrait;
use App\Repository\HomepageSliderRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=HomepageSliderRepository::class)
 * @Vich\Uploadable()
 * @ORM\HasLifecycleCallbacks()
 */
class HomepageSlider
{
    use TimestampableTrait;
    use BlamableTrait;
    use ImageTrait;
    use IsActiveTrait;
    use UrlTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heading;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHeading(): ?string
    {
        return $this->heading;
    }

    public function setHeading(?string $heading): self
    {
        $this->heading = $heading;

        return $this;
    }
}
