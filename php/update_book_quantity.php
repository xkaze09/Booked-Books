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
    // Fetch the current quantity of the book
    $sqlSelect = "SELECT quantity FROM books WHERE id = ?";
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param('i', $bookId);
    $stmtSelect->execute();
    $stmtSelect->bind_result($currentQuantity);
    $stmtSelect->fetch();
    $stmtSelect->close();

    // Ensure the rentedQuantity is a positive value
    $rentedQuantity = max(0, intval($rentedQuantity));

    // Calculate the new quantity after renting
    $newQuantity = max(0, $currentQuantity - $rentedQuantity);

    // Update the book quantity in the database
    $sqlUpdate = "UPDATE books SET quantity = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param('ii', $newQuantity, $bookId);

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
