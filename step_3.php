<?php
session_start();
function generateCaptcha() {
    return mt_rand(100000, 999999); // Change this to your captcha generation logic
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readcycle";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
if (isset($_GET['book_id'])) {
    $book_id_to_buy = $_GET['book_id'];
    echo "Book ID to Buy: $book_id_to_buy"; // Add this line to print the book_id for debugging
} else {
    echo "Error: Book ID not received.";
}

// Fetch user details from userinfo table
$user_data = [];
$sql_user = "SELECT * FROM userinfo WHERE User_ID = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows > 0) {
    $user_data = $result_user->fetch_assoc();
}

$stmt_user->close();

// Fetch book details from add_books table
$book_details = '';
$user_id = $_SESSION['user_id'];

// Fetch book details from add_books table based on the user's cart
$sql_books = "SELECT * FROM add_books WHERE book_id = ? LIMIT 1";
$stmt_books = $conn->prepare($sql_books);
$stmt_books->bind_param("i", $book_id_to_buy);
$stmt_books->execute();
$result_books = $stmt_books->get_result();

if ($result_books->num_rows > 0) {
    $row = $result_books->fetch_assoc(); // Fetch the first row (since we limited to 1)

    $book_details .= "<div class='book-details-container'>";
    $book_details .= "<div class='book-image'>";
    $book_details .= "<img src='{$row['book_image']}' alt='{$row['book_name']}' style='max-width: 200px;'>";
    $book_details .= "</div>";
    $book_details .= "<div class='book-info'>";
    $book_details .= "<h2>{$row['book_name']}</h2><br>";
    $book_details .= "<p><b>Author:</b> {$row['author']}</p>";
    $book_details .= "<p><b>Condition:</b> {$row['book_condition']}</p>";
    $available_quantity = $row['quantity'];

    // Display the quantity dropdown menu
    $book_details .= "<form action='my_orders.php' method='POST'>";
    $book_details .= "<label for='quantity'><b>Select Quantity: </b></label>";
    $book_details .= "<select id='quantity' name='quantity' onchange='updateTotalBill(this)'>";

    // Populate dropdown options dynamically based on available quantity
    for ($i = 1; $i <= $available_quantity; $i++) {
        $book_details .= "<option value='$i'>$i</option>";
    }

    $book_details .= "</select>";

    // Calculate total bill based on the selected quantity
    $price = (float)$row['price'];
    $total_bill = $price; // Initialize total bill with the price of 1 item
    $book_details .= "<input type='hidden' name='quantity' id='hiddenQuantity' value='1'> <!-- Default quantity -->";
    $book_details .= "<input type='hidden' name='price' value='<?= $price; ?>'>";
    $book_details .= "<input type='hidden' name='total_bill' id='hiddenTotalBill' value='0'> <!-- Default total bill -->";
    


    $book_details .= "<p><b>Seller Name:</b> {$row['name']}</p>";
    $book_details .= "<p><b>Seller Email:</b> {$row['email']}</p>";

    // Fetch available quantity from the add_books table
    $deliveryDate = date('F j, Y', strtotime('+3 days'));

    // Concatenate the order confirmation and delivery date to $book_details
    $book_details .= "<br><p style=\"color:purple;\">Your order will be delivered to your address on <b>$deliveryDate</b>.</p>";

    $book_details .= "</div>";
    $book_details .= "</div>";
    $book_details .= "</div>";

    // Include JavaScript to update total bill dynamically
    // ... (Your existing code)

    $book_details .= "<script>
    var price = " . $price . "; // Set the price in JavaScript variable

function updateTotalBill() {
    var quantity = document.getElementById('quantity').value;
    var totalBill = (parseFloat(price) * parseInt(quantity)).toFixed(2);
    document.getElementById('totalBill').innerText = totalBill;
    document.getElementById('hiddenQuantity').value = quantity;
    document.getElementById('hiddenTotalBill').value = totalBill;

    // Add these lines to debug
    console.log('Selected Quantity in step_3.php: ' + quantity);
    console.log('Total Bill in step_3.php: ' + totalBill);
}

function validateForm() {
    // Implement form validation logic if needed
    return true; // Return true to submit the form
}
</script>";


    


 
    // Form for submitting captcha and placing the order
    $book_details .= "<form action='my_orders.php' method='POST' onsubmit='return validateCaptcha()'>";
    $book_details .= "<div>";
    $book_details .= "<label for='captchaInput'>Enter Captcha:</label>";
    $book_details .= "<input type='text' id='captchaInput' name='captchaInput' required>";
    $book_details .= "<label id='captchaLabel' name='captchaLabel'>Generating...</label>";
    $book_details .= "<button type='button' class='generate-button' onclick='generateCaptcha()'>Generate Captcha</button>";
    $book_details .= "</div>";

    // Display the quantity dropdown menu
    $book_details .= "<label for='quantity'><b>Select Quantity: </b></label>";
    $book_details .= "<select id='quantity' name='quantity' onchange='updateTotalBill()'>";

    // Populate dropdown options dynamically based on available quantity
    for ($i = 1; $i <= $available_quantity; $i++) {
        $selected = isset($_POST['quantity']) && $_POST['quantity'] == $i ? 'selected' : '';
        $book_details .= "<option value='$i' $selected>$i</option>";
    }

    $book_details .= "</select>";

    // Hidden inputs for book_id, price, and additional parameters
    $book_details .= "<input type='hidden' name='book_id' value='$book_id_to_buy'>";
    $book_details .= "<input type='hidden' name='price' value='$price'>";

    // Payment method section
    $book_details .= "<div class='payment-info'>Payment Method</div>";
    $book_details .= "<div class='payment-method'>";
    $book_details .= "<label for='cashOnDelivery'>";
    $book_details .= "<input type='radio' id='cashOnDelivery' name='paymentMethod' value='cash' required>";
    $book_details .= "Cash On Delivery";
    $book_details .= "</label>";
    $book_details .= "<label for='onlineBanking'>";
    $book_details .= "<input type='radio' id='onlineBanking' name='paymentMethod' value='online' required>";
    $book_details .= "Online Banking";
    $book_details .= "</label>";
    $book_details .= "</div>";

    $book_details .= "<input type='submit' value='Proceed to Confirmation'>";
    $book_details .= "</form>";
} else {
    echo "Error: Book details not found.";
}

