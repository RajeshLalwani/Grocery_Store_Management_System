<!DOCTYPE html>
<html lang="en">

<head>
<style>
    /* General styles for the main container */
.main {
    display: flex;
    flex-direction: column; /* Stack sections vertically */
    gap: 30px; /* Space between sections */
    padding: 20px;
    background-color: #f4f4f4; /* Light background color */
}

/* Individual Section Styling */
.main > div {
    background-color: white; /* White background for each section */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow */
}

/* Title for each section */
.main > div h2 {
    color: #0056b3; /* Blue color for section titles */
    font-size: 24px;
    margin-bottom: 15px;
}

/* Content in each section (products) */
.product-thumbnail {
    display: flex;
    flex-direction: column;
    align-items: center; /* Center content */
    padding: 10px;
    margin-bottom: 20px;
    background-color: rgba(255, 255, 255, 0.8); /* Slight white background */
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Product Image Styling */
.product-thumbnail .product-img img {
    width: 100%;
    max-height: 250px; /* Control image size */
    object-fit: cover; /* Ensure images fill the box without distortion */
}

/* Product Title and Price Styling */
.product-title {
    color: #0056b3; /* Blue text */
    font-size: 18px;
    text-align: center;
    margin-top: 10px;
}

.product-price {
    color: #333; /* Dark gray text */
    font-size: 16px;
    text-align: center;
    margin-bottom: 15px;
}

/* Button Styling */
.product_btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.btn-primary {
    background-color: #0056b3;
    border-color: #0056b3;
    padding: 10px 20px;
    width: 100%;
    max-width: 150px;
}

.btn-outline-light {
    color: #0056b3;
    border-color: #0056b3;
    padding: 10px 20px;
    width: 100%;
    max-width: 150px;
}

.btn-outline-light:hover {
    background-color: #0056b3;
    color: #fff;
}

/* Adjust Layout for Smaller Screens */
@media (max-width: 768px) {
    .main {
        padding: 10px;
    }

    .main > div {
        padding: 15px;
    }

    .product-thumbnail {
        width: 100%;
    }

    .product-title {
        font-size: 16px;
    }
}
</style>
</head>

<body>

   <?php include("index1.php");?>

    <!-- Main Section -->
   <!-- Main Section -->
<div class="main">
    <div class="section" id="fruit-section">
        <h2>Fruits</h2>
        <?php include("fruit.php"); ?>
    </div>
    <div class="section" id="vegetable-section">
        <h2>Vegetables</h2>
        <?php include("vegetable.php"); ?>
    </div>
    <div class="section" id="milkproduct-section">
        <h2>Milk Products</h2>
        <?php include("milkproduct.php"); ?>
    </div>
    <div class="section" id="grains-section">
        <h2>Grains</h2>
        <?php include("Grains.php"); ?>
    </div>
</div>


    <!-- Footer Section -->
    <div class="footer" id="footer">
        <div class="foot-container">
            <div class="foot">
                <h2>About Us</h2>
                <p>Krishna Grocery is your one-stop shop for fresh groceries.</p>
            </div>
            <div class="foot">
                <h2>Quick Links</h2>
                <a href="index.php">Home</a>
                <a href="shop.php">Shop</a>
                <a href="order.php">Cart</a>
                <a href="clogin.php">Login/SignUp</a>
            </div>
            <div class="foot">
                <h2>Contact</h2>
                <p>Email: contact@krishnagrocery.com</p>
                <p>Phone: +91 9876543210</p>
            </div>
        </div>
        <div class="copy-right">
            <p>© 2025 Krishna Grocery. All rights reserved.</p>
        </div>
    </div>

</body>

</html>
