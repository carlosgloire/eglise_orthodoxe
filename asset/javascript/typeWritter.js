
    const titleText = "HOLY SPIRIT ACADEMIA CHURCH";
    let index = 0;
    let isDeleting = false;
    const speed = 250; 
    const target = document.getElementById("title");

    function typeWriter() {
        let displayText = titleText.slice(0, index);
        target.textContent = displayText;

        if (!isDeleting && index < titleText.length) {
            index++;
        } else if (isDeleting && index > 0) {
            index--;
        }

        if (index === titleText.length) {
            isDeleting = true;
        } else if (index === 0) {
            isDeleting = false;
        }

        setTimeout(typeWriter, speed);
    }

    typeWriter();
