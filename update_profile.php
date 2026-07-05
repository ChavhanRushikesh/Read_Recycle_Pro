<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readcycle";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['save_changes'])) {
    $user_id = $_SESSION['user_id'];
    
    // Retrieve form fields
    $fullName = $_POST['fullName'];
    $mobileNumber = $_POST['mobileNumber'];
    $cityWithPin = $_POST['cityWithPin'];
    $colonyHouseNo = $_POST['colonyHouseNo'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    // Add similar code for other form fields

    // Update user information in the database
    $sql = "UPDATE userinfo SET Full_Name=?, Mobile_Number=?, City_Pin=?, Colony_HouseNo=?, State=?, Country=?  WHERE User_ID=?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssssssi", $fullName, $mobileNumber, $cityWithPin, $colonyHouseNo, $state, $country, $user_id);
        $stmt->execute();
        $stmt->close();
        header("Location: account.php"); // Redirect back to the account page
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
    
}

$conn->close();
?>
