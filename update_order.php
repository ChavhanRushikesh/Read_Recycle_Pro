<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "readcycle");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $order_id = isset($_POST['order_id']) ? mysqli_real_escape_string($con, $_POST['order_id']) : '';
    $del_status = isset($_POST['del_status']) ? $_POST['del_status'] : '';
    $payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : '';

    // Print debugging information
    echo "Order ID: $order_id<br>";
    echo "Delivery Status: " . $del_status . "<br>";
    echo "Payment Status: " . $payment_status . "<br>";

    // Update query using prepared statement
    $query = "UPDATE orders SET del_status = ?, payment_status = ? WHERE order_id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($con, $query);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ssi", $del_status, $payment_status, $order_id);

    // Execute the statement only if the dropdown values are different
    if (mysqli_stmt_execute($stmt)) {
        // If update successful, redirect back to view_orders.php or any other page
        header("Location: view_orders.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Redirect to view_orders.php if accessed directly
    header("Location: view_orders.php");
    exit();
}
?>
