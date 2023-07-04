<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nota</title>
        <link rel="stylesheet" href="./css/nota.css">
    </head>
    <body>
        <?php
            include "../../config/connection.php";
        ?>
        <div class="main_content">
            <a href="../../frontend/user/transaction/table.php"><button><</button></a>
            <div class="info">
                <div class="nota">
                    <h1>Dry Me</h1>
                    <?php
                    $qry_transaksi = mysqli_query($conn, "select * from transaksi 
                                                        join user ON user.id_user = transaksi.id_user 
                                                        join costumer ON costumer.id_costumer = transaksi.id_costumer
                                                        where transaksi.id_transaksi = '".$_GET['id_transaksi']."'");
                    while ($dt_transksi = mysqli_fetch_array($qry_transaksi)) {
                        $total = 0;
                        $harga_sub = "<ol>";
                        $harga = "<ol>";
                        $qty = "<ol>";
                        $nota_paket = "<ol>";
                        $qry_paket = mysqli_query($conn,"select * from  detail_transaksi join paket on paket.id_paket=detail_transaksi.id_paket where id_transaksi = ".$dt_transksi['id_transaksi']);
                        while($dt_paket=mysqli_fetch_array($qry_paket)){
                            $subtotal = 0;
                            $subtotal += $dt_paket['harga'] * $dt_paket['qty'];
                            $qty .= "<li>".$dt_paket['qty']."</li><br>";
                            $nota_paket .= "<li>".$dt_paket['nama_paket']."</li><br>";
                            $total += $dt_paket['harga'] * $dt_paket['qty'];
                            $harga.= "<li>"."Rp. ".number_format($dt_paket['harga'], 2, ',', '.').""."</li><br>";
                            $harga_sub.= "<li>"."Rp. ".number_format($subtotal, 2, ',', '.').""."</li><br>";
                        }
                        $nota_paket .= "</ol>";
                        $qty .= "</ol>";
                        $harga .= "</ol>";
                        $harga_sub .= "</ol>";
                        ?>
                    <p id = "atas">Status Bayar&nbsp;:&nbsp;<?=$dt_transksi['status_bayar']?></p>
                    <p>Nama Member&nbsp;:&nbsp;<?=$dt_transksi['nama_costumer']?></p>
                    <p id = "bawah">Tanggal Transaksi&nbsp;:&nbsp;<?=$dt_transksi['tgl_transaksi']?></p>
                    <p>Nama User&nbsp;:&nbsp;<?=$dt_transksi['nama_user']?></p>
                    
                    
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nama Paket</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?=$nota_paket?></td>
                                <td><?=$qty?></td>
                                <td><?=$harga?></td>
                                <td><?=$harga_sub?></td>
                            </tr>
                            <tr>
                                <td colspan="3">Total</td>
                                <td colspan="3">
                                    <?php
                                        echo "Rp. ".number_format($total, 2, ',', '.')."";
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                    }
                ?>
                    <script>
                        window.print();
                    </script>
                </div>
            </div>
        </div>
    </body>
</html>