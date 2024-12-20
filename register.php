<?php
// Include database connection

include('db.php');

// Check if the form is submitted

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data and sanitize it

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

   
    // Validate the input

    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'error' => 'All fields are required.']);

        exit();

    }



    // Check if the username or email already exists

    $checkUserQuery = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";

    $result = mysqli_query($conn, $checkUserQuery);



    if (mysqli_num_rows($result) > 0) {

        echo json_encode(['success' => false, 'error' => 'Username or Email already exists.']);

        exit();

    }



    // Hash the password securely using bcrypt

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);



    // Insert the new user into the database

    $insertQuery = "INSERT INTO users (username, email, password, role) 

                    VALUES ('$username', '$email', '$hashedPassword', 'user')";



    if (mysqli_query($conn, $insertQuery)) {

        echo json_encode(['success' => true, 'message' => 'Registration successful.']);

    } else {

        echo json_encode(['success' => false, 'error' => 'Error registering the user: ' . mysqli_error($conn)]);

    }

}



// Close the database connection

mysqli_close($conn);

?>



/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

