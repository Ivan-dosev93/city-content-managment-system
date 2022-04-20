<?php

namespace App\Entity;

use App\Entity\Interfaces\EntityBaseURLInterface;
use App\Entity\Traits\BlamableTrait;
use App\Entity\Traits\ImageTrait;
use App\Entity\Traits\IsActiveTrait;
use App\Entity\Traits\SlugTrait;
use App\Entity\Traits\TimestampableTrait;
use App\Repository\BlogPostRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=BlogPostRepository::class)
 * @Vich\Uploadable()
 * @ORM\HasLifecycleCallbacks()
 */
class BlogPost implements EntityBaseURLInterface
{
    use TimestampableTrait;
    use BlamableTrait;
    use ImageTrait;
    use SlugTrait;
    use IsActiveTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=BlogCategory::class, inversedBy="blogPosts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCategory(): ?BlogCategory
    {
        return $this->category;
    }

    public function setCategory(?BlogCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function __toString(): string
    {
        return $this->title;
    }

    function getEntityBaseUrl()
    {
        if ($this->getCategory() && $this->getCategory()->getSelfUrl())
            return $this->getCategory()->getSelfUrl()->getAbsoluteUrl().'/';
        return $_ENV['base_url'];
    }
}
