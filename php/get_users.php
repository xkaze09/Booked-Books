<?php

include 'conn.php';

// Retrieve books to confirm will all data
$sql = "SELECT * FROM books_to_confirm JOIN users ON (users.id = books_to_confirm.user_id) JOIN books ON (books.id = books_to_confirm.book_id)";
$result = $conn->query($sql);

// Create an array to store the book data
$books = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
                
        // Add the book data along with the cover image path to the array
        $book = array(
            "id" => $row["id"],
            "title" => $row["title"],
            "author" => $row["author"],
            "description" => $row["description"],
            "genre" => $row["genre"],
            "rent_date" => $row["rent_date"],
            "return_date" => $row["return_date"],
            "status" => $row["status"],
            "requester" => $row["username"]
        );
        $books[] = $book;
    }
}

// Close the database connection
$conn->close();

// Convert the book data array to JSON format
$booksJSON = json_encode($books);

// Send the JSON response
header("Content-Type: application/json");
echo $booksJSON;
?>
