<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
body, html {
    height: 100%;
    margin: 0;
    padding: 0;
    overflow-y: hidden; 
    position: relative; /* Set body and html to relative positioning */
}

.text {
    text-align: center;
    margin-top: 30px; /* Increased margin-top to create more space */
    animation: slideInDown 1s ease forwards;
}

@keyframes slideInDown {
    0% {
        transform: translateY(-100%);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

.text h2 {
    font-size: 45px;
    font-weight: bold;
    color: red; /* Changed text color */
    font-family: Inter, sans-serif;
}

.section-1 {
    width: 100%;
    height: calc(100% - 50px); /* Adjusted height to accommodate the top bar */
    background-color: white;
    display: flex;
    justify-content: center;
    align-items: center;
}

.section-1-container {
    width: 100%;
    max-width: 1280px;
    display: flex;
    flex-wrap: wrap; /* Allow flex items to wrap to the next line */
    justify-content: center;
    margin-top: -150px;
}

.section-1-item {
    width: 300px;
    max-width: 300px;
    height: 200px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    font-size: 18px;
    font-weight: 540;
    padding: 10px;
    border: 2px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    margin: 30px; /* Added margin for space between cards */
    flex-grow: 1; /* Allow flex item to grow to fill available space */
    top: 40px;
    animation: fadeIn 1s ease forwards;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(50%);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.section-1-item a {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    color: black;
    font-weight: bold;
    font-family: Inter, sans-serif;
    font-size: 20px;
}

.section-1-item a i {
    margin-bottom: 35px; /* Add space between icon and text */
}

.section-1-item i {
    font-size: 70px;
    height: 60px;
    text-decoration: none;
    color: #0047ab;
}

.section-1-item:hover {
    transform: scale(1.05); /* Increase size on hover */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Add box shadow on hover */
}

.section-1-item a:hover {
    color: #191970; /* Change text color on hover */
}

.section-1-item i:hover {
    color: #191970; /* Change icon color on hover */
}

/* Style for the logout text */
.logout-text {
    position: absolute;
    top: 10px;
    right: 20px;
    font-weight: bold;
    font-size: 18px;
    color: red;
    font-family: Inter, sans-serif;
    text-decoration: none;
    animation: slideInRight 1s ease forwards;
}

@keyframes slideInRight {
    0% {
        transform: translateX(100%);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

.logout-text a{
    font-size: 18px;
    color: red;
    font-family: Inter, sans-serif;
    text-decoration: none;
}

</style>
</head>
<body>
<?php include 'admin_header1.php'; ?>
<div class="text">
    <h2> Hello, Admin </h2>
</div>

<section class="section-1">
    <div class="section-1-container">
        <div class="section-1-item" style="animation-delay: 0.2s;"> <!-- Delay animation -->
            <a href="add_books.php">
                <i class="fas fa-book-open"></i>
            </a>
            <a href="add_books.php">
                Add Books
            </a>
        </div>
        <div class="section-1-item" style="animation-delay: 0.4s;"> <!-- Delay animation -->
            <a href="view_books.php">
                <i class="fa-solid fa-book-open-reader"></i>
            </a>
            <a href="view_books.php">
                View Books
            </a>
        </div>
        <div class="section-1-item" style="animation-delay: 0.6s;"> <!-- Delay animation -->
            <a href="view_users.php">
                <i class="fas fa-user"></i>
            </a>
            <a href="view_users.php">
                View Users
            </a>
        </div>
        <div class="section-1-item" style="animation-delay: 0.8s;"> <!-- Delay animation -->
            <a href="delete_books.php">
               <i class="fas fa-book"></i>
            </a>
            <a href="delete_books.php">
                Delete Books
            </a>
        </div>
        <div class="section-1-item" style="animation-delay: 1s;"> <!-- Delay animation -->
            <a href="view_orders.php">
                <i class="fa-solid fa-box-open"></i>
            </a>
            <a href="view_orders.php">
                Order Details
            </a>
        </div>
        <div class="section-1-item" style="animation-delay: 1.2s;"> <!-- Delay animation -->
            <a href="view_reviews.php">
               <i class="fa-solid fa-thumbs-up"></i>
            </a>
            <a href="view_reviews.php">
                Website Reviews
            </a>
        </div>
    </div>
</section>
</body>
</html>
