

<?php
session_start();  // Start the session
$sq = $_SESSION['pr']; 

// Database connection
$con = new mysqli("localhost", "root", "", "grocery store");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?><?php
$servername = "localhost"; // Change if needed
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "grocery store"; // Your database name

// Connect to database
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$totalAmount = isset($_SESSION['total_amount']) ? $_SESSION['total_amount'] : 0;

// Ensure form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are set
    if (isset($_POST['p_type']) && isset($_POST['p_detail']) && isset($_POST['p_amount'])) {
        // Get data from form safely
        $p_type = $conn->real_escape_string($_POST['p_type']);
        $p_detail = $conn->real_escape_string($_POST['p_detail']);
        $p_amount = $conn->real_escape_string($_POST['p_amount']);

        // Insert query
        $sql = "INSERT INTO payment (p_type, p_detail, p_amount) VALUES ('$p_type', '$p_detail', '$p_amount')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Order Placed Successfully'); window.location.href='order_history.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('All fields are required!');</script>";
    }
} 
// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <!-- Bootstrap CDN for Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       body {
    background: url('picture/ob.jpg') no-repeat center center fixed; 
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
      .btn-primary {
    background-color: blue !important;
    border-color: blue !important;
    color: white;
}

.btn-primary:hover {
    background-color: darkblue !important; /* Darker Blue on Hover */
    border-color: darkblue !important;
}




    </style>
</head>
<body>

    <div class="container">
        <h2>Payment Form</h2>
        <form action="payment.php" method="POST">
            <div class="mb-3">
                <label for="p_type" class="form-label">Payment Type</label>
                <select name="p_type" id="p_type" class="form-control" required>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="p_detail" class="form-label">Receiver's Information</label>
                <input type="text" name="p_detail" id="p_detail" class="form-control" placeholder="Enter Order Receiver's Information" required>
            </div>

            <div class="mb-3">
                <label for="p_amount" class="form-label">Amount</label>
<input type="hidden" name="ed" ">

                <input type="number" name="p_amount" id="p_amount" value="<?php echo urlencode($sq); ?>" class="form-control" min="1" step="0.01" readonly>
            </div>

           <center>
    <button type="submit" class="btn btn-primary">Place Order</button>
</center>

        </form>
    </div>

    <!-- Bootstrap JS (Optional for dropdowns & effects) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
