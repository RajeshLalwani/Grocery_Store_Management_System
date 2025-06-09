<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['c_id'])) {
    echo "<script>alert('Please Log in to Proceed to Checkout...'); window.location.href='clogin.php';</script>";
    exit();
}

$c_id = intval($_SESSION['c_id']);

// Database connection
$con = new mysqli("localhost", "root", "", "grocery store");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$con->set_charset("utf8");

// Remove item from cart
if (isset($_POST['remove_item'])) {
    $remove_p_id = intval($_POST['remove_item']);
    $deleteQuery = "DELETE FROM orders WHERE p_id = ? AND c_id = ?";
    $stmt = $con->prepare($deleteQuery);
    $stmt->bind_param("ii", $remove_p_id, $c_id);
    $stmt->execute();
    echo "<script>window.location.href='checkout.php';</script>";
    exit();
}

// Fetch current cart items
$sqlCart = "SELECT * FROM orders WHERE c_id=?";
$stmt = $con->prepare($sqlCart);
$stmt->bind_param("i", $c_id);
$stmt->execute();
$cartResult = $stmt->get_result();

if ($cartResult->num_rows == 0) {
    echo "<script>alert('Your Cart is Empty. Please Add Few Items Before Proceeding to Checkout.'); window.location.href='fruit1.php';</script>";
    exit();
}

// Calculate total price
$totalPrice = 0;
$orderItems = [];

while ($row = $cartResult->fetch_assoc()) {
    $totalPrice += $row['order_price'] * $row['order_quantity'];
    $orderItems[] = [
        'p_id' => $row['p_id'],
        'product_name' => $row['order_detail'],
        'quantity' => $row['order_quantity'],
        'price' => $row['order_price']
    ];
}
$_SESSION['pr'] = $totalPrice;

// Handle Order Placement
if (isset($_POST['place_order'])) {
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';

    // Update Order Status
    $sqlUpdateOrder = "UPDATE orders SET order_status = 'Placed' WHERE c_id = ?";
    $stmt = $con->prepare($sqlUpdateOrder);
    $stmt->bind_param("i", $c_id);

    if ($stmt->execute()) {
        // If address is provided, update customer table
        if (!empty($address)) {
            $sqlUpdateAddress = "UPDATE customer SET c_address = ? WHERE c_id = ?";
            $stmt2 = $con->prepare($sqlUpdateAddress);
            $stmt2->bind_param("si", $address, $c_id);
            $stmt2->execute();
        }

        echo "<script>window.location.href='payment.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error While Placing an Order. Please Try Again Later.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Krishna Grocery</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url('picture/ob.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            color: #333;
        }
        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #0077b6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #0077b6;
            color: white;
        }
        .total {
            text-align: right;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .checkout-btn {
            display: block;
            width: 100%;
            background-color: #0077b6;
            color: white;
            padding: 10px;
            text-align: center;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            margin-top: 20px;
        }
        .checkout-btn:hover {
            background-color: #005a8e;
        }
        .remove-btn {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
        }
        .remove-btn:hover {
            background-color: #cc0000;
        }
    </style>
    <script>
        function getAddressAndSubmit() {
            let address = prompt('Please Enter Your Delivery Address Here:');

            if (address === null || address.trim() === '') {
                // If address is cancelled or empty, go to payment directly
                document.getElementById('order_form').submit();
            } else {
                // If address is entered, save it and proceed to payment
                document.getElementById('address_input').value = address;
                document.getElementById('order_form').submit();
            }
        }
    </script>
</head>
<body>
<?php include("index1.php");?>

<div class="container">
    <h2>Cart</h2>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price (₹)</th>
                <th>Quantity</th>
                <th>Total (₹)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderItems as $item): ?>
                <tr>
                    <td><?= $item['product_name']; ?></td>
                    <td>₹<?= $item['price']; ?></td>
                    <td><?= $item['quantity']; ?></td>
                    <td>₹<?= ($item['price'] * $item['quantity']); ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <button type="submit" name="remove_item" value="<?= $item['p_id']; ?>" class="remove-btn">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p class="total">Total Amount: ₹<?= $totalPrice; ?></p>

    <form id="order_form" method="POST">
        <input type="hidden" id="address_input" name="address">
        <button type="button" class="checkout-btn" onclick="getAddressAndSubmit()">Order</button>
        <input type="hidden" name="place_order" value="1">
    </form>
</div>

</body>
</html>
