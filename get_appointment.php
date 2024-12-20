<?php

include('db.php');

// Retrieve form data
$description = $_POST['description'];
$appointment_date = $_POST['appointment_date'];

// SQL to insert the new appointment
$sql = "INSERT INTO appointments (description, appointment_date) VALUES ('$description', '$appointment_date')";

if ($conn->query($sql) === TRUE) {
    echo "New appointment created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

