document.getElementById("searchForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    let owner = document.getElementById("owner").value;
    let project = document.getElementById("project").value;

    fetch(`/buscar-tareas?owner=${owner}&project=${project}`)
        .then(response => response.json())
        .then(data => {
            let resultsDiv = document.getElementById("results");
            resultsDiv.innerHTML = "";

            if (data.length > 0) {
                let table = `<div class="table-responsive">
                    <table class="futuristic-table">
                        <thead>
                            <tr>
                                <th>Owner</th>
                                <th>Project</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>`;
        
                data.forEach(task => {
                    table += `<tr>
                        <td>${task.owner}</td>
                        <td><strong>${task.name_project}</strong></td>
                        <td>
                            <a href="/tasks/pending/create?project_id=${task.id}" class="btn btn-info btn-sm crear">Create Task</a>
                        </td>
                    </tr>`;
                });
                
                table += `   </tbody>
                    </table>
                </div>`;
                resultsDiv.innerHTML = table;
            } else {
                resultsDiv.innerHTML = "<div class='alert alert-warning text-center'><strong>No Projects Found.</strong></div>";
            }
        })
        .catch(error => {
            console.error("Search Error:", error);
        });
});