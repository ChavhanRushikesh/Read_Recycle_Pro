<?php
// Start or resume the session
session_start();

// Database connection parameters
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

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // Handle the case where the user is not logged in (you can redirect to the login page, show a message, etc.)
    echo '<script>alert("User not logged in.");</script>';
    // You might want to redirect the user to the login page or homepage:
    header("Location: login.php"); // Uncomment this line to redirect to the login page
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diy-and-Hobby Category</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-...your-sha512-hash-here..." crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        /* Your CSS styles */
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", times new roman;
            background-color: #fff;
            overflow-x: hidden;
            padding-top: 30px; /* Add padding to the top to accommodate the fixed header */
            padding-left: 30px; /* Add padding to the left */
            padding-right: 20px; /* Add padding to the right */
        }

        .card {
            width: 21rem;
            height: 480px; /* Adjust height to accommodate the upward movement */
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5); /* Add black shadow */
        }

        .card-img-top {
            height: 0;
            padding-top: calc(2/3 * 100%);
            object-fit: contain;
            max-width: 100%;
            margin-bottom: -10px; /* Adjust this value to move the image upward */
            top: 0; /* Reset top position */
        }

        .card-body {
            height: 200px !important; /* Add !important to force the height */
        }

        .col-md-3 {
            margin-bottom: 35px; /* Adjust the space between rows as needed */
        }

        /* CSS to position the button container */
        .button-container {
            position: absolute;
            bottom: 10px; /* Adjust as needed */
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            width: 100%;
        }

        .button-container button {
            margin: 5px; /* Adjust spacing between buttons */
            cursor: pointer; /* Set cursor to pointer */
            background-color: #007bff; /* Set default button background color */
            border-color: #007bff; /* Set default button border color */
        }

        .button-container button:hover {
            background-color: green; /* Change background color on hover */
            border-color: green; /* Change border color on hover */
        }

        .card-title {
            margin-top: -30px; /* Adjust as needed to move the title upward */
            margin-bottom: 5px; /* Adjust as needed */
            font-weight: bold; /* Make the title bold */
            text-align: center; /* Center align the text */
        }

        .card-body p {
            text-align: center;
        }

        .card-text.book-info,
        .card-text.seller-info {
            margin-bottom: 3px; /* Adjust the margin between each line of information */
            text-align: center; /* Center align the text */
        }

        .card-text.book-info {
            font-size: 16px; /* Decrease font size for seller info */
        }

        .card-text.seller-info {
            font-size: 14px; /* Decrease font size for seller info */
            font-weight: 500; /* Increase font weight for seller info */
        }

        .card-wishlist {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 12px;
    color: grey; /* Change color to white */
    cursor: pointer;
    z-index: 1; /* Ensure the heart icon appears above the card */
    border: 1px solid white; /* Add this line to set the border color to white */
}

