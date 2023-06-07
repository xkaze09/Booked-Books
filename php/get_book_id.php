<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the book ID from the query parameter
$bookId = $_GET['bookId'] ?? null;

// Validate the received value
if ($bookId === null) {
    $response = array('success' => false, 'message' => 'Invalid book ID');
} else {
    // Fetch the book ID from the database
    $sql = "SELECT id FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $bookId);
    $stmt->execute();
    $stmt->bind_result($fetchedBookId);
    
    if ($stmt->fetch()) {
        $response = array('success' => true, 'bookId' => $fetchedBookId);
    } else {
        $response = array('success' => false, 'message' => 'Book ID not found');
    }

    $stmt->close();
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

$conn->close(); // Close the database connection
?>
