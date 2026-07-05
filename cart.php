<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Include your database connection code
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

// Check if the remove_from_cart parameter is set
if (isset($_GET['remove_from_cart'])) {
    $book_id_to_remove = $_GET['remove_from_cart'];

    // Assuming you have a logged-in user and their user_id
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Check if $conn is not null before using it
        if ($conn) {
            // Remove the selected book from the cart_books table
            $delete_query = "DELETE FROM cart_books WHERE User_ID = '$user_id' AND book_id = '$book_id_to_remove'";
            $conn->query($delete_query);
        } else {
            echo "Database connection error.";
        }
    } else {
        // Handle the case where the user is not logged in
        echo "User not logged in.";
    }
}

// Fetch cart items for the logged-in user
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $cart_query = "SELECT add_books.book_id, add_books.category, add_books.book_name, add_books.price, add_books.book_image,add_books.name,add_books.email, userinfo.User_ID
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
        $total_price += $cart_row['price']; // Use 'price' instead of 'book_price'
    }
}

// Include your header
echo '<html lang="en">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>Your Book Reselling Website - Cart</title>';
echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">';
echo '</head>';
echo '<body>';

echo '<header class="header">';
echo '<div class="images">';
echo '<a href="categories.php">';
echo '<i class="fas fa-arrow-left"></i>';
echo '</a>';
echo '</div>';
echo '<div class="text">';
echo '<h4 style="color: #000;">My Cart</h4>';
echo '</div>';
echo '<div class="icons">';
echo '<a href="wishlist.html" class="fas fa-heart"></a>';
echo '<a href="cart.php" class="fas fa-shopping-cart"></a>';
echo '</div>';
echo '</header>';
echo '<br><br><br><br><br><br>';

echo '<main>';
echo '<div class="cart-container">';
// HTML code to display cart items
if (isset($cart_result) && $cart_result->num_rows > 0) {
    $cart_result->data_seek(0); // Reset result pointer for looping through again
    while ($cart_row = $cart_result->fetch_assoc()) {
        echo '<div class="cart-item">';
        echo '<div class="book-image">';
        echo '<img src="' . $cart_row['book_image'] . '" alt="' . $cart_row['book_name'] . '">';
        echo '</div>';
        echo '<div class="cart-item-details">';
        echo '<div class="cart-item-title">' . $cart_row['book_name'] . '</div>';
        echo '<div class="cart-item-price">' . $cart_row['price'] . ' Rs/-</div>';
        echo '<div>Seller name :' . $cart_row['name'] . '</div>';
        echo '<div>Seller email :' . $cart_row['email'] . '</div>';
        echo '<button class="remove-btn" onclick="removeBook(' . $cart_row['book_id'] . ')">Remove</button>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>No items in the cart.</p>';
}
echo '</div>';

// Bill Details
echo '<div class="bill-container">';
echo '<div class="bill-title">Bill Details</div>';
echo '<br>';
echo '<form method="post" action="cartStep2.php">';
if (isset($cart_result) && $cart_result->num_rows > 0) {
    $cart_result->data_seek(0); // Reset result pointer for looping through again
    while ($cart_row = $cart_result->fetch_assoc()) {
        echo '<div class="bill-item">';
        echo '<span class="bill-item-title">' . $cart_row['book_name'] . '</span>';
        echo '<span class="bill-item-price">' . $cart_row['price'] . ' Rs/-</span>';
        echo '</div>';
    }
    echo '<div class="bill-total">';
    echo '<span>Total: ' . $total_price . ' Rs/-</span>';
    echo '</div>';
    echo '<div>';
    echo '<button type="submit" class="checkout-btn">Proceed to Checkout</button>';
    echo '</div>';
} else {
    echo '<p>No items to calculate total.</p>';
}
echo '</form>';
echo '</div>';
echo '</main>';

// Include your footer content
echo '<script>';
echo 'function removeBook(bookId) {';
echo '  if (confirm("Are you sure you want to remove this item from the cart?")) {';
echo '    window.location.href = "cart.php?remove_from_cart=" + bookId;';
echo '  }';
echo '}';
echo '</script>';

echo '</body>';
echo '</html>';

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Book Reselling Website - Cart</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #E6F7FF;
    }

   .header{
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #002147;
            padding: 1rem 9%;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000;
        }

        .header .images {
            display: flex;
            align-items: center;
            margin-left: -120px; 
        }

        .header .images a{
            border: none;
            outline: none;
            background-color: transparent;
            color: white;
			font-size:22px;
        }

        .header .images a:hover {
            color: #fff; 
        }

        .header .text {
    color: white;
    margin-left: 20px; /* Adjust the value as per your preference */
    font-size: 24px;
    font-weight: 500;
    flex-grow: 1; /* This will allow the text to take up available space */
}

    main {
      padding: 20px;
      display: flex;
      justify-content: space-between;
    }

    .cart-container {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      width: 70%;
    }

    .cart-item {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 15px;
      width: 400px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Add shadow effect */
      position: relative;
      display: flex;
    }

    .book-image {
      height: 150px;
      width: 150px;
      overflow: hidden;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .book-image img {
      width: 100%;
      height: auto;
    }

    .cart-item-details {
      flex-grow: 1;
      padding-left: 20px;
    }

    .cart-item-title {
      font-weight: bold;
      margin-top: 10px;
      margin-bottom: 10px;
    }

    .cart-item-price {
      color: #e44d26;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .remove-btn {
      background-color: #e44d26;
      color: #fff;
      padding: 5px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .bill-container {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 15px;
      width: 30%;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Add shadow effect */

    }

    .bill-title {
      font-weight: bold;
      text-align: center;
      font-size: 20px;
      margin-bottom: 10px;
    }

    .bill-item {
      display: flex;
      justify-content: space-between;
      margin-bottom: 8px;
    }

    .bill-total {
      font-weight: bold;
      margin-top: 20px;
    }

    .checkout-btn {
      background-color: #e44d26;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
  </style>
</head>
<body>
    <body>
        <script>
	function goBack() {
  window.history.back()
}
</script>
<header class="header">
<div class="images">
<a>
<i class="fas fa-arrow-left" onclick="goBack()"></i>
</a>
</div>
            <div class="text">
                <h4 style="color: #fff;">My Cart</h4>
            </div>
            
        </header>
        <br><br><br><br><br><br>

 </body>
 
 </html>