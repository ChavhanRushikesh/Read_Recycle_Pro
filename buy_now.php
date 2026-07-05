<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buy Now</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <style>
        /* Import Google font - Poppins */
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f6f7fb;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
            max-width: 500px; /* Increased width */
            width: 90%; /* Adjusted width */
            background: #fff; /* Added background color */
            padding: 20px; /* Added padding */
            border-radius: 10px; /* Added border radius */
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1); /* Added box shadow */
        }
        .container .steps {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        .steps .circle {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            width: 50px;
            color: #999;
            font-size: 22px;
            font-weight: 500;
            border-radius: 50%;
            background: #fff;
            border: 4px solid #e0e0e0;
            transition: all 200ms ease;
            transition-delay: 0s;
        }
        .steps .circle.active {
            transition-delay: 100ms;
            border-color: #4070f4;
            color: #4070f4;
        }
        .steps .progress-bar {
            position: absolute;
            top: 20px; /* Adjust as needed */
            left: 0;
            right: 0;
            height: 4px;
            width: 100%;
            background: #e0e0e0;
            z-index: -1;
        }
        .progress-bar .indicator {
            position: absolute;
            height: 100%;
            width: 0%;
            background: #4070f4;
            transition: all 300ms ease;
        }
        .container .buttons {
            display: flex;
            gap: 20px;
        }
        .buttons button {
            padding: 8px 25px;
            background: #4070f4;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            font-weight: 400;
            cursor: pointer;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
            transition: all 200ms linear;
        }
        .buttons button:active {
            transform: scale(0.97);
        }
        .buttons button:disabled {
            background: #87a5f8;
            cursor: not-allowed;
        }
        .content-area {
            display: none;
            width: 100%;
            max-width: 400px;
            margin-top: 20px;
        }
        .center {
            text-align: center;
        }
        .content-area.active {
            display: block;
        }
        header {
            color: #333;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 0px; /* reduce the bottom margin */
        }
        .input_field {
            position: relative;
            height: 45px;
            margin-top: 15px;
            width: 100%;
        }
        .refresh_button {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            background: #826afb;
            height: 30px;
            width: 30px;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
        }
        .refresh_button:active {
            transform: translateY(-50%) scale(0.98);
        }
        .input_field input,
        .button button {
            height: 100%;
            width: 100%;
            outline: none;
            border: none;
            border-radius: 8px;
        }
        .input_field input {
            padding: 0 15px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
        .captch_box input {
            color: #6b6b6b;
            font-size: 22px;
            pointer-events: none;
        }
        .captch_input input:focus {
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.08);
        }
        .message {
            font-size: 14px;
            margin: 14px 0;
            color: #826afb;
            display: none;
            text-align: left; /* Align text to the left */
        }
        .message.active {
            display: block;
        }
        .button button {
            background: #826afb;
            color: #fff;
            cursor: pointer;
            user-select: none;
        }
        .button button:active {
            transform: scale(0.99);
        }
        .button.disabled {
            opacity: 0.6;
            pointer-events: none;
        }
        .input_field.captch_input {
            margin-top: 10px; /* reduce the top margin */
        }
        .input_field.button {
            margin-top: 10px; /* reduce the top margin */
        }
        /* Additional styles for layout */
        .book-details-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .book-image {
            max-width: 200px;
            flex: 0 0 auto; /* Don't grow or shrink */
        }
        .book-info {
            flex: 1; /* Take remaining space */
        }

        /* Popup box styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 80%; /* Adjust width as needed */
            max-width: 380px;
            padding: 30px 20px;
            border-radius: 24px;
            background-color: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .modal-content i {
            font-size: 70px;
            color: #4070f4;
        }

        .modal-content h2 {
            margin-top: 20px;
            font-size: 25px;
            font-weight: 500;
            color: #333;
        }

        .modal-content h3 {
            font-size: 16px;
            font-weight: 400;
            color: #333;
            text-align: center;
        }

        .modal-content .buttons {
            margin-top: 25px;
        }

        .modal-content button {
            font-size: 14px;
            padding: 6px 12px;
            margin: 0 10px;
        }

        .container .payment-method .content-area {
            max-height: 150px; /* Decrease the maximum height */
            overflow-y: auto; /* Add vertical scrollbar if content exceeds the height */
        }
    </style>
</head>
<body>
<div class="container">
    <div class="steps">
        <div class="progress-bar">
            <span class="indicator"></span>
        </div>
        <span class="circle active">1</span>
        <span class="circle">2</span>
        <span class="circle">3</span>
    </div>
    <div class="content-area active">
        <!-- Content area for the first step -->
        <h2>Edit Profile</h2>
        <form method="post" action="update_profile.php">
            <div style="display: flex; gap: 20px;">
                <!-- Left side -->
                <div style="flex: 1;">
                    <label for="fullName">Full Name:</label>
                    <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" value="<?php echo isset($user_data['Full_Name']) ? $user_data['Full_Name'] : ''; ?>">

                    <label for="mobileNumber">Mobile Number:</label>
                    <input type="tel" id="mobileNumber" name="mobileNumber" placeholder="Enter your mobile number" value="<?php echo isset($user_data['Mobile_Number']) ? $user_data['Mobile_Number'] : ''; ?>">

                    <label for="colonyHouseNo">Colony-House No:</label>
                    <input type="text" id="colonyHouseNo" name="colonyHouseNo" placeholder="Enter your colony-house number" value="<?php echo isset($user_data['Colony_HouseNo']) ? $user_data['Colony_HouseNo'] : ''; ?>">
                </div>

                <!-- Right side -->
                <div style="flex: 1;">
                    <label for="cityWithPin">City with Pin:</label>
                    <input type="text" id="cityWithPin" name="cityWithPin" placeholder="Enter your city with pin code" value="<?php echo isset($user_data['City_Pin']) ? $user_data['City_Pin'] : ''; ?>">

                    <label for="country">Country:</label>
                    <input type="text" id="country" name="country" placeholder="Enter your country" value="<?php echo isset($user_data['Country']) ? $user_data['Country'] : ''; ?>">

                    <label for="state">State:</label>
                    <input type="text" id="state" name="state" placeholder="Enter your state" value="<?php echo isset($user_data['State']) ? $user_data['State'] : ''; ?>">
                </div>
            </div>

            <button type="submit" name="save_changes">Save Changes</button>
        </form>
    </div>
   <div class="content-area">
        <!-- Content area for the second step -->
        <h2>Order Details</h2>
        <!-- Display book details -->
        <?php echo $book_details; ?>
    </div>
    <form method="post" action="confirm_order.php">
    <div class="content-area">
        <!-- Content area for the third step -->
        <h2 class="center">Payment Method</h2><br><br>
        <h3>Payment Method</h3>
        <p>- Cash On Delivery</p><br>
        <div class="container">
            <header> Enter Captcha</header>
            <div class="input_field captch_box">
                <input type="text" value="" disabled />
                <button class="refresh_button">
                    <i class="fa-solid fa-rotate-right"></i>
                </button>
            </div>
            <div class="input_field captch_input">
                <input type="text" placeholder="Enter captcha" />
            </div>
            <div class="message">Entered captcha is correct</div>
            <div class="input_field button disabled">
                <button class="submit">Submit Captcha</button>
            </div>
        </div>
    </div>
    </form>
    <div class="buttons">
        <button id="prev" disabled>Prev</button>
        <button id="next">Next</button>
    </div>
</div>

<!-- Popup modal box -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <button class="close">&times;</button>
    <p>Your order has been placed!</p>
  </div>
</div>

<script>
    // DOM Elements
    const circles = document.querySelectorAll(".circle");
    const progressBar = document.querySelector(".indicator");
    const contentAreas = document.querySelectorAll(".content-area");
    const buttons = document.querySelectorAll("button");

    let currentStep = 1;

    // Function to update the current step and update the DOM
    const updateSteps = (e) => {
        // Update the current step based on the button clicked
        currentStep = e.target.id === "next" ? ++currentStep : --currentStep;

        // Loop through all circles and add/remove the "active" class based on their index and the current step
        circles.forEach((circle, index) => {
            circle.classList[index < currentStep ? "add" : "remove"]("active");
        });

        // Update the progress bar width based on the current step
        progressBar.style.width = ((currentStep - 1) / (circles.length - 1)) * 100 + "%";

        // Show/hide content areas based on the current step
        contentAreas.forEach((area, index) => {
            area.classList[index === currentStep - 1 ? "add" : "remove"]("active");
        });

        // Check if the current step is the last step or the first step and disable corresponding buttons
        if (currentStep === circles.length) {
            buttons[1].disabled = true;
            // Show the modal box to confirm the order
            document.getElementById("myModal").style.display = "block";
        } else {
            buttons[1].disabled = false;
            document.getElementById("myModal").style.display = "none";
        }

        if (currentStep === 1) {
            buttons[0].disabled = true;
        } else {
            buttons[0].disabled = false;
        }
    };

    // Event listeners for next and prev buttons
    buttons.forEach((button) => {
        button.addEventListener("click", updateSteps);
    });

    // Close the modal box when the close button is clicked
    document.querySelector(".close").addEventListener("click", function() {
        document.getElementById("myModal").style.display = "none";
    });
</script>
</body>
</html>
