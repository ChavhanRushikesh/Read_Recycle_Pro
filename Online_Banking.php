<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 26px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 18px;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: calc(100% - 12px);
            padding: 8px;
            font-size: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bank Details</h2>
        <form id="bankForm">
            <label for="bankName">Bank Name:</label>
            <input type="text" id="bankName" name="bankName" required>

            <label for="accountNumber">Account Number:</label>
            <input type="text" id="accountNumber" name="accountNumber" required>

            <label for="ifscCode">IFSC Code:</label>
            <input type="text" id="ifscCode" name="ifscCode" required>

            <label for="payment">Payment:</label>
            <input type="text" id="payment" name="payment" required>

            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('bankForm').addEventListener('submit', function(event) {
            // Prevent the form from submitting normally
            event.preventDefault();

            // Check if all required fields are filled
            var bankName = document.getElementById('bankName').value.trim();
            var accountNumber = document.getElementById('accountNumber').value.trim();
            var ifscCode = document.getElementById('ifscCode').value.trim();
            var payment = document.getElementById('payment').value.trim();

            if (bankName !== '' && accountNumber !== '' && ifscCode !== '' && payment !== '') {
                // Redirect to another webpage if all fields are filled
                window.location.href = 'Step_3.php';
            } else {
                // If any required field is empty, display an alert
                alert('Please fill in all required fields.');
            }
        });
    </script>
</body>
</html>
