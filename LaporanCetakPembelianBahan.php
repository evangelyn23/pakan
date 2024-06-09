<?php 
session_start();

include "INCLUDES/confiig.php";
include "INCLUDES/library.php";

$awal	= $_GET['awal']; 
$tawal=InggrisTgl($awal);

$akhir	= $_GET['akhir'];
$takhir=InggrisTgl($akhir);

	$tglAwal 	= isset($_GET['awal']) ? $_GET['awal'] : "01-".date('m-Y');
	$tglAkhir 	= isset($_POST['akhir']) ? $_GET['akhir'] : date('d-m-Y');
	$SqlPeriode = "where Tanggal BETWEEN '$awal' AND '$akhir'";
?>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CV Sehati Farm</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.4/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body onload="print()">
<form method="post" name="frmedit">

<?php if (!empty($tglAwal)){ ?>
<center><h2>LAPORAN PEMBELIAN BAHAN</h2> <br>
<center><h2>CV SEHATI FARM</h2> 
	<hr> <br></h4>PERIODE PEMESANAN <b><?php echo IndonesiaTgl($awal); ?> s/d <?php echo IndonesiaTgl($akhir); ?></b>
<br> 
<br>
<br>
</h4></center>
<?php } else { ?>
<center><h2>LAPORAN PEMBELIAN BAHAN
</h2></center>
<hr>
<?php } ?>

   <table class="table my-0">
   <thead>
    <th>No</th>
	<th>Kode Pembelian Bahan</th>
	<th>Tanggal</th>
	<th>Barang</th>
	<th>Jumlah</th>
	<th>Harga</th>
	<th>Total Harga</th>
    </thead>
    <tbody>
	<?php
	$Sql 	= "SELECT * FROM pembelianbahan  $SqlPeriode";								
	$myQry 	= mysqli_query($connection, $Sql);
	$nomor  = 0; 
	while ($myData = mysqli_fetch_array($myQry)) {
	$nomor++;
	$kodepersediaan = $myData['KodePersediaan'];
	$persediaan =mysqli_query($connection,"select * from persediaan where kodepersediaan ='$kodepersediaan'");
	$ambildata = mysqli_fetch_array($persediaan);
   	$namapersediaan = $ambildata['NamaPersediaan'];
	?>
        <tr>			
		<td><?php echo $nomor;?></td>
		<td><?php echo $myData['KodePembelianBahan'];?></td>
        <td><?php echo IndonesiaTgl($myData['Tanggal']);?></td> 
		<td><?php echo $namapersediaan;?></td>										
        <td><?php echo number_format($myData['Jumlah']);?></td>
        <td>Rp <?php echo number_format($myData['Harga']);?></td>
        <td>Rp <?php echo number_format($myData['TotalHarga']);?></td>
        </tr>
	<?php
	} ;
	?>
	</tbody>
	</table>
</form>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

