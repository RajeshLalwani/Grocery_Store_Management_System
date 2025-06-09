<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Grocery Store</title>
    <style>
       	body {
    font-family: Arial, sans-serif;
    background-color: #f0f8ff;
    color: #333;
    padding: 0px;
    background-image: url('picture/bk.jpg'); /* Replace with the path to your image */
    background-size: cover; /* This makes the image cover the entire background */
    background-position: center; /* This centers the image */
    background-attachment: fixed; /* Keeps the background fixed while scrolling */
}
        .container {
            max-width: 1000px;
            margin: 100px auto;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 80px;
            border-radius: 100px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        h2 { text-align: center; color: #007bff; }
        .contact-info { display: flex; justify-content: space-around; margin-bottom: 30px; }
        .contact-info div { text-align: center; }
        .contact-info i { font-size: 30px; color: #007bff; margin-bottom: 10px; }
        .contact-info p { font-size: 16px; color: #333; }
        .map-container { margin-top: 20px; text-align: center; }
        iframe { width: 100%; height: 350px; border: 0; border-radius: 10px; }
   

	
       
    </style>
</head>
<body>
    <?php 
    session_start();
    include("index1.php");
    ?>
<center>
<div class="container">
    
    <h2>Contact Us</h2>
    <div class="contact-info">
        <div><i class="fas fa-envelope"></i><p><strong>Email:</strong> sharmaharsh0702@gmail.com</p></div>
        <div><i class="fas fa-phone-alt"></i><p><strong>Phone:</strong> +91 9016582212 </p></div>
    </div>
    
    <!-- Google Map Embed for Bajwa, Vadodara -->
    <div class="map-container">
        <h2>Our Location</h2>
   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14758.333610128922!2d73.12742275306987!3d22.36935382418891!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395fc99d5b3a17d1%3A0x2345a61ac659ffa1!2sBajwa%2C%20Vadodara%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1738137152155!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div></center><br><br><br><br><br><br>

    <div class="footer" id="footer">
        <div class="foot-container">
            <div class="foot">
                <h2>Feedback</h2>
              <a href="f.php"><font color="orange">Give Feedback</font></a>
            </div>
        </div>
        
    </div>
<br><br><br>

</body>
</html>
