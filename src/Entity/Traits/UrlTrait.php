<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\InternalLink;

trait UrlTrait
{
    /**
     * @ORM\ManyToOne(targetEntity=InternalLink::class)
     */
    private $internalLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $externalLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlText;

    public function getUrl(): ?string
    {
        if ($this->getInternalLink())
            return $this->getInternalLink()->getAbsoluteUrl();
        elseif ($this->getExternalLink() != null)
            return $this->getExternalLink();
        else
            return $_ENV['BASE_URL'];
    }

    public function getUrlText(): ?string
    {
        return $this->urlText;
    }

    public function setUrlText(?string $urlText): self
    {
        $this->urlText = $urlText;

        return $this;
    }

    public function getInternalLink(): ?InternalLink
    {
        return $this->internalLink;
    }

    public function setInternalLink(?InternalLink $internalLink): self
    {
        $this->internalLink = $internalLink;

        return $this;
    }

    public function getExternalLink(): ?string
    {
        return $this->externalLink;
    }

    public function setExternalLink(?string $externalLink): self
    {
        $this->externalLink = $externalLink;

        return $this;
    }
}
