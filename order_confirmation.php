<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readcycle";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch cart items for the logged-in user
    $cart_query = "SELECT add_books.book_id, add_books.category, add_books.quantity, add_books.book_name, add_books.price, add_books.book_image, add_books.name, add_books.email, userinfo.User_ID
                   FROM cart_books
                   INNER JOIN add_books ON cart_books.book_id = add_books.book_id
                   INNER JOIN userinfo ON cart_books.User_ID = userinfo.User_ID
                   WHERE cart_books.User_ID = '$user_id'";
    $cart_result = $conn->query($cart_query);
}

// Calculate the total price
$total_price = 0;
if (isset($cart_result) && $cart_result->num_rows > 0) {
    while ($cart_row = $cart_result->fetch_assoc()) {
        $book_id = $cart_row['book_id'];
        $quantity_key = 'quantity_' . $book_id;

        $quantity = isset($_POST[$quantity_key]) ? $_POST[$quantity_key] : 1; // Default to 1 if not set
        $total_price += $cart_row['price'] * $quantity;
    }
}

// Include your header
echo '<html lang="en">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>Your Book Reselling Website - Order Confirmation</title>';
echo '<link rel="stylesheet" href="path/to/your/style.css">'; // Add the path to your stylesheet
echo '</head>';
echo '<body>';

echo '<header class="header">';
// Add your header content here
echo '</header>';

echo '<main>';
echo '<div class="order-confirmation">';
//echo '<h2>Your order has been placed successfully!</h2>';
//echo '<p>Order details:</p>';
echo '<ul>';

// Insert orders for each book in the cart
if (isset($cart_result) && $cart_result->num_rows > 0) {
    $cart_result->data_seek(0); // Reset result pointer for looping through again
    while ($cart_row = $cart_result->fetch_assoc()) {
        $book_id = $cart_row['book_id'];
        $quantity = $_POST['quantity_' . $book_id]; // Get quantity for each book
        $total_bill = $cart_row['price'] * $quantity;

        // Insert order details
        $order_date = date('Y-m-d');
        $delivery_date = date('Y-m-d', strtotime('+3 days'));
        $payment_method = $_POST['paymentMethod'];

        $order_query = "INSERT INTO orders (user_id, book_id, order_date, delivery_date, payment_method, total_bill, quantity, del_status) 
                        VALUES ('$user_id', '$book_id', '$order_date', '$delivery_date', '$payment_method', '$total_bill', '$quantity', 'on the way')";
        $conn->query($order_query);

        // Update quantity in add_books table
        $update_quantity_query = "UPDATE add_books SET quantity = quantity - $quantity WHERE book_id = '$book_id'";
        $conn->query($update_quantity_query);

        //echo '<li>Book: ' . $cart_row['book_name'] . ', Quantity: ' . $quantity . ', Total: ' . number_format($total_bill, 2) . ' Rs/-</li>';
                    echo '<div style="text-align: center; margin-top: 180px;"><div style="width: 50%; margin: 0 auto; box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.2); padding: 20px;"><img src="images/check.gif" /><h1>Congratulations!</h1><h2>Your Order placed successfully!</h2></div></div>';

	}
}

echo '</ul>';
echo '</div>';
echo '</main>';

// Include your footer content
echo '<footer>';
// Add your footer content here
echo '</footer>';

echo '</body>';
echo '</html>';

// Clear the cart for the logged-in user
$clear_cart_query = "DELETE FROM cart_books WHERE user_id = '$user_id'";
$conn->query($clear_cart_query);

// Close database connection
$conn->close();
?>
