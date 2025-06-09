


<?php 
session_start();
include("index1.php");

?>
<?php
//session_start();

// Check if user is logged in
if (!isset($_SESSION['c_id'])) {
    echo "<script>alert('Please log in to view order history.'); window.location.href='clogin.php';</script>";
    exit();
}

$c_id = intval($_SESSION['c_id']);

// Database connection
$con = new mysqli("localhost", "root", "", "grocery store");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$con->set_charset("utf8");

// Fetch past orders for the logged-in user
$sqlOrders = "SELECT * FROM orders WHERE c_id=? ORDER BY order_date DESC";
$stmt = $con->prepare($sqlOrders);
$stmt->bind_param("i", $c_id);
$stmt->execute();
$ordersResult = $stmt->get_result();

// Check for cancellation request
if (isset($_POST['cancel_order_id'])) {
    $cancelOrderId = intval($_POST['cancel_order_id']);
    
    // Update the order status to 'Cancelled'
    $updateStatusSql = "UPDATE orders SET order_status='Cancelled' WHERE o_id=? AND c_id=?";
    $stmtUpdate = $con->prepare($updateStatusSql);
    $stmtUpdate->bind_param("ii", $cancelOrderId, $c_id);
    $stmtUpdate->execute();
    
    echo "<script>alert('Order Cancelled Successfully...'); window.location.href='order_history.php';</script>";
    exit();
}

if ($ordersResult->num_rows == 0) {
    echo "<script>alert('No previous orders found.'); window.location.href='fruit1.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History - Krishna Grocery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            padding: 0px;
        }
        .container {
            max-width: 800px;
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
        .status {
            font-weight: bold;
            color: #28a745;
        }
        .status.pending {
            color: #ffc107;
        }
        .status.placed {
            color: #0077b6;
        }
        .cancel-btn {
            background-color: #ff4136;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            border-radius: 5px;
        }
        .cancel-btn:hover {
            background-color: #e60000;
        }
    </style>
</head>

<body>
<br><br><br><br>

    <div class="container">
        <h2>Order History</h2>

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Price (₹)</th>
                    <th>Quantity</th>
                    <th>Total (₹)</th>
                    <th>Order Status</th>
                    <th>Order Date</th>
                    <th>Time</th>

                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch and display all previous orders
                while ($row = $ordersResult->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['o_id']}</td>
                            <td>{$row['order_detail']}</td>
                            <td>₹{$row['order_price']}</td>
                            <td>{$row['order_quantity']}</td>
                            <td>₹" . ($row['order_price'] * $row['order_quantity']) . "</td>
                            <td class='status " . strtolower($row['order_status']) . "'>{$row['order_status']}</td>
            <td>" . date('d-m-y', strtotime($row['order_date'])) . "</td>
<td>" . date('h:i A', strtotime($row['order_date'])) . "</td>

                            <td>";
                            
                            // Show cancel button only for orders that are 'Placed' or 'Pending'
                            if ($row['order_status'] == 'Placed' || $row['order_status'] == 'Pending') {
                                echo "<form method='POST'>
                                        <input type='hidden' name='cancel_order_id' value='{$row['o_id']}'>
                                        <button type='submit' class='cancel-btn'>Cancel Order</button>
                                      </form>";
                            }
                            
                    echo "</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
<br><br><br><br><br><br>
</body>
</html>
