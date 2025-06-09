<?php
// Database connection
$servername = "localhost"; // Replace with your server name
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "grocery store"; // Replace with your database name (without spaces)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $feedback = htmlspecialchars($_POST['feedback']);
    
    // Insert the data into the 'review' table
    $sql = "INSERT INTO review (c_name, c_feedback, c_email) VALUES ('$name', '$feedback','$email')";
    
    if ($conn->query($sql) === TRUE) {
        // JavaScript to show feedback in a pop-up message
        echo "<script>
                alert('Thank you, " . $name . "! Your feedback has been received. Feedback: " . $feedback . "');
                window.location.href = 'index.php'; // Redirect to the same page (or any page you prefer)
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocery Store Feedback</title>
    <style>
        /* Set the background image */
        body {
            background-image: url('picture/ob.jpg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Container for centering content */
        .container {
            background-color: white; /* White background for form */
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Heading styles */
        h2 {
            color: #1E3D58; /* Blue color */
            font-size: 26px;
            margin-bottom: 20px;
        }

        /* Label and input fields */
        label {
            font-weight: bold;
            color: #1E3D58; /* Blue color */
            display: block;
            margin-top: 15px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px 0;
            border: 2px solid #1E3D58; /* Blue border */
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
        }

        /* Button style */
        button {
            background-color: #1E3D58; /* Blue color */
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
        }

        button:hover {
            background-color: #15436d; /* Darker blue on hover */
        }

        /* Form styling */
        form {
            display: flex;
            flex-direction: column;
        }

        /* Paragraph styling */
        p {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
        }

    </style>
</head>
<body>
<?php include("index1.php");?>
    
    <div class="container">
        <h2>Grocery Store - Customer Feedback</h2>
        <form action="f.php" method="POST">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="feedback">Your Feedback:</label>
            <textarea id="feedback" name="feedback" rows="4" required></textarea>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
<?php
}

// Close the database connection
$conn->close();
?>