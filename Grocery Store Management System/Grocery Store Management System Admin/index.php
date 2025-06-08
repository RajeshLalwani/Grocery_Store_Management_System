


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <title>Admin</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="cssadmin/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="cssadmin/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
            
                <a href="adminhome.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"></i>Krishna Grocery</h3>
                </a>
                <div class="navbar-nav w-100">
                    <a href="adminhome.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-box-open me-2"></i>Products</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="addpro.php" class="dropdown-item">Add Product</a>
                            <a href="updatepro.php" class="dropdown-item">Update Product</a>
                            <a href="deletepro.php" class="dropdown-item">Delete Product</a>
                        </div>
                    </div>


                    <a href="customerregistert.php" class="nav-item nav-link"><i class="fa fa-users me-2"></i>Reg Customer</a>
                    <a href="orders.php" class="nav-item nav-link"><i class="fa fa-shopping-cart me-2"></i>Orders</a>
                    <a href="veiwcategory.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>View Category</a>
                    <a href="feedback.php" class="nav-item nav-link"><i class="fa fa-comment me-2"></i>Feedback</a>
                    
                </div>
            </nav>
        </div>

        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="input-group w-100">
    <input class="form-control border-0 flex-grow-1" type="search" placeholder="Search">
</div>
<div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
        <?php
            // Get first letter of admin's name
            $adminName = isset($_SESSION['aname']) ? $_SESSION['aname'] : 'Guest';
            $firstLetter = strtoupper(substr($adminName, 0, 1)); // Convert first letter to uppercase
        ?>
        <!-- Circle with Initial -->
        <div class="rounded-circle text-white bg-primary d-flex align-items-center justify-content-center me-2" 
             style="width: 40px; height: 40px; font-size: 20px; font-weight: bold;">
            <?php echo $firstLetter; ?>
        </div>
        
        <!-- Admin Name -->
        <span class="d-none d-lg-inline-flex"><?php echo $adminName; ?></span>
    </a><div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <a href="adminlogin.php" class="dropdown-item">Login</a>
                        <a href="logout.php" class="dropdown-item">Log Out</a>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
	
            <div id="content-placeholder">
             

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="jss/main.js"></script>

	
</body>

</html>

