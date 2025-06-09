<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krishna Grocery</title>
    <style>
        /* General Styling */
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
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Ensure each item takes at least 300px space */
            gap: 20px; /* Spacing between items */
            justify-content: center;
            padding: 0 10px;
            align-items: start; /* Ensures items align to the top */
        }

        .feature1 {
            background-color: transparent;
            border: none;
            text-align: center;
            padding: 50px;
            box-shadow: none;
            height: 350px; /* Maintain consistent height */
            display: flex;
            flex-direction: column;
            align-items: center; /* Center align the content */
            gap: 10px; /* Add spacing between elements inside the feature1 */
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
            color: #0077b6;
        }

        .feature1 .cost {
            margin: 10px 0;
            font-size: 1rem;
        }

        .feature1 a {
            text-decoration: none;
            color: #fff;
            background-color: #0077b6;
            padding: 5px 10px;
            border-radius: 5px;
            margin: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <!-- Product Section -->
    <div class="categorie-header">
        <h1>Fruits</h1>
    </div>

    <div class="product-list">
        <?php
        // Database connection
        $con = new mysqli("localhost", "root", "", "grocery store");

        // Check connection
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        // Set charset
        $con->set_charset("utf8");

        // Fetch products
        $sql = "SELECT * FROM `product` WHERE p_category='fruit'";
        $result = $con->query($sql);

        // Debug SQL query execution
        if (!$result) {
            die("SQL error: " . $con->error);
        }

        // Check if any products exist
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = htmlspecialchars($row['p_id']);
                $name = htmlspecialchars($row['p_name']);
                $price = htmlspecialchars($row['p_price']);
                $image = htmlspecialchars($row['image']);
                $weight = htmlspecialchars($row['weight']);

                echo '
                <div class="feature1">
                    <img src="picture/' . $image . '" alt="' . $name . '">
                    <h3>' . $name . '</h3>
                    <span class="cost">₹' . $price . ' (' . $weight . ')</span>
                    <a href="buy.php?o_id=' . $id . '">Buy Now</a>
                    <a href="cart.php?id=' . $id . '" class="add-to-cart">Add to Cart</a>
                </div>';
            }
        } else {
            echo '<p>No products found in the "fruit" category.</p>';
        }

        // Close connection
        $con->close();
        ?>
    </div>
</body>
</html>
