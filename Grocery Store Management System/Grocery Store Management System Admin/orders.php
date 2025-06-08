<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['a_id'])) {
    echo "<script>alert('Please log in as admin to manage orders.'); window.location.href='adminlogin.php';</script>";
    exit();
}

// Database connection
$con = new mysqli("localhost", "root", "", "grocery store");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$con->set_charset("utf8");

// Fetch all orders for admin
$sqlOrders = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $con->query($sqlOrders);

// Check for status update request
if (isset($_POST['update_order_id']) && isset($_POST['order_status'])) {
    $updateOrderId = intval($_POST['update_order_id']);
    $orderStatus = $_POST['order_status'];

    // Update the order status
    $updateStatusSql = "UPDATE orders SET order_status=? WHERE o_id=?";
    $stmtUpdate = $con->prepare($updateStatusSql);
    $stmtUpdate->bind_param("si", $orderStatus, $updateOrderId);
    $stmtUpdate->execute();

    echo "<script>alert('Order status has been updated.'); window.location.href='orders.php';</script>";
    exit();
}

// Check for order cancellation request
if (isset($_POST['cancel_order_id'])) {
    $cancelOrderId = intval($_POST['cancel_order_id']);

    // Update the order status to 'Cancelled'
    $cancelOrderSql = "UPDATE orders SET order_status='Cancelled' WHERE o_id=?";
    $stmtCancel = $con->prepare($cancelOrderSql);
    $stmtCancel->bind_param("i", $cancelOrderId);
    $stmtCancel->execute();

    echo "<script>alert('Order has been cancelled.'); window.location.href='orders.php';</script>";
    exit();
}

if ($result->num_rows == 0) {
    echo "<script>alert('No orders found.'); window.location.href='admin_dashboard.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Order Management - Grocery Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
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
        .status {
            font-weight: bold;
        }
        .status.pending {
            color: #ffc107;
        }
        .status.placed {
            color: #0077b6;
        }
        .status.cancelled {
            color: #ff4136;
        }
        .update-btn {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            border-radius: 5px;
        }
        .update-btn:hover {
            background-color: #218838;
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
<body><?php include("index.php");?>

    <div class="container">
        <h2>Admin - Order Management</h2>

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer ID</th>
                    <th>Product Name</th>
                    <th>Price (₹)</th>
                    <th>Quantity</th>
                    <th>Total (₹)</th>
                    <th>Order Status</th>
                    <th>Order Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch and display all orders
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['o_id']}</td>
                            <td>{$row['c_id']}</td>
                            <td>{$row['order_detail']}</td>
                            <td>₹{$row['order_price']}</td>
                            <td>{$row['order_quantity']}</td>
                            <td>₹" . ($row['order_price'] * $row['order_quantity']) . "</td>
                            <td class='status " . strtolower($row['order_status']) . "'>{$row['order_status']}</td>
<td>" . date('d-m-y', strtotime($row['order_date'])) . "</td>
                            <td>";
                            
                            // Show update status and cancel button only for orders that are 'Placed' or 'Pending'
                            if ($row['order_status'] == 'Placed' || $row['order_status'] == 'Pending') {
                                echo "<form method='POST'>
                                        <input type='hidden' name='update_order_id' value='{$row['o_id']}'>
                                        <select name='order_status'>
                                            <option value='Placed'" . ($row['order_status'] == 'Placed' ? ' selected' : '') . ">Placed</option>
                                            <option value='Shipped'" . ($row['order_status'] == 'Shipped' ? ' selected' : '') . ">Shipped</option>
                                            <option value='Delivered'" . ($row['order_status'] == 'Delivered' ? ' selected' : '') . ">Delivered</option>
                                            <option value='Cancelled'" . ($row['order_status'] == 'Cancelled' ? ' selected' : '') . ">Cancelled</option>
                                        </select>
                                        <button type='submit' class='update-btn'>Update Status</button>
                                      </form>";
                            }
                            
                            // Cancel button
                            if ($row['order_status'] == 'Placed' || $row['order_status'] == 'Pending') {
                                echo "<form method='POST' style='margin-top: 10px;'>
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

</body>
</html>
