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

$user_id = $_SESSION['user_id'];
if (isset($_GET['book_id'])) {
    $book_id_to_buy = $_GET['book_id'];
} else {
    echo "Error: Book ID not received.";
    die(); // Stop script execution
}

// Fetch book details from add_books table
$book_details = '';

// Fetch book details from add_books table based on the user's cart
$sql_books = "SELECT * FROM add_books WHERE book_id = ? LIMIT 1";
$stmt_books = $conn->prepare($sql_books);
$stmt_books->bind_param("i", $book_id_to_buy);
$stmt_books->execute();
$result_books = $stmt_books->get_result();

if ($result_books->num_rows > 0) {
    $row = $result_books->fetch_assoc();  // Fetch the first row (since we limited to 1)

    $book_details .= "<form id='orderForm' action='my_orders.php?book_id=" . $book_id_to_buy . "' method='POST' onsubmit='return validateForm()'>";

    $book_details .= "<h2 class='center'>Order Details :</h2>";
    $book_details .= "<div class='book-details-container'>";
    $book_details .= "<div class='book-image'>";
    $book_details .= "<img src='{$row['book_image']}' alt='{$row['book_name']}' style='max-width: 200px;'>";
    $book_details .= "</div>";
    $book_details .= "<div class='book-info'>";
    $book_details .= "<p class='center' style='color:red;'>Please review your order details before confirming.</p>";
    $book_details .= "<h2>{$row['book_name']}</h2><br>";
    $book_details .= "<p><b>Author:</b> {$row['author']}</p>";
    $book_details .= "<p><b>Condition:</b> {$row['book_condition']}</p>";
    $available_quantity = $row['quantity'];
    $book_details .= "<label for='quantity'><b>Select Quantity: </b></label>";
    $book_details .= "<select id='quantity' name='quantity' onchange='updateTotalBill()'>";

    // Populate dropdown options dynamically based on available quantity
    for ($i = 1; $i <= $available_quantity; $i++) {
        $book_details .= "<option value='$i'>$i</option>";
    }
    $book_details .= "</select>";

    // Calculate total bill based on the selected quantity
    $price = (float)$row['price'];
    $total_bill = $price; // Initialize total bill with the price of 1 item

    $book_details .= "<p><b>Price per item:</b> $price Rs/-</p>";
    $book_details .= "<p><b>Total Bill:</b> <span id='totalBill'>$total_bill</span> Rs/-</p>";
    $deliveryDate = date('F j, Y', strtotime('+3 days'));
    $book_details .= "<br><p style=\"color:purple;\">Your order will be delivered to your address on <b>$deliveryDate</b>.</p>";

    $book_details .= "</div>"; // Closing book-info div
    $book_details .= "</div>"; // Closing book-details-container div
    $book_details .= "<hr>"; // Below all the book details

    // Additional HTML for payment method
    $book_details .= "<div class='payment-method'>";
    $book_details .= "<h3 class='center'>Select Payment Method :</h3><br>";

    // Online Banking Radio Button
    $book_details .= "<label for='online'>";
    $book_details .= "<input type='radio' id='online' name='paymentMethod' value='online' onchange='updateHiddenPaymentMethod()' onclick='showBankDetails()' required>";
    $book_details .= "<b>Online Banking</b>";
    $book_details .= "</label><br>";

    // Cash On Delivery Radio Button
    $book_details .= "<label for='cash'>";
    $book_details .= "<input type='radio' id='cash' name='paymentMethod' value='cash' onchange='updateHiddenPaymentMethod()' required>";
    $book_details .= "<b>Cash On Delivery</b>";
    $book_details .= "</label><br>";

    $book_details .= "</div>";

    // Bank Details Container
    $book_details .= "<div id='bankDetailsContainer' class='center' style='display: none;'>";
    $book_details .= "<h3 class='center'>Bank Details:</h3>";
    $book_details .= "<label for='bankName'>Bank Name:</label>";
    $book_details .= "<input type='text' id='bankName' name='bankName'><br><br>";

    $book_details .= "<label for='accountNumber'>Account Number:</label>";
    $book_details .= "<input type='text' id='accountNumber' name='accountNumber'><br><br>";

    $book_details .= "<label for='ifscCode'>IFSC Code:</label>";
    $book_details .= "<input type='text' id='ifscCode' name='ifscCode'><br><br>";

    $book_details .= "<label for='payment'>Payment:</label>";
    $book_details .= "<input type='text' id='payment' name='payment' value='' readonly><br><br>";
    $book_details .= "</div>";
    $book_details .= "<hr>"; // After payment methods

    // Additional HTML for captcha
    $book_details .= "<div class='center'>";
    $book_details .= "<br>";
    $book_details .= "<label for='captchaInput'><b>Enter Captcha:</b></label>";
    $book_details .= "</div>";
    $book_details .= "<div class='center'>";
    $book_details .= "<input type='text' id='captchaInput' name='captchaInput' required><br>";
    $book_details .= "<label id='captchaLabel' name='captchaLabel'><strong>Generating...</strong></label>";
    $book_details .= "</div>";
    $book_details .= "<div class='center'>";

    $book_details .= "<button type='button' class='generate-button' onclick='generateCaptcha()'>Generate Captcha</button>";
    $book_details .= "</div>";

    $book_details .= "<input type='hidden' name='book_id' value='" . $book_id_to_buy . "'>";
    $book_details .= "<input type='hidden' id='hiddenQuantity' name='quantity' value=''>";
    $book_details .= "<input type='hidden' id='hiddenTotalBill' name='total_bill' value=''>";
    $book_details .= "<input type='hidden' name='price' value='" . $price . "'>";
    $book_details .= "<input type='hidden' name='captchaInput' value=''>"; // Add captcha input value here
    $book_details .= "<input type='hidden' name='paymentMethod' value=''>"; // Add payment method value here
    $book_details .= "<input type='hidden' id='hiddenPaymentMethod' name='paymentMethod' value=''>";

    $book_details .= "<hr>";
    $book_details .= "<div class='center'>";
    $book_details .= "<button class='continue-btn'>Previous</button>";
    $book_details .= "<button class='continue-btn' onclick='submitForm()'>Proceed to Confirmation</button>";

    $book_details .= "</div>";

    $book_details .= "</form>";

    $book_details .= "<script>
    function showBankDetails() {
        var onlineRadio = document.getElementById('online');
        var bankDetailsContainer = document.getElementById('bankDetailsContainer');

        if (onlineRadio.checked) {
            bankDetailsContainer.style.display = 'block';
        } else {
            bankDetailsContainer.style.display = 'none';
        }

        // Call the updateTotalBill function as well
        updateTotalBill();
    }

   function updateTotalBill() {
    var quantity = document.getElementById('quantity').value;
    var totalBill = (parseFloat(price) * parseInt(quantity)).toFixed(2);
    document.getElementById('totalBill').innerText = totalBill;
    document.getElementById('hiddenQuantity').value = quantity;
    document.getElementById('hiddenTotalBill').value = totalBill;

    // Set the value of the payment input field
    document.getElementById('payment').value = totalBill; // Set the payment input field value to the total bill
}

    function generateCaptcha() {
            var captcha = Math.random().toString(36).substring(7);
            document.getElementById('captchaLabel').textContent = captcha;
            document.getElementById('captchaInput').value = ''; // Clear the input field
        }
    // Function to validate captcha before form submission

    // Add this function to your existing script
    function updateHiddenPaymentMethod() {
        var selectedPaymentMethod = document.querySelector('input[name=\"paymentMethod\"]:checked');
        if (selectedPaymentMethod) {
            document.getElementById('hiddenPaymentMethod').value = selectedPaymentMethod.value;
        }
    }
    
function validateForm() {
    updateHiddenPaymentMethod();  // Add this line to update payment method before form submission
        console.log(\"Starting form validation...\")
var enteredCaptcha = document.getElementById('captchaInput').value.trim();
var generatedCaptcha = document.getElementById('captchaLabel').textContent.trim();


    if (enteredCaptcha === \"\") {
        alert(\"Please enter the captcha.\");
        return false;
    } else if (enteredCaptcha !== generatedCaptcha) {
        alert(\"Entered captcha is wrong\");
        return false;
    }

    var paymentMethodSelected = document.querySelector('input[name=\"paymentMethod\"]:checked');
    if (!paymentMethodSelected) {
        alert(\"Please select the payment method\");
        return false;
    }

    console.log(\"Form validation passed.\");
    // Additional validations can be added here

    // If all validations pass, return true to submit the form
    return true;
}
function submitForm() {
    if (validateForm()) {
        document.getElementById('orderForm').submit();
    }
    }

    // Add event listener to online banking radio button
    document.getElementById('onlineBanking').addEventListener('change', function () {
        if (this.checked) {
            window.open('Online_Banking.php', '_blank');
        }
    });
</script>";

} else {
    echo "Error: Book details not found.";
}

$stmt_books->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buy Now</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <style>
        /* Import Google font - Poppins */
        
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        
        body {
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background: #b0c4de;
        }
        
       .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 40px;
    max-width: 900px;
    width: 90%;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    margin-top: 120px;
    padding-bottom: 50px; /* Add padding at the bottom */
}

        .center {
            text-align: center;
        }
        /* Additional styles for layout */
        
        .book-details-container {
            display: flex;
            align-items: center;
            gap: 20px;
            text-align: left;
            margin-top: 20px;
        }
        
        .book-image {
            max-width: 400px;
            max-height: 400px;
            flex: 0 0 auto;
            border: 2px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease;
        }
        
        .book-image:hover {
            border-color: #e44d26;
        }
        
        .book-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        /* Styles for the button */
        
        .continue-btn {
            background-color: #e44d26;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            margin-right: 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        /* Styles for the button on hover */
        
        .continue-btn:hover {
            background-color: #d33f22;
        }
        /* Additional styles */
        
        .payment-method {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        
        input[type="radio"] {
            margin-right: 10px;
        }
        
        .generate-button {
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
            margin-left: auto;
            margin-right: auto;
        }
        
        .generate-button:hover {
            background-color: #0056b3;
        }
		.back-button {
            background-color: green;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 10px;
            left: 10px; /* Adjusted position */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Black shadow with 50% opacity */
            text-decoration: none;
        }

        .back-button i {
            color: white;
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
        <a class="back-button">
            <i class="fas fa-arrow-left" style="font-size: 24px;" onclick="goBack()"></i>
        </a>
    </header>
        <div class="text">
            <h4 style="color: #fff;">Book Details</h4>
        </div>
        <div class="icons">
            <a href="wishlist.html" class="fas fa-heart"></a>
            <a href="cart.php" class="fas fa-shopping-cart"></a>
        </div>
    </header>
    <div class="container">
        <!-- Content area for the second step -->
        <div class="content-area active">
            <!-- Display book details -->
            <?php echo $book_details; ?>
        </div>
    </div>

    <script>
        var price = <?php echo json_encode($price); ?>;
        // Function to validate captcha before form submission
        // Add this function to your existing script
        function updateHiddenPaymentMethod() {
            var selectedPaymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
            if (selectedPaymentMethod) {
                document.getElementById('hiddenPaymentMethod').value = selectedPaymentMethod.value;
            }
        }

       function validateForm() {
    updateHiddenPaymentMethod(); // Add this line to update payment method before form submission
    console.log("Starting form validation...");
    var enteredCaptcha = document.getElementById("captchaInput").value.trim();
    var generatedCaptcha = document.getElementById("captchaLabel").textContent.trim();

    if (enteredCaptcha === "") {
        alert("Please enter the captcha.");
        return false;
    } else if (enteredCaptcha !== generatedCaptcha) {
        alert("Entered captcha is wrong");
        return false;
    }

    var paymentMethodSelected = document.querySelector('input[name="paymentMethod"]:checked');
    if (!paymentMethodSelected) {
        alert("Please select the payment method");
        return false;
    }

    if (paymentMethodSelected.value === 'online') {
        // If online banking is selected, validate banking details
        var bankName = document.getElementById('bankName').value.trim();
        var accountNumber = document.getElementById('accountNumber').value.trim();
        var ifscCode = document.getElementById('ifscCode').value.trim();
        var payment = document.getElementById('payment').value.trim();

        if (bankName === '' || accountNumber === '' || ifscCode === '' || payment === '') {
            alert("Please fill in all banking details");
            return false;
        }

        // Validate account number
        if (!/^\d{11}$/.test(accountNumber)) {
            alert("Account number must be 11 digits long.");
            return false;
        }

        // Validate IFSC code
        if (!/^[A-Za-z]{4}\d{7}$/.test(ifscCode)) {
            alert("IFSC code must contain 4 alphabets followed by 7 digits.");
            return false;
        }
    }

    console.log("Form validation passed.");
    // Additional validations can be added here

    // If all validations pass, return true to submit the form
    return true;
}


        function submitForm() {
            if (validateForm()) {
                document.getElementById('orderForm').submit();
            }
        }

        // Add event listener to online banking radio button
        document.getElementById('onlineBanking').addEventListener('change', function() {
            if (this.checked) {
                window.open('Online_Banking.php', '_blank');
            }
        });

        function generateCaptcha() {
            var captcha = Math.random().toString(36).substring(7);
            document.getElementById("captchaLabel").textContent = captcha;
            document.getElementById("captchaInput").value = ""; // Clear the input field
        }
    </script>
</body>

</html>
