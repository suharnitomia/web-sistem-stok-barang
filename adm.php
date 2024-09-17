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
        <title>Kelola Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> 

    </head>
    <body style="background-image: url('k.jpg'); background-size: cover; background-position: center;">
        <nav class="sb-topnav navbar navbar-expand" style="background-color: #87CEEB;">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php"><strong> Harny</strong></a>
            
            <!-- Sidebar Garis 3-->
            <button class="btn btn-basic btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar Logout-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
           
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php"><strong>logout</strong></a></li>
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
                                Stock barang
                            </strong>
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
                        <h2 class="mt-4" style="color: white;"><i class="fa-solid fa-user-tie"></i><strong> Kelola Admin</strong></h2>
                        <div style="background-color: #4682B4; color: white;" class="card mb-4">
                            <li class="breadcrumb-item active"><strong>SELAMAT DATANG ADMIN</strong></li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">

                            <!---Button to open the modal--->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa-solid fa-user-plus"></i>
                                Tambah Admin Baru
                            </button>
                            </div>
                            <div class="card-body">
                               <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                                    <thead class="table-success">
                                        <tr>
                                            <th>No</th>
                                            <th>Email Admin</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                     $ambilsemuadataadmin = mysqli_query($conn, "SELECT * FROM login");
                                     $i = 1;
                                     while($data = mysqli_fetch_array(($ambilsemuadataadmin))){
                                        $em = $data['email'];
                                        $iduser = $data['iduser'];
                                        $pw = $data['password'];
                                     
                                    ?>

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$em;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$iduser;?>"><i class="fa-solid fa-pen-to-square"></i>
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$iduser;?>"><i class="fa-solid fa-trash"></i>
                                                    Delete
                                                </button>
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
                                            <form method="post">
                                                <div class="modal-body">
                                                <input type="email" name="emailadmin" value="<?=$em;?>" class="form-control" placeholder="Email" required>
                                                <br>
                                                <input type="password" name="passwordbaru" class="form-control" value="<?=$pw;?>" placeholder="password">
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
                                        <div class="modal fade" id="delete<?=$iduser;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                        <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Admin</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                        <!-- Modal body -->
                                            <form method="post">
                                                <div class="modal-body">
                                                Apakah anda yakin ingin menghapus <?=$em;?>?
                                                <input type="hidden" name="id" value="<?=$iduser;?>">
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-danger" name="hapusadmin">Hapus</button>
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
                <h4 class="modal-title">Tambah admin Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

    <!-- Modal body -->
        <form method="post">
            <div class="modal-body">
            <input type="email" name="email" placeholder="Email" class="form-control" required>
            <br>
            <input type="password" name="password" placeholder="Password" class="form-control" required>
            <br>
            <button type="submit" class="btn btn-primary" name="addadmin">Submit</button>
            </div>
        </form>

         </div>
      </div>
     </div>

</html>
