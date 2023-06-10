<?php
include "conn.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($_POST['user'])) {
        // check if the user exists in the users table
        $userSql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND isAdmin=FALSE";
        $userResult = $conn->query($userSql);

        if ($userResult->num_rows > 0) {
            while($row = $userResult->fetch_assoc()){
                 // if user exists, redirect to the user page
                $_SESSION["name"] = $username;
                $_SESSION["isAdmin"] = FALSE;
                header("Location: ../index.html");
                exit();
            }
        }
    } elseif (isset($_POST['admin'])) {
        // check if the user exists in the users table and is an admin
        $adminSql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND isAdmin=TRUE";
        $adminResult = $conn->query($adminSql);

        if ($adminResult->num_rows > 0) {
            // if admin exists, redirect to the admin page
            $_SESSION["isAdmin"] = TRUE;
            header("Location: ../admin-dashboard.php");
            exit();
        }
    }

    // if credentials don't match
    echo "<script>alert('Log in error. Please check your username or password.');
            document.location.href = '../index.html'; 
        </script>";
    session_destroy();
    $conn->close();
}
?>
