<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readcycle";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['order_id'])) {
    $order_id_to_cancel = $_GET['order_id'];

    // Fetch book_id, quantity, del_status, and delivery_date from the order to be canceled
    $sql_fetch_order = "SELECT book_id, quantity, del_status, delivery_date FROM orders WHERE order_id = ?";
    $stmt_fetch_order = $conn->prepare($sql_fetch_order);
    $stmt_fetch_order->bind_param("i", $order_id_to_cancel);
    $stmt_fetch_order->execute();
    $result_fetch_order = $stmt_fetch_order->get_result();
    $row_fetch_order = $result_fetch_order->fetch_assoc();

    if ($row_fetch_order) {
        $book_id_to_cancel = $row_fetch_order['book_id'];
        $quantity_to_cancel = $row_fetch_order['quantity'];
        $del_status = $row_fetch_order['del_status'];
        $delivery_date = $row_fetch_order['delivery_date'];

        if ($del_status === 'on the way') {
            // Change del_status to 'Cancel'
            $sql_update_status = "UPDATE orders SET del_status = 'Cancel' WHERE order_id = ?";
            $stmt_update_status = $conn->prepare($sql_update_status);
            $stmt_update_status->bind_param("i", $order_id_to_cancel);

            if ($stmt_update_status->execute()) {
                // Update the quantity in the 'add_books' table
                $sql_update_quantity = "UPDATE add_books SET quantity = quantity + ? WHERE book_id = ?";
                $stmt_update_quantity = $conn->prepare($sql_update_quantity);
                $stmt_update_quantity->bind_param("ii", $quantity_to_cancel, $book_id_to_cancel);

                if ($stmt_update_quantity->execute()) {
                    // Redirect back to orders.php
                    header("Location: orders.php");
                    exit();
                } else {
                    echo "Error updating quantity: " . $stmt_update_quantity->error;
                    // Additional information for debugging
                    echo "Query: " . $sql_update_quantity . "<br>";
                    echo "Book ID: " . $book_id_to_cancel . "<br>";
                    echo "Quantity to cancel: " . $quantity_to_cancel . "<br>";
                }

                $stmt_update_quantity->close();
            } else {
                echo "Error updating status: " . $stmt_update_status->error;
            }

            $stmt_update_status->close();
        } elseif ($del_status === 'Cancel') {
            // Delete the delivery_date
            $sql_delete_date = "UPDATE orders SET delivery_date = NULL WHERE order_id = ?";
            $stmt_delete_date = $conn->prepare($sql_delete_date);
            $stmt_delete_date->bind_param("i", $order_id_to_cancel);

            if ($stmt_delete_date->execute()) {
                // Redirect back to orders.php
                header("Location: orders.php");
                exit();
            } else {
                echo "Error deleting delivery date: " . $stmt_delete_date->error;
            }

            $stmt_delete_date->close();
        }
    } else {
        echo "Order not found!";
    }

    $stmt_fetch_order->close();
}

// Close database connection
$conn->close();
?>
