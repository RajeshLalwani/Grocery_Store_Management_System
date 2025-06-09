<?php
session_start();  // Start the session

// Database connection
$con = new mysqli("localhost", "root", "", "grocery store");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$con->set_charset("utf8");

// Get selected category from GET request
$selected_category = isset($_GET['category']) ? $_GET['category'] : '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krishna Grocery</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #0077b6;
            color: #fff;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }
        .categorie-header {
            text-align: center;
            margin: 20px 0;
        }
        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            justify-content: center;
            padding: 0 10px;
            align-items: start;
        }
        .feature1 {
            text-align: center;
            padding: 20px;
            background-color: #0077b6;
            border-radius: 10px;
            color: white;
        }
        .feature1 img {
            width: 100%;
            max-width: 280px;
            height: 230px;
            object-fit: cover;
            border-radius: 10px;
        }
        .feature1 h3 {
            font-size: 1.2rem;
        }
        .feature1 .cost {
            font-size: 1rem;
            font-weight: bold;
        }
        .feature1 a {
            text-decoration: none;
            color: #fff;
            background-color: #ff4500;
            padding: 5px 10px;
            border-radius: 5px;
            margin: 5px;
            display: inline-block;
        }
        .category-filter {
            text-align: center;
            margin: 20px;
        }
	.category-filter label {
    color: black; /* Label text white hoga */
}
        .category-filter select {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<?php include("index1.php");?>

<!-- Category Filter Dropdown -->
<div class="category-filter">
    <form method="GET" action="fruit1.php">
        <label for="category">Select Category:</label>
        <select name="category" id="category" onchange="this.form.submit()">
            <option value="">All</option>
            <?php
            $categoryQuery = "SELECT DISTINCT p_category FROM product";
            $categoryResult = $con->query($categoryQuery);
            while ($row = $categoryResult->fetch_assoc()) {
                $category = htmlspecialchars($row['p_category']);
                $selected = ($category == $selected_category) ? 'selected' : '';
                echo "<option value='$category' $selected>$category</option>";
            }
            ?>
        </select>
    </form>
</div>

<!-- Display Products -->
<?php
if ($selected_category) {
    echo "<div class='categorie-header'><h1>$selected_category</h1></div>";
    $productQuery = "SELECT * FROM product WHERE p_category='$selected_category'";
} else {
    echo "<h1 style='text-align: center; color: #0077b6;'>All Products</h1>";
    $productQuery = "SELECT * FROM product";
}

$productResult = $con->query($productQuery);

if ($productResult->num_rows > 0) {
    echo "<div class='product-list'>";
    while ($row = $productResult->fetch_assoc()) {
        $id = $row['p_id'];
        $name = htmlspecialchars($row['p_name']);
        $price = htmlspecialchars($row['p_price']);
        $image = htmlspecialchars($row['image']);
        $weight = htmlspecialchars($row['weight']);

        echo "
        <div class='feature1'>
            <img src='picture/$image' alt='$name'>
            <h3>$name</h3>
            <span class='cost'>₹$price ($weight)</span>
            <a href='cart.php?id=$id' class='add-to-cart'>Add to Cart</a>
        </div>";
    }
    echo "</div>";
} else {
    echo "<p style='text-align: center;'>No products found.</p>";
}

$con->close();
?>

</body>
</html>
