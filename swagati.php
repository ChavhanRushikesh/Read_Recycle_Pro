<?php
$login = false;
$showerror = false;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "readcycle";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST["email"];
    $pass = $_POST["pass"];

    // Check if email and password are set
    if (!empty($email) && !empty($pass)) {
        // Use prepared statement to prevent SQL injection
        $sql = "SELECT * FROM userinfo WHERE Email = ? AND Password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the query was successful
        if ($result) {
            $num = $result->num_rows;

            if ($num == 1) {
                $login = true;
                session_start();
                $row = $result->fetch_assoc();
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $row['User_ID'];
                $_SESSION['email'] = $email;
                // You can set other session variables as needed
                header("location: homepage.php");
                exit(); // Ensure that no code is executed after the header redirect
            } else {
                $showerror = true;
            }
        } else {
            // Handle query error
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Handle case where email or password is not set
        echo "Email and Password are required";
    }
}
?>


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
                header("Location: swagati.php");
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
	<title>How to Design Login & Registration Form Transition</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
 <style>
  *, *:before, *:after{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Nunito', sans-serif;
}

body{
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: white;
  font-family: 'Nunito', sans-serif;
}

input, button{
  border:none;
  outline: none;
  background: none;
}

.cont{
  overflow: hidden;
  position: relative;
  width: 900px;
  height: 550px;
  background: #fff;
  box-shadow: 0 19px 38px rgba(0, 0, 0, 0.30), 0 15px 12px rgba(0, 0, 0, 0.22);
}

.form{
  position: relative;
  width: 640px;
  height: 100%;
  padding: 50px 30px;
  -webkit-transition:-webkit-transform 1.2s ease-in-out;
  transition: -webkit-transform 1.2s ease-in-out;
  transition: transform 1.2s ease-in-out;
  transition: transform 1.2s ease-in-out, -webkit-transform 1.2s ease-in-out;
}

h2{
  width: 100%;
  font-size: 30px;
  text-align: center;
}

label{
  display: block;
  width: 260px;
  margin: 25px auto 0;
  text-align: center;
}

label span{
  font-size: 14px;
  font-weight: 600;
  color: #505f75;
  text-transform: uppercase;
}

input{
  display: block;
  width: 100%;
  margin-top: 5px;
  font-size: 16px;
  padding-bottom: 5px;
  border-bottom: 1px solid rgba(109, 93, 93, 0.4);
  text-align: center;
  font-family: 'Nunito', sans-serif; 
}

button{
  display: block;
  margin: 0 auto;
  width: 260px;
  height: 36px;
  border-radius: 30px;
  color: #fff;
  font-size: 15px;
  cursor: pointer;
}

