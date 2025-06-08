<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <form action="admin_register.php" method="POST">
            <h2>Login</h2>
            
            <div class="input-field">
                <input type="email" name="a_email" required>
                <label>Enter your email</label>
            </div>
            
            <div class="input-field">
                <input type="password" name="a_password" required>
                <label>Enter your password</label>
            </div>
            
            <div class="forget">
                <!-- Optional: <a href="#">Forgot password?</a> -->
            </div>3

            <input type="submit" name="submit" value="Login" class="button" />
        </form>
    </div>
</body>
</html>

<?php
$servername = "localhost"; // Server name
$username = "root";        // MySQL username
$password = "";            // MySQL password
$dbname = "ct";      // Database name

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get email and password from the form
    $a_email = $_POST['a_email'];
    $a_password = $_POST['a_password'];

    // SQL query to fetch user data
    $sql = "SELECT * FROM adminregister WHERE a_email = '$a_email' AND a_password = '$a_password'";
    
    // Execute the query
    $res = mysqli_query($con, $sql);

    // Check if the user exists
    if ($row = mysqli_fetch_array($res)) {
        // If user exists, print success message and redirect
      
      
    } else {
        // If no matching record is found*   
	    echo 'Login failed: Incorrect email or password';
    }
	  header("Location: index.html"); // Redirect to the display page
        exit(); // Ensure no further code is executed
}
?>