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
    }

    .header {
        background-color: #002147;
        color: #fff;
        padding: 1rem;
    }

    .flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        color: #fff;
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
        align-items: center; /* Vertically center items */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add shadow */
    }

    .navbar a {
        color: #fff;
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
        background-color: transparent; /* Set underline color */
        transition: width 0.3s ease, left 0.3s ease;
    }

    .navbar a:hover::after,
    .navbar a.active::after {
        width: 100%;
        left: 0;
        background-color: yellow; /* Change underline color */
    }

    .navbar a:hover {
        color: yellow; /* Change text color on hover */
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

    .icon-btn a {
        color: white; /* Change icon color to white */
        border: none;
        cursor: pointer;
        font-size: 1.5rem;
        transition: color 0.3s;
    }

    /* Prevent color change on hover for icon buttons */
    .icon-btn:hover a {
        color: red; /* Keep icon color white on hover */
    }

    /* Dropdown styles */
    .dropdown {
        position: relative;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        z-index: 1;
        list-style: none;
        padding: 0;
    }

    .dropdown:hover .dropdown-content {
        display: block;
        animation: fadeIn 0.3s ease-in-out;
    }

    .dropdown-item {
        padding: 3px;
        color: black; /* Set default text color */
        transition: color 0.3s;
    }
	.dropdown-item a{
		color: black; /* Set default text color */
	}

    .dropdown-item:hover a{
        color: blue; /* Change text color on hover */
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>
</head>
<body>
<header class="header">
    <div class="flex">
        <a href="homepage.php" class="logo">.Read<span>Cycle</span></a>

        <nav class="navbar">
		<a href="homepage.php">Home</a>
            <div class="dropdown">
                <a href="categories.php" class="dropdown-toggle" onclick="toggleDropdown()">Categories</a>
                <ul class="dropdown-content" id="dropdownMenu">
                    <li class="dropdown-item"><a href="fiction_new.php">Fiction</a></li>
                    <li class="dropdown-item"><a href="non_fiction.php">Non-Fiction</a></li>
                    <li class="dropdown-item"><a href="reference.php">Reference</a></li>
                    <li class="dropdown-item"><a href="poetry.php">Poetry</a></li>
                    <li class="dropdown-item"><a href="drama.php">Drama</a></li>
                    <li class="dropdown-item"><a href="childrens-literature.php">Childrens Literature</a></li>
                    <li class="dropdown-item"><a href="religious-spiritual.php">Religious-Spiritual</a></li>
                    <li class="dropdown-item"><a href="academic-textbook.php">Academic/Textbook</a></li>
                    <li class="dropdown-item"><a href="graphic-novels-comic.php">Graphic Novels and Comics</a></li>
                    <li class="dropdown-item"><a href="diy-and-hobby.php">DIY and Hobby</a></li>
                </ul>
            </div>
            <a href="orders.php">My Orders</a>
            <a href="become a reseller.php">Sell on ReadCycle</a>
            <a href="account.php">Account</a>
            <a href="About_Us.php">About Us</a>
            <a href="help_center.php">Help Center</a>
        </nav>
   
        <div class="icons">
            <button class="icon-btn"><a href="cart.php"><i class="fas fa-shopping-cart"></i></a></button>
            <button class="icon-btn"><a href="wishlist.php"><i class="far fa-heart"></i></a></button>
        </div>
    </div>
</header>

<script>
    function toggleDropdown() {
        var dropdownMenu = document.getElementById("dropdownMenu");
        dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
    }

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
