<?php
// Start the session
session_start();

// Function to check if the user is logged in
function checkLoginStatus() {
    return isset($_SESSION['user_id']);
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

        // Display book details
        echo '<div class="container">';
        echo '<div class="image-container">';
        echo '<img class="book-image" src="' . $row['book_image'] . '" alt="Book Image">';
        echo '</div>';
        echo '<div class="details-container book-details-container">';
        echo "<h1>" . $row['book_name'] . "</h1>";
        echo "<p><strong>Author:</strong> " . $row['author'] . "</p>";
        echo "<p><strong>Category:</strong> " . $row['category'] . "</p>";
        echo "<p><strong>Condition:</strong> " . $row['book_condition'] . "</p>";
        echo "<p><strong>Price:</strong> " . $row['price'] . "</p>";
        echo "<p><strong>Subcategory:</strong> " . $row['subcategory'] . "</p>";
        echo "<p><strong>Seller Name:</strong> " . $row['name'] . "</p>";
        echo "<p><strong>Seller Email:</strong> " . $row['email'] . "</p>";
        
        // Add to Cart and Buy Now form
        echo '<form action="book_details1.php?id=' . $row['book_id'] . '" method="post">';
        echo '<input type="hidden" name="book_id" value="' . $row['book_id'] . '">';
        echo '<a href="login.php" name="add_to_cart" class="btn btn-primary">Add to Cart</button>';
        echo '<a href="login.php" class="btn btn-primary" style="margin-left: 10px;">Buy Now</a>';
        echo '</form>';
        
        echo '</div>'; // Close details-container
        echo '</div>'; // Close container

        // Process Add to Cart and Buy Now logic after displaying book details
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['add_to_cart'])) {
                $book_id_to_add = $_POST['book_id'];
                
                // Check if the user is logged in
                if (checkLoginStatus()) {
                    $user_id = $_SESSION['user_id'];
                    
                    // Connect to the database
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    
                    // Check if the book is already in the cart
                    $check_query = "SELECT * FROM cart_books WHERE User_ID = '$user_id' AND book_id = '$book_id_to_add'";
                    $check_result = $conn->query($check_query);
                    
                    if ($check_result->num_rows == 0) {
                        // Book is not in the cart, add it
                        $insert_query = "INSERT INTO cart_books (User_ID, book_id) VALUES ('$user_id', '$book_id_to_add')";
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
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiction Category</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Include Font Awesome library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
       body {
    font-family: "Arial", sans-serif;
    background-color: #fff ;
    margin: 0;
    padding: 0;
 
    background-size: cover; /* Cover the entire body */
    background-position: center; /* Center the image */
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
    color: red; /* Set the color to red */
}

        .button-container {
            display: flex;
        }

        .button-container a {
            margin-right: 20px;
            cursor: pointer;
            background-color: #007bff;
            border-color: #007bff;
            padding: 15px 25px;
            font-size: 16px;
        }

        .button-container a:last-child {
            margin-right: 0;
        }

        .button-container a:hover {
            background-color: green;
            border-color: green;
        }

        .heart-icon {
            position: fixed;
            top: 10px;
            left: 10px;
            font-size: 24px;
            color: #ff1493;
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

.header .text {
    color: white;
    margin-left: 20px; /* Adjust the left margin as needed */
    font-size: 22px;
    font-weight: 500;
    flex-grow: 1; /* This will allow the text to take up available space */
    margin-top: 10px; /* Add top margin */
}

        .header .images {
            display: flex;
            align-items: center;
            margin-left: -110px;
        }
    .header .icons .fas.fa-heart {
    margin-right: 15px; /* Adjust this value to increase or decrease the space */
}

.header .icons .fas.fa-shopping-cart {
    margin-left: 30px; /* Adjust this value to increase or decrease the space */
}
        .header .images a {
            border: none;
            outline: none;
            background-color: transparent;
            color: #fff;
            font-size: 23px;
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

        .book-image {
            width: 400px; /* Set your desired width */
            height: calc(400px * 4 / 3); /* Calculate height based on 3:4 ratio */
            object-fit: cover; /* Maintain aspect ratio and cover container */
            border: 2px solid #000; /* Add a black border */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Add a black shadow */
        }

        .image-container {
            flex: 1;
            padding: 150px 50px 50px 50px; /* Add more padding to the top */
        }

       .book-details-container {
    background-color: white; /* Set background color to white */
    padding-top: 30px;
    margin-top: 70px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Add black shadow to the container */
}

 

.book-details-container h1 {
    color: darkblue; /* Set the color to dark blue */
    font-weight: bold; /* Make the font bold */
    font-size: 38px; /* Optional: adjust the font size as needed */
    margin-bottom: 10px; /* Optional: add margin to create space below */
	
}
.book-details-container button:hover {
    background-color: green; /* Change background color to green on hover */
    border-color: green; /* Change border color to green on hover */
    color: white; /* Change text color to white on hover */
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
        <div class="text">
            <h4 style="color: #fff;">Book Details</h4>
        </div>
        <div class="icons">
            <a href="login.php" class="fas fa-heart"></a>
            <a href="login.php" class="fas fa-shopping-cart"></a>
        </div>
    </header>
    <br>
    <i class="fas fa-heart heart-icon"></i>
</body>
</html>
