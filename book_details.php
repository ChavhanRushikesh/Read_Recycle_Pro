<?php
// Start the session
session_start();

function checkLoginStatus() {
    return isset($_SESSION['user_id']);
}

// Assuming the user ID is stored in the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // Handle the case where user ID is not set, redirect to login page or handle accordingly
    echo "User ID not set. Redirect to login page or handle accordingly.";
    exit(); // Stop execution to prevent further processing
}

// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readcycle";

// Get the book ID from the query parameters
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch book information from the database based on book ID
    $sql = "SELECT * FROM add_books WHERE book_id = $book_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of the selected book
        $row = $result->fetch_assoc();

        // Check if the book is already in the wishlist
        $check_query = "SELECT * FROM wishlist WHERE user_id = '$user_id' AND book_id = '$book_id'";
        $check_result = $conn->query($check_query);

        // Display book details
        echo '<div class="container">';
        echo '<div class="image-container">';
        echo '<div class="book-image-container">';
        echo '<img class="book-image" src="' . $row['book_image'] . '" alt="Book Image">';
        echo '<div class="wishlist-button">';
        echo '<form action="book_details.php?id=' . $row['book_id'] . '" method="post">';
        echo '<input type="hidden" name="book_id" value="' . $row['book_id'] . '">';
        echo '<button type="submit" name="add_to_wishlist" class="btn btn-primary ' . ($check_result->num_rows > 0 ? 'active' : '') . '">';

        // Display heart icon with appropriate color based on wishlist status
        if ($check_result->num_rows > 0) {
            echo '<i class="fas fa-heart" style="color: red;"></i>';
        } else {
            echo '<i class="fas fa-heart" style="color: grey;"></i>';
        }

        echo '</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="details-container book-details-container">';
echo "<h1>" . $row['book_name'] . "</h1>";
echo "<p><strong>Author:</strong> " . $row['author'] . "</p>";
echo "<p><strong>Category:</strong> " . $row['category'] . "</p>";
echo "<p><strong>Condition:</strong> " . $row['book_condition'] . "</p>";
echo "<p><strong>Quantity:</strong> " . $row['quantity'] . "</p>";
echo "<p><strong>Price:</strong> " . $row['price'] . "</p>";
echo "<p><strong>Subcategory:</strong> " . $row['subcategory'] . "</p>";
echo "<p><strong>Seller Name:</strong> " . $row['name'] . "</p>";
echo "<p><strong>Seller Email:</strong> " . $row['email'] . "</p>";

// Check if the quantity is greater than 0

if ($row['quantity'] > 0) {
    // Add to Cart and Buy Now form
    echo '<form action="book_details.php?id=' . $row['book_id'] . '" method="post">';
    echo '<input type="hidden" name="book_id" value="' . $row['book_id'] . '">';
    echo '<button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>';
    echo '<button type="submit" name="buy_now" class="btn btn-primary" style="margin-left: 10px;">Buy Now</button>';
    echo '</form>';
} else {
    // Display "Out of Stock" message
    echo '<p style="color: red; font-weight: bold;">Out of Stock</p>';
    // Remove the quantity attribute
    echo '<style>.book-details-container p:contains("Quantity") { display: none; }</style>';
}





        // Process Add to Wishlist, Add to Cart, and Buy Now logic after displaying book details
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['add_to_wishlist'])) {
                // Add to Wishlist logic
                // Get book ID from the form
                $book_id_to_wishlist = $_POST['book_id'];

                // Check if the user is logged in
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];

                    // Connect to the database
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Check if the book is already in the wishlist
                    $check_query = "SELECT * FROM wishlist WHERE user_id = '$user_id' AND book_id = '$book_id_to_wishlist'";
                    $check_result = $conn->query($check_query);

                    if ($check_result->num_rows == 0) {
                        // Book is not in the wishlist, add it
                        $insert_query = "INSERT INTO wishlist (user_id, book_id) VALUES ('$user_id', '$book_id_to_wishlist')";
                        if ($conn->query($insert_query) === TRUE) {
                            echo '<script>alert("Book added to wishlist successfully!");</script>';
                        } else {
                            echo "Error adding book to wishlist: " . $conn->error;
                        }
                    } else {
                        echo '<script>alert("Book is already in the wishlist!");</script>';
                    }

                    // Close database connection
                    $conn->close();
                } else {
                    // Handle the case where the user is not logged in
                    echo "User not logged in.";
                }
            } elseif (isset($_POST['add_to_cart'])) {
                // Add to Cart logic
                // Get book ID from the form
                $book_id_to_add = $_POST['book_id'];

                // Check if the user is logged in
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];

                    // Connect to the database
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Check if the book is already in the cart
                    $check_query = "SELECT * FROM cart_books WHERE user_id = '$user_id' AND book_id = '$book_id_to_add'";
                    $check_result = $conn->query($check_query);

                    if ($check_result->num_rows == 0) {
                        // Book is not in the cart, add it
                        $insert_query = "INSERT INTO cart_books (user_id, book_id) VALUES ('$user_id', '$book_id_to_add')";
                        if ($conn->query($insert_query) === TRUE) {
                            echo '<script>alert("Book added to cart successfully!");</script>';
                        } else {
                            echo "Error adding book to cart: " . $conn->error;
                        }
                    } else {
                        echo '<script>alert("Book is already in the cart!");</script>';
                    }

                    // Close database connection
                    $conn->close();
                } else {
                    // Handle the case where the user is not logged in
                    echo "User not logged in.";
                }
            } elseif (isset($_POST['buy_now'])) {
                // Buy Now logic
                
                if (checkLoginStatus()) {
                    // User is logged in
                    $user_id = $_SESSION['user_id'];
                    $book_id_to_buy = $_POST['book_id'];
                    
                    // Redirect to the buy_now1.php page with the book ID
                    echo "Book ID to Buy: $book_id_to_buy"; // Add this line for debugging
                    header("Location: buy_nowStep2.php?book_id=$book_id_to_buy");
                                        exit();
                } else {
                    // User is not logged in, show a popup message
                    echo '<script>';
                    echo 'if (confirm("You are not logged in. Click OK to login.")) {';
                    echo 'window.location.href = "login.php";';
                    echo '}';
                    echo '</script>';
                }
            }
        }

        echo '</div>'; // Close details-container
        echo '</div>'; // Close container
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiction Category</title>
    <!-- Include Font Awesome library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Other stylesheet links... -->

    <!-- Bootstrap CSS (if used) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            font-family: "Arial", sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            background-size: cover;
            /* Cover the entire body */
            background-position: center;
            /* Center the image */
        }

        .container {
            display: flex;
            align-items: center;
        }

        .details-container {
            flex: 1;
            padding-left: 20px;
        }

        .book-details-container strong {
            color: red;
            /* Set the color to red */
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #002147;
            padding: 1rem 9%;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000;
        }
    .header .icons .fas.fa-heart {
    margin-right: 15px; /* Adjust this value to increase or decrease the space */
}

