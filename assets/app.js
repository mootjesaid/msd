import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import { Application } from '@hotwired/stimulus';
import './styles/app.css';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css'
import SidebarController from './controllers/sidebar_controller.js';

const app = Application.start();
app.register('sidebar', SidebarController);


