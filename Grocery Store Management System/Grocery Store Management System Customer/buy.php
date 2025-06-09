<?php
// Database credentials
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

session_start();

// Check if o_id is set and is a valid number
if (isset($_GET['o_id'])) {
    $o_id = $_GET['o_id'];

    // Debugging: Print the o_id to ensure it's being passed
    echo "o_id received: " . $o_id . "<br>";

    if (is_numeric($o_id)) {
        $_SESSION['pr'] = $o_id;

        // Prepare the SQL statement to fetch order details
        $sql = "SELECT * FROM `order` WHERE `o_id` = $o_id";
        $result = mysqli_query($con, $sql);

        // Check if the query returned a result
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the row from the result
            $row = mysqli_fetch_assoc($result);

            // Get order details
            $o_id = $row['o_id'];
            $p_id = $row['p_id'];
            $c_id = $row['c_id'];
            $order_detail = $row['order_detail'];
            $order_price = $row['order_price'];
            $order_quantity = $row['order_quantity'];

            // Prepare the SQL query to insert the order into the database
            $sq = "INSERT INTO `order` (`o_id`, `p_id`, `c_id`, `order_detail`, `order_price`, `order_quantity`) 
                   VALUES ('$o_id', '$p_id', '$c_id', '$order_detail', '$order_price', '$order_quantity')";

            // Execute the insert query
            $re = mysqli_query($con, $sq);

            // Check if the query was successful
            if ($re) {
                // Redirect to address.php
                header("Location: address.php");
                exit();
            } else {
                // Error inserting the order
                echo "Error inserting order: " . mysqli_error($con);
            }
        } else {
            // No order found with the given o_id
            echo "No order found with the given ID.";
        }
    } else {
        // Invalid o_id or not a number
        echo "Invalid order ID: $o_id is not a number.";
    }
} else {
    // Missing o_id in the URL
    echo "Missing order ID in the URL.";
}

// Close the database connection
$con->close();
?>
