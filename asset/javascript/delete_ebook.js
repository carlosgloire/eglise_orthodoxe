// book delete popup
const deletebookButtons = document.querySelectorAll('.delete-book');
const bookPopup = document.querySelector('.popup-book');
const cancelbookPopupButton = document.querySelector('.cancel-popup-book');
const deletebookPopupButton = document.querySelector('.delete-popup-book');

deletebookButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const bookID = this.getAttribute('book_id');

        // Show the book delete popup
        bookPopup.classList.remove('hidden-popup');

        cancelbookPopupButton.addEventListener('click', function() {
            bookPopup.classList.add('hidden-popup');
        });

        deletebookPopupButton.addEventListener('click', function() {
            window.location.href = `../controllers/delete_ebook.php?id=${bookID}`;
        });
    });
});
