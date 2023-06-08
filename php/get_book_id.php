<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bbdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$bookId = $_GET['bookId'];

// Fetch the minimum available book ID from the table
$stmt = $conn->prepare("SELECT MIN(id) AS min_id FROM books_to_confirm");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $minId = $row['min_id'];

    // Calculate the actual book ID based on the minimum available ID
    $actualBookId = $minId + $bookId - 1;

    // Check if the calculated book ID exists in the table
    $stmt = $conn->prepare("SELECT id FROM books_to_confirm WHERE id = ?");
    $stmt->bind_param("i", $actualBookId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $response = array('success' => true, 'id' => $actualBookId);
    } else {
        $response = array('success' => false, 'message' => 'Book ID not found');
    }
} else {
    $response = array('success' => false, 'message' => 'No books available');
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>
