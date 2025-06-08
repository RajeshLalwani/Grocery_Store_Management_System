<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['a_id'])) {
    echo "<script>alert('Please log in as admin to manage orders.'); window.location.href='adminlogin.php';</script>";
    exit();
}
?>

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

// Query to fetch all feedback
$sql = "SELECT * FROM review"; // Ordering feedback by date (newest first)
$result = $conn->query($sql);

// Check if feedback is deleted
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete feedback from the database
    $delete_sql = "DELETE FROM review WHERE feedback_id = '$delete_id'";

    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Feedback deleted successfully'); window.location.href='feedback.php';</script>";
    } else {
        echo "<script>alert('Error deleting feedback: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    
    <!-- Custom Styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 20px;
        }

        .navbar {
            background-color: #0077b6;
            padding: 10px;
            color: white;
        }

        .navbar h3 {
            text-align: center;
            width: 100%;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #0077b6;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .delete-btn {
            background-color: #ff4d4d;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .delete-btn:hover {
            background-color: #e60000;
        }
    </style>
</head>
<body>
    <?php include("index.php");?>

    <!-- Admin Navbar -->
    <div class="navbar">
       <h3 colr>Customer Feedbacks</h3>
    </div>

    <br><br><br>

    <!-- DataTable -->
    <table id="feedbackTable" class="display">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Feedback</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are any feedback records
            if ($result->num_rows > 0) {
                // Output each feedback record
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['c_name'] . "</td>
                            <td>" . $row['c_feedback'] . "</td>
                            <td>" . $row['c_email'] . "</td>
                            <td><a href='feedback.php?delete_id=" . $row['feedback_id'] . "' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this feedback?\")'>Delete</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No feedback available</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('#feedbackTable').DataTable({
                "paging": true,               // Enable pagination
                "searching": true,            // Enable searching
                "ordering": true,             // Enable sorting
                "info": true,                 // Display info about records
                "lengthChange": false,        // Disable option to change the page length
                "language": {
                    "search": "Search: ",     // Custom search placeholder
                    "lengthMenu": "Show MENU entries", // Custom pagination text
                    "zeroRecords": "No matching records found" // No records message
                }
            });
        });
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
