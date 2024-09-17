<?php
require 'function.php';
require 'cek.php';
?>
<html>
<head>
  <title>Export Barang Keluar</title>
    <link rel="icon" href="SB.jpg"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

 
 <body style="background-color: azure;">  
<div class="container">
            <h2>Barang Keluar</h2>
            <h4>(Inventory)</h4>
                <div class="data-tables datatable-white">

                    
                          <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                                    <thead class="table-success">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Branag</th>
                                            <th>Jumlah</th>
                                            <th>Total Harga</th>
                                            <th>Pembeli</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM keluar k, stock s WHERE s.idbarang = k.idbarang");
                                        $i = 1;
                                        while($data = mysqli_fetch_array($ambilsemuadatastock)){
                                                $idm= $data['idkeluar'];
                                                $idb = $data['idbarang'];
                                                $tanggal = $data['tanggal'];
                                                $namabarang = $data['namabarang'];
                                                $qty = $data['qty'];
                                                $harga = $data['harga'] * $qty;
                                                $penerima = $data['penerima'];
                                               
                                                
                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?php echo $tanggal;?></td>
                                            <td><?php echo $namabarang;?></td>
                                            <td><?php echo $qty;?></td>
                                            <td><?php echo $harga;?></td>
                                            <td><?php echo $penerima;?></td>
                                            
                                        </tr>

                                        </div>


                                        <?php
                                        };

                                        
                                        ?>
                                    </tbody>
                               </table>
                    
                    
                </div>
            <a href="keluar.php" class="btn btn-success"><i class="fa-solid fa-share-from-square"></i>Kembali</a>
</div>
    
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

    

</body>

</html>