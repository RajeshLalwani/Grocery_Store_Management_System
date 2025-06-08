<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['a_id'])) {
    echo "<script>alert('Please log in as admin to manage orders.'); window.location.href='adminlogin.php';</script>";
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

  <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            color: #0047ab;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #0047ab;
        }

        input[type="text"], 
        input[type="number"], 
        input[type="file"], 
        button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #0047ab;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #003580;
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
    </style>



</head>
<body>
	<?php include("index.php"); ?>
    <h2>Add Product</h2>
    <form action="addpro.php" method="POST" enctype="multipart/form-data">
       
        
        <label>Product Name:</label>
        <input type="text" name="p_name" required><br>        
        <label>Product Price:</label>
        <input type="number" name="p_price" required><br>        
        <label>Product Category:</label>
        <input type="text" name="p_category" required><br>
        
        <label>Product Image:</label>
        <input type="file" name="img" required><br>

           
                <select name="kg" class="weight" >
                    <option value="1kg" id="1">  1kg  </option>
		    <option value="2kg" id="1">  2kg  </option>
		    <option value="3kg" id="1">  3kg  </option>
	       	    <option value="4kg" id="1">  4kg  </option> 
	            <option value="5kg" id="1">  5kg  </option> 
			
                    <option value="100g" id="2"> 100g  </option>
		 
		  <option value="200g" id="2"> 200g  </option>
		  <option value="300g" id="2"> 300g  </option>
	          <option value="400g" id="2"> 400g  </option>
 		  <option value="500g" id="2"> 500g  </option>
		 <option value="1 piece" id="2"> One  piece  </option>
		<option value="2 piece" id="2"> two  piece  </option>
		<option value="3 piece" id="2"> three  piece  </option>
 		  <option value="500g" id="2"> 500g  </option>
                </select>
                <label>Product weight</label><br><br>
          

        <button type="submit" name="submit">Add Product</button>
    </form>

</body>
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grocery store";

// Database connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_category = $_POST['p_category'];
    $imgName = $_FILES['img']['name'];
    $imgTmpName = $_FILES['img']['tmp_name'];

    // Save image in the folder
    $uploadDir = "uploaded/img/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $imgPath = $uploadDir . $imgName;
    move_uploaded_file($imgTmpName, $imgPath);
	    $weight= $_POST['kg'];

    // Insert product details into the database
    $sql = "INSERT INTO product (p_name, p_price, p_category, image,weight) VALUES ('$p_name', '$p_price', '$p_category', '$imgName','$weight')";

    if ($con->query($sql) === TRUE) {
      echo '<script>alert("Product Add Successfully")</script>';
        echo '<script type="text/JavaScript"> window.location = "displayproduct.php" </script>';
	

    }else{
        
        echo '<script>alert("data deleted failed")</script>';

    }
}

$con->close();
?>

  
    

