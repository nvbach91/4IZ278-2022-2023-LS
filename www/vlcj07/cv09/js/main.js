const initApp = () => {
    const hamburgerMenu = document.getElementById('hamburger-menu');
    const mobileMenu = document.getElementById('mobile-menu');

    const toggleMenu = () => {
        mobileMenu.classList.toggle('hidden');
        mobileMenu.classList.toggle('flex');
        hamburgerMenu.classList.toggle('toggle-btn');
    }

    hamburgerMenu.addEventListener('click', toggleMenu);
    mobileMenu.addEventListener('click', toggleMenu);

    var date = new Date();
    var currentDate = date.getFullYear();
    document.getElementById('year').innerHTML = currentDate;

}

document.addEventListener('DOMContentLoaded', initApp);

