<?php
session_start();

//Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "stockbarang");



//menambah barang baru di stock barang
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];


    //soal gambar
    $allowed_extension = array('png','jpg');
    $nama = $_FILES['file']['name']; //Ambil nama gambar
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot)); //Ambil Ekstensinya
    $ukuran = $_FILES['file']['size']; //Ambil Size Filenya
    $file_tmp = $_FILES['file']['tmp_name']; //Abil Lokasi Filenya

    //Penambahan File -> Enkripsi 
    $image = md5(uniqid($nama, true) . time()).'.'.$ekstensi; //Menggabungkan nama file yang dienkripsi dengan ekstensinya

    //validasi sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM stock WHERE namabarang='$namabarang'");
    $hitung = mysqli_num_rows($cek);

    if($hitung < 1){
     //jika belum ada

        //proses upload gambar
        if(in_array($ekstensi, $allowed_extension) === true){
            //validasi ukuran filenya
            if($ukuran < 15000000){
                move_uploaded_file($file_tmp, 'images/'.$image);

                $addtotable = mysqli_query($conn, "INSERT INTO stock (namabarang, deskripsi, stock, harga, image) VALUES('$namabarang', '$deskripsi', '$stock', '$harga', '$image')");
                if($addtotable){
                    header('location:index.php');
                } else {
                    echo 'Gagal';
                    header('location:index.php');
                }

            } else {
                //hasil filenya lebih dari 15mb
                echo'
                <script>
                alert("ukuran terlalu besar");
                window.location.href="index.php";
                </script>
                ';
                
            }

              } else {
            //kalau filenya tidak png / jpg
            echo'
                <script>
                alert("File harus png/jpg");
                window.location.href="index.php";
                </script>
                ';
              }

             } else {
             //jika sudah ada
                echo'
                <script>
                alert("nama barang sudah terdaftar");
                window.location.href="index.php";
                </script>
                ';
            }
    
}




//Menambah Barang Masuk
if(isset($_POST['addbarangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $namabarang = $_POST['namabarang'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $namabarang = $ambildatanya['namabarang'];

    $cekstocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $cekstocksekarang + $qty;

    $addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, namabarang, keterangan, qty) VALUES('$barangnya', '$namabarang', '$penerima', '$qty')");
    $updatestockmasuk = mysqli_query($conn, "UPDATE stock SET stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
    if($addtomasuk && $updatestockmasuk){
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }
}




//Menambah Barang Keluar
if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $namabarang = $_POST['namabarang'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    $namabarang = $ambildatanya['namabarang'];

    $cekstocksekarang = $ambildatanya['stock'];

    if($cekstocksekarang  >= $qty){
        //kalau barangnya cukup
        $tambahkanstocksekarangdenganquantity = $cekstocksekarang - $qty;

        $addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, namabarang, penerima, qty) VALUES('$barangnya', '$namabarang', '$penerima', '$qty')");
        $updatestockkeluar = mysqli_query($conn, "UPDATE stock SET stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
        if($addtokeluar && $updatestockkeluar){
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        } 
        
        } else {
             //jika barangnya inggak cukup
             echo '
             <script>
                 alert("stock saat ini tidak mencukupi");
                 window.location.href="keluar.php";
             </script>
             ';
        }
}
        
    





//Update info stock barang
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    //soal gambar
    $allowed_extension = array('png','jpg');
    $nama = $_FILES['file']['name']; //Ambil nama gambar
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot)); //Ambil Ekstensinya
    $ukuran = $_FILES['file']['size']; //Ambil Size Filenya
    $file_tmp = $_FILES['file']['tmp_name']; //Abil Lokasi Filenya

    //Penambahan File -> Enkripsi 
    $image = md5(uniqid($nama, true) . time()).'.'.$ekstensi; //Menggabungkan nama file yang dienkripsi dengan ekstensinya

    if($ukuran==0){
    //jika tidak ingin upload
        $update = mysqli_query($conn, "UPDATE stock SET namabarang='$namabarang', deskripsi='$deskripsi', harga='$harga',image='$image' WHERE idbarang='$idb'");
        if($update){
            header('location:index.php');
        } else {
            echo 'Gagal';
            header('location:index.php');
           
        }
    } else {
     //jika ingin
       move_uploaded_file($file_tmp, 'images/'.$image);
        $update = mysqli_query($conn, "UPDATE stock SET namabarang='$namabarang', deskripsi='$deskripsi', harga='$harga', image='$image' WHERE idbarang='$idb'");
        if($update){
            header('location:index.php');
        } else {
            echo 'Gagal';
            header('location:index.php');
        }
    }
}





