import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['nav']; // Target the sidebar element

    toggleSidebar() {
        const nav = this.navTarget;

        // Add the class to show the sidebar
        nav.classList.add('sidebar-open');
    }

}