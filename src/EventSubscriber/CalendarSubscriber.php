<?php

namespace App\EventSubscriber;

use App\Repository\RoomReservationRepository;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\SetDataEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly RoomReservationRepository $roomReservationRepository,
        private readonly UrlGeneratorInterface $router
    ) {}

    public static function getSubscribedEvents()
    {
        return [
            SetDataEvent::class => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(SetDataEvent $setDataEvent)
    {
        $start = $setDataEvent->getStart();
        $end = $setDataEvent->getEnd();
        $filters = $setDataEvent->getFilters();

        // Modify the query to fit your entity and needs
        $bookings = $this->roomReservationRepository
            ->createQueryBuilder('booking')
            ->where('booking.beginAt BETWEEN :start and :end OR booking.endAt BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult()
        ;

        // Apple-like color scheme (soft pastel colors with light opacity)
        $appleEventColors = [
            'rgba(96, 164, 255, 0.3)', // Light blue, Apple's event
            'rgba(255, 153, 51, 0.3)', // Light orange
            'rgba(85, 179, 104, 0.3)', // Light green
            'rgba(255, 159, 255, 0.3)', // Light pink
            'rgba(255, 204, 0, 0.3)',   // Light yellow
        ];

        foreach ($bookings as $booking) {
            // Create the event with the booking data
            $bookingEvent = new Event(
                $booking->getPerson()->getFullName(),
                $booking->getTitle(),
                $booking->getBeginAt(),
                $booking->getEndAt() // If the end date is null or not defined, an all-day event is created.
            );

            // Randomly pick a color from the Apple-like color scheme
            $randomColor = $appleEventColors[array_rand($appleEventColors)];

            // Set the random background color for the event
            $bookingEvent->setOptions([
                'backgroundColor' => $randomColor, // Apply the random Apple-like color
                'borderColor' => $randomColor,
                ]);

            // Add a link to the event
            $bookingEvent->addOption(
                'url',
                $this->router->generate('app_admin_dashboard', [
                    'id' => $booking->getId(),
                ])
            );

            // Add the event to the calendar
            $setDataEvent->addEvent($bookingEvent);
        }
    }

}