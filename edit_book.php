<?php
// Start the session
session_start();

// Assuming you have a database connection established
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $book_id = $_POST['book_id'];
    $category = $_POST['category'];
    $book_condition = $_POST['book_condition'];
    $book_name = $_POST['book_name'];
    $price = $_POST['price'];
    $author = $_POST['author'];
    $subcategory = $_POST['subcategory'];
    // Validate and sanitize data as needed
    
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "readcycle";

    // Create a new connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement with prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE add_books SET category=?, book_condition=?, book_name=?, price=?, author=?, subcategory=? WHERE book_id=?");

    // Check if the preparation was successful
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssssi", $category, $book_condition, $book_name, $price, $author, $subcategory, $book_id);

    // Execute the statement
    $result = $stmt->execute();

    // Check if the execution was successful
    if ($result) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();

    exit; // Stop further execution
}

// If the form is not submitted or if the update process is complete, redirect back to the previous page
header("location: my add books.php");
exit;
?>
