<?php
// Connect to the database (replace with your database credentials)
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

// Query to retrieve books for each category (replace with your actual query)
$sql_fiction = "SELECT * FROM add_books WHERE category = 'fiction' LIMIT 6";
$result_fiction = $conn->query($sql_fiction);

// Query to retrieve books for the Poetry category
$sql_poetry = "SELECT * FROM add_books WHERE category = 'poetry' LIMIT 6";
$result_poetry = $conn->query($sql_poetry);

// Query to retrieve books for the Academic category
$sql_academic = "SELECT * FROM add_books WHERE category = 'academic-textbook' LIMIT 6";
$result_academic = $conn->query($sql_academic);

// Query to retrieve books for the Non-Fiction category
$sql_non_fiction = "SELECT * FROM add_books WHERE category = 'non-fiction' LIMIT 6";
$result_non_fiction = $conn->query($sql_non_fiction);

$sql = "SELECT * FROM add_books ORDER BY book_id DESC LIMIT 8;";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ReadCycle HomePage</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
body {
    background-color: #fff;
    font-family: "Poppins", sans-serif;
    margin: 0;
    box-sizing: border-box;
}

 .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000; /* Ensure it's above other content */
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 70px;
        background-color: #000;
        color: white;
    }

    .nav-logo {
        height: 70px;
        width: 250px;
        margin-bottom: 3px; /* Adjust the margin as needed */
    }

    .logo {
        background-image: url("images/logo2.png");
        background-size: cover;
        height: 70px; /* Adjust the height as needed */
        width: 250px; 
    }

    .border {
        border: 1.5px solid transparent;
    }

    .border:hover {
        border: 1.5px solid white;
    }


    .nav-categories {
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  margin-left: 170px; /* Move the dropdown to the left side of the search bar */
  width: 100px;
  height: 60px;
  border-radius: 4px;
  
}

.category-select {
  width: 230px; /* Adjust the width to auto */
  font-size: 1rem;
  border: none;
  height: 42px;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
  background-color: #d3d3d3;
  color: black;
  appearance: none;
  padding-left: 5px;
  cursor: pointer;
  margin-left: -18px;
}


.category-select::-ms-expand {
  display: none;
}
/* Dropdown menu */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Set width to auto for dynamic width adjustment */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    width: auto; /* Adjust width dynamically */
}

/* Show dropdown on hover */
.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.category-select-container {
  position: relative;
  display: inline-block;
}

.category-select-container i {
  position: absolute;
  top: 50%;
  right: 8px;
  transform: translateY(-50%);
  color: #333;
  font-size: 16px;
}

.nav-search {
    margin-top: 0px;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    margin-left: 0; /* Remove the margin-left */
    width: 600px; /* Adjust the width as needed */
    height: 80px;
    border-radius: 4px;
}


    .search-input {
        width: 70%; /* Adjust the width as needed */
        font-size: 1rem;
        border: none;
        height: 42px;
       
       
		margin-left: 64px;
    }

    .search-button {
        width: 8%; /* Adjust the width as needed */
        height: 42px;
        font-size: 1rem;
        background-color: #febd68;
        border: none;
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
        color: white;
        cursor: pointer;
		margin-left: -77px;
    }
	
	.search-button:hover {
  fill: blue;
}

    .nav-cart i,
    .nav-resell i {
        font-size: 23px;
        color: white;
        margin-right: 8px; /* Adjust the margin as needed */
    }

    .nav-cart a,
    .nav-resell a {
        font-size: 20px;
        color: white;
        text-decoration: none;
    }

    .nav-cart {
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        margin-left: auto; /* Move the cart to the right */
        margin-right: 60px; /* Adjust the margin as needed */
    }

    .nav-resell i {
        font-size: 25px;
        color: white;
        margin-right: 8px; /* Adjust the margin as needed */
    }

    .nav-resell {
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        margin-left: 30px; /* Adjust the margin as needed */
        margin-right: 40px;
    }
.section-1 {
width: 100%;
height: 122px;
background-color: white;
box-shadow: 0 1px 1px 0 rgb(0 0 0 / 16%);
margin-top: 80px;
}

.section-1-container {
width: 1280px;
margin: 0 auto;
height : 100%;
display: flex;
align-items: center;
justify-content: space-between;
}

