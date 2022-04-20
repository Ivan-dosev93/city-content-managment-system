<?php

namespace App\Entity;

use App\Entity\Traits\BlamableTrait;
use App\Entity\Traits\ImageTrait;
use App\Entity\Traits\IsActiveTrait;
use App\Entity\Traits\TimestampableTrait;
use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 * @Vich\Uploadable()
 * @ORM\HasLifecycleCallbacks()
 */
class Contact
{
    use TimestampableTrait;
    use ImageTrait;
    use IsActiveTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="Моля въведете валитен email адрес.")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     min=10,
     *     max=255,
     *     minMessage="Заглавието трябва да е по-дълго от 10 символа",
     *     maxMessage="Заглавието трябва да е по-късо от 255 символа"))
     */
    private $title;

    /**
     * @ORM\Column(type="text", length=2000)
     * @Assert\Length(
     *     min=10,
     *     max=255,
     *     minMessage="Текста трябва да е по-дълъг от 10 символа",
     *     maxMessage="Текста трябва да е по-къс от 255 символа"))
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=ContactType::class)
     */
    private $contactType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $names;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getContactType(): ?ContactType
    {
        return $this->contactType;
    }

    public function setContactType(?ContactType $contactType): self
    {
        $this->contactType = $contactType;

        return $this;
    }

    public function getNames(): ?string
    {
        return $this->names;
    }

    public function setNames(string $names): self
    {
        $this->names = $names;

        return $this;
    }
}
