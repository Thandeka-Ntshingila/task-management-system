document.addEventListener('DOMContentLoaded', () => {
    // Function to load tasks from the backend
    function loadTasks() {
        fetch('get_tasks.php')  // Fetch tasks from the server
            .then(response => response.json())  // Parse JSON response
            .then(tasks => {
                const tasksList = document.getElementById('tasks');
                tasksList.innerHTML = '';  // Clear the current list of tasks

                // Loop through tasks and display them
                tasks.forEach(task => {
                    const taskItem = document.createElement('li');
                    taskItem.innerHTML = `
                        <strong>${task.title}</strong><br>
                        Description: ${task.description}<br>
                        Assigned To: User ${task.assigned_to}<br>
                        Due Date: ${task.due_date}<br>
                        Status: <span id="status-${task.id}">${task.status}</span><br>
                        <button onclick="updateStatus(${task.id}, '${task.status}')">Change Status</button>
                        <button onclick="deleteTask(${task.id})">Delete Task</button>
                    `;
                    tasksList.appendChild(taskItem);
                });
            })
            .catch(error => {
                console.error('Error fetching tasks:', error);
            });
    }

    // Call loadTasks initially to populate the list of tasks
    loadTasks();

    // Form submission event handler (Create Task)
    const taskForm = document.getElementById('taskForm');
    taskForm.addEventListener('submit', function(event) {
        event.preventDefault();  // Prevent the form from submitting normally

        const formData = new FormData(taskForm);  // Get form data
        fetch('create_task.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(message => {
            alert(message);  // Show success or error message
            taskForm.reset();  // Reset form fields
            loadTasks();  // Reload the task list after creation
        })
        .catch(error => {
            console.error('Error creating task:', error);
        });
    });
});

// Delete Task Function
function deleteTask(taskId) {
    if (confirm('Are you sure you want to delete this task?')) {
        fetch(`delete_task.php?id=${taskId}`, {
            method: 'GET'
        })
        .then(response => response.text())
        .then(message => {
            alert(message);  // Show success or error message
            loadTasks();  // Reload the task list after deletion
        })
        .catch(error => {
            console.error('Error deleting task:', error);
        });
    }
}

// Update Task Status Function
function updateStatus(taskId, currentStatus) {
    const newStatus = prompt("Enter new status (e.g., 'Completed', 'Pending'):", currentStatus);
    if (newStatus && newStatus !== currentStatus) {
        const formData = new FormData();
        formData.append('id', taskId);
        formData.append('status', newStatus);

        fetch('update_task_status.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(message => {
            alert(message);  // Show success or error message
            document.getElementById(`status-${taskId}`).textContent = newStatus;  // Update the status on the page
        })
        .catch(error => {
            console.error('Error updating task status:', error);
        });
    }
}
/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */


