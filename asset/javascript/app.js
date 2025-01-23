document.addEventListener("DOMContentLoaded", () => {
    const images = document.querySelectorAll(".home-images .home-bg");
    const circles = document.querySelectorAll(".circle-btn .circle");
    let currentIndex = 0;
    const totalImages = images.length;

    // Function to update the active image
    const updateSlide = (index) => {
        // Remove active class from all images and circles
        images.forEach((img, i) => {
            img.classList.remove("active");
            circles[i].classList.remove("active");
        });

        // Add active class to the current image and circle
        images[index].classList.add("active");
        circles[index].classList.add("active");
    };

    // Auto-slide every 10 seconds
    const autoSlide = () => {
        currentIndex = (currentIndex + 1) % totalImages;
        updateSlide(currentIndex);
    };

    // Add click events for manual navigation
    circles.forEach((circle, index) => {
        circle.addEventListener("click", () => {
            currentIndex = index;
            updateSlide(currentIndex);
        });
    });

    // Start auto-slide
    updateSlide(currentIndex);
    setInterval(autoSlide, 8000); // Change slide every 10 seconds
});

//Codes to handle the menu bar 
const menuIcon = document.querySelector('.menu-icon');
const exitIcon = document.querySelector('.exit-icon');
const navLinks = document.querySelector('.nav-links');

menuIcon.addEventListener('click', () => {
    navLinks.classList.add('active');
    document.querySelector('.our-menu').classList.add('active');
});

exitIcon.addEventListener('click', () => {
    navLinks.classList.remove('active');
    document.querySelector('.our-menu').classList.remove('active');
});
