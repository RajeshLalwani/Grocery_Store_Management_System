<?php
// Initialize message variables
$popup_message = "";
$popup_type = ""; // "success" or "error"

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "grocery store"; // Replace with your database name

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $p_detail = $_POST['p_detail'];
    $p_amount = $_POST['p_amount'];
    $p_type = "COD"; // Hardcoded "Cash on Delivery"

    // SQL query to insert payment (including payment type)
    $sql = "INSERT INTO `payment` (`p_detail`, `p_amount`, `p_type`) VALUES (?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sds", $p_detail, $p_amount, $p_type); // Bind parameters (string, decimal, string)

    // Execute the statement
    if ($stmt->execute()) {
        $popup_message = "Payment record added successfully. Payment ID: " . $stmt->insert_id;
        $popup_type = "success";
    } else {
        $popup_message = "Error: " . $stmt->error;
        $popup_type = "error";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash on Delivery Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #555555;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        // JavaScript function to display pop-up messages
        function showPopupMessage(message, type) {
            if (message) {
                alert((type === "success" ? "Success: " : "Error: ") + message);
            }
        }
    </script>
</head>
<body onload="showPopupMessage('<?php echo $popup_message; ?>', '<?php echo $popup_type; ?>')">
    <div class="container">
        <h1>Cash on Delivery Payment</h1>
        <form method="POST" action="">
            <label for="p_detail">Payment Detail:</label>
            <input type="text" id="p_detail" name="p_detail" required placeholder="Enter payment detail...">

            <label for="p_amount">Payment Amount:</label>
            <input type="number" id="p_amount" name="p_amount" step="0.01" required placeholder="Enter payment amount...">

            <button type="submit">Submit Payment</button>
        </form>
    </div>
</body>
</html>
