<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
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
            <a href="cart.php">
                <i class="fa-regular fa-heart"></i>
                Wishlist
            </a>
        </div>
    </div>
</header>
<style>
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
    margin-top: 16px;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    margin-left: 69; /* Remove the margin-left */
    width: 600px; /* Adjust the width as needed */
    height: 80px;
    border-radius: 4px;
}


    .search-input {
        width: 81%; /* Adjust the width as needed */
        font-size: 1rem;
        border: none;
        height: 42px;
       
       
		margin-left: -91px;
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
		margin-left: -78px;
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

    /* Card Styles */
    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 20px;
        overflow: auto;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); /* Add box-shadow */
    }

    .card-body {
        background-color: #f7f7f7;
        padding: 10px;
    }

    .card-title {
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .card-text {
        font-size: 25px;
        line-height: 2.5;
    }

    .card-info {
        margin-right: 10px;
    }

    .book-info {
        overflow: auto;
    }
	 a {
        text-decoration: none;
		color: black;
    }
.card-buttons {
    margin-top: 10px;
}

.add-to-cart-button,
.buy-now-button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 16px;
    margin-right: 10px;
    cursor: pointer;
}

.add-to-cart-button:hover,
.buy-now-button:hover {
    background-color: green;
}

.card-buttons button {
    font-size: 16px;
    border-radius: 4px;
}

</style>
<div class="content">
    <?php
// Start the session
session_start();
    $query = $_GET['query'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "readcycle";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM add_books WHERE book_name LIKE '%$query%' OR category LIKE '%$query%' OR author LIKE '%$query%'";
    $result = $conn->query($sql);
    ?>
    <br><br><br><br><!-- Added line -->
    <h2>Search results for: <?php echo $query; ?></h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<a href="book_details1.php?id=' . $row['book_id'] . '">';
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<img src='" . $row["book_image"] . "' alt='Book Image' style='width: 200px; height: 300px; float: left; margin-right: 10px;'>";
            echo "<div class='book-info'>";
            echo "<h5 class='card-title' style='font-size: 25px; line-height: 1.2;'>" . $row["book_name"] . "</h5>";
            echo "<p class='card-text' style='font-size: 18px; line-height: 2;'>";
            echo "<span class='card-info'>Author: " . $row["author"] . "</span><br>";
            echo "<span class='card-info'>Price: " . $row["price"] . "</span><br>";
            echo "<span class='card-info'>Subcategory: " . $row["subcategory"] . "</span>";
            echo "</p>";
            echo "<div class='card-buttons'>"; // Container for buttons
    echo "<button class='add-to-cart-button'>Add to Cart</button>";
    echo "<button class='buy-now-button'>Buy Now</button>";
    echo "</div>"; // Closing the button container
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</a>"; // Closing the <a> tag
}
    } else {
        echo "No results found.";
    }
    $conn->close();
    ?>
</div>
