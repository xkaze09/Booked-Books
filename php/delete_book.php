<?php

// Get the book ID from the request body
$data = json_decode(file_get_contents('php://input'), true);
$bookId = $data['bookId'];

// Database connection
require_once 'conn.php';

// Delete the book from the database
$sql = "DELETE FROM books WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $bookId);
if ($stmt->execute()) {
    $response = [
        'success' => true,
        'message' => 'Book deleted successfully.'
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Failed to delete book.'
    ];
}

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);

$stmt->close();
$conn->close();

?>
