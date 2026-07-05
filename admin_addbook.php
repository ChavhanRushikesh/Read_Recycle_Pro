<?php
// Start the session
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readcycle";


// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the book_id from the URL parameter
$book_id = $_GET['book_id'];

// Prepare SQL query to fetch book details by book ID
$sql = "SELECT * FROM add_books WHERE book_id = ?";
$stmt = $conn->prepare($sql);

// Bind the book_id parameter
$stmt->bind_param("i", $book_id);

// Execute the query
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Fetch data from the result set
    $row = $result->fetch_assoc();
    // Retrieve book data
    $book_title = $row['book_name'];
    $category = $row['category'];
    $book_condition = $row['book_condition'];
    $price = $row['price'];
	$bookactualprice = $row['actual_price'];
	$quantity = $row['quantity'];
    $author = $row['author'];
    $subcategory = $row['subcategory'];
    $book_image = $row['book_image']; 
    $name = $row['name'];
    $email = $row['email'];
} else {
    echo "Book not found.";
}

// Close the statement
$stmt->close();

// Prepare SQL query to fetch subcategories
$sql_subcategories = "SELECT DISTINCT subcategory FROM add_books WHERE category = ?";
$stmt_subcategories = $conn->prepare($sql_subcategories);

// Bind the category parameter
$stmt_subcategories->bind_param("s", $category);

// Execute the query
$stmt_subcategories->execute();

// Get the result set
$result_subcategories = $stmt_subcategories->get_result();

// Initialize an empty array to store subcategory options
$subcategory_options = [];

// Check if there are rows returned
if ($result_subcategories->num_rows > 0) {
    // Fetch data from the result set and store in the array
    while ($row_subcategory = $result_subcategories->fetch_assoc()) {
        $subcategory_options[] = $row_subcategory['subcategory'];
    }
} else {
    // No subcategories found for the selected category
    $subcategory_options[] = "No subcategories available";
}

// Close the statement
$stmt_subcategories->close();


// Close the connection
$conn->close();

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Books</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>

body {
    margin: 0px;
    padding: 0px;
    box-sizing: border-box;
    font-family: "Poppins", san-serif;
    background-color: #fff;
}

#addbooksContent {
    background-image: none;
    background-color: #fff;
    padding: 20px;
    margin: 0 auto;
    max-width: 1300px;
    margin-top: 0px;
}

#addbooksContent form {
    position: relative;
    display: flex;
    flex-direction: column;
    gap: 20px;
    max-width: 500px;
    margin: 30px 0 50px 50px;
}

#addbooksContent label {
    font-size: 18px;
    font-weight: bold;
    color: black;
    margin-bottom: 10px;
    margin-left: 70px;
}

#addbooksContent input {
    padding: 15px;
    font-size: 16px;
    border: 2px solid grey;
    border-radius: 8px;
    width: 470px;
    background-color: transparent;
    color: black;
    margin-left: 70px;
}

#addbooksContent input:hover {
    border-color: #100c08;
    background-color: #c0c0c0;
    color: #000;
}

#addbooksContent button {
    padding: 15px;
    background-color: #1d2951;
    font-size: 16px;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 10px;
    width: 40%;
    margin-top: 40px;
    margin-left: 220px;
}

#addbooksContent button:hover {
    background-color: #01796f;
}

#addbooksContent h2 {
    font-size: 35px;
    margin-left: 300px;
    font-family: Inter, sans-serif;
    color: red;
}

.content-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    margin: 50px auto;
    max-width: 60%;
}

#addbooksContent select {
    padding: 15px;
    font-size: 16px;
    border: 2px solid grey;
    border-radius: 8px;
    width: 100%;
    background-color: transparent;
    color: black;
    margin-left: 70px;
    cursor: pointer;
}

#addbooksContent select:hover {
    background-color: #c0c0c0;
    border-color: #100c08;
}

#addbooksContent option {
    background-color: #fff;
    color: #000;
}

#addbooksContent option:hover {
    background-color: #d3d3d3;
    color: #000;
}

