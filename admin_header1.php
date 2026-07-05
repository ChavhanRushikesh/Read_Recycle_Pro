<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-...your-sha512-hash-here..." crossorigin="anonymous" />
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #fff; /* Set background color to white */
    }

    .header {
        background-color: #fff;
        color: #fff;
        padding: 1rem;
        border-bottom: 2px solid #ccc; /* Add border to the bottom */
    }

    .flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        color: #191970;
        text-decoration: none;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .logo span {
        font-weight: normal;
    }

    .navbar {
        display: flex;
        gap: 50px;
        position: relative;
    }

    .navbar a {
        color: #000;
        text-decoration: none;
        font-size: 1.2rem;
        transition: color 0.3s;
        position: relative;
    }

    .navbar a::after {
        content: "";
        position: absolute;
        bottom: -3px;
        left: 0;
        width: 0;
        height: 2px;
        background-color: red; /* Set underline color */
        transition: width 0.3s ease, left 0.3s ease;
    }

    .navbar a:hover::after,
    .navbar a.active::after {
        width: 100%;
        left: 0;
    }

    .navbar a.active {
        color: green; /* Change text color to blue */
    }

    .delete-btn {
        color: #fff; /* Text color */
        background-color: red; /* Background color */
        padding: 0.5rem 1rem; /* Padding */
        border: none; /* Remove border */
        border-radius: 5px; /* Add border-radius */
        text-decoration: none; /* Remove underline */
        transition: background-color 0.3s, color 0.3s; /* Smooth transition */
    }

    .delete-btn:hover {
        background-color: #ff5a5a; /* Change background color on hover */
    }

    .delete-btn:focus {
        outline: none; /* Remove focus outline */
    }

    .icons {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .icon-btn {
        background-color: transparent;
        color: white; /* Change icon color to white */
        border: none;
        cursor: pointer;
        font-size: 1.5rem;
        transition: color 0.3s;
    }

    .icon-btn a{
        color: white; /* Change icon color to white */
        border: none;
        cursor: pointer;
        font-size: 1.5rem;
        transition: color 0.3s;
    }

    /* Prevent color change on hover for icon buttons */
    .icon-btn:hover a{
        color: red; /* Keep icon color white on hover */
    }
</style>
</head>
<body>
<header class="header">
    <div class="flex">
        <a href="admin_panel.php" class="logo">.Admin<span>Panel</span></a>
        <nav class="navbar">
            <a href="admin_panel.php">Home</a>
			 <a href="add_books.php">Add Books</a>
            <a href="view_books.php">Books</a>
            <a href="view_users.php">Users</a>
            <a href="delete_books.php">Delete Books</a>
            <a href="view_orders.php">Orders</a>
			  <a href="view_reviews.php">Reviews</a>
        </nav>
   
        <a href="homepage.php" class="delete-btn">Logout</a>
        
    </div>
</header>

<script>
    // JavaScript to toggle active class on click
    document.addEventListener("DOMContentLoaded", function() {
        const currentPage = window.location.href;
        const navbarLinks = document.querySelectorAll(".navbar a");

        navbarLinks.forEach(link => {
            if (link.href === currentPage) {
                link.classList.add("active");
            }
            
            link.addEventListener("click", function() {
                navbarLinks.forEach(link => {
                    link.classList.remove("active");
                });
                this.classList.add("active");
            });
        });
    });
</script>

</body>
</html>
