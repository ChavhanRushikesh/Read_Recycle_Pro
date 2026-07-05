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

        if (isset($_POST[$quantity_key])) {
            $quantity = $_POST[$quantity_key];
            $total_price += $cart_row['price'] * $quantity; // Update the total price calculation
        }
    }
}

// Update the total price in the database
if ($total_price > 0) {
    $update_total_query = "UPDATE userinfo SET total_price = $total_price WHERE User_ID = $user_id";

    if ($conn->query($update_total_query) === TRUE) {
        // Return success message
        echo "Success";
    } else {
        // Return error message
        echo "Error updating total price: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Your Book Reselling Website - Cart</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<header class="header">
<div class="images">
<a href="categories.php">
<i class="fas fa-arrow-left"></i>
</a>
</div>
<div class="text">
<h4 style="color: #000;">My Cart</h4>
</div>
<div class="icons">
<a href="wishlist.html" class="fas fa-heart"></a>
<a href="cart.php" class="fas fa-shopping-cart"></a>
</div>
</header>
<br><br><br><br><br><br>
<main>
<div class="cart-container">
<?php
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
        echo '<span class="bill-item-price">Price : ' . $cart_row['price'] . ' Rs/-</span><br>';
        echo '<label>Total amount : </label>';
        echo '<div class="cart-item-price" data-unit-price="' . $cart_row['price'] . '"> ' . $cart_row['price'] . ' Rs/-</div>';
        echo '<label for="quantity_' . $cart_row['book_id'] . '">Select Quantity:</label>';
        echo '<select class="quantity-select" id="quantity_' . $cart_row['book_id'] . '" name="quantity_' . $cart_row['book_id'] . '">';

        // Display numbers up to the available quantity
        for ($i = 1; $i <= $cart_row['quantity']; $i++) {
            echo '<option value="' . $i . '">' . $i . '</option>';
        }

        echo '</select>';
        echo '<div>Seller name :' . $cart_row['name'] . '</div>';
        echo '<div>Seller email :' . $cart_row['email'] . '</div>';

        echo '</div>';
        echo '</div>';
    }
}
?>
</div>
<div class="bill-container">
<hr style="color: #F0F8FF;">
<div class="bill-title">Bill Details</div>
<hr style="color: #F0F8FF;">
<br>
<span><b>Delivery Charges :   Free </b></span><br><br>
<form method="post" action="order_confirmation.php" id="orderForm">
<?php
if (isset($cart_result) && $cart_result->num_rows > 0) {
    $cart_result->data_seek(0); // Reset result pointer for looping through again
    while ($cart_row = $cart_result->fetch_assoc()) {
        $book_id = $cart_row['book_id'];
        $quantity_key = 'quantity_' . $book_id;

        echo '<input type="hidden" name="' . $quantity_key . '" value="' . (isset($_POST[$quantity_key]) ? $_POST[$quantity_key] : 1) . '">';
    }
    echo '<div class="bill-total">';
    echo '<span>Total  :  <span id="totalBill">' . $total_price . '</span> Rs/-</span><br><br>';
    echo '</div>';
    echo '<div>';
    echo '<br><hr style="color: #F0F8FF;">';
    $deliveryDate = date('F j, Y', strtotime('+3 days'));
    // Display the order confirmation and delivery date
    echo "<p>Your order will be delivered to your address on <b>$deliveryDate</b>.</p>";
    echo '</div>';
    echo '<hr style="color: #F0F8FF;">';
    echo "<div class='payment-method'>";
    echo "<h3 class='center'>Select Payment Method :</h3><br>";

    $paymentMethods = ['cash' => 'Cash On Delivery', 'online' => 'Online Banking'];

    foreach ($paymentMethods as $methodValue => $methodLabel) {
        echo "<label for='{$methodValue}'>";
        echo "<input type='radio' id='{$methodValue}' name='paymentMethod' value='{$methodValue}' onchange='updateHiddenPaymentMethod()' required>";
        echo "<b>{$methodLabel}</b>";
        echo "</label><br>";
    }

    echo "</div>";
    echo "<input type=\"hidden\" id=\"hiddenPaymentMethod\" name=\"hiddenPaymentMethod\" value=\"\">";
    echo "<hr>";
    echo "<br>";
    echo "<div class='center'>";
    echo "<label for='captchaInput'><b>Enter Captcha:</b></label>";
    echo "</div>";
    echo "<div class='center'>";
    echo "<input type='text' id='captchaInput' name='captchaInput' required><br>";
    echo "<label id='captchaLabel' name='captchaLabel'><strong>Generating...</strong></label>";
    echo "</div>";
    echo "<div class='center'>";

    echo "<button type='button' class='generate-button' onclick='generateCaptcha()'>Generate Captcha</button>";
    echo "</div>";
    echo "<hr>";
    echo "<div class='center'>";
    echo "<button class='continue-btn' type='button' onclick='proceedToConfirmation()'>Proceed to Confirmation</button>
";
    echo "</div>";
    echo "</form>";
} else {
    echo '<p>No items to calculate total.</p>';
}
?>
</div>
</div>
</main>
<script>
    function removeBook(bookId) {
        if (confirm("Are you sure you want to remove this item from the cart?")) {
            window.location.href = "cart.php?remove_from_cart=" + bookId;
        }
    }

    function proceedToConfirmation() {
    // Validate form and update total before submission
    if (validateForm()) {
        updateTotal();
        // Submit the form asynchronously using AJAX
        var form = document.getElementById('orderForm');
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Check if data is saved successfully
                    if (xhr.responseText.trim() === 'Success') {
                        // Redirect to confirmation page
                        window.location.href = "order_confirmation.php";
                    } else {
                        // Handle error
                        alert("Error occurred while saving data. Please try again.");
                    }
                } else {
                    // Handle error
                    alert("Error occurred while processing your request. Please try again later.");
                }
            }
        };
        xhr.send(formData);
    }
}


    function generateCaptcha() {
        // Generate a random captcha code
        var captchaCode = Math.random().toString(36).substr(2, 6);
        
        // Display the captcha code in the label
        document.getElementById('captchaLabel').textContent = captchaCode;
        
        // Set the captcha code as the value of the input field
        document.getElementById('captchaInput').value = captchaCode;
    }

    function updateTotal() {
        var total = 0;

        document.querySelectorAll('.cart-item').forEach(function (item) {
            var quantitySelect = item.querySelector('.quantity-select');
            var priceElement = item.querySelector('.cart-item-price');
            var removeButton = item.querySelector('.remove-btn');

            var quantity = parseInt(quantitySelect.value);
            var unitPrice = parseFloat(priceElement.dataset.unitPrice);
            var itemTotal = quantity * unitPrice;
            priceElement.textContent = itemTotal.toFixed(2) + ' Rs/-';

            total += itemTotal;
        });

        document.getElementById('totalBill').textContent = total.toFixed(2);
    }

    document.querySelectorAll('.quantity-select').forEach(function (select) {
        select.addEventListener('change', updateTotal);
    });
</script>
</body>
</html>
