<?php
include "conn.php";

// Ensure that the form is submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check which table to add the user
    if (isset($_POST['user'])) {
        $table = "users";
        // Set redirect page for user
        $redirectPage = "../index.html";
    } elseif (isset($_POST['admin'])) {
        $table = "admins";
        // Set redirect page for admin
        $redirectPage =  "../index.html";
    }

    if (isset($table)) {
        // Check if the user already exists
        $sql = "SELECT * FROM $table WHERE email='$email'";
        $result = $conn->query($sql);

        // If user exists, redirect to log in page
        if ($result->num_rows > 0) {
            echo "<script>alert('You already have an account. Go to login page.');
                    document.location.href = '../index.html'; 
                </script>";
        } else {
            // Insert the new user
            $sql = "INSERT INTO $table (email, password) VALUES ('$email', '$password')";
            if ($conn->query($sql) === TRUE) {
                // Redirect to user/admin page
                header("Location: $redirectPage");
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }

    $conn->close();
}
?>