#preview-image {
    max-width: 20%;
    height: 9%;
    display: block;
    border: 1px solid black;
    border-radius: 1px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    position: absolute;
    top: 0;
    right: 0;
    margin-top: 760px;
    margin-right: -170px;
}
</style>
</head>
<body>
<?php include 'admin_header1.php'; ?>

<div id="addbooksContent" class="content-area">
    <!-- Content for Add Books -->
    <div class="content-container">
        <h2>Edit Books</h2>
        <form action="adminupdate_book.php" method="post" enctype="multipart/form-data">
            <input type="hidden" id="book_id" name="book_id" value="<?php echo $book_id; ?>">

            <label for="category">Category:</label>
            <select id="category" name="category">
                <!-- Options for categories -->
                <option value="-1">Select...</option>
                <option value="fiction" <?php if(isset($category) && $category == "fiction") echo "selected"; ?>>Fiction</option>
                <option value="non-fiction" <?php if(isset($category) && $category == "non-fiction") echo "selected"; ?>>Non-Fiction</option>
                <option value="reference" <?php if(isset($category) && $category == "reference") echo "selected"; ?>>Reference</option>
                <option value="poetry" <?php if(isset($category) && $category == "poetry") echo "selected"; ?>>Poetry</option>
                <option value="drama" <?php if(isset($category) && $category == "drama") echo "selected"; ?>>Drama</option>
                <option value="childrens-literature" <?php if(isset($category) && $category == "childrens-literature") echo "selected"; ?>>Children's Literature</option>
                <option value="religious-spiritual" <?php if(isset($category) && $category == "religious-spiritual") echo "selected"; ?>>Religious/Spiritual</option>
                <option value="academic-textbook" <?php if(isset($category) && $category == "academic-textbook") echo "selected"; ?>>Academic/Textbook</option>
                <option value="graphic-novels-comic" <?php if(isset($category) && $category == "graphic-novels-comic") echo "selected"; ?>>Graphic Novels and Comics</option>
                <option value="diy-and-hobby" <?php if(isset($category) && $category == "diy-and-hobby") echo "selected"; ?>>DIY and Hobby</option>
            </select>

            <label for="condition">Condition:</label>
            <select id="condition" name="condition">
                <option value="-1">Select...</option>
                <option value="good" <?php if(isset($book_condition) && $book_condition == "good") echo "selected"; ?>>Good</option>
                <option value="poor" <?php if(isset($book_condition) && $book_condition == "poor") echo "selected"; ?>>Poor</option>
                <option value="average" <?php if(isset($book_condition) && $book_condition == "average") echo "selected"; ?>>Average</option>
                <option value="new" <?php if(isset($book_condition) && $book_condition == "new") echo "selected"; ?>>New</option>
            </select>

            <label for="bookname">Book Title:</label>
            <input type="text" id="bookname" name="bookname" value="<?php echo $book_title; ?>" required>

