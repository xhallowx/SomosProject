indow.onload = function() {
    setTimeout(function() {
        var alert = document.getElementById('alert');
        alert.classList.add('fade'); // Applies fade class after 3 seconds

        // Wait 1 second (the fade time) and then delete the item
        setTimeout(function() {
            alert.remove();
        }, 1000);
    }, 3000); // Fade after 3 seconds
};