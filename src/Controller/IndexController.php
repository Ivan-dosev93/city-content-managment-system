<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Entity\Business;
use App\Entity\HomepageSlider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends BaseController
{
    /**
     * @Route("", name="index")
     * IF change ROUTE go and change it and in RouteConstants file.
     */
    public function index(): Response
    {
        $sliderItems = $this->manager->getRepository(HomepageSlider::class)->findByIsActive(true);
        $posts = $this->manager->getRepository(BlogPost::class)->findBy(['isActive' => true], ['createdAt' => 'DESC'], 5, 0);
        $businesses = $this->manager->getRepository(Business::class)->findBy(['isActive' => true], ['createdAt' => 'DESC'], 5, 0);

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'sliderItems' => $sliderItems,
            'posts' => $posts,
            'businesses' => $businesses,
        ]);
    }
}
