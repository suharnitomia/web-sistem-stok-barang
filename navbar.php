<?php
require 'function.php';
require 'cek.php';


// Kueri untuk menghitung jumlah pengguna
$user = mysqli_query($conn, "SELECT COUNT(*) AS total_users FROM login");
$data_user = mysqli_fetch_assoc($user);
$total_users = $data_user['total_users'];

// Kueri untuk menghitung jumlah stok
$stock = mysqli_query($conn, "SELECT COUNT(*) AS total_stock FROM stock");
$data_stock = mysqli_fetch_assoc($stock);
$total_stock = $data_stock['total_stock'];

// Kueri untuk menghitung jumlah stok
$masuk = mysqli_query($conn, "SELECT COUNT(*) AS total_masuk FROM masuk");
$data_masuk = mysqli_fetch_assoc($masuk);
$total_masuk = $data_masuk['total_masuk'];

// Kueri untuk menghitung jumlah stok
$keluar = mysqli_query($conn, "SELECT COUNT(*) AS total_keluar FROM keluar");
$data_keluar = mysqli_fetch_assoc($keluar);
$total_keluar = $data_keluar['total_keluar'];


// kueri untuk prifile
$query = "SELECT image FROM login";
$result = mysqli_query($conn, $query);


if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $gambar = $data['image'];
} else {
    
    $gambar = 'logout.png'; 
}

$img = 'images/' . htmlspecialchars($gambar);

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <link rel="icon" href="SB.jpg"/>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>


    <!---BACKGROUND GAMBAR--->

            <body style="background-color: azure;"> 
                <nav class="sb-topnav navbar navbar-expand" style="background-color: #87CEEB;">
                    <!-- Navbar Brand-->
                    <a class="navbar-brand ps-3" href="index.php" style="color: white;"><strong>TK FADHIL ULLULER</strong></a>
                    
                    <!-- Sidebar garis 3-->
                    <button class="btn btn-basic btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
                    
                    <!-- Navbar Logout-->
                    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
                    <marquee behavior="scroll" direction="left" style="color: white;"><strong>WELCOME TO TOKO FADHIL ULULER</strong></marquee>

                
                    <!-- Navbar Profile and Logout -->
                    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="img-profile rounded-circle" src='<?php echo $img; ?>' style="height: 30px; width: 30px;">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="admin.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>                       
                                    Logout
                                </a>
                            </ul>
                        </li>
                    </ul>
                </nav>


                <!---NAVBAR SAMPING--->

                <div id="layoutSidenav">
                    <div id="layoutSidenav_nav">
                        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #4682B4; color: white;">
                            <div class="sb-sidenav-menu">
                                <div class="nav">
                                <a class="nav-link" href="navbar.php">
                                <div class="sb-nav-link-icon"><i class='fa fa-dashboard' style='font-size:20px;color:white;'></i></div><strong>
                                Dashboard
                            </strong>
                            </a>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class='fa-solid fa-boxes-stacked' style='font-size:20px;color:white;'></i></div><strong>
                                Stock Barang
                            </strong>
                            </a>
                            <a class="nav-link collapsed" href="index.php" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns" style='font-size:20px;color:white;'></i></div><strong>
                                Kelola Barang
                                </strong>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="masuk.php"><strong> Barang Masuk</strong></a>
                                    <a class="nav-link" href="keluar.php"><strong> Barang Keluar</strong></a>    
                                </nav>
                            </div>
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class='fa-solid fa-user' style='font-size:20px;color:white'></i></div><strong>
                                Profil
                            </strong>
                            </a>  
                            </div>
                    </div>

                    <!---LOGO/GAMBAR PADA BAGIAN BAWA NAVBAR--->

                    <div class="logo">
                        <img src="icon.png" alt="logo" style="height: 200px; margin-right: 10px;">
                    </div>
                </nav>
            </div>


            <!---NAMA YANG ADA PADA NAVBAR-->
            <div id="layoutSidenav_content">
                <main>
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between mt-4">
                        <h2 class="" style="color: dark;"><i class="fa-solid fa-house" style="color:steelblue;"></i><strong> Dashboard</strong></h2>
                        <strong class="time-display" id="timeDisplay">Loading...</strong>
                    </div>
                    <div class="card-header">
                    <div class="container-fluid px-6">
                        <div class="alert alert-primary fade show" role="alert">
                            SELAMAT DATANG DI TOKO FADHIL ULLULER  
                        </div>



                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Stock Barang</div>
                                                <div class="card-footer d-flex align-items-center justify-content-between">
                                                <a class="small text-primary stretched-link" href="index.php">More Info</a>
                                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <h1 class="text-primary"><strong><?php echo $total_stock; ?></strong></h1>
                                            <i class="fa-solid fa-box-open fa-2x text-gray-300" style="color:steelblue;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Barang Masuk</div>
                                                 <div class="card-footer d-flex align-items-center justify-content-between">
                                                <a class="small text-success stretched-link" href="masuk.php">More Info</a>
                                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <h1 class="text-success"><strong><?php echo $total_masuk; ?></strong></h1>
                                            <i class="fa-solid fa-cart-plus fa-2x text-gray-300" style="color:green;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Barang Keluar </div>
                                             <div class="card-footer d-flex align-items-center justify-content-between">
                                                <a class="small text-info stretched-link" href="keluar.php">More Info</a>
                                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <h1 class="text-info"><strong><?php echo $total_keluar; ?></strong></h1>
                                            <i class="fa-solid fa-cart-shopping fa-2x text-gray-300" style="color:skyblue;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



             <div class="logo">
             <img src="h.gif" alt="logo" style="height: 100px; margin-right: 10px;">
                 </div>
                </nav>
            </div>

    <!-- Collapse Example -->
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Tentang stock barang
    </button>
    <br>

    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            Stock barang adalah sistem yang membantu Perusahaan mengelola persediaan mereka dengan efesien. Tujuan utamanya adalah untuk memantau dan mengontrol jumlah stok yang tersedia, memudahkan proses pemesanan, serta memberikan informasi yang diperlukan untuk membuat keputusan terkait manajemen.
        </div>
    </div>

    

    <!-- TANGGAL-->

    <script>
        function updateTimeDisplay() {
            // Create a new Date object with the current time
            const now = new Date();

            // Define options for date and time formatting
            const options = {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                timeZone: 'Asia/Jayapura', // Timezone for Eastern Indonesian Time (WIT)
                // timeZoneName: 'short'
            };

            // Format the date and time using Intl.DateTimeFormat
            const formatter = new Intl.DateTimeFormat('en-GB', options);
            const formattedDate = formatter.format(now);

            // Update the display
            document.getElementById('timeDisplay').textContent = formattedDate;
        }

        // Update the time display every second
        setInterval(updateTimeDisplay, 1000);

        // Initialize the time display
        updateTimeDisplay();
    </script>




        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
