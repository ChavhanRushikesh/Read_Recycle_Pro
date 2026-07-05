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
                
                // Check if there's a redirect parameter in the session
                if(isset($_SESSION['redirect'])) {
                    $redirect = $_SESSION['redirect'] . '.php'; // Append .php if needed
                    unset($_SESSION['redirect']); // Remove the redirect session variable
                    header("location: $redirect");
                } else {
                    header("location: homepage.php");
                }
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


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
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
  width: 420px;
  background: transparent;
  border: 2px solid rgba(255, 255, 255, .2);
  backdrop-filter: blur(9px);
  color: #fff;
  border-radius: 12px;
  padding: 30px 30px;
}

.wrapper h1 {
  font-size: 36px;
  text-align: center;
  margin-bottom: 20px; /* Add space below h1 */
}

.wrapper .input-box {
  position: relative;
  width: 100%;
  height: 50px;
  margin: 30px 0;
}

.input-box.password-input {
  margin-bottom: 40px; 
}

.input-box input {
  width: 100%;
  height: 100%;
  background: transparent;
  border: none;
  outline: none;
  border: 2px solid rgba(255, 255, 255, .2);
  border-radius: 40px;
  font-size: 16px;
  color: #fff;
  padding: 20px 45px 20px 20px;
}

.input-box input::placeholder {
  color: #fff;
}

.input-box i {
  position: absolute;
  right: 20px;
  top: 30%;
  transform: translate(-50%);
  font-size: 20px;
}

.wrapper .remember-forgot {
  display: flex;
  justify-content: space-between;
  font-size: 14.5px;
  margin: -15px 0 15px;
}

.remember-forgot label input {
  accent-color: #fff;
  margin-right: 3px;
}

.remember-forgot a {
  color: #fff;
  text-decoration: none;
}

.remember-forgot a:hover {
  text-decoration: underline;
}

.wrapper .btn {
  width: 100%;
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
  margin-top: 20px; /* Add space above button */
}

.wrapper .register-link {
  font-size: 14.5px;
  text-align: center;
  margin: 20px 0 15px;
}

.register-link p a {
  color: #FF0000; /* Change this color to the desired one */
  text-decoration: none;
  font-weight: 600;
}

.register-link p a:hover {
  text-decoration: underline;
  color: #FF0000; /* Change this color to the desired one */
}

    </style>
</head>
<body>
  <div class="wrapper">
    <form action="login.php" method="POST">
      <h1>User Login</h1>
      <div class="input-box">
    <input type="text" id="email" name="email" placeholder="Enter Email" required>
    <i class="fas fa-envelope"></i>
</div>
    <div class="input-box password-input">
    <input type="password" id="pass" name="pass" placeholder="Password" required>
    <div class="eye-area">
                     <div  class="eye-box" onclick="myLogPassword()">
                      <i class="fa-regular fa-eye" id="eye"></i>
                      <i class="fa-regular fa-eye-slash" id="eye-slash"></i>
                   </div>
                 </div>
</div>

      <div class="remember-forgot">
        <label><input type="checkbox">Remember Me</label>
        <a href="#">Forgot Password</a>
      </div>
      <button type="submit" name="apply" class="btn">Login</button>
      <div class="register-link">
        <p class="signup-link">Don't have an account? <br> <a href="registration.php">Click here to sign up</a></p>

      </div>
    </form>
  </div>
  <script>
   function validation() {
    var id = document.f1.email.value;
    var ps = document.f1.pass.value;
    if (id === "" || ps === "") {
        alert("Email and Password fields are required");
        return false;
    }
}

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
