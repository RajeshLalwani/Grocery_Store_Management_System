<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
       body {
       background-image: url('picture/ob.jpg');     
	background-size: cover; 
      background-position: center center;    
     background-attachment: fixed; 
    color: #333; }


       header {
    
    background-size: cover;
    background-position: center center;
    height: 200px; /* Adjust the height as needed */
    color: white; /* Text color for the header */
}


        .container {
            width: 80%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
        }

        .btn-confirm {
            display: block;
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 15px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn-confirm:hover {
            background-color: #0056b3;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: white;
            margin-top: 20px;
        }

        /* Popup message styles */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        .popup-button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .popup-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body><?php include("index.php");?>

 <br><br><br><br><br>

    <div class="container">
        <h2>Checkout</h2>

        <form method="post">
            <p>Your cart items will be processed for order.</p>
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                <?php
$con = new mysqli("localhost", "root", "", "grocery store");

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
                $totalAmount = 0;
                if ($cartResult->num_rows > 0) {
                    while ($row = $cartResult->fetch_assoc()) {
                        $itemTotal = $row['order_price'] * $row['order_quantity'];
                        $totalAmount += $itemTotal;
                        echo '<tr>
                                <td>' . htmlspecialchars($row['order_detail']) . '</td>
                                <td>₹' . htmlspecialchars($row['order_price']) . '</td>
                                <td>' . htmlspecialchars($row['order_quantity']) . '</td>
                                <td>₹' . $itemTotal . '</td>
                              </tr>';
                    }
                }
                ?>
            </table>
            
            <div class="total">
                <p><strong>Grand Total: ₹<?php echo $totalAmount; ?></strong></p>
            </div>
            
            <input type="submit" name="confirm_order" value="Confirm Order" class="btn-confirm">
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Grocery Store. All rights reserved.</p>
    </footer>

    <!-- Pop-up message -->
    <div class="popup" id="popupMessage">
        <div class="popup-content">
            <p id="popupText">Order Confirmation Message Here</p>
            <button class="popup-button" onclick="closePopup()">Close</button>
        </div>
    </div>

    <script>
        function closePopup() {
            document.getElementById('popupMessage').style.display = 'none';
        }

        // Show popup based on order placement or error message
        <?php
        if (isset($_POST['confirm_order'])) {
            if ($cartResult->num_rows > 0) {
                echo "document.getElementById('popupText').innerText = 'Your order has been placed successfully!';";
          
            } else {
                echo "document.getElementById('popupText').innerText = 'Your cart is empty. Please add items to the cart before placing the order.';";
                echo "document.getElementById('popupMessage').style.display = 'flex';";
            }
        }
        ?>
    </script>

</body>
</html>