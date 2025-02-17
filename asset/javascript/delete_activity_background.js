// Video delete popup
const deleteVideoButtons = document.querySelectorAll('.delete-background');
const videoPopup = document.querySelector('.popup-background');
const cancelVideoPopupButton = document.querySelector('.cancel-popup-background');
const deleteVideoPopupButton = document.querySelector('.delete-popup-background');

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
            window.location.href = `../controllers/delete_activity_background.php?id=${videoID}`;
        });
    });
});
