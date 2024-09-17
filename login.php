<?php

require 'function.php';

// Cek jika form login disubmit
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validasi input
    if (empty($email) || empty($password)) {
        // Jika email atau password kosong, tampilkan pesan error
        echo '<script>
                alert("Username dan password tidak boleh kosong.");
                window.location.href = "login.php";
              </script>';
    } else {
        // Cocokkan dengan database, cari data
        $cekdatabase = mysqli_query($conn, "SELECT * FROM login WHERE email='$email' AND password='$password'");

        // Hitung jumlah data
        $hitung = mysqli_num_rows($cekdatabase);

        if ($hitung > 0) {
            // Jika data ditemukan, set session dan redirect
            $_SESSION['log'] = 'true';
            header('Location: navbar.php');
            exit();
        } else {
            // Jika data tidak ditemukan, redirect kembali ke halaman login dengan pesan error
            echo '<script>
                    alert("Username atau password salah.");
                    window.location.href = "login.php";
                  </script>';
        }
    }
}

// Cek jika user sudah login, redirect ke halaman lain
if (isset($_SESSION['log']) && $_SESSION['log'] === 'true') {
    header('Location: navbar.php');
    exit();
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
        <title>Login</title>
        <link rel="icon" href="SB.jpg"/>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body style="background-image: url('login2.jpg'); background-size: cover; background-position: center;">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                            <div class=" border-0 rounded-lg mt-5">
                                <div style="width: 400px; margin: auto; padding: 30px; background: rgb(255, 255, 255, 0.8); border-radius: 30px; text-align: center;">
                                    <div class="card-header"><h1 class="text-center font-weight-light my-4">Login</h1></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary" name="login" >Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
