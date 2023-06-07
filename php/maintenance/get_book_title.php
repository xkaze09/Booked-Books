<?php
// conn.php contains the database connection code (updated according to the previous changes)
require_once "conn.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  // Check if the book ID is provided
  if (isset($_GET["id"])) {
    $bookId = $_GET["id"];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT title FROM books WHERE id = ?");
    $stmt->bind_param("i", $bookId);
    $stmt->execute();

    // Retrieve the title from the query result
    $stmt->bind_result($title);
    $stmt->fetch();

    // Return the title as JSON response
    echo json_encode([
      "success" => true,
      "title" => $title
    ]);
  } else {
    // Book ID is not provided
    echo json_encode([
      "success" => false,
      "message" => "Book ID not specified"
    ]);
  }
} else {
  // Invalid request method
  echo json_encode([
    "success" => false,
    "message" => "Invalid request method"
  ]);
}

// Close the database connection
$conn->close();
?>
