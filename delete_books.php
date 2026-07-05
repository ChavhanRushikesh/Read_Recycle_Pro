<?php
session_start(); // Start the session
$con = mysqli_connect("localhost", "root", "", "readcycle");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
// Delete related records in cart_books table
if (isset($_POST['book_id'])) {
    $book_id = $_POST['book_id'];

    // Delete records from cart_books table
    $delete_cart_query = "DELETE FROM cart_books WHERE book_id = '$book_id'";
    $delete_cart_run = mysqli_query($con, $delete_cart_query);

    // Delete related records in wishlist table
    $delete_wishlist_query = "DELETE FROM wishlist WHERE book_id = '$book_id'";
    $delete_wishlist_run = mysqli_query($con, $delete_wishlist_query);

    // Proceed with deletion from add_books table if no error occurred
    if ($delete_cart_run && $delete_wishlist_run) {
        $delete_add_query = "DELETE FROM add_books WHERE book_id = '$book_id'";
        $delete_add_run = mysqli_query($con, $delete_add_query);

        if ($delete_add_run) {
            $_SESSION['message'] = "Book deleted successfully"; // Set session message
            // Update book_id values
            $update_query = "SET @count = 0";
            mysqli_query($con, $update_query);
            $update_query = "UPDATE add_books SET book_id = @count:= @count + 1";
            mysqli_query($con, $update_query);
        } else {
            $_SESSION['message'] = "Error deleting book"; // Set session message
        }
    } else {
        $_SESSION['message'] = "Error deleting related records"; // Set session message
    }
}

// Unset session message to prevent it from being displayed after page reload
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-...your-sha512-hash-here..." crossorigin="anonymous" />

    <style>
        /* Custom styles for the table */
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
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

        /* Table styles */
        .table th,
        .table td {
            padding: 10px; /* Increase the padding */
            border: 1px solid black; /* Add black border to all cells */
            font-size: 16px; /* Increase font size */
        }

        .table th {
            background-color: #6c757d; /* Change table header color to gray */
            color: white;
            font-weight: bold;
            text-align: center;
            vertical-align: middle; /* Vertically center the text */
            line-height: 1.5; /* Adjust line height for vertical centering */
        }

        .table td {
        padding: 10px; /* Adjust padding as needed */
        text-align: center; /* Horizontally center text */
        vertical-align: middle; /* Vertically center text */
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
            max-width: 1350px; /* Adjust as needed */
            margin: 0 auto; /* Center the container horizontally */
            padding: 0 15px; /* Add some padding to the sides */
        }
    </style>
</head>
<body>
<?php include 'admin_header1.php'; ?>
    <div class="container">
          <h4>View Books</h4>
                   <div class="card-body">
                    <table class="table table-bordered">
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
                            <th>Action</th> <!-- New column for delete button -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM add_books";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
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
                                    <td><img src="<?= $row['book_image']; ?>" alt="Book Image"
                                             style="max-width: 100px; max-height: 100px;"></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                      <td>
                                                    <form action="admin_deletebooks.php" method="post" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                                        <input type="hidden" name="book_id" value="<?= $row['book_id']; ?>">
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td> <!-- Delete button -->
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="11">No Record Found</td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
       // Show table with animation when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.table').classList.add('show');
        });
    </script>
    <!-- Display success or error message using JavaScript -->
    <?php if (isset($message)): ?>
        <script>alert("<?php echo $message; ?>");</script>
    <?php endif; ?>
</body>
</html>
