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
	header("Location: delete_userbook.php"); // Redirect back to the account page
}
?>