.submit{
  margin-top: 40px;
  margin-bottom: 30px;
  text-transform: uppercase;
  font-weight: 600;
  font-family: 'Nunito', sans-serif;
  background: -webkit-linear-gradient(left, #7579ff, #b224ef);
}

.submit:hover{
  background: -webkit-linear-gradient(left, #b224ef, #7579ff);
}

.forgot-pass{
  margin-top: 15px;
  text-align: center;
  font-size: 14px;
  font-weight: 600;
  color: #0c0101;
  cursor: pointer;
}

.forgot-pass:hover{
  color: red;
}

.social-media{
  width: 100%;
  text-align: center;
  margin-top: 20px;
}

.social-media ul{
  list-style: none;
}

.social-media ul li{
  display: inline-block;
  cursor: pointer;
  margin: 25px 15px;
}

.social-media img{
  width: 40px;
  height: 40px;
}

.sub-cont{
  overflow: hidden;
  position: absolute;
  left: 640px;
  top: 0;
  width: 900px;
  height: 100%;
  padding-left: 260px;
  background: #fff;
  -webkit-transition: -webkit-transform 1.2s ease-in-out;
  transition: -webkit-transform 1.2s ease-in-out;
  transition: transform 1.2s ease-in-out;
}

.cont.s-signup .sub-cont{
  -webkit-transform:translate3d(-640px, 0, 0);
          transform:translate3d(-640px, 0, 0);
}

.img{
  overflow: hidden;
  z-index: 2;
  position: absolute;
  left: 0;
  top: 0;
  width: 260px;
  height: 100%;
  padding-top: 360px;
}

.img:before{
  content: '';
  position: absolute;
  right: 0;
  top: 0;
  width: 900px;
  height: 100%;
  background-image: url(images/bg.jpg);
  background-size: cover;
  transition: -webkit-transform 1.2s ease-in-out;
  transition: transform 1.2s ease-in-out, -webkit-transform 1.2s ease-in-out;
}

.img:after{
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.3);
}

.cont.s-signup .img:before{
  -webkit-transform:translate3d(640px, 0, 0);
          transform:translate3d(640px, 0, 0);
}

.img-text{
  z-index: 2;
  position: absolute;
  left: 0;
  top: 50px;
  width: 100%;
  padding: 0 20px;
  text-align: center;
  color: #fff;
  -webkit-transition:-webkit-transform 1.2s ease-in-out;
  transition: -webkit-transform 1.2s ease-in-out;
  transition: transform 1.2s ease-in-out, -webkit-transform 1.2s ease-in-out;
}

.img-text h2{
  margin-bottom: 10px;
  font-weight: normal;
}

.img-text p{
  font-size: 14px;
  line-height: 1.5;
}

.cont.s-signup .img-text.m-up{
  -webkit-transform:translateX(520px);
          transform:translateX(520px);
}

.img-text.m-in{
  -webkit-transform:translateX(-520px);
          transform:translateX(-520px);
}

.cont.s-signup .img-text.m-in{
  -webkit-transform:translateX(0);
          transform:translateX(0);
}


.sign-in{
  padding-top: 65px;
  -webkit-transition-timing-function:ease-out;
          transition-timing-function:ease-out;
}

.cont.s-signup .sign-in{
  -webkit-transition-timing-function:ease-in-out;
          transition-timing-function:ease-in-out;
  -webkit-transition-duration:1.2s;
          transition-duration:1.2s; 
  -webkit-transform:translate3d(640px, 0, 0);
          transform:translate3d(640px, 0, 0);
}

.img-btn{
  overflow: hidden;
  z-index: 2;
  position: relative;
  width: 100px;
  height: 36px;
  margin: 0 auto;
  background: transparent;
  color: #fff;
  text-transform: uppercase;
  font-size: 15px;
  cursor: pointer;
}

.img-btn:after{
  content: '';
  z-index: 2;
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  border: 2px solid #fff;
  border-radius: 30px;
}

.img-btn span{
  position: absolute;
  left: 0;
  top: 0;
  display: -webkit-box;
  display: flex;
  -webkit-box-pack:center;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  -webkit-transition:-webkit-transform 1.2s;
  transition: -webkit-transform 1.2s;
  transition: transform 1.2s;
  transition: transform 1.2s, -webkit-transform 1.2s;;
}

.img-btn span.m-in{
  -webkit-transform:translateY(-72px);
          transform:translateY(-72px);
}

.cont.s-signup .img-btn span.m-in{
  -webkit-transform:translateY(0);
          transform:translateY(0);
}

.cont.s-signup .img-btn span.m-up{
  -webkit-transform:translateY(72px);
          transform:translateY(72px);
}

.sign-up{
  -webkit-transform:translate3d(-900px, 0, 0);
          transform:translate3d(-900px, 0, 0);
}

.cont.s-signup .sign-up{
  -webkit-transform:translate3d(0, 0, 0);
          transform:translate3d(0, 0, 0);
}
.columns { display: flex; flex-wrap: wrap; margin-top: 2rem; }

.column { flex: 1; margin-right: 1.5rem; margin-bottom: 1.5rem; width: 100%; }

.form-row { margin-bottom: 1.5rem; }
</style>
</head>
<body>
  <div class="cont">
    <div class="form sign-in">
      <h2>LogIn</h2>
      <label>
        <span>Email Address</span>
        <input type="email" name="email">
		<i class="fa fa-envelope"></i>
      </label>
      <label>
        <span>Password</span>
        <input type="password" name="pass">
		<div class="eye-area">
                     <div  class="eye-box" onclick="myLogPassword()">
<i class="fa fa-eye" id="eye"></i>
<i class="fa fa-eye-slash" id="eye-slash"></i>
                   </div>
                 </div>
      </label>
  <button type="submit" name="apply" class="btn">Login</button>
      <p class="forgot-pass">Forgot Password ?</p>

      
    </div>

    <div class="sub-cont">
      <div class="img">
        <div class="img-text m-up">
          <h2>New here?</h2>
          <p>Sign up and discover great amount of new opportunities!</p>
        </div>
        <div class="img-text m-in">
          <h2>One of us?</h2>
          <p>If you already has an account, just sign in. We've missed you!</p>
        </div>
        <div class="img-btn">
          <span class="m-up">Sign Up</span>
          <span class="m-in">Sign In</span>
        </div>
      </div>
      <div class="sub-cont"> 
	 <div class="img"> <!-- ... --> </div> 
	  <form action="registration.php" method="POST"> 
	  <h2>Sign Up</h2>
	  <div class="columns"> 
	  <div class="column"> 
	  <div class="form-row"> 
	  <label for="uname">Full Name:</label> 
	  <input type="text" id="uname" name="uname" placeholder="Enter Full Name" required> 
	  </div> 
	  <div class="form-row">
	  <label for="mobile_number">Mobile Number:</label> 
	  <input type="text" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number" required> 
	  </div> 
	  <div class="form-row">
	  <label for="email">Email:</label>
	  <input type="text" id="email" name="email" placeholder="Enter Email" required> 
	  </div> 
	  <div class="form-row">
	  <label for="area">Colony, House No:</label> 
	  <input type="text" id="area" name="area" placeholder="Enter Colony, House No." required> </div>
	  </div> 
	  <div class="column">
	  <div class="form-row">
	  <label for="city">City with Pin:</label> 
	  <input type="text" id="city" name="city" placeholder="Enter City with Pin" required> 
	  </div> 
	  <div class="form-row"> 
	  <label for="country">Country:</label> 
	  <input type="text" id="country" name="country" placeholder="Enter Country" required> 
	  </div> 
	  <div class="form-row">
	  <label for="state">State:</label>
	  <input type="text" id="state" name="state" placeholder="Enter State" required> 
	  </div> 
	  <div class="form-row password-field"> 
	  <label for="password">Password:</label> 
	  <input type="password" id="password" name="password" placeholder="Enter Password" required>
	  <div class="eye-area">
	  <div class="eye-box" onclick="myLogPassword()"> 
	  <i class="fa fa-eye" id="eye"></i>
<i class="fa fa-eye-slash" id="eye-slash"></i>
	  </div>
	  </div> 
	  </div> 
	  </div> 
	  </div> 
	  <input type="submit" class="btn" name="apply" value="Register"> 
	  </form> 
	  </div>
<script>
document.querySelector('.img-btn').addEventListener('click', function()
	{
		document.querySelector('.cont').classList.toggle('s-signup')
	}
);

function myLogPassword(){
         var a = document.getElementById("pass");
         var b = document.getElementById("eye");
         var c = document.getElementById("eye-slash");
         if(a.type === "password"){
            a.type = "text";
            b.style.opacity = "0";
            c.style.opacity = "1";
         }else{
            a.type = "password";
            b.style.opacity = "1";
            c.style.opacity = "0";
         }
        }
</script>
</body>
</html>