//menghapus barang dari stock
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb']; //idbarang

    $gambar = mysqli_query($conn, "SELECT * FROM STOCK WHERE idbarang='$idb'");
    $get = mysqli_fetch_array($gambar);
    $img = 'images/'.$get['image'];
    unlink($img);

    $hapus = mysqli_query($conn, "DELETE FROM stock WHERE idbarang='$idb'");
    if($hapus){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}




//mengubah data barang masuk
if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $deskripsi = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrng = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "SELECT * FROM masuk WHERE idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty > $qtyskrg){
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrng + $selisih;
        $kuranginstocknya = mysqli_query($conn, "UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb'");
        $updatenya = mysqli_query($conn, "UPDATE masuk SET qty='$qty', keterangan='$deskripsi' WHERE idmasuk='$idm'");
            if($kuranginstocknya && $updatenya){
                header('location:masuk.php');
            } else {
                echo 'Gagal';
                header('location:masuk.php');
            }

        } else {
            $selisih = $qtyskrg - $qty;
            $kurangin = $stockskrng - $selisih;
            $kuranginstocknya = mysqli_query($conn, "UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb'");
            $updatenya = mysqli_query($conn, "UPDATE masuk SET qty='$qty', keterangan='$deskripsi' WHERE idmasuk='$idm'");
                if($kuranginstocknya && $updatenya){
                    header('location:masuk.php');
                } else {
                    echo 'Gagal';
                    header('location:masuk.php');
                }
        }
    }




//memghapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock - $qty;

    $update = mysqli_query($conn, "UPDATE stock SET stock='$selisih' WHERE idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM masuk WHERE idmasuk='$idm'");
    if($update && $hapusdata){
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    }


}




//Mengubah data barang keluar
if(isset($_POST['updatebarangkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $deskripsi = $_POST['penerima'];
    $qty = $_POST['qty'];


    //mengambil stock barang saat ini
    $lihatstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrng = $stocknya['stock'];


    //Qty barang keluar saat ini
    $qtyskrg = mysqli_query($conn, "SELECT * FROM keluar WHERE idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty > $qtyskrg){
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrng - $selisih;

        if($selisih <= $stockskrng){
            
        $kuranginstocknya = mysqli_query($conn, "UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb'");
        $updatenya = mysqli_query($conn, "UPDATE keluar SET qty='$qty', penerima='$deskripsi' WHERE idkeluar='$idk'");
            if($kuranginstocknya && $updatenya){
                header('location:keluar.php');
            } else {
                echo 'Gagal';
                header('location:keluar.php');
            }

        } else {
            $selisih = $qtyskrg - $qty;
            $kurangin = $stockskrng + $selisih;
            $kuranginstocknya = mysqli_query($conn, "UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb'");
            $updatenya = mysqli_query($conn, "UPDATE keluar SET qty='$qty', penerima='$deskripsi' WHERE idkeluar='$idk'");
                if($kuranginstocknya && $updatenya){
                    header('location:keluar.php');
                } else {
                    echo 'Gagal';
                    header('location:keluar.php');
                }
        }
    }
}




//memghapus barang keluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

    $getdatastock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];

    $selisih = $stock + $qty;

    $update = mysqli_query($conn, "UPDATE stock SET stock='$selisih' WHERE idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM keluar WHERE idkeluar='$idk'");
    if($update && $hapusdata){
        header('location:keluar.php');
    } else {
        header('location:keluar.php');
    }


}




