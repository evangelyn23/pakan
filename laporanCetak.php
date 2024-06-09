<?php 
session_start();

include "INCLUDES/confiig.php";
include "INCLUDES/library.php";

$awal	= $_GET['awal']; 
$akhir	= $_GET['akhir'];

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
<center><h2>LAPORAN PENGELOLAAN PAKAN</h2> <br>
<center><h2>CV SEHATI FARM</h2> 
<hr> <br></h4>PERIODE PEMESANAN <b><?php echo IndonesiaTgl($awal); ?> s/d <?php echo IndonesiaTgl($akhir); ?></b>
<br> 
<br>
<br>
</h4></center>
<?php } else { ?>
<center><h2>LAPORAN PENGELOLAAN PAKAN
</h2></center>
<hr>
<?php } ?>

<table class="table my-0">
	<thead>
    <th>No</th>
    <th>Kode Pengelolaan</th>
    <th>Tanggal</th>
	<th>Total Protein</th>
    <th>Total Pakan</th>
    <th>Hasil Pengelolaan</th>
    </thead>
    <tbody>
								
	<?php
	$Sql 	= "SELECT * FROM pengelolaanpakanh ph join persediaanpakan k on ph.kodepersediaanpakan = k.kodepersediaanpakan $SqlPeriode";			
	$myQry 	= mysqli_query($connection, $Sql);
	$nomor  = 0; 
	$TotalPakan=0;
	$TotalProtein=0;
	while ($myData = mysqli_fetch_array($myQry)) {	
	$TotalPakan+=$myData['TotalPakan'];	
	$TotalProtein+=$myData['TotalProtein'];									
	$nomor++;
	?>						
    <tr>			
	<td><?php echo $nomor;?></td>
	<td><?php echo $myData['KodePengelolaan'];?></td>
    <td><?php echo $myData['Tanggal'];?></td> 
	<td><?php echo number_format($myData['TotalProtein']);?></td>										
    <td><?php echo number_format($myData['TotalPakan']);?></td>
    <td><?php echo $myData['NamaPersediaanPakan'];?></td>
    </tr>
	<?php
	} ;
	?>
    </tbody>
  	<tr>
	<th align="center" ><strong></strong></th>
	<th><strong></strong></th>
	<th><strong></strong></th>
	<th><strong></strong></th>
	<th><strong> Total Protein</strong></th>  
	<th style="background-color:whitesmoke;" align="right" ><strong><?php echo number_format($TotalProtein); ?></strong></th>
	</tr>
	<tr>
	<th align="center" ><strong></strong></th>
	<th  ><strong></strong></th>
	<th  ><strong></strong></th>
	<th  ><strong></strong></th>
	<th  ><strong> Total Pakan</strong></th>
	<th style="background-color:whitesmoke;" align="right" ><strong><?php echo number_format($TotalPakan); ?></strong></th>
	</tr>      
</table>

</form>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

