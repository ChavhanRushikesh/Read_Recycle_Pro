<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection established already
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database_name";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assume $_SESSION['user_id'] contains the user's ID
    $user_id = $_SESSION['user_id'];

    // Process each item in the cart
    foreach ($_POST as $key => $value) {
        // Check if the key corresponds to a quantity input
        if (strpos($key, 'quantity_') !== false) {
            // Extract the book_id from the key
            $book_id = substr($key, strlen('quantity_'));

            // Sanitize input to prevent SQL injection
            $quantity = mysqli_real_escape_string($conn, $value);

            // Update the quantity in the cart table
            $update_query = "UPDATE cart_books SET quantity = $quantity WHERE book_id = $book_id AND User_ID = $user_id";
            $conn->query($update_query);
        }
    }

    // Close the connection
    $conn->close();

    // Redirect the user to the order confirmation page or any other page as needed
    header("Location: confirm_order.php");
    exit();
} else {
    // If the form was not submitted via POST method, redirect the user to the cart page
    header("Location: cart.php");
    exit();
}
?>
