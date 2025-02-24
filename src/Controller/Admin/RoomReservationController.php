<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RoomReservationController extends AbstractController
{
    #[Route('/admin/room/reservation', name: 'app_admin_room_reservation')]
    public function index(): Response
    {
        return $this->render('admin/room_reservation/index.html.twig', [
            'controller_name' => 'RoomReservationController',
        ]);
    }
}
