<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Krishna Grocery</title>
    <style>
        
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('picture/bk.jpg'); /* Replace with your image path */
            background-size: cover; /* Ensures the image covers the entire page */
            background-position: center; /* Centers the image */
            background-attachment: fixed; /* Keeps the image fixed when scrolling */
            color: #333;
        }


        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: blue; 
            color: blue;
        }

.navbar .logo h3 {
    margin: 0;
    color:white; 
}


        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            font-size: 16px;
            transition: color 0.3s;
        }

        .navbar a:hover {
            color: #caf0f8; 
        }

      
        .main {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }

       .main .solgan h1 {
    font-size: 2.5rem;
    line-height: 1.4;
    color: blue; 
}


        .main .image img {
            border-radius: 30%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Footer Section */
        .footer {
            background-color: #0077b6; /* Deep blue */
            color: #fff;
            padding: 20px 0;
            margin-top: 40px;
        }

        .foot-container {
            display: flex;
            justify-content: space-around;
            padding: 0 20px;
        }

        .foot h2 {
            margin-bottom: 10px;
        }

        /* Footer Link Styling */
        .footer a {
            color: #0077b6; /* Deep blue */
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: orange; 
        }

        .copy-right {
            text-align: center;
            margin-top: 20px;
        }

        .copy-right img {
            width: 15px;
            height: auto;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main {
                flex-direction: column;
                text-align: center;
            }

            .foot-container {
                flex-direction: column;
                align-items: center;
            }

        }
    </style>
</head>

<body>

    <!-- Navbar Section -->
    <div class="navbar">
        <div class="logo">
            <a href="index.php"><h3>Krishna Grocery</h3></a>

        </div>
        <div class="nav-element">
            <a href="index.php">Home</a>
            <a href="fruit1.php">Product List</a>
            <a href="contact.php">Contact Us</a>
            <a href="checkout.php">Cart</a>
	<a href="order_history.php">Order</a>
	<a href="myprofile.php">My Profile</a>
        <?php
           session_start();
            if (!isset($_SESSION['c_id']) || empty($_SESSION['c_id'])) 
            {
                echo"<a href=\"clogin.php\">Login/SignUp</a>";                
            }

            if (isset($_SESSION['c_id']) || !empty($_SESSION['c_id'])) 
            {
                echo"<a href=\"logout.php\">Logout</a>";
            }
            
            //echo"<a href=\"clogin.php\">Login/SignUp</a>";
            //echo"<a href=\"logout.php\">Logout</a>";
            ?>
        </div>
    </div>

    <!-- Main Section -->
    <div class="main" id="c1">
        <div class="solgan">
            <h1>Welcome To My Shop</h1>
        </div>
        <div class="image">
            <img src="picture/apple.jpg" class="img-shadow" height="400px" alt="main page image">
        </div>
    </div>

    <?php include("fruits.php"); ?><br><br><br><br><br><br>

    <div class="footer" id="footer">
        <div class="foot-container">
            <div class="foot">
                <h2>Feedback</h2>
                <a href="f.php"><font color="orange">Give Feedback</font></a>
            </div>
        </div>
    </div>

</body>

</html>
