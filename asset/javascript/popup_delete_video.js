// Video delete popup
const deleteVideoButtons = document.querySelectorAll('.delete-video');
const videoPopup = document.querySelector('.popup-video');
const cancelVideoPopupButton = document.querySelector('.cancel-popup-video');
const deleteVideoPopupButton = document.querySelector('.delete-popup-video');

deleteVideoButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const videoID = this.getAttribute('video_id');

        // Show the video delete popup
        videoPopup.classList.remove('hidden-popup');

        cancelVideoPopupButton.addEventListener('click', function() {
            videoPopup.classList.add('hidden-popup');
        });

        deleteVideoPopupButton.addEventListener('click', function() {
            window.location.href = `../controllers/delete_video.php?id=${videoID}`;
        });
    });
});
