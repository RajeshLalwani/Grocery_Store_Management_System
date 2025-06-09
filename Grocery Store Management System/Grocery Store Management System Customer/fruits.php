<?php
//session_start();  // Start the session

// Database connection
$con = new mysqli("localhost", "root", "", "grocery store");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
$con->set_charset("utf8");

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
        .categorie-header h1 {
            color: #0077b6;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
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
            background-color: #0077b6; /* Background blue */
            border-radius: 10px;
            color: white; /* White text */
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
            color: white; /* Product name white */
        }
        .feature1 .cost {
            font-size: 1rem;
            color: white; /* Price text white */
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
    </style>
</head>
<body>


<h1 style="text-align: center; color: #0077b6;">Products</h1>

<?php
$categoryQuery = "SELECT DISTINCT p_category FROM product";
$categoryResult = $con->query($categoryQuery);

if ($categoryResult->num_rows > 0) {
    while ($categoryRow = $categoryResult->fetch_assoc()) {
        $category = htmlspecialchars($categoryRow['p_category']);
        echo "<div class='categorie-header'><h1>$category</h1></div>";
        echo "<div class='product-list'>";

        $productQuery = "SELECT * FROM product WHERE p_category='$category'";
        $productResult = $con->query($productQuery);

        if ($productResult->num_rows > 0) {
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
        }
        echo "</div>";
    }
} else {
    echo "<p style='text-align: center;'>No categories found.</p>";
}
$con->close();
?>

</body>
</html>
