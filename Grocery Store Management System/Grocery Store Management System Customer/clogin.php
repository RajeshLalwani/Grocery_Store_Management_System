<?php
// Start the session to store user information
session_start();

// Database connection
$con = mysqli_connect('localhost', 'root', '', 'grocery store');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['sub'])) {
    // Get email and password from the form
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // SQL query to fetch user data based on email and password
    $sql = "SELECT * FROM customer WHERE c_email= '$email' AND c_password= '$pass'";

    // Execute the query
    $res = mysqli_query($con, $sql);

    // Check if the user exists
    if ($row = mysqli_fetch_array($res)) {
        // Set session variables
        $_SESSION['c_id'] = $row['c_id']; 
        $_SESSION['username'] = $row['c_name'];
        $_SESSION['usemail'] = $row['c_email'];
        // Redirect to the homepage
        header("Location: index.php");
        exit(); // Ensure no further code is executed
    } else {
        // If login fails, show error message
        $error = "Login failed: Incorrect email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('picture/ob.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-label {
            font-weight: bold;
        }
        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Customer Login</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter your password" required>
            </div>
            <button type="submit" name="sub" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3">
            <p>Don't have an account? <a href="c_register1.php" class="text-primary">Register here</a></p>
            <p><a href="forgot_password.php" class="text-primary">Forgot password</a></p>

        </div>
    </div>
</body>
</html>
