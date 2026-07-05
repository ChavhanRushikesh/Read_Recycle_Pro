<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readcycle";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo "Connected to database successfully";

$user_id = $_SESSION['user_id'];

// Fetch user details from the database
$sql = "SELECT * FROM userinfo WHERE User_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$user_data = [];

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
}
//echo "User_ID in session: " . $_SESSION['user_id'];
//echo "SQL Query: $sql";

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-...your-sha512-hash-here..." crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<style>
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Times New Roman', serif;
        background-image: url("images/account_image.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    
    .sidebar {
        position: fixed;
        top: 60px;
        left: 0;
        bottom: 0;
        width: 200px;
        background: #d3d3d3;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        z-index: 1000;
    }

    .sidebar a {
        text-decoration: none;
        color: #000000;
        text-align: center;
        padding: 15px 0;
        font-size: 20px;
        font-weight: bold;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .sidebar a img {
        max-width: 50px;
        max-height: 50px;
        margin-bottom: 5px;
    }

    .sidebar a:hover {
        background-color: #00008b;
        color: #fff;
    }

    .content-area {
        position: fixed;
        top: 70px;
        left: 200px; /* Set left to the width of the sidebar */
        right: 0;
        bottom: 0;
        background: #fff; /* Background color for the content area */
        display: none;
        padding: 20px;
        overflow-y: auto;
        z-index: 999;
    }

    #editProfileContent {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 20px; /* Adjust padding as needed */
}

  #editProfileContent form {
    position: relative;
    display: flex;
    flex-direction: column;
    gap: 20px;
    max-width: 500px;
    margin: 30px 0 50px 50px; /* Updated margin property */
}


    #editProfileContent label {
    font-size: 18px;
    font-weight: bold;
    color: dark blue; /* Updated color property */
    text-decoration: underline;
    margin-bottom: 10px;
}

#editProfileContent input {
    padding: 15px;
    font-size: 16px;
    border: 2px solid darkblue;
    border-radius: 12px;
    width: 100%;
    background-color: rgba(0, 0, 139, 0.2); /* Updated background color property with transparency */
    color: black; /* Updated text color property */
}


    #editProfileContent button {
    padding: 15px;
    background-color: #00008b;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 12px;
    width: 30%;
    margin-top: 20px;
    margin-left: 35%; /* Updated margin property */
}


    #editProfileContent button:hover {
        background-color: #000;
    }

   
#editProfileContent h2 {
    font-size: 24px; /* Updated font-size property */
}

#reviewsContent {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 20px; /* Adjust padding as needed */
    }

    #reviewsContent form {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 20px;
        max-width: 500px;
        margin: 30px 0 50px 50px; /* Updated margin property */
    }

  #reviewsContent label {
    font-size: 18px;
    font-weight: bold;
    color: darkblue;
    text-decoration: underline;
    margin-bottom: 15px; /* Adjust the margin-bottom for space between labels and input fields */
    display: block;
}

#reviewsContent input {
    padding: 15px;
    font-size: 16px;
    border: 2px solid darkblue;
    border-radius: 12px;
    width: calc(100% - 30px); /* Adjusted width calculation to include padding */
    background-color: rgba(0, 0, 139, 0.2);
    color: white;
    margin-bottom: 15px; /* Adjust the margin-bottom for space between labels and input fields */
    box-sizing: border-box; /* Ensure padding is included in the width calculation */
}



    #reviewsContent button {
        padding: 15px;
        background-color: #00008b;
        color: #fff;
        border: none;
        cursor: pointer;
        border-radius: 12px;
        width: 20%;
        margin-top: 20px;
        margin-left: 40%; /* Updated margin property */
    }

    #reviewsContent button:hover {
        background-color: green;
    }

  #reviewsContent h3 {
    font-size: 30px;
    margin-bottom: -20px; /* Adjust the margin-bottom to decrease space */
margin-top: -30px; /* Adjust the margin-top to move it up */
}

