<?php
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($_POST['user'])) {
        $table = "users";
    } elseif (isset($_POST['admin'])) {
        $table = "admins";
    }

    if (isset($table)) {
        $sql = "INSERT INTO $table (email, password) VALUES ('$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            // redirect to user/admin page
            header("Location: ../index.html");
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Invalid request.";
    }

    $conn->close();
}
?>
