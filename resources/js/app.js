import './bootstrap';

import { createIcons } from 'lucide';

document.addEventListener('DOMContentLoaded', () => {
    createIcons();
});



import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
