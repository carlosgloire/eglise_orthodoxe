const deleteButtons = document.querySelectorAll('.delete-archeveque');
const popup = document.querySelector('.popup-archeveque');
const cancelButton = document.querySelector('.cancel-popup-archeveque');
const deleteButton = document.querySelector('.delete-popup-archeveque');

deleteButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const galleryID = this.getAttribute('gallery_id'); // Correct attribute name

        // Ensure popup exists before manipulating it
        if (popup) {
            popup.classList.remove('hidden-popup');

            cancelButton.addEventListener('click', function() {
                popup.classList.add('hidden-popup');
            });

            deleteButton.addEventListener('click', function() {
                window.location.href = `../controllers/delete_gallery_background.php?id=${galleryID}`;
            });
        }
    });
});
