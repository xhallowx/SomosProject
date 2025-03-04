window.onload = function() {
    setTimeout(function() {
        var alert = document.getElementById('alert');
        alert.classList.add('fade');

        setTimeout(function() {
            alert.remove();
        }, 1000);
    }, 3000); 
};
document.getElementById('filterOwner').addEventListener('change', function () {
    let selectedOwner = this.value;
    let rows = document.querySelectorAll('.task-row');
    let hasResults = false;

    rows.forEach(row => {
        if (selectedOwner === '' || row.dataset.owner === selectedOwner) {
            row.style.display = '';
            hasResults = true;
        } else {
            row.style.display = 'none';
        }
    });

    document.getElementById('noResults').style.display = hasResults ? 'none' : 'block';
});

document.addEventListener("DOMContentLoaded", function() {
    // Select all forms that have the confirm-form class
    const forms = document.querySelectorAll("form.confirm-form");
    forms.forEach(form => {
        form.addEventListener("submit", function(event) {
            // Show a confirmation alert
            if (!confirm("Are you sure about creating the project?")) {
                event.preventDefault();
            }
        });
    });
});
