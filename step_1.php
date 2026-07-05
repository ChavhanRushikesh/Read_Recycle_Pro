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
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Step 1</title>
    <!---Custom CSS File--->
    <link rel="stylesheet" href="style.css" />
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
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  background: rgb(130, 106, 251);
}
.container {
  position: relative;
  max-width: 500px;
  width: 100%;
  background: #fff;
  padding: 25px;
  border-radius: 8px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  height: 680px;
  margin-top: 0px;
}
.container header {
  font-size: 1.5rem;
  color: #333;
  font-weight: 500;
  text-align: center;
}
.container .form {
  margin-top: 30px;
}
.form .input-box {
  width: 100%;
  margin-top: 20px;
}
.input-box label {
  color: #333;
}
.form :where(.input-box input, .select-box) {
  position: relative;
  height: 50px;
  width: 100%;
  outline: none;
  font-size: 1rem;
  color: #707070;
  margin-top: 8px;
  border: 1px solid #ddd;
  border-radius: 6px;
  padding: 0 15px;
}
.input-box input:focus {
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
}
.form .column {
  display: flex;
  column-gap: 15px;
}
.form .gender-box {
  margin-top: 20px;
}
.gender-box h3 {
  color: #333;
  font-size: 1rem;
  font-weight: 400;
  margin-bottom: 8px;
}
.form :where(.gender-option, .gender) {
  display: flex;
  align-items: center;
  column-gap: 50px;
  flex-wrap: wrap;
}
.form .gender {
  column-gap: 5px;
}
.gender input {
  accent-color: rgb(130, 106, 251);
}
.form :where(.gender input, .gender label) {
  cursor: pointer;
}
.gender label {
  color: #707070;
}
.address :where(input, .select-box) {
  margin-top: 15px;
}
.select-box select {
  height: 100%;
  width: 100%;
  outline: none;
  border: none;
  color: #707070;
  font-size: 1rem;
}
.form button {
  height: 55px;
  width: 100%;
  color: #fff;
  font-size: 1rem;
  font-weight: 400;
  margin-top: 30px;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
  background: rgb(130, 106, 251);
}
.form button:hover {
  background: rgb(88, 56, 250);
}
/*Responsive*/
@media screen and (max-width: 500px) {
  .form .column {
    flex-wrap: wrap;
  }
  .form :where(.gender-option, .gender) {
    row-gap: 15px;
  }
}
input[type="text"],
input[type="tel"],
select {
  /* Common styles for text, tel input types and select */
  width: 100%;
  height: 40px;
  padding: 0 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-top: 5px;
  box-sizing: border-box;
  font-size: 16px;
}

/* Apply specific styles for labels */
label {
  margin-top: 10px;
  font-weight: bold;
}

/* Apply styles for the button */
button[type="submit"] {
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  height: 40px;
  width: 55%;
  margin-top: 20px;
  margin-left: 100px;
}

button[type="submit"]:hover {
  background-color: #45a049;
}
input[type="text"],
input[type="tel"],
label {
  margin-bottom: 15px; /* Adjusted margin for space between fields */
}
</style>
  </head>
  <body>
  <script>
	function goBack() {
  window.history.back()
}
</script>
<header class="header">
<div class="images">
<a>
<i class="fas fa-arrow-left" onclick="goBack()"></i>
</a>
</div>
    <section class="container">
      <header>Delivery Address</header>
      <form method="post" action="buy_nowStep2.php">

          
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

            <button type="submit" name="save_changes">Next</button>
        </form>
    </section>
  </body>
</html>