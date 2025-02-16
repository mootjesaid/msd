<?php

namespace App\Controller\Admin;

use App\Entity\EventRoom;
use App\Form\EventRoomType;
use App\Repository\EventRoomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/event/room')]
final class EventRoomController extends AbstractController
{
    #[Route('/', name: 'app_admin_event_room')]
    public function index(EventRoomRepository $eventRoomRepository): Response
    {
        return $this->render('admin/event_room/index.html.twig', [
            'event_rooms' => $eventRoomRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_event_room_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $eventRoom = new EventRoom();
        $form = $this->createEventRoomForm($eventRoom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($eventRoom);
            $entityManager->flush();

            $this->addFlash('success', 'Bon voyage!');

            if ($request->headers->has('turbo-frame')) {
                $stream = $this->renderBlockView('admin/event_room/new.html.twig', 'stream_success', [
                    'event_room' => $eventRoom
                ]);

                $this->addFlash('stream', $stream);
            }

            return $this->redirectToRoute('app_admin_event_room', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/event_room/new.html.twig', [
            'entity' => $eventRoom,
            'form' => $form,
        ]);
    }
    #[Route('/edit/{id}', name: 'app_admin_event_room_edit')]
    public function edit(Request $request, EventRoom $eventRoom, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createEventRoomForm($eventRoom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'EventRoom updated!');
            if ($request->headers->has('turbo-frame')) {
                $stream = $this->renderBlockView('admin/event_room/edit.html.twig', 'stream_success', [
                    'event_room' => $eventRoom
                ]);

                $this->addFlash('stream', $stream);
            }

            return $this->redirectToRoute('app_admin_event_room_edit', ['id' => $eventRoom->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/event_room/edit.html.twig', [
            'form' => $form,
            'entity' => $eventRoom
        ]);
    }


    #[Route('/{id}', name: 'app_admin_event_room_delete', methods: ['POST'])]
    public function delete(Request $request, EventRoom $eventRoom, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eventRoom->getId(), $request->request->get('_token'))) {
            $id = $eventRoom->getId();
            $entityManager->remove($eventRoom);
            $entityManager->flush();

            $this->addFlash('success', 'EventRoom deleted!');

            if ($request->headers->has('turbo-frame')) {
                $stream = $this->renderBlockView('admin/delete.html.twig', 'success_stream', [
                    'id' => $id,
                    'entity' => $eventRoom
                ]);

                $this->addFlash('stream', $stream);
            }
        }

        return $this->redirectToRoute('app_admin_event_room', [], Response::HTTP_SEE_OTHER);
    }

    private function createEventRoomForm(EventRoom $eventRoom = null): FormInterface
    {
        $eventRoom = $eventRoom ?? new EventRoom();

        return $this->createForm(EventRoomType::class, $eventRoom, [
            'action' => $eventRoom->getId() ? $this->generateUrl('app_admin_event_room_edit', ['id' => $eventRoom->getId()]) : $this->generateUrl('app_admin_event_room_new'),
        ]);
    }
}
