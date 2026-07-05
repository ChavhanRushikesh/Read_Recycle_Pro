<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Books</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-...your-sha512-hash-here..." crossorigin="anonymous" />

<style>

        body {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
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
            transition: all 0.5s ease; /* Added transition */
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
            font-family: Inter, sans-serif;
            background-color: transparent;
            color: black;
            margin-left: 70px;
            transition: all 0.3s ease; /* Added transition */
        }
		
		#addbooksContent select {
            padding: 15px;
            font-size: 16px;
            border: 2px solid grey;
            border-radius: 8px;
            width: 500px;
            font-family: Inter, sans-serif;
            background-color: transparent;
            color: black;
            margin-left: 70px;
            transition: all 0.3s ease; /* Added transition */
        }

        #addbooksContent input:hover,
        #addbooksContent select:hover {
            transform: scale(1.02); /* Added scaling effect on hover */
            background-color: #c0c0c0;
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
            transition: all 0.3s ease; /* Added transition */
        }

        #addbooksContent button:hover {
            background-color: #01796f;
            transform: scale(1.05); /* Added scaling effect on hover */
        }

        #addbooksContent h2 {
            font-size: 35px;
            margin-left: 300px;
            font-family: Inter, sans-serif;
            color: red;
            transition: all 0.5s ease; /* Added transition */
        }

        .content-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            margin: 50px auto;
            max-width: 60%;
            transition: all 0.5s ease; /* Added transition */
        }
		

    </style>

</head>
<body>
<?php include 'admin_header1.php'; ?>


 <div id="addbooksContent" class="content-area">
    <!-- Content for Add Books -->
<div class="content-container">
    <h2>Add Books</h2>

    <form action="seller_db.php" method="post" enctype="multipart/form-data">
        <label for="category">Category:</label>
       <select id="category" name="category">
    <option value="-1" selected>Select...</option>
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


        <label for="condition">Condition:</label>
        <select id="condition" name="condition">
		 <option value="-1" selected>Select...</option>
        <option value="good">Good</option>
		<option value="poor">Poor</option>
		<option value="average">Average</option>
        <option value="new">New</option>
    </select>
	
        <label for="bookname">Enter Book Name:</label>
        <input type="text" id="bookname" name="bookname" placeholder="Enter Book Name" required>

         <label for="bookprice">Enter Actual Book Price:</label>
        <input type="text" id="bookactualprice" name="bookactualprice" placeholder="Enter actual price" required>
		
		<label for="bookprice">Enter Book Price:</label>
        <input type="text" id="bookprice" name="bookprice" placeholder="Enter price" readonly="true" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="1" min="1" required>

        <label for="author">Name of Author:</label>
        <input type="text" id="author" name="author" placeholder="Enter name of author" required>

       <label for="subcategory">Enter Sub-Category:</label>
    <select id="subcategory" name="subcategory">
    </select>
	
	<label for="file" class="select-image"> Choose Book Image </label>
	<input type="file" id="file" name="file" accept="image/*">
	
	<label for="name">Enter Name of Seller:</label>
<input type="text" id="name" name="name" placeholder="Enter name of seller" value="Admin" readonly required>

<label for="name">Enter Email:</label>
<input type="text" id="email" name="email" placeholder="Enter email of seller" value="readcycle@gmail.com" readonly required>

		
	<button onclick="addBooks()">Add Book</button>
    </form>
</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Define subcategory options for each category
    const subcategoryOptions = {
        fiction: ["Novel", "Short Story", "Mystery/Thriller", "Fantasy", "Science Fiction", "Historical Fiction"],
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

    const categoryDropdown = document.getElementById("category");
    const subcategoryDropdown = document.getElementById("subcategory");

    // Function to update subcategory options based on the selected category
    function updateSubcategoryOptions() {
        const selectedCategory = categoryDropdown.value;
        const subcategories = subcategoryOptions[selectedCategory] || [];
        
        // Clear existing options
        subcategoryDropdown.innerHTML = "";
        
        // Add new options
        subcategories.forEach(function(subcategory) {
            const option = document.createElement("option");
            option.text = subcategory;
            option.value = subcategory.toLowerCase().replace(/\s+/g, '-'); // convert to lowercase and replace spaces with hyphens
            subcategoryDropdown.add(option);
        });
    }

    // Add event listener to category dropdown
    categoryDropdown.addEventListener("change", updateSubcategoryOptions);

    // Initial update of subcategory options
    updateSubcategoryOptions();
});

function changeQuantity(delta) {
            const quantityInput = document.getElementById("quantity");
            let currentQuantity = parseInt(quantityInput.value);

            // Ensure the quantity is at least 1
            currentQuantity = Math.max(1, currentQuantity + delta);

            // Update the quantity input value
            quantityInput.value = currentQuantity;
        } 

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

document.addEventListener("DOMContentLoaded", function() {
    // Add event listener to detect changes in the actual book price input
    document.getElementById("bookactualprice").addEventListener("change", updateBookPrice);
    // Add event listener to detect changes in the condition select
    document.getElementById("condition").addEventListener("change", updateBookPrice);
});

function updateBookPrice() {
    // Retrieve the actual book price from the input field
    const actualPrice = parseFloat(document.getElementById("bookactualprice").value);
    // Retrieve the selected condition from the select dropdown
    const condition = document.getElementById("condition").value;
    // Define the condition multipliers
    const conditionMultipliers = {
        good: 0.8, // 80% of the actual price
        poor: 0.6, // 60% of the actual price
        average: 0.7, // 70% of the actual price
        new: 1 // 100% of the actual price
    };

    // Calculate the displayed book price based on the actual price and condition
    const displayedPrice = actualPrice * conditionMultipliers[condition];

    // Update the value of the book price input field with the calculated price
    document.getElementById("bookprice").value = displayedPrice.toFixed(2); // Round to 2 decimal places
}

function validateForm() {
    // Retrieve the values of the input fields
    const bookName = document.getElementById("bookname").value;
    const actualPrice = document.getElementById("bookactualprice").value;
    const bookPrice = document.getElementById("bookprice").value;
    const author = document.getElementById("author").value;
    const email = document.getElementById("email").value;

    // Regular expressions for validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Flag to track if the form is valid
    let isValid = true;

    // Validate book name
    if (bookName.trim() === "") {
        alert("Please enter the book name.");
        isValid = false;
    }

    // Validate actual price
    if (actualPrice.trim() === "" || isNaN(parseFloat(actualPrice))) {
        alert("Please enter a valid actual price.");
        isValid = false;
    }

    // Validate book price
    if (bookPrice.trim() === "" || isNaN(parseFloat(bookPrice))) {
        alert("Please enter a valid book price.");
        isValid = false;
    }

    // Validate author
    if (author.trim() === "") {
        alert("Please enter the author's name.");
        isValid = false;
    }

    // Validate email
    if (email.trim() === "" || !emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        isValid = false;
    }

    // Return true if the form is valid, otherwise return false
    return isValid;
}
       
      
</script>


</body>
</html>
