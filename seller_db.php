<?php
// Enable error reporting to display any errors or warnings
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readcycle"; // Your database name

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    // If connection fails, display an error message and stop further execution
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $category = $_POST["category"];
    $condition = $_POST["condition"];
    $bookname = $_POST["bookname"];
	 $bookactualprice = $_POST["bookactualprice"];
    $bookprice = $_POST["bookprice"];
	$quantity = $_POST["quantity"];
    $author = $_POST["author"];
    $subcategory = $_POST["subcategory"];
    $name = $_POST["name"];
    $email = $_POST["email"];

    // Check if a file is uploaded
    if (isset($_FILES["file"]["tmp_name"]) && !empty($_FILES["file"]["tmp_name"])) {
        // Move the uploaded file to a permanent location
        $target_dir = "images/"; // Specify the directory where you want to store uploaded files
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            // File uploaded successfully, store the file path in the $file variable
            $file = $target_file;
        } else {
            // If there's an error uploading the file, display an error message
            echo "Sorry, there was an error uploading your file.";
            $file = ""; // Set $file to an empty string
        }
    } else {
        // If no file is uploaded, display a message
        echo "No file uploaded.";
        $file = ""; // Set $file to an empty string
    }

    // Prepare the SQL statement with prepared statements to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO add_books (category, book_condition, book_name, actual_price, price, author, subcategory, book_image, name, email, quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters
$stmt->bind_param("ssssssssssi", $category, $condition, $bookname, $bookactualprice, $bookprice, $author, $subcategory, $file, $name, $email, $quantity);


    // Execute the statement
    if ($stmt->execute()) {
        // If the record is inserted successfully, display a success message
        // Redirect to the corresponding page based on the selected category
        switch ($category) {
            case "fiction":
                header("Location: fiction_new.php");
                break;
            case "non-fiction":
                header("Location: non_fiction.php");
                break;
            case "reference":
                header("Location: reference.php");
                break;
				case "poetry":
                header("Location: poetry.php");
                break;
				case "drama":
                header("Location: drama.php");
                break;
				case "childrens-literature":
                header("Location: childrens-literature.php");
                break;
				case "religious-spiritual":
                header("Location: religious-spiritual.php");
                break;
				case "academic-textbook":
                header("Location: academic-textbook.php");
                break;
				case "graphic-novels-comic":
            header("Location: graphic-novels-comic.php"); // Add this line to redirect to graphic-novels-comics.php
            break;
				case "diy-and-hobby":
                header("Location: diy-and-hobby.php");
                break;
            default:
                // If no specific category is selected, redirect to a default page
                header("Location: default.php");
                break;
        }
        exit(); // Terminate the script after redirection
    } else {
        // If there's an error executing the statement, display the error message
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
