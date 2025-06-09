<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $otpEntered = $_POST['otp'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($otpEntered == $_SESSION['otp'] && $newPassword == $confirmPassword) {
        // Update password in the database
        include 'config.php'; // Your database connection
        $email = $_SESSION['email'];

        // Store password without hashing (NOT RECOMMENDED)
        $query = "UPDATE customer SET c_password = ? WHERE c_email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $newPassword, $email); // Directly store plain password
        $stmt->execute();

        echo "<div class='success'>Password updated successfully!</div>";
    } else {
        echo "<div class='error'>Invalid OTP or passwords do not match.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 50px;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            margin: auto;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: #e74c3c;
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .success {
            color: #28a745;
            background-color: #d4edda;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Reset Your Password</h2>

        <form method="POST" action="">
            <label for="otp">Enter OTP:</label>
            <input type="text" name="otp" required>

            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" required>

            <button type="submit">Submit</button>
              <center>
                <br/>
            <a href="clogin.php" style="content-align:center">Back to Login</a>
              </center>
        </form>
    </div>

</body>
</html>
