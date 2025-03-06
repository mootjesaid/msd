<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    '@hotwired/turbo' => [
        'version' => '7.3.0',
    ],
    'bootstrap' => [
        'version' => '5.3.3',
    ],
    '@popperjs/core' => [
        'version' => '2.11.8',
    ],
    'bootstrap/dist/css/bootstrap.min.css' => [
        'version' => '5.3.3',
        'type' => 'css',
    ],
    'flowbite' => [
        'version' => '3.1.2',
    ],
    'flowbite-datepicker' => [
        'version' => '1.3.2',
    ],
    '@symfony/ux-live-component' => [
        'path' => './vendor/symfony/ux-live-component/assets/dist/live_controller.js',
    ],
    'stimulus-use' => [
        'version' => '0.52.3',
    ],
    '@fullcalendar/core' => [
        'version' => '6.1.15',
    ],
    'preact' => [
        'version' => '10.12.1',
    ],
    'preact/compat' => [
        'version' => '10.12.1',
    ],
    'preact/hooks' => [
        'version' => '10.12.1',
    ],
    '@fullcalendar/daygrid' => [
        'version' => '6.1.15',
    ],
    '@fullcalendar/core/index.js' => [
        'version' => '6.1.15',
    ],
    '@fullcalendar/core/internal.js' => [
        'version' => '6.1.15',
    ],
    '@fullcalendar/core/preact.js' => [
        'version' => '6.1.15',
    ],
    '@fullcalendar/timegrid' => [
        'version' => '6.1.15',
    ],
    '@fullcalendar/daygrid/internal.js' => [
        'version' => '6.1.15',
    ],
    'fullcalendar' => [
        'version' => '6.1.15',
    ],
    '@fullcalendar/interaction/index.js' => [
        'version' => '6.1.15',
    ],
    '@fullcalendar/daygrid/index.js' => [
        'version' => '6.1.15',
    ],
    '@fullcalendar/timegrid/index.js' => [
        'version' => '6.1.15',
    ],
    '@fullcalendar/list/index.js' => [
        'version' => '6.1.15',
    ],
    '@fullcalendar/multimonth/index.js' => [
        'version' => '6.1.15',
    ],
];
