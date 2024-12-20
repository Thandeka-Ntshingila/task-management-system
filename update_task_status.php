<?php
// Include database connection

include('db.php');



// Get the task ID and new status from the POST request
$task_id = $_POST['id'];  // Task ID to be updated
$new_status = $_POST['status'];  // New status (e.g., 'Completed', 'Pending', etc.)

if (empty($task_id) || empty($new_status)) {
    echo "Task ID and status are required.";
    exit;
}

// SQL query to update the task's status
$sql = "UPDATE tasks SET status = '$new_status' WHERE id = $task_id";

if ($conn->query($sql) === TRUE) {
    echo "Task status updated successfully.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

