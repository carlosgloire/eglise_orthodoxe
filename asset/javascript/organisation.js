// popup delete patriarche
const deletepatriarcheButtons = document.querySelectorAll('.delete-patriarche');
const patriarchePopup = document.querySelector('.popup-patriarche');
const cancelpatriarchePopupButton = document.querySelector('.cancel-popup-patriarche');
const deletepatriarchePopupButton = document.querySelector('.delete-popup-patriarche');

deletepatriarcheButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const patriarcheID = this.getAttribute('patriarche_id');

        // Show the patriarche delete popup
        patriarchePopup.classList.remove('hidden-popup');

        cancelpatriarchePopupButton.addEventListener('click', function() {
            patriarchePopup.classList.add('hidden-popup');
        });

        deletepatriarchePopupButton.addEventListener('click', function() {
            window.location.href = `../controllers/delete_patriarche.php?id=${patriarcheID}`;
        });
    });
});

// popup delete archeveque
const deletearchevequeButtons = document.querySelectorAll('.delete-archeveque');
const archevequePopup = document.querySelector('.popup-archeveque');
const cancelarchevequePopupButton = document.querySelector('.cancel-popup-archeveque');
const deletearchevequePopupButton = document.querySelector('.delete-popup-archeveque');

deletearchevequeButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const archevequeID = this.getAttribute('archeveque_id');

        // Show the archeveque delete popup
        archevequePopup.classList.remove('hidden-popup');

        cancelarchevequePopupButton.addEventListener('click', function() {
            archevequePopup.classList.add('hidden-popup');
        });

        deletearchevequePopupButton.addEventListener('click', function() {
            window.location.href = `../controllers/delete_archeveque.php?id=${archevequeID}`;
        });
    });
});

// popup delete priest
const deletepriestButtons = document.querySelectorAll('.delete-priest');
const priestPopup = document.querySelector('.popup-priest');
const cancelpriestPopupButton = document.querySelector('.cancel-popup-priest');
const deletepriestPopupButton = document.querySelector('.delete-popup-priest');

deletepriestButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const priestID = this.getAttribute('priest_id');

        // Show the priest delete popup
        priestPopup.classList.remove('hidden-popup');

        cancelpriestPopupButton.addEventListener('click', function() {
            priestPopup.classList.add('hidden-popup');
        });

        deletepriestPopupButton.addEventListener('click', function() {
            window.location.href = `../controllers/delete_priest.php?id=${priestID}`;
        });
    });
});


// popup delete metropolite
const deletemetropoliteButtons = document.querySelectorAll('.delete-metropolite');
const metropolitePopup = document.querySelector('.popup-metropolite');
const cancelmetropolitePopupButton = document.querySelector('.cancel-popup-metropolite');
const deletemetropolitePopupButton = document.querySelector('.delete-popup-metropolite');

deletemetropoliteButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const metropoliteID = this.getAttribute('metropolite_id');

        // Show the metropolite delete popup
        metropolitePopup.classList.remove('hidden-popup');

        cancelmetropolitePopupButton.addEventListener('click', function() {
            metropolitePopup.classList.add('hidden-popup');
        });

        deletemetropolitePopupButton.addEventListener('click', function() {
            window.location.href = `../controllers/delete_metropolite.php?id=${metropoliteID}`;
        });
    });
});

// popup delete nun
const deletenunButtons = document.querySelectorAll('.delete-nun');
const nunPopup = document.querySelector('.popup-nun');
const cancelnunPopupButton = document.querySelector('.cancel-popup-nun');
const deletenunPopupButton = document.querySelector('.delete-popup-nun');

deletenunButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const nunID = this.getAttribute('nun_id');

        // Show the nun delete popup
        nunPopup.classList.remove('hidden-popup');

        cancelnunPopupButton.addEventListener('click', function() {
            nunPopup.classList.add('hidden-popup');
        });

        deletenunPopupButton.addEventListener('click', function() {
            window.location.href = `../controllers/delete_nun.php?id=${nunID}`;
        });
    });
});

// popup delete vicaire
const deletevicaireButtons = document.querySelectorAll('.delete-vicaire');
const vicairePopup = document.querySelector('.popup-vicaire');
const cancelvicairePopupButton = document.querySelector('.cancel-popup-vicaire');
const deletevicairePopupButton = document.querySelector('.delete-popup-vicaire');

deletevicaireButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const vicaireID = this.getAttribute('vicaire_id');

        // Show the vicaire delete popup
        vicairePopup.classList.remove('hidden-popup');

        cancelvicairePopupButton.addEventListener('click', function() {
            vicairePopup.classList.add('hidden-popup');
        });

        deletevicairePopupButton.addEventListener('click', function() {
            window.location.href = `../controllers/delete_vicaire.php?id=${vicaireID}`;
        });
    });
});
// popup delete diacre
const deletediacreButtons = document.querySelectorAll('.delete-diacre');
const diacrePopup = document.querySelector('.popup-diacre');
const canceldiacrePopupButton = document.querySelector('.cancel-popup-diacre');
const deletediacrePopupButton = document.querySelector('.delete-popup-diacre');

deletediacreButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const diacreID = this.getAttribute('diacre_id');

        // Show the diacre delete popup
        diacrePopup.classList.remove('hidden-popup');

        canceldiacrePopupButton.addEventListener('click', function() {
            diacrePopup.classList.add('hidden-popup');
        });

        deletediacrePopupButton.addEventListener('click', function() {
            window.location.href = `../controllers/delete_diacre.php?id=${diacreID}`;
        });
    });
});


// popup delete sous_diacre
const deletesous_diacreButtons = document.querySelectorAll('.delete-sous_diacre');
const sous_diacrePopup = document.querySelector('.popup-sous_diacre');
const cancelsous_diacrePopupButton = document.querySelector('.cancel-popup-sous_diacre');
const deletesous_diacrePopupButton = document.querySelector('.delete-popup-sous_diacre');

deletesous_diacreButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const sous_diacreID = this.getAttribute('sous_diacre_id');

        // Show the sous_diacre delete popup
        sous_diacrePopup.classList.remove('hidden-popup');

        cancelsous_diacrePopupButton.addEventListener('click', function() {
            sous_diacrePopup.classList.add('hidden-popup');
        });

        deletesous_diacrePopupButton.addEventListener('click', function() {
            window.location.href = `../controllers/delete_sous_diacre.php?id=${sous_diacreID}`;
        });
    });
});

// popup delete acolyte
const deleteacolyteButtons = document.querySelectorAll('.delete-acolyte');
const acolytePopup = document.querySelector('.popup-acolyte');
const cancelacolytePopupButton = document.querySelector('.cancel-popup-acolyte');
const deleteacolytePopupButton = document.querySelector('.delete-popup-acolyte');

deleteacolyteButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const acolyteID = this.getAttribute('acolyte_id');

        // Show the acolyte delete popup
        acolytePopup.classList.remove('hidden-popup');

        cancelacolytePopupButton.addEventListener('click', function() {
            acolytePopup.classList.add('hidden-popup');
        });

        deleteacolytePopupButton.addEventListener('click', function() {
            window.location.href = `../controllers/delete_acolyte.php?id=${acolyteID}`;
        });
    });
});

