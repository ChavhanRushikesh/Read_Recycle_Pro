<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readcycle";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errorMsg = "";  // Variable to store error messages

// Variables to store form field values
$fullNameValue = "";
$mobileNumberValue = "";
$emailValue = "";
$colonyHouseNoValue = "";
$cityPinValue = "";
$countryValue = "";
$stateValue = "";

if (isset($_POST['apply'])) {
    $fullName = $_POST['uname'];
    $mobileNumber = $_POST['mobile_number'];
    $email = $_POST['email'];
    $Colony_HouseNo = $_POST['area'];
    $City_Pin = $_POST['city'];
    $Country = $_POST['country'];
    $State = $_POST['state'];
    $Password = $_POST['password'];

    // Set form field values to be used in case of an error
    $fullNameValue = $fullName;
    $mobileNumberValue = $mobileNumber;
    $emailValue = $email;
    $colonyHouseNoValue = $Colony_HouseNo;
    $cityPinValue = $City_Pin;
    $countryValue = $Country;
    $stateValue = $State;

    // Validate mobile number (must be 10 digits)
    if (!preg_match("/^\d{10}$/", $mobileNumber)) {
        $errorMsg = "Mobile number must be 10 digits long.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validate email format
        $errorMsg = "Invalid email format.";
    } else {
        // Check if the email already exists
        $checkQuery = $conn->prepare("SELECT Email FROM userinfo WHERE Email = ?");
        $checkQuery->bind_param("s", $email);
        $checkQuery->execute();
        $checkQuery->store_result();

        if ($checkQuery->num_rows > 0) {
            // Email already exists, set error message
            $errorMsg = "User already exists. Please choose a different email.";
        } else {
            // Email doesn't exist, proceed with registration
            $stmt = $conn->prepare("INSERT INTO userinfo (Full_Name, Mobile_Number, Email, Colony_HouseNo, City_Pin, Country, State, Password) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("ssssssss", $fullName, $mobileNumber, $email, $Colony_HouseNo, $City_Pin, $Country, $State, $Password);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                // Registration successful, redirect to login.php
                header("Location: login.php");
                exit();  // Ensure the script stops execution after redirect
            } else {
                $errorMsg = "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        $checkQuery->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url("https://cdn.pixabay.com/photo/2018/04/16/10/44/literature-3324242_1280.jpg");
            background-size: cover;
            background-position: center;
        }

        .wrapper {
            width: 800px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(9px);
            color: #fff;
            border-radius: 12px;
            padding: 30px 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .columns {
            display: flex;
            justify-content: space-between;
            width: 270%;
            margin-left: -200px;
        }

        .column {
            width: 45%;
            display: flex;
            flex-direction: column;
        }

        .wrapper h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-row label {
            margin-bottom: 10px;
        }

        .form-row input[type="text"],
        .form-row input[type="password"] {
            padding: 10px;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 8px;
            font-size: 16px;
            color: #fff;
        }

        .form-row input::placeholder {
            color: #fff;
            font-size: 14px;
        }

        .form-row.password-field {
            position: relative;
            margin-bottom: 40px;
        }

        .toggle-password {
            position: absolute;
            right: 20px;
            top: 30%;
            transform: translate(-50%);
            font-size: 20px;
            color: #fff;
            cursor: pointer;
        }

        .form-row {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .btn {
            width: 200px;
            height: 45px;
            background: #fff;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .1);
            cursor: pointer;
            font-size: 16px;
            color: #333;
            font-weight: 600;
            margin-top: 0px;
            align-self: center;
        }
		
		   .eye-area {
            position: relative;
            display: inline-block;
        }

        .eye-box {
            position: absolute;
            right: 20px;
            top: -20px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .fa-eye-slash {
            display: none;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h1>User Registration</h1>
        <?php
        if (!empty($errorMsg)) {
            echo '<div style="color: red; margin-bottom: 10px;">' . $errorMsg . '</div>';
        }
        ?>
        <form action="registration.php" method="POST">
            <div class="columns">
                <div class="column">
                    <div class="form-row">
                        <label for="uname">Full Name:</label>
                        <input type="text" id="uname" name="uname" placeholder="Enter Full Name" value="<?php echo $fullNameValue; ?>" required>
                    </div>
                    <div class="form-row">
                        <label for="mobile_number">Mobile_number:</label>
                        <input type="text" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number" value="<?php echo $mobileNumberValue; ?>" required>
                    </div>
                    <div class="form-row">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" placeholder="Enter Email" value="<?php echo $emailValue; ?>" required>
                    </div>
                    <div class="form-row password-field">
                        <label for="area">Colony, House No:</label>
                        <input type="text" id="area" name="area" placeholder="Enter Colony, House No." value="<?php echo $colonyHouseNoValue; ?>" required>
                    </div>
                </div>
                <div class="column">
                    <div class="form-row">
                        <label for="city">City with Pin:</label>
                        <input type="text" id="city" name="city" placeholder="Enter City with Pin" value="<?php echo $cityPinValue; ?>" required>
                    </div>
                    <div class="form-row">
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" placeholder="Enter Country" value="<?php echo $countryValue; ?>" required>
                    </div>
                    <div class="form-row">
                        <label for="state">State:</label>
                        <input type="text" id="state" name="state" placeholder="Enter State" value="<?php echo $stateValue; ?>" required>
                    </div>
                    <div class="form-row password-field">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter Password" required>
                      <div class="eye-area">
    <div class="eye-box" onclick="myLogPassword()">
        <i class="far fa-eye" id="eye"></i>
        <i class="far fa-eye-slash" id="eye-slash"></i>
    </div>
</div>

                    </div>
                </div>
            </div>
            <input type="submit" class="btn" name="apply" value="Register">
        </form>
    </div>
    <script>
		
		function myLogPassword() {
    var passwordInput = document.getElementById("password");
    var eye = document.getElementById("eye");
    var eyeSlash = document.getElementById("eye-slash");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eye.style.display = "none";
        eyeSlash.style.display = "block"; // Display the eye-slash icon
    } else {
        passwordInput.type = "password";
        eye.style.display = "block"; // Display the eye icon
        eyeSlash.style.display = "none";
    }
}

    </script>
</body>

</html>
