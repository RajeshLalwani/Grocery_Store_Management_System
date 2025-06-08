<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['a_id'])) {
    echo "<script>alert('Please log in as admin to manage orders.'); window.location.href='adminlogin.php';</script>";
    exit();
}
?>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "grocery store"; 

$con = new mysqli($servername, $username, $password, $dbname);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// **🔹 DELETE FUNCTIONALITY**
if (isset($_GET["delete_id"])) {
    $delete_id = $_GET["delete_id"];

    // Step 1: Delete related orders first
    $delete_orders_sql = "DELETE FROM orders WHERE c_id = ?";
    $order_stmt = $con->prepare($delete_orders_sql);
    $order_stmt->bind_param("i", $delete_id);
    $order_stmt->execute(); // Delete orders first
    $order_stmt->close();

    // Step 2: Now delete the customer
    $delete_customer_sql = "DELETE FROM customer WHERE c_id = ?";
    $stmt = $con->prepare($delete_customer_sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "<script>alert('Customer and related orders deleted successfully!'); window.location.href='customerregistert.php';</script>";
    } else {
        die("Error executing query: " . $stmt->error);
    }

    $stmt->close();
}

// **🔹 SEARCH FUNCTIONALITY**
$search_query = "";
if (isset($_GET["search"])) {
    $search_query = $_GET["search"];
    $sql = "SELECT * FROM customer WHERE c_name LIKE ? OR c_email LIKE ?";
    $search_value = "%" . $search_query . "%";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $search_value, $search_value);
} else {
    $sql = "SELECT * FROM customer";
    $stmt = $con->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .container { margin-top: 30px; }
        .table th, .table td { text-align: center; vertical-align: middle; }
    </style>
</head>
<body><?php include("index.php");?>
    <div class="container">
        <h2 class="text-center mb-4">Customer List</h2>

        <!-- 🔹 Search Form -->
        <form method="GET" class="mb-3 d-flex">
            <input type="text" class="form-control me-2" name="search" placeholder="Search by Name or Email" value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row["c_id"]; ?></td>
                        <td><?php echo $row["c_name"]; ?></td>
                        <td><?php echo $row["c_email"]; ?></td>
                        <td><?php echo $row["c_phoneno"]; ?></td>
                        <td><?php echo $row["c_address"]; ?></td>
                        <td>
                            <a href="customerregistert.php?delete_id=<?php echo $row['c_id']; ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this customer?');">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $stmt->close(); $con->close(); ?>
