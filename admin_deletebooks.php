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

    // Delete related records in orders table
    $delete_orders_query = "DELETE FROM orders WHERE book_id = '$book_id'";
    $delete_orders_run = mysqli_query($con, $delete_orders_query);

    // Delete related records in wishlist table
    $delete_wishlist_query = "DELETE FROM wishlist WHERE book_id = '$book_id'";
    $delete_wishlist_run = mysqli_query($con, $delete_wishlist_query);

    if ($delete_orders_run && $delete_wishlist_run) {
        // Proceed with deletion from add_books table
        $delete_add_query = "DELETE FROM add_books WHERE book_id = '$book_id'";
        $delete_add_run = mysqli_query($con, $delete_add_query);

        if ($delete_add_run) {
            $_SESSION['message'] = "Book deleted successfully";
            // Update book_id values if needed
        } else {
            $_SESSION['message'] = "Error deleting book";
        }
    } else {
        $_SESSION['message'] = "Error deleting related records";
    }
}

// Unset session message to prevent it from being displayed after page reload
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
	header("Location: delete_books.php"); // Redirect back to the account page
}
?>
