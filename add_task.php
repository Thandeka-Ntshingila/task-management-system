<?php
include('db.php');

include('db.php');

// Retrieve form data
$title = $_POST['title'];
$description = $_POST['description'];
$assigned_to = $_POST['assigned_to'];
$due_date = $_POST['due_date'];

// SQL to insert the new task
$sql = "INSERT INTO tasks (title, description, assigned_to, due_date) 
        VALUES ('$title', '$description', '$assigned_to', '$due_date')";

if ($conn->query($sql) === TRUE) {
    echo "New task created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

