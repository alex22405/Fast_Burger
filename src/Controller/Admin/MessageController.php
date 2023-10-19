<?php

namespace App\Controller\Admin;

use App\Entity\Message;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessageController extends AbstractController
{
    #[Route('/admin/messages', name: 'admin_messages')]
    public function listMessages(EntityManagerInterface $entityManager): Response
    {
        $messages = $entityManager->getRepository(Message::class)->findBy([], ['createdAt' => 'DESC']);;

        return $this->render('admin/messages/index.html.twig', [
            'messages' => $messages,
        ]);
    }
}