// Video delete popup
const deleteVideoButtons = document.querySelectorAll('.delete-metropolite');
const videoPopup = document.querySelector('.popup-metropolite');
const cancelVideoPopupButton = document.querySelector('.cancel-popup-metropolite');
const deleteVideoPopupButton = document.querySelector('.delete-popup-metropolite');

deleteVideoButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const videoID = this.getAttribute('background_id');

        // Show the video delete popup
        videoPopup.classList.remove('hidden-popup');

        cancelVideoPopupButton.addEventListener('click', function() {
            videoPopup.classList.add('hidden-popup');
        });

        deleteVideoPopupButton.addEventListener('click', function() {
            window.location.href = `../controllers/delete_gallery_background.php?id=${videoID}`;
        });
    });
});
