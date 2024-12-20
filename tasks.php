<?php

include('db.php');
$sql = "SELECT id, title, status FROM tasks";
$result = $conn->query($sql);
$tasks = [];
while($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}

echo json_encode($tasks);

?>
/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

