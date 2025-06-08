<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #0047ab;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #0047ab;
            color: white;
        }

        table td img {
            max-width: 100px;
            border-radius: 4px;
        }

        .message {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include("index.php"); ?>

    <div class="container table-responsive">
        <h2>Product List</h2>
        <table id="productTable">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Weight</th>
                    <th>Image</th>
                </tr>
            </thead>

            <tbody>
                <?php
                // Database connection
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "grocery store";

                $con = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($con->connect_error) {
                    die("Connection failed: " . $con->connect_error);
                }

                // Fetch products
                $sql = "SELECT * FROM product";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['p_id']}</td>
                                <td>{$row['p_name']}</td>
                                <td>{$row['p_price']}</td>
                                <td>{$row['p_category']}</td>
                                <td>{$row['weight']}</td>
                                <td><img src='uploaded/img/{$row['image']}' alt='Product Image'></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='message'>No products found</td></tr>";
                }

                $con->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize DataTables with search and pagination enabled
            $('#productTable').DataTable({
                paging: true,
                searching: true
            });
        });
    </script>
</body>
</html>
