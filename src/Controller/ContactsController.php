<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\BreadcrumbsManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController
 * @package App\Controller
 * @Route("/contacts")
 */
class ContactsController extends BaseController
{
    /**
     * @Route("/{slug}", name="contacts_action")
     */
    public function contactAction(Request $request, \App\Entity\ContactType $contactType): Response
    {
        $contact = new Contact();
        $contact->setContactType($contactType);

        BreadcrumbsManager::addBreadcrumb($contactType->getName(), null);

        $form = $this->createForm(ContactType::class, $contact, []);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $contact->setIsActive(false);
            $this->manager->persist($contact);
            $this->manager->flush();
            $this->addFlash('success', "Успешно изпратихте " . $contactType->getName() . ". Ще получите отговор в най-скоро време.");

            return $this->redirectToRoute('contacts_action', ['slug' => $contactType->getSlug()]);
        }

        return $this->render('contacts/contacts.html.twig', [
            'controller_name' => 'ContactsController',
            'form' => $form->createView(),
            'contactType' => $contactType,
        ]);
    }

}
