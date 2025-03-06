// assets/controllers/calendar_controller.js
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static values = {
        eventsUrl: String
    }

    connect() {
        this.initializeCalendar();
    }

    initializeCalendar() {
        const calendarEl = this.element;

        const calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'nl',
            initialView: 'timeGridWeek',
            editable: false,
            eventSources: [
                {
                    url: this.eventsUrlValue,
                    method: 'POST',
                    extraParams: {
                        filters: JSON.stringify({})
                    },
                    failure: () => {
                        // alert('There was an error while fetching FullCalendar!');
                    },
                },
            ],
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'today timeGridWeek,timeGridDay',
            },
            timeZone: 'Europe/Amsterdam',
            windowResize: () => calendar.updateSize(),

            viewDidMount: (info) => {
                // Apply base Flowbite/Tailwind classes to the calendar container
                calendarEl.classList.add('w-full', 'overflow-x-auto', 'shadow-sm', 'rounded-lg');

                // Style the toolbar header
                const calendarHeader = document.querySelector('.fc-toolbar');
                if (calendarHeader) {
                    calendarHeader.classList.add('w-full', 'flex', 'flex-col', 'p-2', 'gap-2');
                }

                // First row: prev/next buttons and date
                const headerLeft = document.querySelector('.fc-toolbar-chunk:first-child');
                const headerCenter = document.querySelector('.fc-toolbar-chunk:nth-child(2)');

                if (headerLeft && headerCenter) {
                    // Create first row container
                    const firstRow = document.createElement('div');
                    firstRow.classList.add('flex', 'w-full', 'justify-between', 'items-center', 'mb-2');

                    // Style navigation buttons container
                    headerLeft.classList.add('flex', 'gap-1');
                    firstRow.appendChild(headerLeft);

                    // Style title container
                    headerCenter.classList.add('flex');
                    firstRow.appendChild(headerCenter);

                    // Add first row to the header
                    calendarHeader.insertBefore(firstRow, calendarHeader.firstChild);
                }

                /// Second row: today and view buttons
                const headerRight = document.querySelector('.fc-toolbar-chunk:last-child');

                if (headerRight) {
                    // Create second row container
                    const secondRow = document.createElement('div');
                    secondRow.classList.add('flex', 'w-full', 'justify-between', 'items-center');

                    // Extract today button and view buttons
                    const todayButton = headerRight.querySelector('.fc-today-button');
                    const viewButtons = headerRight.querySelector('.fc-button-group');

                    if (todayButton && viewButtons) {
                        // Today button container
                        const leftSide = document.createElement('div');
                        leftSide.classList.add('flex');
                        leftSide.appendChild(todayButton.cloneNode(true));
                        secondRow.appendChild(leftSide);

                        // View buttons container
                        const rightSide = document.createElement('div');
                        rightSide.classList.add('flex');
                        rightSide.appendChild(viewButtons.cloneNode(true));
                        secondRow.appendChild(rightSide);

                        // Replace original right section with our new row
                        headerRight.parentNode.replaceChild(secondRow, headerRight);

                        // Re-attach event listeners
                        calendar.render();
                    }
                }

                // Apply Flowbite-compatible button styles
                const navButtons = document.querySelectorAll('.fc-prev-button, .fc-next-button');
                navButtons.forEach(button => {
                    button.classList.add(
                        'text-xs', 'sm:text-sm', 'md:text-base', 'lg:text-lg',
                        'px-2', 'sm:px-3', 'md:px-4', 'lg:px-5',
                        'py-1', 'sm:py-1.5', 'md:py-2',
                        'font-medium',
                        'rounded-lg',
                        'transition-colors'
                    );
                });

// Today button
                const todayButton = document.querySelector('.fc-today-button');
                if (todayButton) {
                    todayButton.classList.add(
                        'text-xs', 'sm:text-sm', 'md:text-base', 'lg:text-lg',
                        'px-2', 'sm:px-3', 'md:px-4', 'lg:px-5',
                        'py-1', 'sm:py-1.5', 'md:py-2',
                        'font-medium',
                        'rounded-lg',
                        'transition-colors'
                    );
                }

// View buttons (day/week/month)
                const viewButtons = document.querySelectorAll('.fc-button-group button');
                viewButtons.forEach(button => {
                    button.classList.add(
                        'text-xs', 'sm:text-sm', 'md:text-base', 'lg:text-lg',
                        'px-2', 'sm:px-3', 'md:px-4', 'lg:px-5',
                        'py-1', 'sm:py-1.5', 'md:py-2',
                        'font-medium',
                        'transition-colors'
                    );
                });

// Apply responsive typography to the calendar title
                const calendarTitle = document.querySelector('.fc-toolbar-title');
                if (calendarTitle) {
                    calendarTitle.classList.add(
                        'text-base', 'sm:text-lg', 'md:text-xl', 'lg:text-2xl',
                        'font-semibold',
                        'text-center',
                        'text-gray-900', 'dark:text-white'
                    );
                }

// Style day numbers
                const dayNumbers = document.querySelectorAll('.fc-daygrid-day-number');
                dayNumbers.forEach(el => {
                    el.classList.add(
                        'text-xs', 'sm:text-sm', 'md:text-base', 'lg:text-lg', 'xl:text-xl', // Adjust font size for larger screens
                        'font-medium'
                    );
                });

// Style day headers
                const dayHeaders = document.querySelectorAll('.fc-col-header-cell-cushion');
                dayHeaders.forEach(el => {
                    el.classList.add(
                        'text-xs', 'sm:text-sm', 'md:text-base', 'lg:text-lg', 'xl:text-xl', // Adjust font size for larger screens
                        'font-medium'
                    );
                });


// Style button groups to have proper Flowbite appearance
                const buttonGroups = document.querySelectorAll('.fc-button-group');
                buttonGroups.forEach(group => {
                    group.classList.add('inline-flex', 'rounded-md', 'shadow-sm');
                });

            }
        });

        calendar.render();
    }
}
