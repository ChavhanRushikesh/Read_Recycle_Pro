<?php
// Start the session
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readcycle";

// Validate session
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("location: login.php");
    exit;
}

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted for updating book
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file has been uploaded
    if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // File upload path
        $targetDir = "images/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes)){
            // Move uploaded file to specified directory
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                // Get form data and sanitize
                $book_id = $_POST['book_id'];
                $category = $_POST['category'];
                $book_condition = $_POST['condition'];
                $book_name = $_POST['bookname'];
                $price = $_POST['bookprice'];
                $author = $_POST['author'];
                $subcategory = $_POST['subcategory'];
                $name = $_POST['name'];
                $email = $_POST['email'];

                // Prepare SQL statement to update book information including book image
                $sql = "UPDATE add_books SET category=?, book_condition=?, book_name=?, price=?, author=?, subcategory=?, name=?, email=?, book_image=? WHERE book_id=?";
                $stmt = $conn->prepare($sql);

                // Bind parameters
                $stmt->bind_param("sssssssssi", $category, $book_condition, $book_name, $price, $author, $subcategory, $name, $email, $targetFilePath, $book_id);

                // Execute the statement
                if ($stmt->execute()) {
                    // Redirect to book list page after successful update
                    header("location: my add books.php"); // Corrected file name
                    exit; // Add exit after header to prevent further execution
                } else {
                    echo "Error updating book information: " . $conn->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "File format not supported.";
        }
    } else {
        echo "No file uploaded.";
    }
}

// Close the connection
$conn->close();
?>
