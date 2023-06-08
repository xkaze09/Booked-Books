<?php
// Include the database connection file
include 'conn.php';

// Get the book ID from the query parameters
$bookId = $_GET['bookId'];

// Fetch the book details based on the ID
$sql_fetch_book_details = "SELECT * FROM books WHERE id = '$bookId'";
$result = $conn->query($sql_fetch_book_details);

if ($result->num_rows > 0) {
  $bookDetails = $result->fetch_assoc();
} else {
  $bookDetails = null;
}

// Close the database connection
$conn->close();

// Set the response header to indicate JSON content
header('Content-Type: application/json');

// Return the book details as JSON
echo json_encode($bookDetails);
?>
