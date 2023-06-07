<?php

include_once 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST["title"];
    $author = $_POST["author"];
    $description = $_POST["description"];
    $genre = $_POST["genre"];
    $availability = $_POST["availability"];
    $quantity = $_POST["quantity"];

    // Handle the cover image file upload
    $targetDirectory = "./uploads/"; // Specify the directory where you want to save the uploaded images
    $targetFile = $targetDirectory . basename($_FILES["cover_image"]["name"]); // Get the file name
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // Get the file extension

    // Check if the file is a valid image
    $validExtensions = ["jpg", "jpeg", "png"];
    if (!in_array($imageFileType, $validExtensions)) {
        echo "Invalid file format. Only JPG, JPEG, and PNG files are allowed.";
        // You can handle the error case as needed (e.g., redirect back to the form with an error message)
        exit;
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["cover_image"]["tmp_name"], $targetFile)) {
        // File uploaded successfully, proceed with database insertion

        // Prepare the INSERT statement
        $sql = "INSERT INTO books (title, author, description, genre, availability, quantity, cover_image) 
                VALUES ('$title', '$author', '$description', '$genre', '$availability', '$quantity', '$targetFile')";

        // Execute the statement
        if ($conn->query($sql) === TRUE) {
            echo "Book added successfully.";
        } else {
            echo "Error adding book: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
        // You can handle the error case as needed
    }

    // Close the connection
    $conn->close();

    // After inserting the data and handling the file upload, can redirect the user to a success page or perform any other necessary actions
}
?>
