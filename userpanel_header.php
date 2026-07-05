<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Panel</title>
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

    .icons {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .delete-btn {
        background-color: #d3003f;
        color: #fff;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .delete-btn:hover {
        background-color: #ff4d68;
    }
</style>
</head>
<body>
<header class="header">
    <div class="flex">
        <a href="user_panel.php" class="logo">.User<span>Panel</span></a>
        <nav class="navbar">
            <a href="user_panel.php">Home</a>
			 <a href="user_addbooks.php">Add Books</a>
            <a href="my add books.php">Books</a>
            <a href="delete_userbook.php">Delete Books</a>
            <a href="view_userorder.php">Orders</a>
        </nav>
   
        <a href="become a reseller.php" class="delete-btn">Back</a>
        
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
