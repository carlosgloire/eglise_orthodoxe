const deleteButtons1 = document.querySelectorAll('.delete-priest');
const popup1 = document.querySelector('.popup-priest');
const cancelButton1 = document.querySelector('.cancel-popup-priest');
const deleteButton1 = document.querySelector('.delete-popup-priest');

deleteButtons1.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const galleryID = this.getAttribute('gallery_id'); // Correct attribute name

        // Ensure popup exists before manipulating it
        if (popup1) {
            popup1.classList.remove('hidden-popup');

            cancelButton1.addEventListener('click', function() {
                popup1.classList.add('hidden-popup');
            });

            deleteButton1.addEventListener('click', function() {
                window.location.href = `../controllers/delete_gallery_background.php?id=${galleryID}`;
            });
        }
    });
});
