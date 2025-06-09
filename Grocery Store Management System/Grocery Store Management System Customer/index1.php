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
            background-image: url('picture/bk.jpg'); 
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed; 
            color: #333;
        }


        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #0077b6; 
            color: #fff;
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
            color: #caf0f8; /* Light blue hover effect */
        }

        /* Main Section Styling */
        .main {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            flex-grow: 1; 
        }

        .main .solgan h1 {
            font-size: 2.5rem;
            line-height: 1.4;
            color: #0077b6;        }

        .main .image img {
            border-radius: 30%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Footer Section */
        .footer {
            background-color: #0077b6;
            color: #fff;
            padding: 20px 0;
            margin-top: auto;        }

        .foot-container {
            display: flex;
            justify-content: space-around;
            padding: 0 20px;
        }

        .foot h2 {
            margin-bottom: 10px;
        }

               .footer a {
            color: #0077b6; 
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: orange;         }

        .copy-right {
            text-align: center;
            margin-top: 20px;
        }

        .copy-right img {
            width: 15px;
            height: auto;
        }

       
        @media (max-width: 768px) {
            .main {
                flex-direction: column;
                text-align: center;
            }

            .foot-container {
                flex-direction: column;
                align-items: center;
            }

            .footer {
                padding: 15px 0;
            }
        }
	
    </style>
</head>

<body>

   
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
           //session_start();
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
            <!--<a href="clogin.php">Login/SignUp</a>
            <a href="logout.php">Logout</a>-->
        </div>
    </div>

   
    

</body>

</html>
