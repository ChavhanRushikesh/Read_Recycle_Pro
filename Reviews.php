<?php
// Start the session to access user_id
session_start();

// Display PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readcycle";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Debugging: Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user_id from the session
    $user_id = $_SESSION['user_id'];

    // Get other form data
    $experience = $_POST['experience'];
    $starRating = $_POST['starRating'];

    // Prepare and execute SQL query
    $sql = "INSERT INTO reviews (User_ID, Experience, StarRating) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $user_id, $experience, $starRating);

    if ($stmt->execute()) {
        // Review submitted successfully!
        // Debugging: Display a success message
        //echo "Review submitted successfully!";

        // Redirect to account.php after a short delay
// Redirect to account.php#reviewsContent after a short delay
// Instead of header("Location: account.php");
echo '<script>
          setTimeout(function() {
              window.location.href = "account.php#reviewsContent";
          }, 1000); // Redirect after 2 seconds
      </script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
