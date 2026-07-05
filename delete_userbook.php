<?php
    // Start the session
    session_start();

    // Assuming you have a database connection established
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Validate session
    if (!isset($_SESSION['email'])) {
        // Redirect to login page if the user is not logged in
        header("location: login.php");
        exit;
    }

    // Retrieve User_ID from the session
    $user_id = $_SESSION['email'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "readcycle";

    // Create a new connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement with prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM add_books WHERE email = ?");

    // Check if the preparation was successful
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("s", $user_id);

    // Execute the statement
    $result = $stmt->execute();

    // Check if the execution was successful
    if (!$result) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }

    // Get the result set
    $resultSet = $stmt->get_result();

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom styles for the table */
        table {
            width: 90%; /* Reduce the width of the table */
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
            border-spacing: 0;
        }

        th, td {
            padding: 10px; /* Increase the padding */
            border: 1px solid black; /* Add black border to all cells */
            font-size: 16px; /* Increase font size */
        }

        th {
            background-color: #6c757d; /* Change table header color to gray */
            color: white;
            font-weight: bold;
            text-align: center;
            vertical-align: middle; /* Vertically center the text */
            line-height: 1.5; /* Adjust line height for vertical centering */
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #ddd;
        }

        img.book-image {
            max-width: 100px;
            max-height: 100px;
            display: block;
            margin: 0 auto;
        }


        /* Table animation */
        .table {
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
            border: 2px solid black; /* Add black border to the table */
        }

        .table.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Style for the h4 tag */
        h4 {
            text-align: center;
            margin-top: 30px; /* Adjust as needed */
            color: #333; /* Text color */
            font-size: 26px; /* Font size */
            font-weight: bold; /* Font weight */
        }

        /* Increase width of container */
        .container {
            margin: 0 auto; /* Center the container horizontally */
            padding: 0 15px; /* Add some padding to the sides */
        }
    </style>
</head>
<body>
<?php include 'userpanel_header.php'; ?>
<div class="container">
                <h4>Delete Books</h4>
            </div>
        </div>
        <div class="card-body">
            <table>
                <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Book Category</th>
                    <th>Book Condition</th>
                    <th>Book Name</th>
                    <th>Book Price</th>
                    <th>Book Author</th>
                    <th>Subcategory</th>
					<th>Quantity</th>
                    <th>Book Image</th>
                    <th>Name of Seller</th>
                    <th>Email of Seller</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if($resultSet->num_rows > 0)
                {
                    while($row = $resultSet->fetch_assoc())
                    {
                        ?>
                        <tr>
                            <td><?= $row['book_id']; ?></td>
                            <td><?= $row['category']; ?></td>
                            <td><?= $row['book_condition']; ?></td>
                            <td><?= $row['book_name']; ?></td>
                            <td><?= $row['price']; ?></td>
                            <td><?= $row['author']; ?></td>
                            <td><?= $row['subcategory']; ?></td>
							 <td><?= $row['quantity']; ?></td>
                            <td><img src="<?= $row['book_image']; ?>" alt="Book Image" class="book-image"></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td>
                                <form action="delete_book.php" method="post" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                    <input type="hidden" name="book_id" value="<?= $row['book_id']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="4">You Have Not Added Any Books Yet...</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
