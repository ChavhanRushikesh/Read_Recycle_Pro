<?php
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

// Check if the remove_from_wishlist parameter is set
if (isset($_GET['remove_from_wishlist'])) {
    $book_id_to_remove = $_GET['remove_from_wishlist'];

    // Assuming you have a logged-in user and their user_id
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Check if $conn is not null before using it
        if ($conn) {
            // Remove the selected book from the wishlist table
            $delete_query = "DELETE FROM wishlist WHERE User_ID = '$user_id' AND book_id = '$book_id_to_remove'";
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
    $wishlist_query = "SELECT wishlist.book_id, add_books.category, add_books.book_name, add_books.price, add_books.book_image, add_books.name, add_books.email, userinfo.User_ID
                   FROM wishlist
                   INNER JOIN add_books ON wishlist.book_id = add_books.book_id
                   INNER JOIN userinfo ON wishlist.User_ID = userinfo.User_ID
                   WHERE wishlist.User_ID = '$user_id'";
    $wishlist_result = $conn->query($wishlist_query);
}

 if (isset($_POST['buy_now'])) {
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

// Include your header
echo '<html lang="en">';
echo '<head>';
echo '<meta charset="UTF-8">';
echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
echo '<title>Your Book Reselling Website - wishlist</title>';
echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">';
echo '<style>';
// Add your CSS styles here
echo '</style>';
echo '</head>';
echo '<body>';

echo '<header class="header">';
echo '<div class="images">';
echo '<a href="categories.php">';
echo '<i class="fas fa-arrow-left"></i>';
echo '</a>';
echo '</div>';
echo '<div class="text">';
echo '<h4 style="color: #000;">My wishlist</h4>';
echo '</div>';
echo '<div class="icons">';
echo '<a href="wishlist.php" class="fas fa-heart"></a>';
echo '<a href="cart.php" class="fas fa-shopping-cart"></a>';
echo '</div>';
echo '</header>';
echo '<br><br><br><br><br><br>';

echo '<main>';
echo '<div class="wishlist-container">';
// HTML code to display wishlist items
if (isset($wishlist_result) && $wishlist_result->num_rows > 0) {
    $wishlist_result->data_seek(0); // Reset result pointer for looping through again

    while ($wishlist_row = $wishlist_result->fetch_assoc()) {
        echo '<div class="wishlist-item">';
        echo '<div class="card-wishlist" data-book-id="' . $wishlist_row['book_id'] . '"><i class="fas fa-heart"></i></div>';
        echo '<div class="book-details">';
        echo '<div class="book-image">';
        echo '<img src="' . $wishlist_row['book_image'] . '" alt="' . $wishlist_row['book_name'] . '">';
        echo '</div>';
        echo '<div class="wishlist-item-details">';
        echo '<div class="wishlist-item-title">' . $wishlist_row['book_name'] . '</div>';
        echo '<div class="wishlist-item-price">' . $wishlist_row['price'] . ' Rs/-</div>';
        echo '<div>Seller name: ' . $wishlist_row['name'] . '</div>';
        echo '<div>Seller email: ' . $wishlist_row['email'] . '</div>';
    
        // Add "Add to Cart" and "Buy Now" buttons
        echo '<div class="wishlist-buttons">';
        echo '<form method="post" style="display: inline-block;">';
        echo '<input type="hidden" name="book_id" value="' . $wishlist_row['book_id'] . '">';
        echo '<button type="submit" name="add_to_cart" class="add-to-cart-btn">Add to Cart</button>';
        //echo '<button type="submit" name="buy-now-btn" class="buy-now-btn" style="margin-left: 10px;">Buy Now</button>';
        echo '</form>';

        // ...

        echo '<form method="post" action="buy_nowStep2.php" style="display: inline-block;">'; // Set the action to your "Buy Now" page
        echo '<input type="hidden" name="book_id" value="' . $wishlist_row['book_id'] . '">';
        echo '<button type="submit" name="buy_now_btn" class="buy-now-btn" style="margin-left: 10px;">Buy Now</button>';
        echo '</form>';

// ...


        
        echo '</div>';
    
        // Remove button
       // echo '<button class="remove-btn" onclick="removeBook(' . $wishlist_row['book_id'] . ')">Remove</button>';
        //echo '<i class="fas fa-heart remove-btn" onclick="removeBook(' . $wishlist_row['book_id'] . ')"></i>';
        echo '<button class="card-wishlist"  onclick="removeBook(' . $wishlist_row['book_id'] .')"><i class="fas fa-heart"></i></button>';
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    
} else {
    echo '<p>No items in the Wishlist</p>';
}

echo '</div>';

// Include your footer content
echo '<script>';
echo 'function removeBook(bookId) {';
echo '  if (confirm("Are you sure you want to remove this item from the wishlist?")) {';
echo '    window.location.href = "wishlist.php?remove_from_wishlist=" + bookId;';
echo '  }';
echo '}';
echo '</script>';

// Check if the Add to Cart form is submitted
if (isset($_POST['add_to_cart'])) {
    // Add to Cart logic
    // Get book ID from the form
    $book_id_to_add = $_POST['book_id'];

    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Connect to the database (already connected above, no need to reconnect)

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
    } else {
        // Handle the case where the user is not logged in
        echo '<script>alert("User not logged in.");</script>';
    }
}
elseif (isset($_POST['buy-now-btn'])) {
    // Buy Now logic
    // Get book ID from the form
    $book_id_to_buy = $_POST['book_id'];

    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Connect to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo '</div>'; // Close details-container
        echo '</div>'; // Close container
    }
}
echo '</body>';
echo '</html>';

// Close database connection (already closed above, no need to close again)
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <title>Your Book Reselling Website - Wishlist</title>
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

    .wishlist-container {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: space-between; /* Adjust alignment */
  width: 100%;
  height: 260px;
}

.wishlist-item {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 15px;
  width: calc(32% - 20px); /* Adjust width to fit one card per row */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Add shadow effect */
  position: relative;
  display: flex;
  flex-direction: column; /* Adjust to stack content vertically */
}

.wishlist-item-details {
  flex-grow: 1;
  padding-left: 0; /* Adjust padding */
}


    .book-image {
      height: 200px;
      width: 150px;
      overflow: hidden;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .book-image img {
      width: 100%;
      height: auto;
    }

    .wishlist-item {
        position: relative;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    width: calc(32% - 20px); /* Adjust width to fit one card per row */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Add shadow effect */
    display: flex;
    flex-direction: column; 
}

.book-details {
    display: flex;
    width: 100%;
}

.book-image {
    width: 150px;
    height: 200px;
    overflow: hidden;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.book-image img {
    width: 100 px;
    height: auto;
}

.wishlist-item-details {
    flex-grow: 1;
    padding: 15px;
}

.wishlist-item-title {
    font-weight: bold;
    margin-top: 10px;
    margin-bottom: 10px;
}

.wishlist-item-price {
    color: #e44d26;
    font-weight: bold;
    margin-bottom: 10px;
}

.wishlist-buttons {
    position: absolute;
    bottom: 35px; /* Adjust as needed */
    left: 55%;
    transform: translateX(-50%);
    text-align: center;
    width: 100%;
}

.add-to-cart-btn
{
    margin: 10px; /* Adjust spacing between buttons */
    cursor: pointer; /* Set cursor to pointer */
    background-color: #007bff; /* Set default button background color */
    border-color: #007bff; /* Set default button border color */
    border-radius: 5px;
    height: 29px;
}

.add-to-cart-btn:hover{

    background-color: green; /* Change background color on hover */
    border-color: green; /* Change border color on hover */
}


.buy-now-btn
{
    margin: 10px; /* Adjust spacing between buttons */
    cursor: pointer; /* Set cursor to pointer */
    background-color: #007bff; /* Set default button background color */
    border-color: #007bff; /* Set default button border color */
    border-radius: 5px;
    height: 29px;
}


.buy-now-btn:hover{

    background-color: green; /* Change background color on hover */
    border-color: green; /* Change border color on hover */
}


.remove-btn {
    position: absolute;
    bottom: 25px; 
    background-color: #e44d26;
    color: #fff;
    padding: 5px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.card-wishlist {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    color: #d3003f; /* Default color */
    cursor: pointer;
}

.card-wishlist.active {
    color: #d3003f; /* Active (clicked) color */
}

    </style>
   <script>
    document.addEventListener('DOMContentLoaded', function () {
        const wishlistIcons = document.querySelectorAll('.card-wishlist');

        wishlistIcons.forEach(icon => {
            icon.addEventListener('click', function () {
                icon.classList.toggle('active');

                // Get the book ID associated with the clicked card
                const bookId = icon.getAttribute('data-book-id');

                // Send an AJAX request to add the book to the wishlist
                if (icon.classList.contains('active')) {
                    // Book is added to the wishlist
                    addToWishlist(bookId);
                } else {
                    // Book is removed from the wishlist (optional)
                    removeFromWishlist(bookId);
                }
            });
        });

        function addToWishlist(bookId) {
            $.ajax({
                type: 'POST',
                url: 'wishlist.php', // Change to the correct file if needed
                data: { bookId: bookId },
                success: function (response) {
                    // Handle the response if needed
                    console.log('Book added to wishlist:', response);
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        }

        function removeFromWishlist(bookId) {
            // Implement the logic to remove the book from the wishlist if needed
        }
    });
</script>


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
                <h4 style="color: #fff;">My Wishlist</h4>
            </div>
        </header>
        <br><br><br><br><br><br>

 </body>
 
 </html>
