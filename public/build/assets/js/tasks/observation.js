window.onload = function() {
    setTimeout(function() {
        var alert = document.getElementById('alert');
        alert.classList.add('fade'); 

        setTimeout(function() {
            alert.remove();
        }, 1000);
    }, 3000);
};

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.btn-visualizar').forEach(button => {
      button.addEventListener('click', function() {
        const tbody = button.closest('tbody');
        const previewRow = tbody.querySelector('tr.preview-task');
        if (previewRow) {
          previewRow.classList.remove('preview-task');
        }
        tbody.querySelectorAll('tr.additional-task').forEach(row => {
          row.style.display = 'table-row';
        });
        const previewButtonRow = tbody.querySelector('tr.preview-button-row');
        if (previewButtonRow) {
          previewButtonRow.style.display = 'none';
        }
        const ocultarRow = tbody.querySelector('tr.ocultar-row');
        if (ocultarRow) {
          ocultarRow.style.display = 'table-row';
        }
      });
    });
  
    document.querySelectorAll('.btn-ocultar').forEach(button => {
      button.addEventListener('click', function() {
        const tbody = button.closest('tbody');
        tbody.querySelectorAll('tr.additional-task').forEach(row => {
          row.style.display = 'none';
        });
        const taskRows = tbody.querySelectorAll('tr.task-row');
        if (taskRows.length >= 2) {
          taskRows[1].classList.add('preview-task');
        }
        const previewButtonRow = tbody.querySelector('tr.preview-button-row');
        if (previewButtonRow) {
          previewButtonRow.style.display = 'table-row';
        }
        const ocultarRow = tbody.querySelector('tr.ocultar-row');
        if (ocultarRow) {
          ocultarRow.style.display = 'none';
        }
      });
    });
  });
  