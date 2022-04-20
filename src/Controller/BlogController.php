<?php

namespace App\Controller;

use App\Entity\BlogCategory;
use App\Entity\BlogPost;
use App\Service\BreadcrumbsManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController
 * @package App\Controller
 * @Route("/blog")
 * IF change ROUTE go and change it and in RouteConstants file.
 */
class BlogController extends BaseController
{
    /**
     * @Route("/{category}", name="blog_category_view")
     * @ParamConverter("category", options={"mapping": {"category" : "slug"}})
     */
    public function viewCategoryAction(BlogCategory $category): Response
    {
        $posts = $this->manager->getRepository(BlogPost::class)->findByCategory($category);

        BreadcrumbsManager::addBreadcrumb($category->getName(), null);

        return $this->render('blog/category_view.html.twig', [
            'controller_name' => 'BlogController',
            'posts' => $posts,
            'category' => $category,
        ]);
    }

    /**
     * @Route("/{category}/{post}", name="blog_post_view")
     * @ParamConverter("category", options={"mapping": {"category" : "slug"}})
     * @ParamConverter("post", options={"mapping":{"post" : "slug"}})
     */
    public function viewPostAction(BlogCategory $category, BlogPost $post): Response
    {
        BreadcrumbsManager::addBreadcrumb($category->getName(), $this->generateUrl('blog_category_view', ['category'=>$category->getSlug()]));
        BreadcrumbsManager::addBreadcrumb($post->getTitle(), null);

        return $this->render('blog/post_view.html.twig', [
            'controller_name' => 'BlogController',
            'post' => $post,
        ]);
    }
}