<label for="bookactualprice">Actual Book Price:</label>
<input type="text" id="bookactualprice" name="bookactualprice" value="<?php echo $bookactualprice; ?>" required oninput="calculateBookPrice()">

            <label for="bookprice">Enter Book Price:</label>
            <input type="text" id="bookprice" name="bookprice" value="<?php echo $price; ?>" required>
			
			 <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo $quantity; ?>" required>


            <label for="author">Name of Author:</label>
            <input type="text" id="author" name="author" value="<?php echo $author; ?>" required>

            <label for="subcategory">Enter Sub-Category:</label>
            <select id="subcategory" name="subcategory">
                <?php foreach ($subcategory_options as $option) : ?>
                    <option value="<?php echo $option; ?>" <?php if(isset($subcategory) && $subcategory == $option) echo "selected"; ?>><?php echo $option; ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Book image -->
            <label for="file" class="select-image"> Choose Book Image </label>
            <input type="file" id="file" name="file" accept="image/*">
            <img id="preview-image" src="<?php echo $book_image; ?>" alt="Book Image">

            <!-- Input field for name populated with PHP echo -->
            <label for="name">Enter Name of Seller:</label>
            <input type="text" id="name" name="name" placeholder="Enter name of seller" value="<?php echo $name; ?>" required>

            <!-- Input field for email populated with PHP echo -->
            <label for="email">Enter Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter email of seller" value="<?php echo $email; ?>" required>
                
            <button type="submit">Edit Book</button>
        </form>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    // Define subcategory options for each category
    const subcategoryOptions = {
        fiction: ["Novel", "Short Story", "Mystery/Thriller", "Fantasy", "Science Fiction", "Historical Fiction"],
        "non-fiction": ["Biography/Autobiography", "Essay", "Memoir", "Self-Help", "Science", "History"],
        "non-fiction": ["Biography/Autobiography", "Essay", "Memoir", "Self-Help", "Science", "History"],
        reference: ["Dictionary", "Encyclopedia", "Atlas", "Almanac"],
        poetry: ["Verse", "Haiku", "Epic"],
        drama: ["Play", "Script"],
        "childrens-literature": ["Picture Books", "Chapter Books", "Young Adult"],
       "religious-spiritual": ["Christianity", "Islam", "Buddhism", "Hinduism", "Sikhism"],
        "academic-textbook": ["Textbook", "Research Papers"],
        "graphic-novels-comic": ["Graphic Novels", "Comic Book"],
        "diy-and-hobby": ["Crafts", "Hobby Guides", "Gardening"]
    };

  
function addBooks() {
    // Retrieve the selected category
    const selectedCategory = document.getElementById("category").value;
    
    // Create an object to store book information
    const bookInfo = {
        category: selectedCategory,
        condition: document.getElementById("condition").value,
        bookid: document.getElementById("bookid").value,
        bookname: document.getElementById("bookname").value,
        bookprice: document.getElementById("bookprice").value,
		quantity: document.getElementById("quantity").value,
        author: document.getElementById("author").value,
        subcategory: document.getElementById("subcategory").value
    };

    // Store the book information in local storage
    localStorage.setItem("bookInfo", JSON.stringify(bookInfo));

    // Redirect to the corresponding HTML file based on the selected category
    switch (selectedCategory) {
        case "fiction":
            window.location.href = "fiction_new.php";
            break;
        case "non-fiction":
            window.location.href = "non_fiction.php";
            break;
       case "reference":
            window.location.href = "reference.php";
            break;
        case "poetry":
            window.location.href = "poetry.php";
            break;
			case "drama":
            window.location.href = "drama.php";
            break;
			case "childrens-literature":
            window.location.href = "childrens-literature.php";
            break;
			case "religious-spiritual":
            window.location.href = "religious-spiritual.php";
            break;
			case "academic-textbook":
            window.location.href = "academic-textbook.php";
            break;
			case "graphic-novels-comic":
            window.location.href = "graphic-novels-comic.php";
            break;
			case "diy-and-hobby":
            window.location.href = "diy-and-hobby.php";
            break;
        default:
            // Display an alert if no valid category is selected
            alert("Please select a valid category.");
            break;
    }
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Function to preview selected image
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview-image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // Add event listener to the file input
    document.getElementById('file').addEventListener('change', previewImage);
});
</script>
<script>
function calculateBookPrice() {
    // Get the actual book price entered by the user
    var actualPrice = parseFloat(document.getElementById("bookactualprice").value);

    // Get the selected condition
    var condition = document.getElementById("condition").value;

    // Define the price multiplier based on the condition
    var priceMultiplier = 1.0; // Default multiplier for new condition
    switch(condition) {
        case "good":
            priceMultiplier = 0.8; // 80% of actual price
            break;
        case "poor":
            priceMultiplier = 0.6; // 50% of actual price
            break;
        case "average":
            priceMultiplier = 0.7; // 70% of actual price
            break;
        // "new" condition will use the default multiplier (1.0)
    }

    // Calculate the new book price
    var newPrice = actualPrice * priceMultiplier;

    // Update the book price input field with the new price
    document.getElementById("bookprice").value = newPrice.toFixed(2); // Round to 2 decimal places
}
</body>
</html>
