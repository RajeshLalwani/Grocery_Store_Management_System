<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grocery store";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Confirm or Cancel action
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_action']) && isset($_POST['o_id'])) {
    $o_id = intval($_POST['o_id']); // Order ID
    $order_action = $_POST['order_action']; // Action (Confirm or Cancel)
    
    // Update order status in the database
    if ($order_action == 'confirm') {
        $update_sql = "UPDATE `order` SET order_status = 'confirmed' WHERE o_id = ?";
    } else if ($order_action == 'cancel') {
        $update_sql = "UPDATE `order` SET order_status = 'cancelled' WHERE o_id = ?";
    }

    if ($stmt = $conn->prepare($update_sql)) {
        $stmt->bind_param("i", $o_id);
        if ($stmt->execute()) {
            echo "<script>alert('Order status updated successfully!');</script>";
        } else {
            echo "<script>alert('Error updating order status!');</script>";
        }
        $stmt->close();
    }
}

// Fetch orders with product and customer details
$sql = "SELECT o.o_id, p.p_name, c.c_name, o.order_quantity, o.order_price, o.order_detail, o.order_status 
        FROM `order` o 
        JOIN product p ON o.p_id = p.p_id 
        JOIN customer c ON o.c_id = c.c_id";
$result = $conn->query($sql);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Order List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #0047ab;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #0047ab;
            color: white;
        }

        .message {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }

        button {
            padding: 5px 15px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .confirm-btn {
            background-color: #28a745;
            color: white;
        }

        .confirm-btn:hover {
            background-color: #218838;
        }

        .cancel-btn {
            background-color: #dc3545;
            color: white;
        }

        .cancel-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<?php include("index.php");?>
    <div class="container">
        <h2>Admin - Order List</h2>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Customer Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Order Details</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['o_id']}</td>
                                <td>{$row['p_name']}</td>
                                <td>{$row['c_name']}</td>
                                <td>{$row['order_quantity']}</td>
                                <td>{$row['order_price']}</td>
                                <td>{$row['order_detail']}</td>
                                <td>{$row['order_status']}</td>
                                <td>
                                    <form method='POST' style='display:inline;'>
                                        <input type='hidden' name='o_id' value='{$row['o_id']}'>
                                        <input type='hidden' name='order_action' value='confirm'>
                                        <button type='submit' class='confirm-btn'>Confirm</button>
                                    </form>
                                    <form method='POST' style='display:inline;'>
                                        <input type='hidden' name='o_id' value='{$row['o_id']}'>
                                        <input type='hidden' name='order_action' value='cancel'>
                                        <button type='submit' class='cancel-btn'>Cancel</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="message">No orders found</p>
        <?php endif; ?>
    </div>

</body>
</html>