.section-1-item {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center; 
    gap: 4px;
    font-size: 18px;
    font-weight: 540;
}

.section-1-item a {
    color: black; /* Change to the desired color */
	text-decoration: none;
}

.section-1-item:hover i {
    color: #d3003f; /* Change to the desired color */
}

.section-1-item:hover a {
    color: #d3003f; /* Change to the desired color */
}


.section-1-item i {
    font-size: 30px;
	height: 45px;
	text-decoration: none;
	color: black;
}

.shop-section {
  display: flex;
  justify-content: space-evenly;
  background-color: #fff;
}

.box {
  border: 2px solid #d3d3d3;
  height: 240px;
  width: 160px;
  background-color: #fff;
  padding: 0; /* Remove padding */
  margin-top: 15px;
  border-radius: 4px;
  transition: border-color 0.3s ease; /* Adding transition effect */
}

.box:hover {
  border-color: #555; /* Changing border color on hover */
}

.shop-section {
  display: flex;
  justify-content: space-evenly;
  background-color: #fff;
}

.shop-section .box .box-img {
  width: 160px;
  height: 240px; /* Adjusted height to fit inside the box */
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  margin-top: 15px; /* Removed margin */
}

.box-content {
  margin-left: 0;
  margin-right: 20px;
  margin-bottom: 20px;
  margin-top: -15px;
  text-decoration: none;
}



.book-name {
  text-align: left; /* Center the text */
  margin-top: 50px; /* Adjust the top margin as needed */
  font-size: 17px; /* Adjust the font size as needed */
      color: #000000;
    font-weight: 500;
	font-family: "Poppins", sans-serif;
	text-decoration: none;
}

.book-price {
  text-align: left; /* Center the text */
  margin-top: 5px; /* Adjust the top margin as needed */
 font-size: 17px; /* Adjust the font size as needed */
      color: #000000;
    font-weight: 500;
	font-family: "Poppins", arial;
	text-decoration: none;
}

.text {
	text-align: right;
	 margin-top: -50px;
	 margin-right: 40px;
}

.shop-section .box .icon {
	text-align: right;
margin-top: -10px;	
text-decoration: none;
color: white;
}

.icon a{
text-decoration: none;
color: black;
font-size: 20px;
margin-right: -10px;
margin-top: 7px;
}

.icon.clicked {
    color: red; /* Color when clicked */
}

footer {
margin-top: 15px;
}

.foot-panel1 {
background-color: #1b1b1b;
color: white;
height: 50px;
display: flex;
justify-content: center;
align-items: center;
font-size: 0.85rem; 
margin-bottom: -20px;
}

.foot-panel1 a {
    color: white;
    text-decoration: none; 
  }

#carousel-container {
    width: 100%;
    max-width: 1500px;
    height: 400px; /* Set a fixed height for the carousel */
    overflow: hidden;
    margin: 0 auto;
    position: relative;
  }

  #carousel {
    display: flex;
    transition: transform 0.5s ease-in-out;
    width: 100%;
    height: 100%; 
  }

  .carousel-item {
    flex: 0 0 100%;
    height: 100%;
    width: 100%;
  }

  #carousel-buttons {
    position: absolute;
    top: 45%;
    transform: translateY(-50%);
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: center;
  }

  #carousel img {
    width: 100%; 
    height: 350px; 
  }
  
   .back-button {
            background-color: darkblue;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 620px;
            left: 1450px; /* Adjusted position */
            text-decoration: none;
        }

        .back-button i {
            color: white;
        }
		
		 .back-button1 {
            background-color: darkblue;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 1060px;
            left: 1450px; /* Adjusted position */
            text-decoration: none;
        }

        .back-button1 i {
            color: white;
        }
		
		 .back-button2 {
            background-color: darkblue;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 1500px;
            left: 1450px; /* Adjusted position */
            text-decoration: none;
        }

        .back-button2 i {
            color: white;
        }
		
		 .back-button3 {
            background-color: darkblue;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 1950px;
            left: 1450px; /* Adjusted position */
            text-decoration: none;
        }

        .back-button3 i {
            color: white;
        }

           /* Box container */
   .products .box-container{
   width: 100%;
   margin: 0 auto;
   display: grid;
   grid-template-columns: repeat(auto-fit, 15rem);
   gap:0rem;
   justify-content: center;
}

   /* Boxes */
