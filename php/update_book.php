<?php
require_once 'conn.php';

// Check if all required fields are present
if (isset($_POST['id'], $_POST['edit-title'], $_POST['edit-author'], $_POST['edit-description'], $_POST['edit-genre'], $_POST['edit-availability'], $_POST['edit-quantity'])) {
    // Get the form data
    $id = $_POST['id'];
    $title = $_POST['edit-title'];
    $author = $_POST['edit-author'];
    $description = $_POST['edit-description'];
    $genre = $_POST['edit-genre'];
    $availability = $_POST['edit-availability'];
    $quantity = $_POST['edit-quantity'];

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
