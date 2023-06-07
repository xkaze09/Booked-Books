<?php
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request body
    $requestBody = file_get_contents('php://input');
    
    // Decode the JSON data
    $requestData = json_decode($requestBody, true);
    
    // Get the cart and user ID from the request data
    $cart = $requestData['cart'];
    $userId = $requestData['userId'];
    
    // Perform any necessary validations or checks
    
    // Process the rent request
    $success = processRentRequest($cart, $userId);
    
    // Prepare the response data
    $response = array('success' => $success);
    
    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    exit();
}

// Function to process the rent request
function processRentRequest($cart, $userId) {
    // Perform the necessary steps to process the rent request
    // Here you can implement any logic such as updating the database, sending notifications, etc.
    // Return true if the rent request was processed successfully, false otherwise
    // Example code:
    
    // Connect to the database (replace with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bbdatabase";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Iterate over the cart items and update the status of rented books
    foreach ($cart as $bookId) {
        // Update the database with the rented book status
        $sql = "UPDATE books SET availability = 'Rented' WHERE id = $bookId";
        if ($conn->query($sql) !== TRUE) {
            // Error updating the database
            $conn->close();
            return false;
        }
    }

    // Insert the rent request into the rent_requests table
    $sql = "INSERT INTO rent_requests (user_id, request_date) VALUES ($userId, NOW())";
    if ($conn->query($sql) !== TRUE) {
        // Error inserting the rent request
        $conn->close();
        return false;
    }

    $conn->close();
    return true;
}
