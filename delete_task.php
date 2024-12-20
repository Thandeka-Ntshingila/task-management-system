<?php

include('db.php');

// Get the appointment ID from the GET request
$appointment_id = $_GET['id'];  

if (empty($appointment_id)) {
    echo "Appointment ID is required.";
    exit;
}

// SQL query to delete the appointment by ID
$sql = "DELETE FROM appointments WHERE id = $appointment_id";

if ($conn->query($sql) === TRUE) {
    echo "Appointment deleted successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>




/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

