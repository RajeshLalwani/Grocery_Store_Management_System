<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grocery store";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the product ID from the URL
$product_id = isset($_GET['p_id']) ? $_GET['p_id'] : 0;

// Query to get the details of the selected product
$sql_product = "SELECT * FROM product WHERE p_id = '$product_id'";
$product_result = $conn->query($sql_product);

// Check if the product exists
if ($product_result->num_rows > 0) {
    $product = $product_result->fetch_assoc();
    $image_url = "picture/" . $product['image']; // Image path
} else {
    echo "<p>Product not found.</p>";
    exit;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['p_name']; ?> - Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-detail {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product-detail img {
            max-width: 400px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .product-detail h2 {
            font-size: 24px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .product-detail p {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        .product-detail .price {
            font-size: 20px;
            color: #007bff;
            font-weight: bold;
        }

        .product-detail .buy-button {
            background-color: #007bff;
            color: white;
            padding: 12px 30px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .product-detail .buy-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="product-detail">
        <img src="<?php echo $image_url; ?>" alt="<?php echo $product['p_name']; ?>">
        <h2><?php echo $product['p_name']; ?></h2>
        <p><strong>Category:</strong> <?php echo $product['p_category']; ?></p>
        
        <p><strong>Weight:</strong> <?php echo $product['weight']; ?></p>
        <p class="price">Price: ₹<?php echo $product['p_price']; ?></p>
        <button class="buy-button">Add to Cart</button>
    </div>
</div>

</body>
</html>