#reviewsContent #starRating {
    font-size: 40px;
    margin-top: -5px; /* Adjust the margin-top to decrease space */
}



    #reviewsContent .star {
        font-size: 40px; /* Keep the font size */
        cursor: pointer;
    }

    #reviewsContent .star:hover {
        color: #efcc00;
    }
#reviewsContent h2 {
    font-size: 24px; /* Adjust the font size as needed */
    margin-bottom: 10px; /* Optional: Adjust the margin-bottom for spacing */
}
#reviewsContent .experience-question p {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    #reviewsContent textarea {
        padding: 15px;
        font-size: 16px;
        border: 2px solid darkblue;
        border-radius: 12px;
        width: calc(100% - 30px);
        background-color: rgba(0, 0, 139, 0.2);
        color: white;
        margin-bottom: 15px;
        box-sizing: border-box;
        resize: vertical; /* Allow vertical resizing of textarea */
    }
#editProfileContent .close-button,
#reviewsContent .close-button,
#logoutContent .close-button {
    position: absolute;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
    cursor: pointer;
    font-size: 14px !important;
    color: #00008b; /* Set the color to the desired color */
    background: none;
    border: none;
    padding: 0;
width:20px;
}

#editProfileContent .close-button:hover,
#reviewsContent .close-button:hover,
#logoutContent .close-button:hover {
    text-decoration: underline;
    color: #000; /* Set the hover color to the desired color */
}

#logoutContent {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 20px; /* Adjust padding as needed */
    }
#logoutContent .logout-button {
    display: block;
    margin: 0 auto;
    padding: 15px;
    background-color: red;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 12px;
    width: 20%;
 margin-top: 20px; /* Adjusted margin-top */
}
#logoutContent button {
    padding: 15px;
    background-color: #00008b;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 12px;
    width: 20%;
    margin-top: 20px;
    margin-left: 40%; /* Updated margin property */
}


    #logoutContent button:hover {
        background-color: #000;
    }
</style>

<body>
    <?php include 'user_header.php'; ?>
    <div class="sidebar">
        <a href="#" onclick="openContent('editProfileContent')">
            <img src="https://static.vecteezy.com/system/resources/previews/000/367/333/original/edit-profile-vector-icon.jpg" alt="Icon 1">
            Edit Profile
        </a>
        <a href="#" onclick="openContent('reviewsContent')">
            <img src="https://www.svgrepo.com/show/341075/star-review.svg" alt="Icon 2">
            Reviews
        </a>
        <a href="#" onclick="openContent('logoutContent')">
            <img src="https://static.vecteezy.com/system/resources/previews/000/574/782/original/vector-logout-sign-icon.jpg" alt="Icon 3">
            Logout
        </a>
    </div>

    <div id="editProfileContent" class="content-area">
    <!-- Content for Edit Profile -->
    <br>
    <h2>Edit Profile</h2>

    <form method="post" action="update_profile.php">
            <label for="emailAddress">Email Address:</label>
            <input type="email" id="emailAddress" name="emailAddress" placeholder="Enter your email address" value="<?php echo isset($user_data['Email']) ? $user_data['Email'] : ''; ?>">
            
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" value="<?php echo isset($user_data['Full_Name']) ? $user_data['Full_Name'] : ''; ?>">

            <label for="mobileNumber">Mobile Number:</label>
            <input type="tel" id="mobileNumber" name="mobileNumber" placeholder="Enter your mobile number" value="<?php echo isset($user_data['Mobile_Number']) ? $user_data['Mobile_Number'] : ''; ?>">
                        
            <label for="colonyHouseNo">Colony-House No:</label>
            <input type="text" id="colonyHouseNo" name="colonyHouseNo" placeholder="Enter your colony-house number" value="<?php echo isset($user_data['Colony_HouseNo']) ? $user_data['Colony_HouseNo'] : ''; ?>">

            <label for="cityWithPin">City with Pin:</label>
            <input type="text" id="cityWithPin" name="cityWithPin" placeholder="Enter your city with pin code" value="<?php echo isset($user_data['City_Pin']) ? $user_data['City_Pin'] : ''; ?>">

            <label for="country">Country:</label>
            <input type="text" id="country" name="country" placeholder="Enter your country" value="<?php echo isset($user_data['Country']) ? $user_data['Country'] : ''; ?>">
            
            <label for="state">State:</label>
            <input type="text" id="state" name="state" placeholder="Enter your state" value="<?php echo isset($user_data['State']) ? $user_data['State'] : ''; ?>">

            <button type="submit" name="save_changes">Save Changes</button>
        </form>


    <!--<button onclick="closeContent('editProfileContent')">Close</button>-->