.products .box-container .box {
    text-align: center;
    padding: 2rem;
    box-shadow: var(--box-shadow);
    border: var(--border);
    border-radius: .5rem;
    box-width: 20rem; /* Adjust the width as needed */
    height: 20rem;
	gap:0rem;
}


   /* Image */
   .products .box-container .box img{
      width: 10rem;
      height: 15rem;
      object-fit: cover;
      margin-bottom: 1rem;
   }

   /* Title and price */
   .products .box-container .box h3{
      margin: 0 0 .5rem;
      font-size: 1.1rem;
	  font-weight: 500;
   }

   .products .box-container .box .price{
      margin: 0;
      font-size: 1.0rem;
      font-weight: 700;
   }

   /* Hover styles */
   .products .box-container .box:hover{
      box-shadow: var(--box-shadow-hover);
      transform: translateY(-5px);
      transition: all 0.3s ease;
   }

   .products .box-container .box:hover .price{
      color: var(--color-primary);
   }

   .products .box-container .box:hover .add-to-cart-btn{
      background-color: var(--color-primary);
      color: #fff;
      transition: all 0.3s ease;
   }

</style>
</head>
<body>
<header>
    <div class="navbar">
        <div class="nav-logo border">
            <div class="logo"></div>
        </div>



     <div class="nav-categories">
  <div class="category-select-container">
    <select class="category-select" name="cat" id="categorySelect">
      <option value="" hidden>All</option>
      <option value="fiction">Fiction</option>
    <option value="non-fiction">Non-Fiction</option>
    <option value="reference">Reference</option>
    <option value="poetry">Poetry</option>
    <option value="drama">Drama</option>
    <option value="childrens-literature">Children's Literature</option>
    <option value="religious-spiritual">Religious/Spiritual</option>
    <option value="academic-textbook">Academic/Textbook</option>
    <option value="graphic-novels-comic">Graphic Novels and Comics</option>
    <option value="diy-and-hobby">DIY and Hobby</option>
    </select>
    <i class="fa-solid fa-caret-down"></i>
  </div>
</div>
    <form method="GET" action="search.php">
        <div class="nav-search">
            <input placeholder="   Search for a book..." class="search-input" type="search" name="query" id="searchInput">
            <button type="submit" class="search-button"><i class="fa-solid fa-magnifying-glass"></i> </button>
        </div>
    </form>

    <script>
        // Add an event listener to the category select
        document.getElementById('categorySelect').addEventListener('change', function() {
            // Get the selected category value
            var selectedCategory = this.value;

            // Update the search input value with the selected category
            document.getElementById('searchInput').value = selectedCategory;
        });
    </script>









        <div class="nav-cart border">
            <a href="cart.php">
                <i class="fas fa-shopping-cart"></i>
                Cart
            </a>
        </div>
        <div class="nav-resell border">
            <a href="wishlist.php">
                <i class="fa-regular fa-heart"></i>
                Wishlist
            </a>
        </div>
    </div>
</header>

<section class="section-1">
<div class="section-1-container">
<div class="section-1-item">
<a href="homepage.php">
<i class="fas fa-home"></i>
</a>
<a href="homepage.php">
Home
</a>
</div>

<div class="section-1-item">
<a href="categories.php">
<i class="fa-solid fa-table-cells-large"></i>
</a>
<a href="categories.php">
Categories
</a>
</div>


<div class="section-1-item">
<a href="orders.php">
<i class="fa-solid fa-box-open"></i>
</a>
<a href="orders.php">
My Orders
</a>
</div>


<div class="section-1-item">
<a href="become a reseller.php">
<i class="fas fa-indian-rupee-sign"></i>
</a>
<a href="become a reseller.php">
Sell On ReadCycle
</a>
</div>
<div class="section-1-item">
<a href="account.php">
<i class="fas fa-circle-user"></i>
</a>
<a href="account.php">
Account
</a>
</div>
<div class="section-1-item">
<a href="About_Us.php">
<i class="fas fa-users"></i>
</a>
<a href="About_Us.php">
About Us
</a>
</div>
<div class="section-1-item">
<a href="help_center.php">
<i class="fa-solid fa-headset"></i>
</a>
<a href="help_center.php">
Help Center
</a>
</div>
</section>


