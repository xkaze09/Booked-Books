<?php
// Retrieve the book data from the request
$data = json_decode(file_get_contents('php://input'), true);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// Prepare the SQL statement to insert the books into the books_to_confirm table
$sql = 'INSERT INTO books_to_confirm (title, author, description, genre, rent_date, return_date, status, request_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind parameters and execute the statement for each book
foreach ($data['books'] as $book) {
  // Retrieve book details from the database based on the book ID
  $stmt_get_book = $conn->prepare('SELECT title, author, description, genre FROM books WHERE id = ?');
  $stmt_get_book->bind_param('i', $book['id']);
  $stmt_get_book->execute();
  $stmt_get_book->store_result();

  if ($stmt_get_book->num_rows > 0) {
    $stmt_get_book->bind_result($title, $author, $description, $genre);
    $stmt_get_book->fetch();

    $stmt->bind_param('ssssssss', $title, $author, $description, $genre, $book['rent_date'], $book['return_date'], $book['status'], $book['request_by']);
    $stmt->execute();
  } else {
    echo json_encode(array('success' => false, 'message' => 'Book not found for ID: ' . $book['id']));
    exit;
  }

  $stmt_get_book->close();
}

$stmt->close();
$conn->close();

echo json_encode(array('success' => true, 'message' => 'Books inserted into the confirmation table'));
?>
