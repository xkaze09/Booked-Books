<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

// SQL statements to create the users table
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql_users) === TRUE) {
    echo "Table 'users' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

// SQL statements to create the admins table
$sql_admins = "CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql_admins) === TRUE) {
    echo "Table 'admins' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

// SQL statements to create the books table
$sql_books = "CREATE TABLE IF NOT EXISTS books (
	id INT PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	author VARCHAR(255) NOT NULL,
	cover_image LONGBLOB,
	description TEXT,
	genre VARCHAR(50),
	availability BOOLEAN DEFAULT true,
    quantity INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql_books) === TRUE) {
    echo "Table 'books' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
