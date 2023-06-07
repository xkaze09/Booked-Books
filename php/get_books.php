<?php
// Retrieve books from the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbdatabase";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve books with cover images
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

// Create an array to store the book data
$books = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Fetch the cover image path
        $coverImagePath = "php/" . $row["cover_image"];
                
        // Add the book data along with the cover image path to the array
        $book = array(
            "id" => $row["id"],
            "title" => $row["title"],
            "author" => $row["author"],
            "cover_image" => $coverImagePath,
            "description" => $row["description"],
            "genre" => $row["genre"],
            "availability" => $row["availability"],
            "quantity" => $row["quantity"]
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
