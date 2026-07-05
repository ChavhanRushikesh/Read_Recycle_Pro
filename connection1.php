<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "readcycle";

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("Connection Error");
}

if (isset($_POST['apply'])) {
    $data_user = $_POST['user'];
    $data_pass = $_POST['pass'];

    $sql = "SELECT * FROM admin_info WHERE Username='$data_user' AND Password='$data_pass'";
    $result = mysqli_query($data, $sql);

    if ($result) {
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            // Redirect to admin_panel page
            header("Location: admin_panel.php");
            exit();
        } else {
            // Display login failed message
            echo "<script>alert('Login Failed');</script>";
        }
    } else {
        echo "Query Error: " . mysqli_error($data);
    }
}
mysqli_close($data);
?>
