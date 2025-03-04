document.addEventListener("DOMContentLoaded", function() {
    const forms = document.querySelectorAll("form.confirm-form");
    forms.forEach(form => {
        form.addEventListener("submit", function(event) {
            if (!confirm("You want to assign the task")) {
                event.preventDefault();
            }
        });
    });
});

window.onload = function() {
    setTimeout(function() {
        var alert = document.getElementById('alert');
        alert.classList.add('fade');

        setTimeout(function() {
            alert.remove();
        }, 1000);
    }, 3000); 
};