.card-wishlist.active {
    color: #d3003f; /* Active (clicked) color */
    border: 1px solid white; /* Add this line to set the border color when active */

    .out-of-stock {
    color: red;
}

}
/* Price range and condition filters */
.filters {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.price-filters,
.condition-filters {
    display: flex;
    align-items: center;
    margin-right: 30px;
}

.price-filters h3,
.condition-filters h3 {
    margin-right: 10px;
    font-size: 18px;
}

.price-buttons,
.condition-buttons {
    display: flex;
    flex-wrap: wrap;
}

.price-button,
.condition-button {
    display: inline-block;
    padding: 1px 15px;
    margin-right: 10px;
    background-color: white;
    color: black;
    border: 1px solid black;
    border-square: 20px;
    text-decoration: none;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.price-button:hover,
.condition-button:hover {
    background-color: #87cefa;
    border-color: green;
}

    </style>
       <script>
   function addToWishlist(bookId) {
    // Redirect the user to the login page
    window.location.href = 'login.php';
}


    document.addEventListener('DOMContentLoaded', function() {
        const priceFilter = document.getElementById('price');
        const cards = document.querySelectorAll('.card');

        priceFilter.addEventListener('change', function() {
            const selectedPrice = this.value;

            cards.forEach(card => {
                const price = parseInt(card.getAttribute('data-price'));

                if (selectedPrice === '' || (price >= parseInt(selectedPrice.split('-')[0]) && price <= parseInt(selectedPrice.split('-')[1]))) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>


</head>

<body>
<script>
	function goBack() {
  window.history.back()
}
</script>
<?php include 'usernotlogin_header.php'; ?>
    <br>
<div class="filters">
    <div class="price-filters">
        <h3>Price Range:</h3>
        <div class="price-buttons">
            <!-- Price range buttons -->
            <a href="?price=0-50" class="price-button">0-50</a>
            <a href="?price=51-100" class="price-button">51-100</a>
            <a href="?price=101-150" class="price-button">101-150</a>
            <a href="?price=151-200" class="price-button">151-200</a>
            <a href="?price=201-300" class="price-button">201-300</a>
            <a href="?price=301-500" class="price-button">301-500</a>
            <a href="?price=500+" class="price-button">Above 500</a>
            <a href="?price=" class="price-button">Clear</a> <!-- This will remove the price filter -->
        </div>
    </div>
    <!-- Condition buttons -->
    <div class="condition-filters">
        <h3>Condition:</h3>
        <div class="condition-buttons">
            <a href="?condition=new" class="condition-button">New</a>
            <a href="?condition=good" class="condition-button">Good</a>
            <a href="?condition=average" class="condition-button">Average</a>
            <a href="?condition=poor" class="condition-button">Poor</a>
            <a href="?condition=" class="condition-button">Clear</a> <!-- This will remove the condition filter -->
        </div>
    </div>
</div><br>
    <div class="row">
        <div class="col-md-12 card-container">
            <!--books-->
            <div class="row">
                <?php
                // SQL query to fetch book information from the database
                if (isset($_SESSION['email'])) {
                    $loggedInUserEmail = $_SESSION['email'];
                
                    // SQL query to fetch non-fiction books excluding those added by the logged-in user
                    $sql = "SELECT * FROM add_books WHERE category = 'diy-and-hobby' AND email != '$loggedInUserEmail'";
                } else {
                    // If the user is not logged in, retrieve all non-fiction books
                    $sql = "SELECT * FROM add_books WHERE category = 'diy-and-hobby'";
                }
                
                // Rest of your code...
                
                
                $result = $conn->query($sql);


// Check if price filter is applied
if (isset($_GET['price']) && !empty($_GET['price'])) {
    $price_range = $_GET['price'];
    $price_conditions = explode('-', $price_range);
    $min_price = (int) $price_conditions[0];
    $max_price = isset($price_conditions[1]) ? (int) $price_conditions[1] : PHP_INT_MAX; // Set max price to PHP_INT_MAX if index 1 is undefined

    $sql .= " AND price BETWEEN $min_price AND $max_price";
}

// Check if condition filter is applied
if (isset($_GET['condition']) && !empty($_GET['condition'])) {
    $condition = $_GET['condition'];

    // Assuming 'book_condition' is the column name in your add_books table
    $sql .= " AND book_condition = '$condition'";
}

// Execute the SQL query and fetch the results
$result = $conn->query($sql);

// Output data of each row
if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
                    // Inside the while loop where you're displaying the cards
                    echo '<div class="col-md-3">';
                    echo '<div class="card" style="width: 21rem; position: relative;">';
                
                    // Check if the book is already in the wishlist
                    $check_query = "SELECT * FROM wishlist WHERE user_id = '$user_id' AND book_id = '{$row['book_id']}'";
                    $check_result = $conn->query($check_query);
                
                ?>
                
                <?php
                    // Display heart icon with appropriate color based on wishlist status
                    echo '<form method="post">';
                    echo '<a href="login.php" name="add_to_wishlist" onclick="addToWishlist()" class="card-wishlist ' . ($check_result->num_rows > 0 ? 'active' : '') . '">';
                    echo '<i class="fas fa-heart fa-2x"></i>'; // Increase the size of the heart icon
                    echo '</a>';
                    echo '<input type="hidden" name="book_id" value="' . $row['book_id'] . '">';
                    echo '</form>';
                
                    echo '<a href="book_details1.php?id=' . $row['book_id'] . '">';
                    echo '<img src="' . $row['book_image'] . '" class="card-img-top" alt="Book Image" style="height: 380px; padding: 40px;">';
                    echo '</a>';
                
                    echo '<div class="card-body" style="height: 200px;">'; // Adjust the height as needed
                    echo '<h5 class="card-title">' . $row['book_name'] . '</h5>';
                    echo '<p class="card-text book-info">';
                    echo '<span class="card-info">Author: ' . $row['author'] . '</span>';
                    echo '<span class="card-info">| Price: ' . $row['price'] . '</span>';
                    echo '<span class="card-info">| Subcategory: ' . $row['subcategory'] . '</span>';
                    echo'<br>';
                    if ($row['quantity'] == 0) {
                        echo '<span class="card-info out-of-stock"> <span style="color: red;">Out of Stock</span></span>';
                    } else {
                        echo '<span class="card-info"> Quantity: ' . $row['quantity'] . '</span>';
                    }
                
                    echo '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
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
                            //$check_query = "SELECT * FROM wishlist WHERE user_id = '$user_id' AND book_id = '$book_id_to_wishlist'";
                            //$check_result = $conn->query($check_query);
        
                            //if ($check_result->num_rows == 0) {
                                // Book is not in the wishlist, add it
                             //   $insert_query = "INSERT INTO wishlist (user_id, book_id) VALUES ('$user_id', '$book_id_to_wishlist')";
                              //  if ($conn->query($insert_query) === TRUE) {
                              //      echo '<script>alert("Book added to wishlist successfully!");</script>';
                               // } else {
                                //    echo "Error adding book to wishlist: " . $conn->error;
                               //}
                            } }
                       }
                   }
               // }
                
                    
else {
    echo "No books available on selected filter.";
}

                
                
                ?>
                </body>
                
                </html>