<div id="carousel-container"  style="width: calc(100% - 40px); height: 400px; margin: 0 20px; object-fit: cover;">
  <div id="carousel">
    <div class="carousel-item"><img src="images/banner 1.jpg" alt="Image 1" width="100%" height="100px"></div>
    <div class="carousel-item"><img src="images/banner 2.jpg" alt="Image 1" width="100%" height="100px"></div>
    <div class="carousel-item"><img src="images/banner 3.jpg" alt="Image 1" width="100%" height="100px"></div>
    <div class="carousel-item"><img src="images/banner 4.jpg" alt="Image 1" width="100%" height="100px"></div>
    <div class="carousel-item"><img src="images/banner 5.jpg" alt="Image 1" width="100%" height="100%"></div>
    <div class="carousel-item"><img src="images/banner 6.jpg" alt="Image 1" width="100%" height="100%"></div>
    <div class="carousel-item"><img src="images/banner 8.jpg" alt="Image 1" width="100%" height="100%"></div>

  </div>

  <div id="carousel-buttons">
    <button class="carousel-button" onclick="prevSlide()">&#9664;</button>
    <button class="carousel-button" onclick="nextSlide()">&#9654;</button>
  </div>
</div>
<script>
  const carousel = document.getElementById('carousel');
  let currentIndex = 0;

  function showSlide(index) {
    const newTransformValue = -index * 100 + '%';
    carousel.style.transform = 'translateX(' + newTransformValue + ')';
  }

  function nextSlide() {
    currentIndex = (currentIndex + 1) % 7; 
    showSlide(currentIndex);
  }

  function prevSlide() {
    currentIndex = (currentIndex - 1 + 7) % 7; 
    showSlide(currentIndex);
  }

  setInterval(nextSlide, 4000);

  window.onload = function() {
    showSlide(currentIndex);
  };
</script>












 <!-- DisplayLatest books -->
 <h2 style="margin-left: 40px;">Latest Books</h2>
	<div class="fornt-button">
        <a href="categories.php" class="back-button">
            <i class="fa-solid fa-arrow-right"style="font-size: 20px;"></i>
        </a>
    </div>
    <div class="shop-section">
        <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Display book details here
            echo "<div class='box'>
                    <div class='box-content'>
                        <a href='book_details.php?id=" . $row['book_id'] . "'>
                            <div class='box-img' style='background-image: url(" . $row['book_image'] . ");'></div>
                            <div class='book-name'>" . $row['book_name'] . "</div>
                            <div class='book-price'>" . $row['price'] . "</div>
                        </a>
                    </div>
                  </div>";
        }
    } else {
        echo "No books found";
    }
    ?>
    </div>

<br><br><br><br><br><br>


 <!-- Display books for the Fiction category -->
    <h2 style="margin-left: 40px;">Fiction Category</h2>
	<div class="fornt-button">
        <a href="fiction_new.php" class="back-button">
            <i class="fa-solid fa-arrow-right"style="font-size: 20px;"></i>
        </a>
    </div>
    <div class="shop-section">
        <?php
    if ($result_fiction->num_rows > 0) {
        while($row = $result_fiction->fetch_assoc()) {
            // Display book details here
            echo "<div class='box'>
                    <div class='box-content'>
                        <a href='book_details.php?id=" . $row['book_id'] . "'>
                            <div class='box-img' style='background-image: url(" . $row['book_image'] . ");'></div>
                            <div class='book-name'>" . $row['book_name'] . "</div>
                            <div class='book-price'>" . $row['price'] . "</div>
                        </a>
                    </div>
                  </div>";
        }
    } else {
        echo "No books found for Fiction category";
    }
    ?>
    </div>





    <br><br><br><br><br><br>
    <!-- Display books for the Poetry category -->
    <h2 style="margin-left: 40px;">Poetry Category</h2>
	<div class="fornt-button">
        <a href="poetry.php" class="back-button1">
            <i class="fa-solid fa-arrow-right"style="font-size: 20px;"></i>
        </a>
    </div>
    <div class="shop-section">
