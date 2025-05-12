import { Controller } from '@hotwired/stimulus';
import dayjs from '/dayjs';
import '/dayjs/locale/nl';

dayjs.locale('nl');

export default class extends Controller {
    static values = {
        eventsUrl: String
    }

    connect() {
        this.loadEvents();
    }

    async loadEvents() {
        try {
            const response = await fetch(this.eventsUrlValue, { method: 'POST' });
            const events = await response.json();
            this.renderAgenda(events);
        } catch (error) {
            console.error('Error loading events:', error);
        }
    }

    renderAgenda(events) {
        const container = this.element;
        container.innerHTML = '';

        const days = this.getUpcomingDays(7);

        days.forEach(date => {
            const eventsForDay = events.filter(event => dayjs(event.start).isSame(date, 'day'));

            const dayElement = document.createElement('div');
            dayElement.classList.add('mb-4', 'p-4', 'bg-white', 'dark:bg-gray-800', 'rounded-lg', 'shadow');

            // Header with date
            const header = document.createElement('div');
            header.classList.add('font-bold', 'text-lg', 'mb-2');
            header.textContent = dayjs(date).format('dd D');

            dayElement.appendChild(header);

            // Events list
            if (eventsForDay.length > 0) {
                eventsForDay.forEach(event => {
                    const eventEl = document.createElement('div');
                    eventEl.classList.add('p-2', 'border', 'rounded', 'mb-2', 'bg-gray-100', 'dark:bg-gray-700');
                    eventEl.textContent = `${dayjs(event.start).format('HH:mm')} - ${event.title}`;
                    dayElement.appendChild(eventEl);
                });
            } else {
                const noEvents = document.createElement('div');
                noEvents.classList.add('text-gray-500', 'italic');
                noEvents.textContent = 'Geen vergaderingen';
                dayElement.appendChild(noEvents);
            }

            container.appendChild(dayElement);
        });
    }

    getUpcomingDays(count) {
        return Array.from({ length: count }, (_, i) => dayjs().add(i, 'day').format('YYYY-MM-DD'));
    }
}
