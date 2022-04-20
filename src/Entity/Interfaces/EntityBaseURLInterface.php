<?php


namespace App\Entity\Interfaces;

use App\Entity\InternalLink;

/**
 * Interface EntityBaseURLInterface
 * @package App\Entity\Interfaces
 * Use with SlugTrait
 */
interface EntityBaseURLInterface
{
    function getEntityBaseUrl();

    function getSlug();

    function setSlug(string $slug);

    function getSelfUrl();

    function setSelfUrl(InternalLink $internalLink);
}