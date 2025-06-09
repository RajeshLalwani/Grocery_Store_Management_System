<?php
session_start();

        // Database connection
        $conn= new mysqli("localhost", "root", "", "grocery store");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

// Fetch products from the database
$sql = "SELECT * FROM product WHERE p_category = 'fruit'";
$result = $conn->query($sql);

// Initialize cart count
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fruit Shop</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-image: url('images/background.jpg');
            background-size: cover;
            background-attachment: fixed;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .nav-link, .badge {
            color: #fff !important;
        }
        .product-thumbnail {
            background-color: #fff;
            border: 1px solid #007bff;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .product-title {
            color: #007bff;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-outline-light {
            border-color: #007bff;
            color: #007bff;
        }
        .btn-outline-light:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">Fruit Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="fas fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        <i class="fas fa-shopping-cart"></i> Cart
                        <span class="badge badge-pill badge-secondary"><?php echo $cartCount; ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
            ?>
            <div class="col-md-3">
                <div class="product-thumbnail">
                    <img src="uploads/<?php echo $row['image']; ?>" class="img-fluid" alt="<?php echo $row['p_name']; ?>">
                    <h3 class="product-title"><?php echo $row['p_name']; ?></h3>
                    <p class="product-price">₹<?php echo $row['p_price']; ?></p>
                    <button onclick="addToCart(<?php echo $row['p_id']; ?>)" class="btn btn-primary btn-block">Add to Cart</button>
                    <a href="single_product.php?product_id=<?php echo $row['p_id']; ?>" class="btn btn-outline-light btn-block">Details</a>
                </div>
            </div>
            <?php
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        function addToCart(productId) {
            $.ajax({
                url: 'add_to_cart.php',
                method: 'POST',
                data: { id: productId },
                success: function(response) {
                    alert('Product added to cart!');
                    location.reload();
                }
            });
        }
    </script>
</body>
</html>
