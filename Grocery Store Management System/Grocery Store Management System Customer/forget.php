<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the database
    include 'config.php'; // Your database configuration file
    $query = "SELECT * FROM users WHERE c_email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate OTP
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;
        
        // Send OTP via email
        $subject = "Your OTP for Password Reset";
        $message = "Your OTP for password reset is: " . $otp;
        $headers = "From: no-reply@yourdomain.com";

        // Send OTP email
        if(mail($email, $subject, $message, $headers)) {
            header("Location: otp_verification.php");
        } else {
            echo "Failed to send OTP. Try again later.";
        }
    } else {
        echo "Email not found in our records.";
    }
}
?>

<!-- HTML Form to input Email -->
<form method="POST" action="">
    <label for="email">Enter your email to reset password:</label>
    <input type="email" name="email" required>
    <button type="submit">Send OTP</button>
</form>