.header .icons .fas.fa-shopping-cart {
    margin-left: 35px; /* Adjust this value to increase or decrease the space */
}
    
.header .text{
color: #fff;
margin-left: -1160px;
font-size: 21px;
margin-top:10px;
}
        .header .images {
            display: flex;
            align-items: center;
            margin-left: -110px;
        }

        .header .images a {
            border: none;
            outline: none;
            background-color: transparent;
            color: #fff;
            font-size: 28px;
        }
		
.header .images a:hover {
    color: #fff; /* Change the text color to white on hover */
}

        .header .icons {
            display: flex;
            align-items: center;
            margin-right: -100px;
            font-size: 18px;
            color: #fff;
            /* Set icon color to white */
        }

        .header .icons a {
            border: none;
            outline: none;
            margin-left: 15px;
            background-color: transparent;
            color: #fff;
            text-decoration: none;
        }

        .header .icons a:hover {
            color: #d3003f;
        }

        .header .icons div.hover {
            color: #ff1493;
        }

        .book-image-container {
            position: relative;
            display: inline-block;
        }

        .book-image {
            width: 400px;
            /* Set your desired width */
            height: calc(480px * 4 / 3);
            /* Calculate height based on 3:4 ratio */
            object-fit: cover;
            /* Maintain aspect ratio and cover container */
            border: 2px solid #000;
            /* Add a black border */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            /* Add a black shadow */
        }

        .wishlist-button {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .wishlist-button i {
            font-size: 22px;
            color: #ff1493;
            background-color: transparent;
            border: none;
            outline: none;
        }

        .image-container {
            flex: 1;
            padding: 150px 50px 50px 50px;
            /* Add more padding to the top */
        }

        .book-details-container {
            background-color: white;
            /* Set background color to white */
            padding-top: 30px;
            margin-top: 70px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            /* Add black shadow to the container */
        }

        .book-details-container h1 {
            color: darkblue;
            /* Set the color to dark blue */
            font-weight: bold;
            /* Make the font bold */
            font-size: 38px;
            /* Optional: adjust the font size as needed */
            margin-bottom: 10px;
            /* Optional: add margin to create space below */
        }

        .book-details-container button:hover {
            background-color: green;
            /* Change background color to green on hover */
            border-color: green;
            /* Change border color to green on hover */
            color: white;
            /* Change text color to white on hover */
        }
    </style>
</head>
        
<body>
    <header class="header">
        <div class="images">
            <a>
                <i class="fas fa-arrow-left" onclick="goBack()"></i>
            </a>
        </div>
        <div class="text">
            <h4 style="color: #fff;">Book Details</h4>
        </div>
        <div class="icons">
            <a href="wishlist.php" class="fas fa-heart"></a>
            <a href="cart.php" class="fas fa-shopping-cart"></a>
        </div>
    </header>
    <br>
	<script>
	function goBack() {
  window.history.back()
}
</script>
</body>

</html>