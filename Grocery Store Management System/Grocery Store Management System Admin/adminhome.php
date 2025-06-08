<html>
<body>
<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['a_id'])) {
    echo "<script>alert('Please log in as admin to manage orders.'); window.location.href='adminlogin.php';</script>";
    exit();
}
?>
<?php
include("index.php");
?>

<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- REGISTER USERS Box -->
        <div class="col-sm-6 col-xl-3">
            <div class="custom-box bg-primary text-white rounded shadow-xl p-5 d-flex flex-column align-items-center justify-content-between">
                <div class="text-center">
                    <p class="mb-3" style="font-size: 20px; font-family: 'Poppins', sans-serif; font-weight: 700;">REG Customers</p>
                    <h6 id="lblTotalUsers" class="mb-0" style="font-size: 18px; font-family: 'Roboto', sans-serif; font-weight: 500;"></h6>
                </div>
            </div>
            <a href="customerregistert.php" class="btn btn-light mt-3 w-100">View Details</a>
        </div>

        <!-- VEHICLES Box -->
        <div class="col-sm-6 col-xl-3">
            <div class="custom-box bg-success text-white rounded shadow-xl p-5 d-flex flex-column align-items-center justify-content-between">
                <div class="text-center">
                    <p class="mb-3" style="font-size: 20px; font-family: 'Poppins', sans-serif; font-weight: 700;">View Order</p>
                </div>
            </div>
            <a href="orders.php" class="btn btn-light mt-3 w-100">View Details</a>
        </div>

        <!-- BOOKING Box -->
        <div class="col-sm-6 col-xl-3">
            <div class="custom-box bg-info text-white rounded shadow-xl p-5 d-flex flex-column align-items-center justify-content-between">
                <div class="text-center">
                    <p class="mb-3" style="font-size: 20px; font-family: 'Poppins', sans-serif; font-weight: 700;">View Product</p>
                </div>
            </div>
            <a href="displayproduct.php" class="btn btn-light mt-3 w-100">View Details</a>
        </div>

        <!-- BRANDS Box -->
        <div class="col-sm-6 col-xl-3">
            <div class="custom-box bg-warning text-white rounded shadow-xl p-5 d-flex flex-column align-items-center justify-content-between">
                <div class="text-center">
                    <p class="mb-3" style="font-size: 20px; font-family: 'Poppins', sans-serif; font-weight: 700;">View Category</p>
                </div>
            </div>
            <a href="veiwcategory.php" class="btn btn-light mt-3 w-100">View Details</a>
        </div>

        <!-- FEEDBACK Box -->
        <div class="col-sm-6 col-xl-3">
            <div class="custom-box bg-secondary text-white rounded shadow-xl p-5 d-flex flex-column align-items-center justify-content-between">
                <div class="text-center">
                    <p class="mb-3" style="font-size: 20px; font-family: 'Poppins', sans-serif; font-weight: 700;">FEEDBACK</p>
                </div>
            </div>
            <a href="feedback.php" class="btn btn-light mt-3 w-100">View Details</a>
        </div>
    </div>
</div>
<!-- Sale & Revenue End -->

<style>
    .custom-box {
        width: 100%;
        height: 200px;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
    }
    
    .custom-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    
    .btn-light {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
    }
    
    .btn-light:hover {
        background-color: #e2e6ea;
        border-color: #ccc;
    }
</style>
</body>
</html>
