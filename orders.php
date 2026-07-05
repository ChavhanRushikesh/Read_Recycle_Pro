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

$user_id = $_SESSION['user_id'];

$sql_orders = "SELECT o.*, ab.book_name, ab.book_image, ab.category
               FROM orders o
               INNER JOIN add_books ab ON o.book_id = ab.book_id
               WHERE o.user_id = ?
               ORDER BY o.order_date DESC";
$stmt_orders = $conn->prepare($sql_orders);

if ($stmt_orders === false) {
    echo "Error preparing statement: " . $conn->error;
    die();
}

$stmt_orders->bind_param("i", $user_id);

if ($stmt_orders->execute() === false) {
    echo "Error executing statement: " . $stmt_orders->error;
    die();
}

$result_orders = $stmt_orders->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>My Orders</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

      


        .container {
            padding: 20px;
        }

        .order-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}



        .order-details {

            background-color: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            width: 100%;  /* Changed width to 100% */
            box-sizing: border-box;  /* Added box-sizing for better width handling */
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;  /* Aligning items horizontally */
            transition: box-shadow 0.3s ease-in-out;  /* Added box-shadow transition */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .order-details:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);  /* Updated box shadow on hover */
}

.order-details img {
    max-width: 200px;  /* Adjusted max-width for the image */
    height: auto;
    margin-right: 1px;
    margin-left: 20px;  /* Added margin for spacing between image and text */
}


        .order-details p {
            margin-top: 60px;
            line-height: 1.5;
            padding : right 10px;
            margin-right: 30px;

        }

        .order-details strong {
            font-weight: bold;
            margin-right: 3px;
        }

        .cancel-button {
            background-color: #d9534f;
            color: #fff;
            border: none;
            padding: 3px 8px !important; /* Adjusted padding */
            border-radius: 3px;
            cursor: pointer;
            margin-top: 60px;  /* Added margin for spacing */
            margin-bottom: 60px;
            margin-right: 30px;

        }

        .cancel-button:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
<script>
	function goBack() {
  window.history.back()
}
</script>
<?php include 'user_header.php'; ?>
<br>
    <div class="container">
        <!-- Display order details -->
        <div class="order-container">
        <?php while ($row = $result_orders->fetch_assoc()) : ?>
    <div class="order-details <?= $row['del_status'] === 'Cancel' ? 'cancelled-order' : '' ?>">
        <img src="<?= $row['book_image'] ?>" alt="<?= $row['book_name'] ?>" style="max-width: 100px;">
        <p><strong>Book Name:<br></strong> <?= $row['book_name'] ?></p>
        <p><strong>Category:<br></strong> <?= $row['category'] ?></p>
        <p><strong>Total Bill: <br></strong> <?= $row['total_bill'] ?> Rs/-</p>
        <p><strong>Quantity: <br></strong> <?= $row['quantity'] ?></p>
        <p><strong>Order Date: <br></strong> <?= $row['order_date'] ?></p>
        <p><strong>Delivery Date: <br></strong> <?= $row['delivery_date'] ?></p>
        <p><strong>Status:<br></strong>
            <span style="color: <?= $row['del_status'] === 'Cancel' ? 'red' : 'inherit' ?>">
                <?= $row['del_status'] ?>
            </span>
        </p>
        <?php if ($row['del_status'] !== 'Cancel') : ?>
            <button class="cancel-button" onclick="cancelOrder(<?= $row['order_id'] ?>)">Cancel Order</button>
        <?php endif; ?>
    </div>
<?php endwhile; ?>

        </div>
    </div>

    <script>
        function cancelOrder(orderId) {
            var confirmCancel = confirm("Are you sure to cancel order?");
            if (confirmCancel) {
                // Redirect to cancel_order.php with orderId parameter
                window.location.href = "cancel_order.php?order_id=" + orderId;
            }
        }
    </script>
</body>
</html>

<?php
$stmt_orders->close();
// Close database connection
$conn->close();
?>