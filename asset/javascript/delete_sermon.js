/*----------------------------------
#Popup delete sermon
----------------------------------*/
const deleteButtons = document.querySelectorAll('.delete');
const popup = document.querySelector('.popup');
const cancelPopupButton = document.querySelector('.cancel-popup');
const deletePopupButton = document.querySelector('.delete-popup');

deleteButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const sermonID = this.dataset.sermonId; // Utilisez dataset pour récupérer l'attribut data-sermon-id
        console.log("Sermon ID:", sermonID); // Vérifiez dans la console

        // Affichez la popup
        popup.classList.remove('hidden-popup');

        cancelPopupButton.addEventListener('click', function() {
            popup.classList.add('hidden-popup');
        });

        deletePopupButton.addEventListener('click', function() {
            window.location.href = `../controllers/delete_sermon.php?sermon_id=${sermonID}`;
        });
    });
});




