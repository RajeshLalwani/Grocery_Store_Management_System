<?php
session_start();

// Database connection
$con = new mysqli("localhost", "root", "", "grocery store");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$con->set_charset("utf8");

if (!isset($_SESSION['c_id']) || empty($_SESSION['c_id'])) {
    echo "<script>alert('Please Log in to Add items to the Cart.'); window.location.href='clogin.php';</script>";
    exit();
}

$c_id = intval($_SESSION['c_id']);

// Step 1: Ensure customer exists
$checkCustomerQuery = "SELECT * FROM customer WHERE c_id = ?";
$stmt = $con->prepare($checkCustomerQuery);
$stmt->bind_param("i", $c_id);
$stmt->execute();
$customerResult = $stmt->get_result();

if ($customerResult->num_rows == 0) {
    echo "<script>alert('Customer not found. Please login again.'); window.location.href='clogin.php';</script>";
    exit();
}

// Proceed with adding to the cart if customer exists
if (isset($_GET['id'])) {
    $p_id = intval($_GET['id']);

    $query = "SELECT p_name, p_price FROM product WHERE p_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $p_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $p_name = $row['p_name'];
        $p_price = $row['p_price'];
        $quantity = 1;

        $checkQuery = "SELECT order_quantity FROM orders WHERE p_id = ? AND c_id = ?";
        $stmt = $con->prepare($checkQuery);
        $stmt->bind_param("ii", $p_id, $c_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $updateQuery = "UPDATE orders SET order_quantity = order_quantity + 1 WHERE p_id = ? AND c_id = ?";
            $stmt = $con->prepare($updateQuery);
            $stmt->bind_param("ii", $p_id, $c_id);
        } else {
            $insertQuery = "INSERT INTO orders (p_id, c_id, order_detail, order_price, order_quantity) VALUES (?, ?, ?, ?, ?)";
            $stmt = $con->prepare($insertQuery);
            $stmt->bind_param("iissi", $p_id, $c_id, $p_name, $p_price, $quantity);
        }

        if ($stmt->execute()) {
            echo "<script>alert('Product added to cart!'); window.location.href='cart.php';</script>";
        } else {
            echo "<script>alert('Error adding to cart.'); window.location.href='fruits.php';</script>";
        }
    }
}

// Display only the latest added product
$cartQuery = "SELECT p_id, order_detail, order_price, order_quantity FROM orders WHERE c_id = ? ORDER BY o_id DESC LIMIT 1";
$stmt = $con->prepare($cartQuery);
$stmt->bind_param("i", $c_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        /* Global Styling */
      	body {
    font-family: Arial, sans-serif;
    background-color: #f0f8ff;
    color: #333;
    padding: 0px;
    background-image: url('picture/bk.jpg'); /* Replace with the path to your image */
    background-size: cover; /* This makes the image cover the entire background */
    background-position: center; /* This centers the image */
    background-attachment: fixed; /* Keeps the background fixed while scrolling */
}

        h2 {
            text-align: center;
            color: #3498db; /* Blue color for the heading */
        }

        /* Styling for the table */
        table {
            width: 70%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #3498db; /* Blue header */
            color: white;
        }

        td {
            background-color: #ffffff; /* White for table content */
        }

        /* Styling for the Order Now button */
        .btn1 {
            display: inline-block;
            text-align: center;
            margin-top: 20px;
            padding: 8px 14px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .btn1:hover {
            background-color: #2980b9;
        }

        /* Center the body content */
        .content-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .cart-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 50%;
        }
    </style>
</head>
<body>
    <?php include("index1.php"); ?>

    <div class="content-wrapper">
        <div class="cart-container">
            <h2>Shopping Cart</h2>

            <?php if ($row = $result->fetch_assoc()): ?>
                <table>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                    <tr>
                        <td><?php echo $row['order_detail']; ?></td>
                        <td>₹<?php echo $row['order_price']; ?></td>
                        <td><?php echo $row['order_quantity']; ?></td>
                    </tr>
                </table>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>

            <center><div class="btn1"><a href="checkout.php">Order Now</a></div></center> 
        </div>
    </div>
</body>
</html>

<?php
$con->close();
?>
