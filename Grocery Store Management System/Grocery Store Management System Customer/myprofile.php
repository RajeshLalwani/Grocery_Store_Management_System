<?php
session_start();

// Database connection
$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "grocery store";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// *Check if User is Logged In*
if (!isset($_SESSION['c_id'])) {
    echo "<script>alert('Please login first!'); window.location.href='clogin.php';</script>";
    exit();
}

// *Get Current User Data*
$c_id = $_SESSION['c_id'];
$query = "SELECT * FROM customer WHERE c_id='$c_id'";
$result = $conn->query($query);
$row = $result->fetch_assoc();

// *Handle Profile Update Form*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c_name = mysqli_real_escape_string($conn, $_POST['c_name']);
    $c_email = mysqli_real_escape_string($conn, $_POST['c_email']);
    $c_phone = mysqli_real_escape_string($conn, $_POST['c_phone']);
    $c_address = mysqli_real_escape_string($conn, $_POST['c_address']);

    // *Validation for phone and address*
    if (!preg_match("/^[0-9]{10}$/", $c_phone)) {
        echo "<script>alert('Invalid phone number! It must be 10 digits.');</script>";
    } elseif (empty($c_name) || empty($c_address)) {
        echo "<script>alert('Name and Address cannot be empty!');</script>";
    } else {
        // *Update Query*
        $updateQuery = "UPDATE customer SET 
            c_name='$c_name', 
            c_email='$c_email', 
            c_phoneno='$c_phone', 
            c_address='$c_address'
            WHERE c_id='$c_id'";

        if ($conn->query($updateQuery) === TRUE) 
        {
            echo "<script>alert('Profile Updated Successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "Error: " . $updateQuery . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e3f2fd;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #007bff;
        }
        input[type="text"], input[type="email"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        input[readonly] {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<?php include("index1.php");?>

<div class="container">
    <h2>My Profile</h2>
    <form action="myprofile.php" method="POST">
        <label>Name:</label>
        <input type="text" name="c_name" value="<?php echo $row['c_name']; ?>" required>

        <label>Email:</label>
        <input type="email" name="c_email" value="<?php echo $row['c_email']; ?>" readonly>

        <label>Phone:</label>
        <input type="number" name="c_phone" value="<?php echo $row['c_phoneno']; ?>" required>

        <label>Address:</label>
        <textarea name="c_address" required><?php echo $row['c_address']; ?></textarea>

        <button type="submit">Update Profile</button>
    </form>
</div>

</body>
</html>