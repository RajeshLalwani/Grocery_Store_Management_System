<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['a_id'])) {
    echo "<script>alert('Please log in as admin to manage orders.'); window.location.href='adminlogin.php';</script>";
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grocery store";
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Handle product update
if (isset($_POST['submit'])) {
    $p_id = $_POST['p_id'];
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_category = $_POST['p_category'];
    $imgName = $_FILES['img']['name'];
    $imgTmpName = $_FILES['img']['tmp_name'];
    
    // If a new image is uploaded, handle it
    if ($imgName) {
        $uploadDir = "uploaded/img/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $imgPath = $uploadDir . $imgName;
        move_uploaded_file($imgTmpName, $imgPath);
    } else {
        // Keep the existing image if no new image is uploaded
        $imgName = $_POST['existing_image'];
    }

    $weight = $_POST['kg'];

    // Update product query
    $q = "UPDATE product SET p_name='$p_name', p_price='$p_price', p_category='$p_category', image='$imgName', weight='$weight' WHERE p_id='$p_id'";
    $query = mysqli_query($con, $q);

    if ($query) {
        echo "<p style='color:green;'>Product updated successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error updating product: " . $con->error . "</p>";
    }
}

// Fetch all products
$sql = "SELECT * FROM product";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Product Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

       
        
       
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #0047ab;
            color: white;
        }

        button {
            background-color: #0047ab;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #003580;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container {
            width: 50%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .message {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-top: 15px;
        }

        .message.success {
            color: #28a745;
        }

        .message.error {
            color: #dc3545;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            table, .form-container {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <?php include("index.php");?>


<div class="container">

    <!-- Product List -->
    <h2>Product List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Weight</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['p_id'] . "</td>";
                echo "<td>" . $row['p_name'] . "</td>";
                echo "<td>" . $row['p_price'] . "</td>";
                echo "<td>" . $row['p_category'] . "</td>";
                echo "<td>" . $row['weight'] . "</td>";
                echo "<td><img src='uploaded/img/" . $row['image'] . "' alt='Image' width='100'></td>";
                echo "<td><a href='?edit_id=" . $row['p_id'] . "'><button>Edit</button></a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Handle the form when Edit button is clicked
    if (isset($_GET['edit_id'])) {
        $edit_id = $_GET['edit_id'];
        $sql = "SELECT * FROM product WHERE p_id='$edit_id'";
        $result = mysqli_query($con, $sql);
        $product = mysqli_fetch_assoc($result);
    ?>
        <div class="form-container">
            <h2>Edit Product</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="p_id" value="<?php echo $product['p_id']; ?>" required>
                <input type="hidden" name="existing_image" value="<?php echo $product['image']; ?>">
                
                <label>Product Name:</label>
                <input type="text" name="p_name" value="<?php echo $product['p_name']; ?>" required><br>

                <label>Product Price:</label>
                <input type="number" name="p_price" value="<?php echo $product['p_price']; ?>" required><br>

                <label>Product Category:</label>
                <input type="text" name="p_category" value="<?php echo $product['p_category']; ?>" required><br>

                <label>Product Image (optional):</label>
                <input type="file" name="img"><br>
                <img src="uploaded/img/<?php echo $product['image']; ?>" alt="Product Image" width="100"><br>

                <label>Product Weight:</label>
                <select name="kg" required>
                    <option value="1kg" <?php echo ($product['weight'] == '1kg' ? 'selected' : ''); ?>>1kg</option>
                    <option value="2kg" <?php echo ($product['weight'] == '2kg' ? 'selected' : ''); ?>>2kg</option>
                    <option value="3kg" <?php echo ($product['weight'] == '3kg' ? 'selected' : ''); ?>>3kg</option>
                    <option value="4kg" <?php echo ($product['weight'] == '4kg' ? 'selected' : ''); ?>>4kg</option>
                    <option value="5kg" <?php echo ($product['weight'] == '5kg' ? 'selected' : ''); ?>>5kg</option>
                    <option value="100g" <?php echo ($product['weight'] == '100g' ? 'selected' : ''); ?>>100g</option>
                    <option value="200g" <?php echo ($product['weight'] == '200g' ? 'selected' : ''); ?>>200g</option>
                    <option value="300g" <?php echo ($product['weight'] == '300g' ? 'selected' : ''); ?>>300g</option>
                    <option value="400g" <?php echo ($product['weight'] == '400g' ? 'selected' : ''); ?>>400g</option>
                    <option value="500g" <?php echo ($product['weight'] == '500g' ? 'selected' : ''); ?>>500g</option>
                    <option value="1 piece" <?php echo ($product['weight'] == '1 piece' ? 'selected' : ''); ?>>1 piece</option>
                    <option value="2 piece" <?php echo ($product['weight'] == '2 piece' ? 'selected' : ''); ?>>2 piece</option>
                    <option value="3 piece" <?php echo ($product['weight'] == '3 piece' ? 'selected' : ''); ?>>3 piece</option>
                </select><br><br>

                <button type="submit" name="submit">Update Product</button><br><br><br>
            </form>
        </div>
    <?php } ?>
</div>


</body>
</html>