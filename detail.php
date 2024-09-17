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



//Dapetin ID barang Yang dipasing di halaman sebelumnya
$idbarang = $_GET['id']; //get id barang

//Get informasi barang berdasarkan database
$get = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idbarang'");
$fetch = mysqli_fetch_assoc($get);

//set variabel
$namabarang = $fetch['namabarang'];
$deskripsi = $fetch['deskripsi'];
$stock = $fetch['stock'];

  //cek ada gambar atau tidak
$gambar = $fetch['image']; //ambil gambar
if($gambar==null){
     //jika tidak ada gambar
     $img = 'No Foto';
 } else {
     //jika ada gambar
     $img = '<img src="images/'.$gambar.'" class="zoomable">';                                    

 }


 

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Detail Barang</title>
        <link rel="icon" href="SB.jpg"/>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            .zoomable{
                width: 100px;
                height: 100px;
            }

            .zoomable:hover{
                transform: scale(1.5);
                transition: 0,3s ease;
            }
        </style>


        <!---MENAMBAH BACKGROUND--->

    </head>
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



        <!---NAVBAR--->

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <!---WARNA PADA NAVBAR SAMPING--->
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

                    <!---LOGO BAGIAN BAWA NAVBAR--->

                    <div class="logo">
                        <img src="icon.png" alt="logo" style="height: 200px; margin-right: 10px;">
                    </div>
                </nav>
            </div>


            <!---NAMA YANG ADA DALAM  NAVBAR DAN WARNA TABEL---> 
            <div id="layoutSidenav_content">
                <main >
                    <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between mt-4">
                        <h2 class="" style="color: dark;"><i class="fa-solid fa-box-open" style="color:steelblue;"></i><strong> Detail Barang</strong></h2>
                        <strong class="time-display" id="timeDisplay">Loading...</strong>
                    </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><a href="navbar.php">Dashboard</a></li>
                        </ol>
                            <div style="background-color:  aliceblue;" class="card mb-4">




                            <!---Button to open the modal--->                            
                            <div class="card mb-4 mt-4">
                                <div class="card-header">
                                    <h2><?=$namabarang;?></h2>
                                        <?=$img;?>
                            </div>
                            <div class="card-body">

                            <div class="row">
                                <div class="col-md-3"><strong>Deskripsi</strong></div>
                                <div class="col-md-9"><strong>: <?=$deskripsi;?></strong></div>
                            </div>

                            <div class="row">
                                <div class="col-md-3"><strong>Stock</strong></div>
                                <div class="col-md-9"><strong>: <?=$stock;?></strong></div>
                            </div>

                            <br><br><hr>


                                 <!---TABEL--->

                                 <h2 class="text-center">Laporan: <?=$namabarang;?></h2>
                                 <h3>Barang Masuk</h3>
                                 <div class="responsive">
                                <table id="datatablesSimple" class="table table-bordered" id="barangmasuk"  width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Penerima</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                 $ambildatamasuk = mysqli_query($conn, "SELECT * FROM masuk WHERE idbarang='$idbarang'");
                                        $i = 1;
                                        while($fetch = mysqli_fetch_array($ambildatamasuk)){
                                            $tanggal = $fetch['tanggal'];
                                            $keterangan = $fetch['keterangan'];   
                                            $quantity = $fetch['qty'];               

                                     
                                    ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$keterangan;?></td>
                                            <td><?=$quantity;?></td>
                                        </tr>

                                       

                                        <?php
                                        };

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <br><br><hr>


                            <h3>Barang Keluar</h3>
                                 <div class="responsive">
                                <table id="datatablesSimple" class="table table-bordered" id="barangkeluar"  width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Pembeli</th>
                                            <th>Quantity</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                 $ambildatamasuk = mysqli_query($conn, "SELECT * FROM keluar k, stock s  WHERE s.idbarang = k.idbarang ");
                                        $i = 1;
                                        $grandTotal = 0; // Variabel untuk menyimpan jumlah total
                                        $rowCount = 0;   // Variabel untuk menghitung jumlah baris
                                        while($fetch = mysqli_fetch_array($ambildatamasuk)){
                                            $tanggal = $fetch['tanggal'];
                                            $penerima = $fetch['penerima'];   
                                            $quantity = floatval($fetch['qty']);
                                            $harga = floatval($fetch['harga']);
                                            $total = $harga * $quantity;
          
            

                                     // Update jumlah total dan jumlah baris
                                        $grandTotal += $total;
                                        $rowCount++;
                                    ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$penerima;?></td>
                                            <td><?=$quantity;?></td>
                                            <td><?=$total;?></td>
                                        </tr>

                                       

                                        <?php
                                        };
                                            $averageTotal = ($rowCount > 0) ? $grandTotal / $rowCount : 0;
                                        ?>
                                          <tr>
                                            <td colspan="4"><strong>Jumlah Total</strong></td>
                                            <td><strong><?=$grandTotal;?></strong></td>
                                        </tr>
                                    </table> <!-- Menutup tag <table> jika diperlukan -->

                                    </tbody>
                                </table>
                            </div>
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

    <!-- The Modal -->
        <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

    <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

    <!-- Modal body -->
        <form method="post" enctype="multipart/form-data">
            <div class="modal-body">
            <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
            <br>
            <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required>
            <br>
            <input type="number" name="stock" placeholder="Stock" class="form-control" required>
            <br>
            <input type="file" name="file" class="form-control">
            <br>
            <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
            </div>
        </form>

         </div>
      </div>
     </div>

</html>
