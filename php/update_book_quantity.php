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

// Retrieve the book ID and quantity from the request
$bookId = $_POST['bookId'] ?? null;
$quantity = $_POST['quantity'] ?? null;

// Add debugging statements
error_log('Received bookId: ' . $bookId);
error_log('Received quantity: ' . $quantity);

// Validate the received values
if ($bookId === null || $quantity === null) {
    $response = array('success' => false, 'message' => 'Invalid book ID or quantity');
} else {
    // Update the book quantity in the database
    $sqlUpdate = "UPDATE books SET quantity = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param('ii', $quantity, $bookId);

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
