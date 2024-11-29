<?php

namespace App\Controller;

use App\Repository\ReminderRepository;
use DateTimeZone;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ReminderRepository $reminderRepository): Response
    {
        $reminders = $reminderRepository->findAll();
        $today = new \DateTimeImmutable("today");
        $todayReminders = [];
        $otherReminders = [];

        foreach ($reminders as $reminder) {
            if (!$reminder->getEventDate() || ($reminder->getEventDate() >= $today && $reminder->getEventDate() < $today->modify('+1 day'))) {
                $todayReminders[] = $reminder; // Rappels sans date ou du jour
            } else {
                $otherReminders[] = $reminder; // Autres rappels
            }
        }

        usort($todayReminders, fn($a, $b) => $a->getEventDate() <=> $b->getEventDate());
        usort($otherReminders, fn($a, $b) => $a->getEventDate() <=> $b->getEventDate());

        // dd($now, $todayReminders);

        return $this->render('home/index.html.twig', [
            'todayReminders' => $todayReminders,
            'otherReminders' => $otherReminders
        ]);
    }
}