//Menambah admin baru
if(isset($_POST['addadmin'])){
    $email = $_POST['email'];
    $namaadmin = $_POST['namaadmin'];
    $password = $_POST['password'];

     //soal gambar
    $allowed_extension = array('png','jpg');
    $nama = $_FILES['file']['name']; //Ambil nama gambar
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot)); //Ambil Ekstensinya
    $ukuran = $_FILES['file']['size']; //Ambil Size Filenya
    $file_tmp = $_FILES['file']['tmp_name']; //Abil Lokasi Filenya

    //Penambahan File -> Enkripsi 
    $image = md5(uniqid($nama, true) . time()).'.'.$ekstensi; //Menggabungkan nama file yang dienkripsi dengan ekstensinya


    $queryinsert = mysqli_query($conn, "INSERT INTO login (email, namaadmin, password, image) VALUES ('$email', '$namaadmin', '$password', '$image')");
     if($queryinsert){
        //if berhasil
        header('location:admin.php');
    } else {
        //kalau gagal insert ke db
        header('location:admin.php');
    }


    //proses upload gambar
        if(in_array($ekstensi, $allowed_extension) === true){
            //validasi ukuran filenya
            if($ukuran < 15000000){
                move_uploaded_file($file_tmp, 'images/'.$image);

                $addtotable = mysqli_query($conn, "INSERT INTO login (email, namaadmin, password,  image) VALUES('$email', '$namaadmin', '$password' '$image')");
                if($addtotable){
                    header('location:admin.php');
                } else {
                    echo 'Gagal';
                    header('location:admin.php');
                }

            } else {
                //hasil filenya lebih dari 15mb
                echo'
                <script>
                alert("ukuran terlalu besar");
                window.location.href="admin.php";
                </script>
                ';
                
            }

              } else {
            //kalau filenya tidak png / jpg
            echo'
                <script>
                alert("File harus png/jpg");
                window.location.href="admin.php";
                </script>
                ';
              }


}





//Edit data admin
if(isset($_POST['updateadmin'])){
    $emailbaru = $_POST['emailadmin'];
    $passwordbaru = $_POST['passwordbaru'];
    $namaadmin = $_POST['namaadmin'];
    $idnya = $_POST['id'];


    //soal gambar
    $allowed_extension = array('png','jpg');
    $nama = $_FILES['file']['name']; //Ambil nama gambar
    $dot = explode('.',$nama);
    $ekstensi = strtolower(end($dot)); //Ambil Ekstensinya
    $ukuran = $_FILES['file']['size']; //Ambil Size Filenya
    $file_tmp = $_FILES['file']['tmp_name']; //Abil Lokasi Filenya

    //Penambahan File -> Enkripsi 
    $image = md5(uniqid($nama, true) . time()).'.'.$ekstensi; //Menggabungkan nama file yang dienkripsi dengan ekstensinya

    if($ukuran==0){
    //jika tidak ingin upload
     $queryupdate = mysqli_query($conn, "UPDATE login SET email='$emailbaru', password='$passwordbaru', namaadmin='$namaadmin', image='$image' WHERE iduser='$idnya'");
        if($queryupdate){
            header('location:admin.php');
        } else {
            header('location:admin.php');

        }
    } else {
     //jika ingin
       move_uploaded_file($file_tmp, 'images/'.$image);
         $queryupdate = mysqli_query($conn, "UPDATE login SET email='$emailbaru', password='$passwordbaru', namaadmin='$namaadmin', image='$image' WHERE iduser='$idnya'");
    if($queryupdate){
        header('location:admin.php');
    } else {
        header('location:admin.php');

    }
}



//Hapus Admin
// if(isset($_POST['hapusadmin'])){
//     $id = $_POST['iduser'];

//     $gambar = mysqli_query($conn, "SELECT * FROM login WHERE iduser='$id'");
//     $get = mysqli_fetch_array($gambar);
//     $img = 'images/'.$get['image'];
//     unlink($img);
        


//     $querydelete = mysqli_query($conn, "DELETE FROM login WHERE iduser='$id'");
//     if($querydelete){
//         header('location:admin.php');
//     } else {
//         header('location:admin.php');
//     }
// }

}





?>