<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Grocery Order</title>
    <style>


body {
    font-family: 'Arial', sans-serif;
    background-image: url('picture/ob.jpg'); 
    background-size: cover; 
    background-position: center;
    background-repeat: no-repeat; 
    margin: 0;
    padding: 0;
    height: 180vh;     width: 100vw;
}


        .container {
            max-width: 500px;
            margin: 40px auto;
            background: rgba(355, 355, 355, 0.8);
            padding: 50px;
            border-radius: 100px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #0047ab;
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
        }

        label {
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #0047ab;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
        }

        button:hover {
            background-color: #003380;
        }

        .price-display {
            font-size: 18px;
            color: #333;
            font-weight: bold;
            margin-top: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .alert {
            color: red;
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
                margin: 20px;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<?php include("index.php");?>
    <div class="container">
        <h2>Place Your Grocery Order</h2>
        <form action="order.php" method="POST">
            <!-- Customer selection -->
            <div class="form-group">
                <label for="c_id">Select Customer (ID):</label>
                <select id="c_id" name="c_id" required>
                    <option value="">Select a customer</option>
                    <?php
                    if ($customer_result->num_rows > 0) {
                        while ($row = $customer_result->fetch_assoc()) {
                            echo "<option value='{$row['c_id']}'>Customer {$row['c_id']} - {$row['c_name']}</option>";
                        }
                    } else {
                        echo "<option>No customers available</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Product selection -->
            <div class="form-group">
                <label for="p_id">Select Product:</label>
                <select id="p_id" name="p_id" required>
                    <option value="">Select a product</option>
                    <?php
                    if ($product_result->num_rows > 0) {
                        while ($row = $product_result->fetch_assoc()) {
                            echo "<option value='{$row['p_id']}'>{$row['p_name']} - \${$row['p_price']}</option>";
                        }
                    } else {
                        echo "<option>No products available</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Quantity input -->
            <div class="form-group">
                <label for="order_quantity">Quantity:</label>
                <input type="number" id="order_quantity" name="order_quantity" min="1" required>
            </div>

            <!-- Order detail (optional) -->
            <div class="form-group">
                <label for="order_detail">Order Detail:</label>
                <input type="text" id="order_detail" name="order_detail" placeholder="Special instructions (optional)">
            </div>

            <!-- Display total price (optional) -->
            <div class="form-group price-display">
                <label for="order_price">Total Order Price: </label>
                <input type="text" id="order_price" name="order_price" readonly>
            </div>

            <button type="submit">Place Order</button>
        </form>
    </div>

    <script>
        // Update total price dynamically based on quantity and selected product price
        document.getElementById("order_quantity").addEventListener("input", function () {
            var productSelect = document.getElementById("p_id");
            var selectedProduct = productSelect.options[productSelect.selectedIndex];
            var price = parseFloat(selectedProduct.text.split('-')[1].trim().slice(1)); // Extract price from option and remove "$"
            var quantity = document.getElementById("order_quantity").value;
            var totalPrice = price * quantity;
            document.getElementById("order_price").value = totalPrice.toFixed(2);
        });
    </script>
    <div class="footer" id="footer">
        <div class="foot-container">
            <div class="foot">
                <h2>Feedback</h2>
              <a href="f.php"><font color="orange">Give Feedback</font></a>
            </div>
        </div>
        
    </div>

</body>
</html>
