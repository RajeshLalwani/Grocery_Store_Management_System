<?php
// Database connection
$con = mysqli_connect('localhost', 'root', '', 'grocery store');

if (!$con) {
    die("Something went wrong");
}

session_start();

if (isset($_POST['sub'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phoneno = mysqli_real_escape_string($con, $_POST['phone']);

    // Check if fields are empty
    if (empty($name) || empty($phoneno)) {
        $_SESSION['error'] = "❌ Email and Password cannot be blank.";
        header("Location: adminlogin.php");
        exit();
    }

    // Check for valid email format
    if (!filter_var($name, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "❌ Invalid Email Format!";
        header("Location: adminlogin.php");
        exit();
    }

    // Check if email and password match
    $sql = "SELECT * FROM admin WHERE a_email = '$name' AND a_password = '$phoneno'";
    $res = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_array($res)) {
        // Successful login
        $_SESSION['a_id'] = $row['a_id']; 
        $_SESSION['aname'] = $row['a_name']; 
        header("Location: adminhome.php");
        exit();
    } else {
        // Incorrect email or password
        $_SESSION['error'] = "❌ Incorrect Email or Password.";
        header("Location: adminlogin.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .login-container h2 {
            text-align: center;
            color: #4e54c8;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            border: none;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #3a42a8, #7b84db);
        }

        .alert {
            margin-bottom: 20px;
        }

        .form-label {
            color: #4e54c8;
            font-weight: bold;
        }

        .form-control:focus {
            border-color: #4e54c8;
            box-shadow: 0 0 10px rgba(78, 84, 200, 0.5);
        }

        #showPassword {
            cursor: pointer;
            color: #4e54c8;
        }

        .error-msg {
            color: red;
            font-size: 14px;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <div id="response">
            <?php 
                                if(isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger">❌ '.htmlspecialchars($_SESSION['error']).'</div>';
                    unset($_SESSION['error']);
                }
            ?>
        </div>
        <form method="POST" action="adminlogin.php" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="email" class="form-label">Id</label>
                <input type="text" class="form-control" id="email" name="name" placeholder="Enter your email">
                <div class="error-msg" id="emailError"></div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="phone" placeholder="Enter your password">
                <div class="error-msg" id="passwordError"></div>
                <small id="showPassword" onclick="togglePassword()">Show Password</small>
            </div>

            <button type="submit" name="sub" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <script>
        function validateForm() {
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let emailError = document.getElementById('emailError');
            let passwordError = document.getElementById('passwordError');

            emailError.innerText = "";
            passwordError.innerText = "";

            let valid = true;
// Email format validation
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                emailError.innerText = "Invalid email format.";
                valid = false;
            }
            if (email === "") {
                emailError.innerText = "Id cannot be blank.";
                valid = false;
            }

            if (password === "") {
                passwordError.innerText = "Password cannot be blank.";
                valid = false;
            }

            return valid;
        }

        function togglePassword() {
            let password = document.getElementById('password');
            if (password.type === 'password') {
                password.type = 'text';
            } else {
                password.type = 'password';
            }
        }
    </script>
</body>
</html>
