import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.addEventListener("DOMContentLoaded", function() {
    console.log("Patient Management System Loaded!");

    let sidebar = document.querySelector(".sidebar");
    let toggleButton = document.querySelector("#toggleSidebar");

    if (toggleButton && sidebar) {
        toggleButton.addEventListener("click", function() {
            sidebar.classList.toggle("hidden");
        });
    }
});
