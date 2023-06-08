<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch the books to be confirmed
$sql_fetch_books_to_confirm = "SELECT c.id, c.title, c.author, c.description, c.genre, c.rent_date, c.return_date, c.status, c.request_by
                               FROM books_to_confirm AS c";


$result = $conn->query($sql_fetch_books_to_confirm);

if ($result->num_rows > 0) {
  $books = array();
  while ($row = $result->fetch_assoc()) {
    $books[] = $row;
  }
  echo json_encode($books);
} else {
  echo json_encode([]);
}

// Close the database connection
$conn->close();
?>