<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['a_id'])) {
    echo "<script>alert('Please log in as admin to manage orders.'); window.location.href='adminlogin.php';</script>";
    exit();
}
?>

<?php
// Database connection details
$servername = "localhost"; // Your server name
$username = "root";        // Your database username
$password = "";            // Your database password
$dbname = "grocery store"; // Your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get all distinct categories from the product table
$sql_categories = "SELECT DISTINCT p_category FROM product";
$categories_result = $conn->query($sql_categories);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <style>
        /* Simple styles for the page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }

        h2 {
            text-align: center;
            margin-top: 60px;
            margin-bottom: 40px;
            font-size: 28px;
            color: #4e73df; /* Soft blue color */
            padding-bottom: 15px; /* Space below the category name */
            border-bottom: 2px solid #4e73df; /* Underline effect */
        }

        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 0 20px;
            margin-bottom: 40px; /* Add margin to separate product categories */
        }

        .product {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .product img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .product h3 {
            font-size: 18px;
            color: #333;
            margin: 10px 0;
        }

        .product p {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .product-list {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }
    </style>
</head>
<body>
<?php include("index.php");?>

<?php
// Check if there are any categories
if ($categories_result->num_rows > 0) {
    // Loop through and display products for each category
    while ($category_row = $categories_result->fetch_assoc()) {
        $category = $category_row['p_category'];

        // Query to get all products for this category
        $sql_products = "SELECT * FROM product WHERE p_category = '$category'";
        $products_result = $conn->query($sql_products);

        // Display the category name
        echo "<h2>Products in '$category' Category</h2>";

        // Check if there are any products in the current category
        if ($products_result->num_rows > 0) {
            // Start the product list for this category
            echo "<div class='product-list'>";

            // Loop through and display each product in this category
            while ($row = $products_result->fetch_assoc()) {
                $image_url = "picture/" . $row['image']; // Image path

                echo "<div class='product'>
                        <img src='" . $image_url . "' alt='" . $row['p_name'] . "'>
                        <h3>" . $row['p_name'] . "</h3>
                        <p><strong>Price:</strong> ₹" . number_format($row['p_price'], 2) . "</p>
                        <p><strong>Weight:</strong> " . $row['weight'] . "g</p>
                      </div>";
            }

            // End the product list for this category
            echo "</div>";
        } else {
            echo "<p>No products found in this category.</p>";
        }
    }
} else {
    echo "<p>No categories found.</p>";
}

// Close the database connection
$conn->close();
?>
</body>
</html>
