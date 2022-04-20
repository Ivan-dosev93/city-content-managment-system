<?php

namespace App\Entity;

use App\Entity\Constants\RouteConstants;
use App\Entity\Interfaces\EntityBaseURLInterface;
use App\Entity\Traits\BlamableTrait;
use App\Entity\Traits\ImageTrait;
use App\Entity\Traits\IsActiveTrait;
use App\Entity\Traits\SlugTrait;
use App\Entity\Traits\TimestampableTrait;
use App\Repository\BusinessRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=BusinessRepository::class)
 * @Vich\Uploadable()
 * @ORM\HasLifecycleCallbacks()
 */
class Business implements EntityBaseURLInterface
{
    use TimestampableTrait;
    use BlamableTrait;
    use ImageTrait;
    use IsActiveTrait;
    use SlugTrait;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $thumbnail1;

    /**
     * @Vich\UploadableField(mapping="thumbnails", fileNameProperty="thumbnail1")
     */

    private $thumbnailFile1;
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */

    private $thumbnail2;

    /**
     * @Vich\UploadableField(mapping="thumbnails", fileNameProperty="thumbnail2")
     */
    private $thumbnailFile2;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $thumbnail3;

    /**
     * @Vich\UploadableField(mapping="thumbnails", fileNameProperty="thumbnail3")
     */
    private $thumbnailFile3;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $thumbnail4;

    /**
     * @Vich\UploadableField(mapping="thumbnails", fileNameProperty="thumbnail4")
     */
    private $thumbnailFile4;

    /**
     * @return mixed
     */
    public function getThumbnail1()
    {
        return $this->thumbnail1;
    }

    /**
     * @param mixed $thumbnail
     */
    public function setThumbnail1($thumbnail): void
    {
        $this->thumbnail1 = $thumbnail;
    }

    /**
     * @return mixed
     */
    public function getThumbnailFile1()
    {
        return $this->thumbnailFile1;
    }

    /**
     * @param mixed $thumbnailFile1
     */
    public function setThumbnailFile1($thumbnailFile): void
    {
        $this->thumbnailFile1 = $thumbnailFile;
    }

    /**
     * @return mixed
     */
    public function getThumbnail2()
    {
        return $this->thumbnail2;
    }

    /**
     * @param mixed $thumbnail2
     * @return Business
     */
    public function setThumbnail2($thumbnail2)
    {
        $this->thumbnail2 = $thumbnail2;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumbnailFile2()
    {
        return $this->thumbnailFile2;
    }

    /**
     * @param mixed $thumbnailFile2
     * @return Business
     */
    public function setThumbnailFile2($thumbnailFile2)
    {
        $this->thumbnailFile2 = $thumbnailFile2;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumbnail3()
    {
        return $this->thumbnail3;
    }

    /**
     * @param mixed $thumbnail3
     * @return Business
     */
    public function setThumbnail3($thumbnail3)
    {
        $this->thumbnail3 = $thumbnail3;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumbnailFile3()
    {
        return $this->thumbnailFile3;
    }

    /**
     * @param mixed $thumbnailFile3
     * @return Business
     */
    public function setThumbnailFile3($thumbnailFile3)
    {
        $this->thumbnailFile3 = $thumbnailFile3;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumbnail4()
    {
        return $this->thumbnail4;
    }

    /**
     * @param mixed $thumbnail4
     * @return Business
     */
    public function setThumbnail4($thumbnail4)
    {
        $this->thumbnail4 = $thumbnail4;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumbnailFile4()
    {
        return $this->thumbnailFile4;
    }

    /**
     * @param mixed $thumbnailFile4
     * @return Business
     */
    public function setThumbnailFile4($thumbnailFile4)
    {
        $this->thumbnailFile4 = $thumbnailFile4;
        return $this;
    }

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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $googleMapIframe;
//
//    /**
//     * @ORM\OneToMany(targetEntity=Job::class, mappedBy="business", orphanRemoval=true)
//     */
//    private $jobs;

    public function __construct()
    {
//        $this->jobs = new ArrayCollection();
    }

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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

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

//    /**
//     * @return Collection|Job[]
//     */
//    public function getJobs(): Collection
//    {
//        return $this->jobs;
//    }
//
//    public function addJob(Job $job): self
//    {
//        if (!$this->jobs->contains($job)) {
//            $this->jobs[] = $job;
//            $job->setBusiness($this);
//        }
//
//        return $this;
//    }
//
//    public function removeJob(Job $job): self
//    {
//        if ($this->jobs->removeElement($job)) {
//            // set the owning side to null (unless already changed)
//            if ($job->getBusiness() === $this) {
//                $job->setBusiness(null);
//            }
//        }
//
//        return $this;
//    }

    public function getGoogleMapIframe(): ?string
    {
        return $this->googleMapIframe;
    }

    public function setGoogleMapIframe(?string $googleMapIframe): self
    {
        $this->googleMapIframe = $googleMapIframe;

        return $this;
    }

    function getEntityBaseUrl()
    {
        return $_ENV['BASE_URL'].RouteConstants::BUSINESS_ROUTE;
    }
}
