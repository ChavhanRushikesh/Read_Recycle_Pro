<?php
session_start();
// var_dump($_POST); // Commented out this line to prevent array output

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readcycle";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if necessary POST parameters are set
    $requiredParameters = ['book_id', 'quantity', 'price', 'captchaInput', 'paymentMethod'];
    $missingParameters = [];

    foreach ($requiredParameters as $param) {
        if (!isset($_POST[$param])) {
            $missingParameters[] = $param;
        }
    }

    if (empty($missingParameters)) {
        // All required parameters are set
        $book_id_to_buy = isset($_GET['book_id']) ? $_GET['book_id'] : null;
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $paymentMethod = $_POST['paymentMethod'];

        // Calculate total bill
        $total_bill = (float)$price * (int)$quantity;

        // Insert order details into 'orders' table
        $sql_insert_order = "INSERT INTO orders (user_id, book_id, quantity, total_bill, payment_method, order_date, delivery_date, del_status) VALUES (?, ?, ?, ?, ?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 3 DAY), 'on the way')";
        $stmt_insert_order = $conn->prepare($sql_insert_order);
        $stmt_insert_order->bind_param("iiids", $user_id, $book_id_to_buy, $quantity, $total_bill, $paymentMethod);

        if ($stmt_insert_order->execute()) {
            // Fetch the order_id after insertion
            $order_id = $stmt_insert_order->insert_id;

            // Update the quantity in the 'add_books' table
            $sql_update_quantity = "UPDATE add_books SET quantity = quantity - ? WHERE book_id = ?";
            $stmt_update_quantity = $conn->prepare($sql_update_quantity);
            $stmt_update_quantity->bind_param("ii", $quantity, $book_id_to_buy);

             if ($stmt_update_quantity->execute()) {
                // Output success message
                echo '<div style="text-align: center; margin-top: 180px;"><div style="width: 50%; margin: 0 auto; box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.2); padding: 20px;"><img src="images/check.gif" /><h1>Congratulations!</h1><h2>Your Order placed successfully!</h2></div></div>';
            } else {
                echo "Error updating quantity: " . $stmt_update_quantity->error;
            }

            $stmt_update_quantity->close();
        } else {
            echo "Error placing the order: " . $stmt_insert_order->error;
        }

        $stmt_insert_order->close();
    } else {
        // Some required parameters are missing
        echo '<div style="text-align: center; margin-top: 50px;"><h1>Error: Required parameters not received. Missing parameters: ' . implode(', ', $missingParameters) . '</h1></div>';
    }

    // Cleanup: Unset captcha session variable
    unset($_SESSION['captcha']);

    // Stop script execution
    die();
} else {
    // Handle the case when the form is not submitted
    echo '<div style="text-align: center;"><h1>Error: Form not submitted.</h1></div>';
}

// Close database connection
$conn->close();
?>
