// Image delete popup
const deleteImageButtons = document.querySelectorAll('.delete-image');
const imagePopup = document.querySelector('.popup-image');
const cancelImagePopupButton = document.querySelector('.cancel-popup-image');
const deleteImagePopupButton = document.querySelector('.delete-popup-image');

deleteImageButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const imageID = this.getAttribute('gallery_id');

        // Show the image delete popup
        imagePopup.classList.remove('hidden-popup');

        cancelImagePopupButton.addEventListener('click', function() {
            imagePopup.classList.add('hidden-popup');
        });

        deleteImagePopupButton.addEventListener('click', function() {
            window.location.href = `../controllers/delete_image.php?id=${imageID}`;
        });
    });
});
