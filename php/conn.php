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
    username VARCHAR (255),
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    isAdmin BOOLEAN NOT NULL DEFAULT FALSE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql_users) === TRUE) {
    echo "Table 'users' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

// SQL statements to create the books table
$sql_books = "CREATE TABLE IF NOT EXISTS books (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    cover_image VARCHAR(255),
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

// SQL statements to create the books_to_confirm table
$sql_books_to_confirm = "CREATE TABLE IF NOT EXISTS books_to_confirm (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    description TEXT,
    genre VARCHAR(50),
    rent_date DATE,
    return_date DATE,
    status VARCHAR(50),
    request_by VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql_books_to_confirm) === TRUE) {
    echo "Table 'books_to_confirm' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

?>
