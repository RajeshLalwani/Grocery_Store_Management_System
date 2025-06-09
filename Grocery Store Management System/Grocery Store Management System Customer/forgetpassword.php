<?php
session_start();
// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'grocery store');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['send_otp'])) {
        // Step 1: Send OTP
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        // Check if email exists
        $query = "SELECT * FROM customer WHERE c_email='$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Generate OTP
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $email;

            // Send OTP via Email
            $to = $email;
            $subject = "Verification Code to Reset Password at Krishna Grocery.";
            $message = "Your Verification Code to Reset Password is: " . $otp ;
            $headers = "From: noreply@yourdomain.com";
            mail($to, $subject, $message, $headers);

            echo "<script>alert('OTP Sent! Check your email.'); window.location.href='forgot_password.php?step=verify';</script>";
        } else {
            echo "<script>alert('Email not found!');</script>";
        }
    } elseif (isset($_POST['verify_otp'])) {
        // Step 2: Verify OTP
        $entered_otp = $_POST['otp'];

        if ($entered_otp == $_SESSION['otp']) {
            echo "<script>alert('OTP Verified!'); window.location.href='forgot_password.php?step=reset';</script>";
        } else {
            echo "<script>alert('Invalid OTP!');</script>";
        }
    } elseif (isset($_POST['reset_password'])) {
        // Step 3: Reset Password
        $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_SESSION['email'];

        // Update password in database
        $query = "UPDATE customer SET c_password='$new_password' WHERE c_email='$email'";
        mysqli_query($conn, $query);

        // Destroy session variables
        session_unset();
        session_destroy();

        echo "<script>alert('Password Reset Successfully!'); window.location.href='clogin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
</head>
<body>
    <?php if (!isset($_GET['step'])) { ?>
        <!-- Step 1: Enter Email -->
        <h2>Forgot Password</h2>
        <form method="POST">
            <label>Email:</label>
            <input type="email" name="email" required>
            <button type="submit" name="send_otp">Send OTP</button>
        </form>

    <?php } elseif ($_GET['step'] == "verify") { ?>
        <!-- Step 2: Verify OTP -->
        <h2>Enter OTP</h2>
        <form method="POST">
            <input type="text" name="otp" required>
            <button type="submit" name="verify_otp">Verify</button>
        </form>

    <?php } elseif ($_GET['step'] == "reset") { ?>
        <!-- Step 3: Reset Password -->
        <h2>Reset Password</h2>
        <form method="POST">
            <label>New Password:</label>
            <input type="password" name="password" required>
            <button type="submit" name="reset_password">Reset Password</button>
        </form>
    <?php } ?>
</body>
</html>
