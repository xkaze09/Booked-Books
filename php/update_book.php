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

    // Check if a cover image was uploaded
    if (isset($_FILES['edit-cover-image']) && $_FILES['edit-cover-image']['error'] === UPLOAD_ERR_OK) {
        // Get the cover image details
        $coverImageName = $_FILES['edit-cover-image']['name'];
        $coverImageTmpName = $_FILES['edit-cover-image']['tmp_name'];
        $coverImagePath = './uploads/' . $coverImageName;

        // Remove the previous cover image
        $prevCoverImagePath = getPrevCoverImagePath($id);
        if ($prevCoverImagePath !== null) {
            unlink($prevCoverImagePath);
        }

        // Move the uploaded cover image to the desired location
        if (move_uploaded_file($coverImageTmpName, $coverImagePath)) {
            // Prepare and execute the SQL update statement
            $stmt = $conn->prepare("UPDATE books SET title=?, author=?, description=?, genre=?, availability=?, quantity=?, cover_image=? WHERE id=?");
            $stmt->bind_param("ssssissi", $title, $author, $description, $genre, $availability, $quantity, $coverImagePath, $id); // Modified parameter type definition
            $result = $stmt->execute();

            if ($result) {
                $response = array("success" => true, "message" => "Book updated successfully.");
            } else {
                $response = array("success" => false, "message" => "Failed to update book. Please try again.");
            }
        } else {
            $response = array("success" => false, "message" => "Failed to move uploaded cover image.");
        }
    } else {
        // Prepare and execute the SQL update statement without cover image
        $stmt = $conn->prepare("UPDATE books SET title=?, author=?, description=?, genre=?, availability=?, quantity=? WHERE id=?");
        $stmt->bind_param("ssssisi", $title, $author, $description, $genre, $availability, $quantity, $id); // Modified parameter type definition
        $result = $stmt->execute();

        if ($result) {
            $response = array("success" => true, "message" => "Book updated successfully.");
        } else {
            $response = array("success" => false, "message" => "Failed to update book. Please try again.");
        }
    }
} else {
    $response = array("success" => false, "message" => "Missing required fields.");
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Function to get the previous cover image path
function getPrevCoverImagePath($id) {
    global $conn;

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT cover_image FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($prevCoverImage);
    $stmt->fetch();
    $stmt->close();

    return $prevCoverImage;
}
?>
