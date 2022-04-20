<?php
//
//namespace App\Entity;
//
//use App\Entity\Traits\BlamableTrait;
//use App\Entity\Traits\IsActiveTrait;
//use App\Entity\Traits\SlugTrait;
//use App\Entity\Traits\TimestampableTrait;
//use App\Repository\JobRepository;
//use Doctrine\ORM\Mapping as ORM;
//
///**
// * @ORM\Entity(repositoryClass=JobRepository::class)
// * @ORM\HasLifecycleCallbacks()
// */
//class Job
//{
//    use TimestampableTrait;
//    use BlamableTrait;
//    use IsActiveTrait;
//    use SlugTrait;
//
//    /**
//     * @ORM\Id
//     * @ORM\GeneratedValue
//     * @ORM\Column(type="integer")
//     */
//    private $id;
//
//    /**
//     * @ORM\Column(type="string", length=255)
//     */
//    private $title;
//
//    /**
//     * @ORM\Column(type="string", length=255)
//     */
//    private $description;
//
//    /**
//     * @ORM\ManyToOne(targetEntity=Business::class, inversedBy="jobs")
//     * @ORM\JoinColumn(nullable=false)
//     */
//    private $business;
//
//    public function getId(): ?int
//    {
//        return $this->id;
//    }
//
//    public function getTitle(): ?string
//    {
//        return $this->title;
//    }
//
//    public function setTitle(string $title): self
//    {
//        $this->title = $title;
//
//        return $this;
//    }
//
//    public function getDescription(): ?string
//    {
//        return $this->description;
//    }
//
//    public function setDescription(string $description): self
//    {
//        $this->description = $description;
//
//        return $this;
//    }
//
//    public function getBusiness(): ?Business
//    {
//        return $this->business;
//    }
//
//    public function setBusiness(?Business $business): self
//    {
//        $this->business = $business;
//
//        return $this;
//    }
//}
