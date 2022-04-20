<?php

namespace App\Controller;

use App\Entity\BlogCategory;
use App\Entity\BlogPost;
use App\Entity\Business;
use App\Service\BreadcrumbsManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BusinessController
 * @package App\Controller
 * @Route("/business")
 * IF change ROUTE go and change it and in RouteConstants file.
 */
class BusinessController extends BaseController
{
    /**
     * @Route("/list", name="business_list")
     */
    public function businessListAction(): Response
    {
        $businesses = $this->manager->getRepository(Business::class)->findBy(['isActive' => true], ['createdAt' => 'ASC']);

        BreadcrumbsManager::addBreadcrumb("Бизнеси", null);

        return $this->render('business/business_list.html.twig', [
            'controller_name' => 'BusinessController',
            'businesses' => $businesses,
        ]);
    }

    /**
     * @Route("/{slug}", name="business_view")
     */
    public function viewBusinessAction(Business $business): Response
    {
        BreadcrumbsManager::addBreadcrumb("Бизнеси", $this->generateUrl('business_list', []));
        BreadcrumbsManager::addBreadcrumb($business->getName(), null);

        $business->setGoogleMapIframe(htmlspecialchars_decode($business->getGoogleMapIframe()));

        return $this->render('business/business_view.html.twig', [
            'controller_name' => 'BusinessController',
            'business' => $business,
        ]);
    }
}