$stmt_books->close();

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method</title>
    <style>
        body {
            font-family: "Poppins", times new roman;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 500px;
            height: 500px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 50px;
        }

        /* Updated CSS */
        form {
            text-align: left;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            display: block;
            font-size: 24px;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: calc(100% - 20px); /* Adjust width as needed */
            padding: 8px;
            font-size: 24px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button.generate-button {
            display: block;
            margin-top: 10px;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button.generate-button:hover {
            background-color: #0056b3;
        }

        /* Style for Payment Method and Cash on Delivery */
        .payment-info {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            margin-top: 10px;
            margin-bottom: 10px;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            align-self: center; /* Align the submit button to the center */
        }

        input[type="submit"]:hover {
            background-color: red;
        }

        /* Style for Payment Method radio buttons */
        .payment-method {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        /* Updated CSS */
        .payment-method label {
            font-weight: normal;
        }
    </style>
</head>
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
    <div class="container">
        <h2>Payment Details</h2>
        <form action="my_orders.php" method="POST" onsubmit="return validateForm()">
    <div>
        <label for="captchaInput">Enter Captcha:</label>
        <input type="text" id="captchaInput" name="captchaInput" required>
        <label id="captchaLabel" name="captchaLabel">Generating...</label>
    </div>
    <button type="button" class="generate-button" onclick="generateCaptcha()">Generate Captcha</button>
    <div class="payment-info">Payment Method</div>
    <div class="payment-method">
        <label for="cashOnDelivery">
            <input type="radio" id="cashOnDelivery" name="paymentMethod" value="cash" required>
            Cash On Delivery
        </label>
        <label for="onlineBanking">
            <input type="radio" id="onlineBanking" name="paymentMethod" value="online" required>
            Online Banking
        </label>
    </div>
    <input type='hidden' name='quantity' id='hiddenQuantity' value='1'> <!-- Default quantity -->
<input type='hidden' name='price' value='<?= $price; ?>'>
<input type='hidden' name='total_bill' id='hiddenTotalBill' value='0'> <!-- Default total bill -->



    <?php if (isset($book_id_to_buy)) : ?>
        <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($_GET['book_id']); ?>">
    <?php endif; ?>
    <button type="submit" value="Proceed to Confirmation">Submit</button>
</form>


    </div>
    <script>
    // Function to generate a random captcha
    function generateCaptcha() {
        var captcha = Math.random().toString(36).substring(7);
        document.getElementById("captchaLabel").textContent = captcha;
        document.getElementById("captcha").value = captcha; // Update the hidden input value
        document.getElementById("captchaInput").value = ""; // Clear the input field
    }

    // Function to validate captcha before form submission
    function validateForm() {
        var enteredCaptcha = document.getElementById("captchaInput").value.trim();
        var generatedCaptcha = document.getElementById("captcha").value.trim();

        if (enteredCaptcha === "") {
            alert("Please enter the captcha.");
            return false;
        } else if (enteredCaptcha !== generatedCaptcha) {
            alert("Entered captcha is wrong");
            return false;
        }

        var paymentMethodSelected = false;
        var paymentMethodInputs = document.querySelectorAll('input[name="paymentMethod"]');
        paymentMethodInputs.forEach(function (input) {
            if (input.checked) {
                paymentMethodSelected = true;
            }
        });

        if (!paymentMethodSelected) {
            alert("Please select the payment method");
            return false;
        }

        return true;
    }

    // Add event listener to online banking radio button
    document.getElementById('onlineBanking').addEventListener('change', function () {
        if (this.checked) {
            window.open('Online_Banking.php', '_blank');
        }
    });
</script>

</body>
</html>
