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
            padding: 8px;
            border: 1px solid black; /* Add black border to all cells */
        }

        .table th {
            background-color: #6c757d; /* Change table header color to gray */
            color: white;
            font-weight: bold;
            text-align: center;
			width: 150px;
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
        <h4>View Reviews</h4>
                    <div class="card-body">
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Review ID</th>
                                    <th>User ID</th>
									<th>Experience</th>
									<th>Star Rating</th>
									<th>Created At</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $con = mysqli_connect("localhost","root","","readcycle");

                                    $query = "SELECT * FROM reviews";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['Review_ID']; ?></td>
                                                <td><?= $row['User_ID']; ?></td>
                                                <td><?= $row['Experience']; ?></td>
												<td><?= $row['StarRating']; ?></td>
												<td><?= $row['Created_At']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                            <tr>
                                                <td colspan="4">No Record Found</td>
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
    </script>
</body>
</html>
