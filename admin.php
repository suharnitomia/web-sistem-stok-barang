<?php
require 'function.php';
require 'cek.php';

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
        <title>Profil</title>
        <link rel="icon" href="SB.jpg"/>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            .zoomable{
                width: 100px;
            }

            .zoomable:hover{
                transform: scale(2.5);
                transition: 0,3s ease;
            }
        </style>

    </head>
     <body style="background-color: azure;">
        <nav class="sb-topnav navbar navbar-expand" style="background-color: #87CEEB;">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php" style="color: white;"><strong>TK FADHIL ULLULER</strong></a>
            
            <!-- Sidebar garis 3-->
            <button class="btn btn-basic btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar Logout-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
             <marquee behavior="scroll" direction="left" style="color: white;"><strong>WELCOME TO TOKO FADHIL ULLULER</strong></marquee>
           
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
                    <div class="logo">
                        <img src="icon.png" alt="logo" style="height: 200px; margin-right: 10px;">
                    </div>
                </nav>
            </div>


             <!-- TANGGAL DAN NAMA YANG ADA DALAM TABEL-->
            <div id="layoutSidenav_content">
                <main>
                     <div class="container-fluid px-4">
                     <div class="d-flex justify-content-between mt-4">
                         <h2 class="" style="color: dark;"><i class="fa-solid fa-user" style="color:orange;"></i><strong> Profil</strong></h2>
                        <strong class="time-display" id="timeDisplay">Loading...</strong>
                    </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><a href="navbar.php">Dashboard</a></li>
                        </ol>
                            <div style="background-color:  aliceblue;" class="card mb-4">
                            <!-- <div class="card-header"> -->

                            <!---Button to open the modal--->
                            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa-solid fa-pen-to-square"></i> -->
                                <!-- Tambah Admin -->
                            <!-- </div> -->
                            <div class="card-body">
                               <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                                    <thead class="table-info">
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Admin</th>
                                            <th>Email Admin</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                     $ambilsemuadataadmin = mysqli_query($conn, "SELECT * FROM login");
                                     $i = 1;
                                     while($data = mysqli_fetch_array(($ambilsemuadataadmin))){
                                        $image = $data['image'];
                                        $em = $data['email'];
                                        $namaadmin = $data['namaadmin'];
                                        $iduser = $data['iduser'];
                                        $pw = $data['password'];

                                        //cek ada gambar atau tidak
                                        $gambar = $data['image']; //ambil gambar
                                        if($gambar==null){
                                            //jika tidak ada gambar
                                            $img = 'No Foto';
                                        } else {
                                            //jika ada gambar
                                            $img = '<img src="images/'.$gambar.'" class="zoomable">';                                    
                                         }
                                     
                                    ?>

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$img;?></td>
                                            <td><?=$namaadmin;?></td>
                                            <td><?=$em;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$iduser;?>"><i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <!-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$iduser;?>"><i class="fa-solid fa-trash"></i>
                                                </button> -->
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?=$iduser;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                        <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Admin</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                        <!-- Modal body -->
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                <input type="email" name="emailadmin" value="<?=$em;?>" class="form-control" placeholder="Email" required>
                                                <br>
                                                <input type="password" name="passwordbaru" class="form-control" value="<?=$pw;?>" placeholder="password">
                                                <br>
                                                <input type="namaadmin" name="namaadmin" class="form-control" value="<?=$namaadmin;?>" placeholder="password">
                                                <br>
                                                <input type="file" name="file"  class="form-control">
                                                <br>
                                                <input type="hidden" name="id" value="<?=$iduser;?>">
                                                <br>
                                                <button type="submit" class="btn btn-warning" name="updateadmin">Submit</button>
                                                </div>
                                            </form>

                                            </div>
                                        </div>
                                        </div>
                                        

                                        <!-- Delete Modal -->
                                        <!-- <div class="modal fade" id="delete<?=$iduser;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content"> -->

                                        <!-- Modal Header -->
                                                <!-- <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Admin</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div> -->

                                        <!-- Modal body -->
                                            <!-- <form method="post">
                                                <div style="background-color: #4682B4; color: dark;" class="modal-body">
                                                Apakah anda yakin ingin menghapus <?=$em;?>?
                                                <input type="hidden" name="iduser" value="<?=$iduser;?>">
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-danger" name="hapusadmin">Hapus</button>
                                                </div>
                                            </form>

                                            </div>
                                        </div>
                                        </div> -->


                                        <?php
                                        };

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

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


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>


</html>