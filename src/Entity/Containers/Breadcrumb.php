<?php

namespace App\Entity\Containers;

class Breadcrumb
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $route;

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getRoute(): ?string
    {
        return $this->route;
    }

    /**
     * @param string $route
     */
    public function setRoute(?string $route): void
    {
        $this->route = $route;
    }
}
