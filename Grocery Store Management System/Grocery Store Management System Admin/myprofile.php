<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            background-image: url('picture/or.jpg'); /* Set your image path here */
            background-size: cover; /* Ensures the image covers the entire background */
            background-position: center; /* Centers the background image */
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .profile-header h1 {
            color: blue; /* Changes 'HARSH SHARMA' text to blue */
        }

        .profile-header p {
            font-size: 16px;
            color: #000; /* Changes the text color to dark black */
        }

        .profile-header img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
        }

        .profile-details {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
            font-size: 16px;
        }

        .profile-details div {
            margin-bottom: 10px;
        }

        .profile-details strong {
            color: #007bff;
        }

        .profile-details p {
            color: #555;
        }

      
    </style>
</head>
<body>

<div class="container">
    <div class="profile-header">
        <!-- Add your image URL below -->
        <img src="picture/my.jpg" alt="Profile Picture">
        <h1>HARSH SHARMA </h1>
        <p>Short Bio or Introduction (e.g., Business owner, passionate about Groceries, etc.)</p>
    </div>

    <div class="profile-details">
        <div>
            <strong>Contact:</strong>
        </div>
        <div>
            <p><font color="blue">Email:</font> <span style="color: #000;">sharmaharsh0702@gmail.com</span></p>
            <p><font color="blue">Phone: </font> <span style="color: #000;">+91 9016582212</span></p>
        </div>

        <div>
            <strong>Location:</strong>
        </div>
        <div>
            <p><span style="color: #000;">Vadodara, India</span></p>
        </div>

        <div>
            <strong>Business:</strong>
        </div>
        <div>
            <p><font color="#000;">Grocery Supplier Business</front></p>
        </div>
    </div>

    
</div>

</body>
</html>
