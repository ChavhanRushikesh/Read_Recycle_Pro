<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Header</title>
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
        background-color: white; /* Set underline color */
        transition: width 0.3s ease, left 0.3s ease;
    }

    .navbar a:hover::after,
    .navbar a.active::after {
        width: 100%;
        left: 0;
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
        <a href="homeNotLogin.php" class="logo">.Read<span>Cycle</span></a>
            <nav class="navbar">
		<a href="homepage.php">Home</a>
            <div class="dropdown">
                <a href="Categories1.php" class="dropdown-toggle" onclick="toggleDropdown()">Categories</a>
                <ul class="dropdown-content" id="dropdownMenu">
                    <li class="dropdown-item"><a href="fiction_new1.php">Fiction</a></li>
                    <li class="dropdown-item"><a href="non_fiction1.php">Non-Fiction</a></li>
                    <li class="dropdown-item"><a href="reference1.php">Reference</a></li>
                    <li class="dropdown-item"><a href="poetry1.php">Poetry</a></li>
                    <li class="dropdown-item"><a href="drama1.php">Drama</a></li>
                    <li class="dropdown-item"><a href="childrens-literature1.php">Childrens Literature</a></li>
                    <li class="dropdown-item"><a href="religious-spiritual1.php">Religious-Spiritual</a></li>
                    <li class="dropdown-item"><a href="academic-textbook11.php">Academic/Textbook</a></li>
                    <li class="dropdown-item"><a href="graphic-novels-comic1.php">Graphic Novels and Comics</a></li>
                    <li class="dropdown-item"><a href="diy-and-hobby1.php">DIY and Hobby</a></li>
                </ul>
            </div>
            <a href="About Us.php">About Us</a>
            <a href="Help Center.php">Help Center</a>
        </nav>
   
        <div class="icons">
            <button class="icon-btn"><a href="login.php"><i class="fas fa-shopping-cart"></i></a></button>
            <button class="icon-btn"><a href="login.php"><i class="far fa-heart"></i></a></button>
        </div>
    </div>
</header>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const categoriesDropdown = document.getElementById("categoriesDropdown");
    const dropdownMenu = document.getElementById("dropdownMenu");

    // Close dropdown when clicking outside
    document.addEventListener("click", function(event) {
        const isClickInsideDropdown = categoriesDropdown.contains(event.target);
        if (!isClickInsideDropdown) {
            dropdownMenu.style.display = "none";
        }
    });

    // Toggle dropdown display
    categoriesDropdown.addEventListener("click", function(event) {
        dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
    });

    // Set active class for current page link
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
