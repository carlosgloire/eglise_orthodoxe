// JavaScript to toggle the hamburger menu
document.addEventListener('DOMContentLoaded', function () {
    const menuIcon = document.querySelector('.menu-icon-admin');
    const exitIcon = document.querySelector('.exit-icon-admin');
    const navMenu = document.querySelector('.first-bloc nav');
    const adminMenu = document.querySelector('.admin-menu');

    // Show the menu when the hamburger icon is clicked
    menuIcon.addEventListener('click', function () {
        navMenu.classList.add('active');    // Show the menu
        adminMenu.classList.add('active');   // Hide menu icon, show exit icon
    });

    // Hide the menu when the exit icon is clicked
    exitIcon.addEventListener('click', function () {
        navMenu.classList.remove('active');  // Hide the menu
        adminMenu.classList.remove('active'); // Show menu icon, hide exit icon
    });
});