document.addEventListener("DOMContentLoaded", function() {
    // Select all fields that have confir-form class
    const forms = document.querySelectorAll("form.confirm-form");
    forms.forEach(form => {
        form.addEventListener("submit", function(event) {
            // Show a confirm alert
            if (!confirm("¿Do you want to continue?")) {
                event.preventDefault();
            }
        });
    });
});
