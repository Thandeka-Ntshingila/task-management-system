document.addEventListener('DOMContentLoaded', () => {
    // Load appointments when the page loads
    loadAppointments();

    // Handle form submission for creating a new appointment
    const appointmentForm = document.getElementById('appointmentForm');
    appointmentForm.addEventListener('submit', function(event) {
        event.preventDefault();  // Prevent the form from submitting normally

        const formData = new FormData(appointmentForm);  // Get form data

        fetch('add_appointment.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(message => {
            alert(message);  // Show success or error message
            appointmentForm.reset();  // Reset form fields
            loadAppointments();  // Reload the appointments list after creation
        })
        .catch(error => {
            console.error('Error creating appointment:', error);
        });
    });

    // Function to load appointments from the server
    function loadAppointments() {
        fetch('get_appointments.php')
            .then(response => response.json())
            .then(appointments => {
                const appointmentsList = document.getElementById('appointments');
                appointmentsList.innerHTML = '';  // Clear the current list

                // Loop through each appointment and display it
                appointments.forEach(appointment => {
                    const appointmentItem = document.createElement('li');
                    appointmentItem.innerHTML = `
                        <strong>${appointment.description}</strong><br>
                        Date: ${new Date(appointment.appointment_date).toLocaleString()}<br>
                        <button onclick="deleteAppointment(${appointment.id})">Delete</button>
                    `;
                    appointmentsList.appendChild(appointmentItem);
                });
            })
            .catch(error => {
                console.error('Error fetching appointments:', error);
            });
    }

    // Function to delete an appointment
    window.deleteAppointment = function(appointmentId) {
        if (confirm('Are you sure you want to delete this appointment?')) {
            fetch(`delete_appointment.php?id=${appointmentId}`, {
                method: 'GET'
            })
            .then(response => response.text())
            .then(message => {
                alert(message);  // Show success or error message
                loadAppointments();  // Reload the appointments list after deletion
            })
            .catch(error => {
                console.error('Error deleting appointment:', error);
            });
        }
    };

});
/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */


