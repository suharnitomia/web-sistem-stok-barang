<?php
require 'function.php';
require 'cek.php';
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Masuk</title>
        <link href="https://cdn.jsdelivr.nest/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            .zoomable{
                width: 100px;
            }

            .zoomable:hover{
                transform: scale(1.5);
                transition: 0,3s ease;
            }
            .form-control {
                margin-right: 1rem; /* Atur jarak antar elemen pada tanggal*/
            }

            .btn-info {
                margin-left: 0rem; /* Atur jarak antar elemen */
            }
        </style>

    </head>
    <body style="background-image: url('k.jpg'); background-size:  cover; background-position: center;">
    <nav class="sb-topnav navbar navbar-expand" style="background-color: #87CEEB;">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php"><strong>PT Harny</strong></a>
            
            <!-- Sidebar Garis 3-->
            <button class="btn btn-basic btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar Logout-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
           
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                 <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #4682B4; color: white;">
                    <div class="sb-sidenav-menu">
                    <div class="nav">
                         <a class="nav-link" href="navbar.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div><strong>
                                Dashboard
                            </strong>
                            </a>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div><strong>
                                Stock Barang
                            <strong>
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-plus"></i></div><strong>
                                Barang Masuk
                            </strong>
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></div><strong>
                                Barang Keluar
                             </strong>
                            </a>  
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie"></i></div><strong>
                                Kelola Admin
                            </strong>
                            </a>  
                        
                        </div>
                    </div>
                    <div class="logo">
                        <img src="k1.png" alt="logo" style="height: 200px; margin-right: 10px;">
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h2 class="mt-4" style="color: white;"><i class="fa-solid fa-cart-plus"></i><strong> Barang Masuk</strong></h2>


                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa-solid fa-pen-to-square"></i>
                                Tambah Barang Masuk
                            </button>
                            <br>
                            <div class="row mt-4">
                                <div class="col-lg-2">
                                    <form method="post" class="d-flex align-items-center">
                                    <input type="date" name="tgl_mulai" class="form-control">
                                    <input type="date" name="tgl_selesai" class="form-control">
                                    <button type="submit" name="filter_tgl" class="btn btn-info">Filter</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                              <table  class="table table-bordered" id="mauexport" width="100%" cellspacing="0" id="datatablesSimple">
                                    <thead>
                                        <tr>
                                        <th>Tanggal</th>
                                            <th>Gambar</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <!---Penambahan Tanggal--->
                                        
                                    <?php
                                      if(isset($_POST['filter_tgl'])){
                                        $mulai = $_POST['tgl_mulai'];
                                        $selesai = $_POST['tgl_selesai'];

                                        if($mulai!=null || $selesai!=null){
                                        $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM masuk m, stock s WHERE s.idbarang = m.idbarang AND tanggal BETWEEN '$mulai' AND date_add('$selesai', INTERVAL 1 DAY)");
                                       
                                    } else {
                                        $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM masuk m, stock s WHERE s.idbarang = m.idbarang "); 
                                    }

                                    } else {
                                        $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM masuk m, stock s WHERE s.idbarang = m.idbarang ");
                                    }
                                   
                                     while($data = mysqli_fetch_array(($ambilsemuadatastock))){
                                        $idb = $data['idbarang'];
                                        $idm= $data['idmasuk'];
                                        $tanggal = $data['tanggal'];
                                        $namabarang = $data['namabarang'];
                                        $qty = $data['qty'];
                                        $keterangan = $data['keterangan'];


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
                                            <td><?=$tanggal;?></td>
                                            <td><?=$img;?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$qty;?></td>
                                            <td><?=$keterangan;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idm;?>"><i class="fa-solid fa-pen-to-square"></i>
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idm;?>"><i class="fa-solid fa-trash"></i>
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit<?=$idm;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                        <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Barang</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                        <!-- Modal body -->
                                            <form method="post">
                                                <div class="modal-body">
                                                <input type="text" name="keterangan" value="<?=$keterangan;?>" class="form-control" required>
                                                <br>
                                                <input type="text" name="qty" value="<?=$qty;?>" class="form-control" required>
                                                <br>
                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                <input type="hidden" name="idm" value="<?=$idm;?>">
                                                <br>
                                                <button type="submit" class="btn btn-warning" name="updatebarangmasuk">Submit</button>
                                                </div>
                                            </form>

                                            </div>
                                        </div>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete<?=$idm;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                        <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Barang</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                        <!-- Modal body -->
                                            <form method="post">
                                                <div class="modal-body">
                                                Apakah anda yakin ingin menghapus <?=$namabarang;?>?
                                                <input type="hidden" name="idb" value="<?=$idb;?>">
                                                <input type="hidden" name="kty" value="<?=$qty;?>">
                                                <input type="hidden" name="idm" value="<?=$idm;?>">
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>
                                                </div>
                                            </form>

                                            </div>
                                        </div>
                                        </div>

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
        </div>
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
                <h4 class="modal-title">Tambah Barang Masuk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

    <!-- Modal body -->
        <form method="post">
            <div class="modal-body">
            <select name="barangnya" class="form-control">
                <?php
                    $ambilsemuadatanya = mysqli_query($conn, "SELECT  * FROM stock");
                    while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
                        $namabarangnya = $fetcharray['namabarang'];
                        $idbarangnya = $fetcharray['idbarang'];

                ?>

                <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>
                
                <?php
                    }
                ?>
            </select>
            <br>
            <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
            <br>
            <input type="text" name="penerima" placeholder="Penerima" class="form-control" required>
            <br>
            <button type="submit" class="btn btn-primary" name="addbarangmasuk">Submit</button>
            </div>
        </form>
        

         </div>
      </div>
     </div>

</html>