<?php
    if ($result_poetry->num_rows > 0) {
        while($row = $result_poetry->fetch_assoc()) {
            // Display book details here
            echo "<div class='box'>
                    <div class='box-content'>
                        <a href='book_details.php?id=" . $row['book_id'] . "'>
                            <div class='box-img' style='background-image: url(" . $row['book_image'] . ");'></div>
                            <div class='book-name'>" . $row['book_name'] . "</div>
                            <div class='book-price'>" . $row['price'] . "</div>
                        </a>
                    </div>
                  </div>";
        }
    } else {
        echo "No books found for Poetry category";
    }
    ?>
    </div>
<br><br><br><br>
    <!-- Display books for the Academic category -->
    <h2 style="margin-left: 40px;">Academic Category</h2>
	<div class="fornt-button">
        <a href="academic-textbook.php" class="back-button2">
            <i class="fa-solid fa-arrow-right"style="font-size: 20px;"></i>
        </a>
    </div>
    <div class="shop-section">
       <?php
    if ($result_academic->num_rows > 0) {
        while($row = $result_academic->fetch_assoc()) {
            // Display book details here
            echo "<div class='box'>
                    <div class='box-content'>
                        <a href='book_details.php?id=" . $row['book_id'] . "'>
                            <div class='box-img' style='background-image: url(" . $row['book_image'] . ");'></div>
                            <div class='book-name'>" . $row['book_name'] . "</div>
                            <div class='book-price'>" . $row['price'] . "</div>
                        </a>
                    </div>
                  </div>";
        }
    } else {
        echo "No books found for Academic category";
    }
    ?>
    </div>
    <br><br><br><br><br><br>
    <!-- Display books for the Non-Fiction category -->
    <h2 style="margin-left: 40px;">Non-Fiction Category</h2>
	<div class="fornt-button">
        <a href="non_fiction.php" class="back-button3">
            <i class="fa-solid fa-arrow-right"style="font-size: 20px;"></i>
        </a>
    </div>
    <div class="shop-section">
       <?php
    if ($result_non_fiction->num_rows > 0) {
        while($row = $result_non_fiction->fetch_assoc()) {
            // Display book details here
            echo "<div class='box'>
                    <div class='box-content'>
                        <a href='book_details.php?id=" . $row['book_id'] . "'>
                            <div class='box-img' style='background-image: url(" . $row['book_image'] . ");'></div>
                            <div class='book-name'>" . $row['book_name'] . "</div>
                            <div class='book-price'>" . $row['price'] . "</div>
                        </a>
                    </div>
                  </div>";
        }
    } else {
        echo "No books found for Non-Fiction category";
    }
    ?>
    </div>

<?php
// Close the database connection
$conn->close();
?>
<br><br><br><br><br><br>
<br>
<br>
<footer>
        <div class="foot-panel1">
           <a href="homepage.php"> Back to top </a>
        </div>
</footer>
<?php include 'footer.php'; ?>
	
	    <script>
// JavaScript function to redirect to the admin login page
function redirectToAdminLoginPage() {
  window.location.href = "Admin Login.html";
}

// Event listener for key press
window.addEventListener("keydown", function(event) {
  if (event.ctrlKey && event.altKey && event.shiftKey && event.code === 'F5') {
    window.location.href = "Admin Login.html";
  }
});


        
    </script>
	
	<script>
  // Function to calculate and set the width of the dropdown container
  function setDropdownWidth() {
    var dropdown = document.getElementById('categoryDropdown');
    var maxWidth = 0;
    // Iterate over each option to find the maximum width
    var options = dropdown.getElementsByClassName('category-select');
    for (var i = 0; i < options.length; i++) {
      var width = options[i].textContent.length * 10; // Adjust the multiplier as needed
      maxWidth = Math.max(maxWidth, width);
    }
    // Set the width of the dropdown container
    dropdown.style.width = maxWidth + 'px';
  }

  // Call the function when the page loads
  window.onload = function() {
    setDropdownWidth();
  };

  // Call the function when the category select options change
  document.getElementById('categorySelect').addEventListener('change', function() {
    setDropdownWidth();
  });
</script>
</body>
</html>
