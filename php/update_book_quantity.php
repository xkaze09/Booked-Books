<?php
// require_once 'conn.php'; // Include the database connection file
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the book ID and rentedQuantity from the request
$bookId = $_POST['bookId'] ?? null;
$rentedQuantity = $_POST['rentedQuantity'] ?? null;

// Add debugging statements
error_log('Received bookId: ' . $bookId);
error_log('Received rentedQuantity: ' . $rentedQuantity);

// Validate the received values
if ($bookId === null || $rentedQuantity === null) {
    $response = array('success' => false, 'message' => 'Invalid book ID or quantity');
} else {
    // Update the book quantity in the database
    $sqlUpdate = "UPDATE books SET quantity = quantity - ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param('ii', $rentedQuantity, $bookId);

    if ($stmtUpdate->execute()) {
        $response = array('success' => true, 'message' => 'Book quantity updated successfully');
    } else {
        $response = array('success' => false, 'message' => 'Failed to update book quantity');
    }

    $stmtUpdate->close();
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

$conn->close(); // Close the database connection
?>
