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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c_name = mysqli_real_escape_string($conn, $_POST['c_name']);
    $c_email = mysqli_real_escape_string($conn, $_POST['c_email']);
    $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);
    $c_confirmpassword = mysqli_real_escape_string($conn, $_POST['c_confirmpassword']);
    $c_phone = mysqli_real_escape_string($conn, $_POST['c_phone']);
    $c_address = mysqli_real_escape_string($conn, $_POST['c_address']);

    // **Password & Confirm Password Match Check**
    if ($c_password !== $c_confirmpassword) {
        echo "<script>alert('Passwords do not match!'); window.location.href = 'c_register1.php';</script>";
        exit();
    }

    // **Check if Email already exists**
    $check_email = "SELECT * FROM customer WHERE c_email = '$c_email'";
    $result = $conn->query($check_email);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered! Please use another email.'); window.location.href = 'c_register1.php';</script>";
        exit();
    }

    // **Insert Query**
    $sql = "INSERT INTO customer (c_name, c_email, c_password, c_phoneno, c_address) 
            VALUES ('$c_name', '$c_email', '$c_password', '$c_phone', '$c_address')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration Successful!'); window.location.href = 'clogin.php';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <style>
        body {
            background: url('picture/ob.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .wrapper {
            max-width: 800px;
            background: rgba(290, 290, 290, 0.9);
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            color: blue;
        }
        .input-field {
            margin-bottom: 15px;
        }
        .input-field label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .input-field input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .button {
            width: 100%;
            padding: 10px;
            background: blue;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        .button:hover {
            background: darkblue;
        }
        .register {
            text-align: center;
            margin-top: 10px;
        }
        .register a {
            color: blue;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <form action="c_register1.php" method="POST" onsubmit="return validateForm()">
            <h2>Customer Registration</h2>

            <div class="input-field">
                <label>Name</label>
                <input type="text" name="c_name" id="name">
                <div class="error" id="nameError"></div>
            </div>

            <div class="input-field">
                <label>Email</label>
                <input type="email" name="c_email" id="email">
                <div class="error" id="emailError"></div>
            </div>

            <div class="input-field">
                <label>Password</label>
                <input type="password" name="c_password" id="password">
                <div class="error" id="passwordError"></div>
            </div>

            <div class="input-field">
                <label>Confirm Password</label>
                <input type="password" name="c_confirmpassword" id="confirmpassword">
                <div class="error" id="confirmpasswordError"></div>
            </div>

            <div class="input-field">
                <label>Phone No.</label>
                <input type="number" name="c_phone" id="phone">
                <div class="error" id="phoneError"></div>
            </div>

            <div class="input-field">
                <label>Address</label>
                <input type="text" name="c_address" id="address">
                <div class="error" id="addressError"></div>
            </div>

            <input type="submit" name="submit" value="Register" class="button"/>
            <div class="register">
                <p>Already have an account? <a href="clogin.php">Login</a></p>
            </div>
        </form>
    </div>

<script>
function validateForm() {
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let confirmpassword = document.getElementById("confirmpassword").value;
    let phone = document.getElementById("phone").value;
    let address = document.getElementById("address").value;
    let valid = true;

    // Clear all errors
    document.querySelectorAll(".error").forEach(e => e.innerHTML = "");

    // Name validation (no special characters)
    let nameRegex = /^[a-zA-Z][a-zA-Z ]*$/;
    if (!nameRegex.test(name)) {
        document.getElementById("nameError").innerHTML = "Name must start with a letter.";
        valid = false;
    }

    // Email validation
    let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z]+\.[a-zA-Z]{2,4}$/;
    if (!emailRegex.test(email)) {
        document.getElementById("emailError").innerHTML = "Enter a valid email.";
        valid = false;
    }

    // Password length
    if (password.length < 6) {
        document.getElementById("passwordError").innerHTML = "Password must be 6 characters.";
        valid = false;
    }

    // Confirm password
    if (confirmpassword != password) {
        document.getElementById("confirmpasswordError").innerHTML = "Password does not match.";
        valid = false;
    }

    // Phone number
    if (phone.length != 10) {
        document.getElementById("phoneError").innerHTML = "Phone must be 10 digits.";
        valid = false;
    }

    return valid;
}
</script>
</body>
</html>
