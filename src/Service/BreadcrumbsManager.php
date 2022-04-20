<?php

namespace App\Service;


use App\Entity\Containers\Breadcrumb;

class BreadcrumbsManager
{
    private static $breadcrumbs = [];

    public static function addBreadcrumb(string $text, ?string $route)
    {
        $breadcrumb =  new Breadcrumb();
        $breadcrumb->setText($text);
        $breadcrumb->setRoute($route);
        self::$breadcrumbs[] = $breadcrumb;
    }

    public static function getBreadcrumbs()
    {
        return self::$breadcrumbs;
    }
}
