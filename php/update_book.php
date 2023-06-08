<?php
require_once 'conn.php';

// Check if all required fields are present
if (isset($_POST['id'], $_POST['title'], $_POST['author'], $_POST['description'], $_POST['genre'], $_POST['availability'], $_POST['quantity'])) {
    // Get the form data
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $genre = $_POST['genre'];
    $availability = $_POST['availability'];
    $quantity = $_POST['quantity'];

    // Prepare and execute the SQL update statement
    $stmt = $conn->prepare("UPDATE books SET title=?, author=?, description=?, genre=?, availability=?, quantity=? WHERE id=?");
    $stmt->bind_param("ssssssi", $title, $author, $description, $genre, $availability, $quantity, $id); // Modified parameter type definition
    $result = $stmt->execute();

    if ($result) {
        $response = array("success" => true, "message" => "Book updated successfully.");
    } else {
        $response = array("success" => false, "message" => "Failed to update book. Please try again.");
    }
} else {
    $response = array("success" => false, "message" => "Missing required fields.");
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
