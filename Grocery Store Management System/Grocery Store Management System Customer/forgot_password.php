<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the database
    include 'config.php'; // Include your database connection
    $query = "SELECT * FROM customer WHERE c_email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate OTP
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        // Send OTP via PHPMailer's SMTP server
        $subject = "Your OTP for Password Reset";
        $message = "Your OTP for password reset is: " . $otp;
        
        // Send OTP email using PHPMailer
        if (sendEmail($email, $subject, $message)) {
            header("Location: otp_verification.php");
        } else {
            echo "Failed to send OTP. Try again later.";
        }
    } else {
        echo "Email not found in our records.";
    }
}

function sendEmail($to, $subject, $message) {
    // Include PHPMailer files
    require 'PHPMailer-master/src/PHPMailer.php';   // PHPMailer class
    require 'PHPMailer-master/src/SMTP.php';         // SMTP class
    require 'PHPMailer-master/src/Exception.php';   // Exception class

    // Create a new PHPMailer instance
    $mail = new PHPMailer\PHPMailer\PHPMailer;

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'rajlalwani511@gmail.com'; // Your Gmail address
        $mail->Password = 'sbby jptb faaz buth'; // Your Gmail App password (if using 2FA)
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient info
        $mail->setFrom('sharmaharsh0702@gmail.com', 'Grocery Store');
        $mail->addAddress($to); // Recipient email

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        // Send email
        if ($mail->send()) {
            return true;
        } else {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
?>

<!-- HTML Form for Email Submission -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        padding: 50px;
    }
    form {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        margin: 0 auto;
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ddd;
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
</style>

<form method="POST" action="">
    <label for="email">Enter your email to Reset Password:</label>
    <input type="email" name="email" placeholder="Enter Your Email here"required>
    <button type="submit">Send OTP</button>

    <center>
            <br/>
            <a href="clogin.php" style="content-align:center">Back to Login</a>
    </center>
</form>