</div>




<script>
    function saveChanges() {
        // Add logic here to save the changes made to the profile

        // Display a confirmation alert (you can replace this with your actual logic)
        alert("Changes saved successfully!");

        // Redirect to the same page with 'editProfileContent' open
        window.location.href = 'account.php#editProfileContent';

        // Prevent the form from submitting normally
        return false;
    }
</script>


    <div id="reviewsContent" class="content-area">
    <!-- Content for Reviews -->
    <br>
    <h2>Ratings and Reviews</h2>

    <form method="post" action="reviews.php">       
<div class="experience-question">
    <p style="color: purple;">How would you rate your overall experience with our Readcycle website, and is there anything specific you liked or think we can improve?</p>
</div>
<div class="form-group">
    <textarea id="experienceTextarea" name="experience" placeholder="Write here..."></textarea>
</div>

        <!-- Increase space between the two labels and input fields -->
        <div style="margin-top: 15px;"></div>

        <h3 style="font-size: 24px;">Rate us:</h3>
        <div id="starRating" name="starRating" style="font-size: 24px;">
    <span class="star" onclick="rate(1)" style="cursor: pointer;">&#9733;</span>
    <span class="star" onclick="rate(2)" style="cursor: pointer;">&#9733;</span>
    <span class="star" onclick="rate(3)" style="cursor: pointer;">&#9733;</span>
    <span class="star" onclick="rate(4)" style="cursor: pointer;">&#9733;</span>
    <span class="star" onclick="rate(5)" style="cursor: pointer;">&#9733;</span>
</div>
<input type="hidden" id="starRatingInput" name="starRating" value="0">

        <button onclick="saveChanges()">Submit</button>
    </form>

   <!-- <button onclick="closeContent('reviewsContent')">Close</button>-->
</div>

<style>
    
</style>


<script>
    let userRating = 0;

    function rate(stars) {
        userRating = stars;
        highlightStars(stars);

        // Set the value of the hidden input field
        document.getElementById('starRatingInput').value = userRating;
    }

    function highlightStars(stars) {
        const starElements = document.querySelectorAll("#starRating .star");

        starElements.forEach((star, index) => {
            if (index < stars) {
                star.style.color = "yellow";
            } else {
                star.style.color = "black";
            }
        });
    }
</script>

    </div>

    <div id="logoutContent" class="content-area">
    
    
    
    <!-- Logout button centered with red color -->
    <br><br>
    <button class="logout-button" onclick="window.location.href='logout.php';">Logout</button>

   <!-- <button onclick="closeContent('logoutContent')">Close</button>-->
</div>

<script>
    // Hide unnecessary close buttons
    // document.querySelectorAll('.close-button').forEach(button => button.style.display = 'none');

    // Show 'Edit Profile' content by default
    document.getElementById('reviewsContent').style.display = 'none';
    document.getElementById('logoutContent').style.display = 'none';

    function openContent(contentId) {
        // Hide all content areas
        document.getElementById('editProfileContent').style.display = 'none';
        document.getElementById('reviewsContent').style.display = 'none';
        document.getElementById('logoutContent').style.display = 'none';

        // Show the selected content area
        document.getElementById(contentId).style.display = 'block';
    }
</script>

</body>

</html>