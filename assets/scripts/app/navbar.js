// Navbar script

const navbarButton = document.getElementById('app_navbar_button');
const mobileMenu = document.getElementById('app_navbar_mobile_menu');

navbarButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
});
