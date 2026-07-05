<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-...your-sha512-hash-here..." crossorigin="anonymous" />
    <style>
      

        /* Table animation */
        .table {
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .table.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Table styles */
        .table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid black; /* Add black border to the table */
        }

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
        .table td.password {
            font-family: monospace;
        }

        /* Style for the h4 tag */
        h4 {
            text-align: center;
            margin-top: 30px; /* Adjust as needed */
            color: #333; /* Text color */
            font-size: 26px; /* Font size */
            font-weight: bold; /* Font weight */
        }
    </style>
</head>
<body>
<?php include 'admin_header1.php'; ?>
    <div class="container">
        <h4>View Orders</h4>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="height: 60px;">Order ID</th> <!-- Increase height as needed -->
                                    <th>User ID</th>
                                    <th>Book ID</th>
                                    <th>Delivery Date</th>
                                    <th>Order Date</th>
                                    <th>Delivery Status</th>
                                    <th>Payment Status</th>
                                    <th>Total Bill</th>
                                    <th>Quantity</th>
                                    <th>Payment Method</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Database connection
                                $con = mysqli_connect("localhost", "root", "", "readcycle");

                                $query = "SELECT * FROM orders 
                                WHERE book_id IN (SELECT book_id FROM add_books WHERE email = 'readcycle@gmail.com')";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                ?>
                                        <tr>
                                            <!-- Table data -->
                                            <form id="updateForm<?= $row['order_id']; ?>" action="update_order.php" method="post">
                                                <input type="hidden" name="order_id" value="<?= $row['order_id']; ?>">
                                                <td><?= $row['order_id']; ?></td>
                                                <td><?= $row['User_ID']; ?></td>
                                                <td><?= $row['book_id']; ?></td>
                                                <td><?= $row['delivery_date']; ?></td>
                                                <td><?= $row['order_date']; ?></td>
                                                <td class="status-dropdown">
                                                    <select name="del_status" class="form-select mb-2 dropdown" required>
                                                        <?php
                                                        // Fetch delivery status options from the database
                                                        $deliveryStatusOptions = array('Cancel', 'Delivered', 'on the way');
                                                        foreach ($deliveryStatusOptions as $option) {
                                                            $selected = ($row['del_status'] == $option) ? 'selected' : '';
                                                            echo "<option value='$option' $selected>$option</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td class="status-dropdown">
                                                    <select name="payment_status" class="form-select mb-2 dropdown" required>
                                                        <?php
                                                        // Fetch payment status options from the database
                                                        $paymentStatusOptions = array('Pending', 'Paid');
                                                        foreach ($paymentStatusOptions as $option) {
                                                            $selected = ($row['payment_status'] == $option) ? 'selected' : '';
                                                            echo "<option value='$option' $selected>$option</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td><?= $row['total_bill']; ?></td>
                                                <td><?= $row['quantity']; ?></td>
                                                <td><?= $row['payment_method']; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary update-btn" data-order-id="<?= $row['order_id']; ?>">Update</button>
                                                </td>
                                            </form>
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
    </div>

    <script>
        // Show table with animation when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.table').classList.add('show');
        });

        document.addEventListener('DOMContentLoaded', () => {
            const updateButtons = document.querySelectorAll('.update-btn');
            const deliveryStatusDropdowns = document.querySelectorAll('select[name="del_status"]');

            updateButtons.forEach(button => {
                button.addEventListener('click', (event) => {
                    // Prevent the default form submission behavior
                    event.preventDefault();

                    // Ask for confirmation
                    const isConfirmed = confirm("Are you sure you want to update changes?");

                    // If user confirms, submit the corresponding form
                    if (isConfirmed) {
                        const orderID = button.getAttribute('data-order-id');
                        const form = document.getElementById(`updateForm${orderID}`);
                        form.submit();
                    }
                });
            });

            // Add event listeners to delivery status dropdowns
            deliveryStatusDropdowns.forEach(deliveryStatusDropdown => {
                deliveryStatusDropdown.addEventListener('change', (event) => {
                    const selectedOption = event.target.value;
                    const row = event.target.closest('tr'); // Find the parent row
                    const paymentStatusDropdown = row.querySelector('select[name="payment_status"]');

                    // If the delivery status is "Delivered", set the payment status to "Paid"
                    if (selectedOption === 'Delivered') {
                        paymentStatusDropdown.value = 'Paid';
                    }
                });
            });
        });
    </script>
</body>
</html>
