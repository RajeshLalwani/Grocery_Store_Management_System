<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Grocery Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .contact-info {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
        }

        .contact-info div {
            text-align: center;
        }

        .contact-info i {
            font-size: 30px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .contact-info p {
            font-size: 16px;
            color: #555;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-size: 16px;
        }

        input, textarea {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            height: 150px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Contact Us</h2>
    
    <!-- Contact Info Section (Email & Phone) -->
    <div class="contact-info">
        <div>
            <i class="fas fa-envelope"></i>
            <p><strong>Email:</strong> info@grocerystore.com</p>
        </div>
        <div>
            <i class="fas fa-phone-alt"></i>
            <p><strong>Phone:</strong> +123 456 7890</p>
        </div>
    </div>

    <!-- Contact Form -->
    <form method="POST" action="contact.php">
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Your Message:</label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</div>

</body>
</html>
