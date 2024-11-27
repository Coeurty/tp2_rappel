<?php

namespace App\Controller;

use App\Repository\ReminderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ReminderRepository $reminderRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'reminders' => $reminderRepository->findAll(),
        ]);
    }
}
