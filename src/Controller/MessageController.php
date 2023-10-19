<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessageController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $manager, MailerInterface $mailer): Response
    {
        $message = new Message();
        $form = $this->createForm(ContactType::class, $message);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $adress = $contact->getEmail();
            $subject = $contact->getSubject();
            $content = $contact->getMessage();

            $manager->persist($contact);
            $manager->flush();

            // Email
            $email = (new Email())
            ->from($adress)
            ->to('lesmerveillesdediane@gmail.com')
            ->subject($subject)
            ->text($content)
            ->html('<p>See Twig integration for better HTML integration!</p>');

            $mailer->send($email);

            $this->addFlash(
                'success',
                'Votre message a été envoyé avec succès !'
            );

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'MessageController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/message/{id}/delete', name: 'app_message_delete')]
    public function delete(Message $message, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($message);
        $entityManager->flush();

        $this->addFlash('success', 'Le message a été supprimé avec succès.');

        return $this->redirectToRoute('admin_messages');
    }
}
