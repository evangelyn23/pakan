<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-widt, initial-scale=1.0">
	<title>PAKAN</title>
</head>

<?php
ob_start();
session_start();
if(!isset($_SESSION['emailuser']))
	header("location:login.php");

$name = $_SESSION['emailuser'];

if(isset($_SESSION['role']))
	$role = $_SESSION['role'];
	
if($role == 'Admin')
	include "header.php";

if($role == 'Spv')
	include "headerSpv.php";
?>

<div class="container-fluid">
<div class="card shadow mb-4">

<?php
include "INCLUDES/confiig.php";
?>

<HTML LANG="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Daftar Pembelian Bahan</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<!-- Jquery DataTables -->
	<script type="text/javascript" language="javascript" src="http:////cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
	<!-- Bootstrap dataTables Javascript -->
	<script type="text/javascript" language="javascript" src="http://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>

	<!-- Panggil Fungsi -->
	<script type="text/javascript" charset="utf-8">
	    $(document).ready(function() {
		$('.table-paginate').dataTable();
	 } );
	</script>
</head>

	<div class="row">
  	<div class="col-sm-12">
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-10">
			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4">
					Daftar Pembelian Bahan</h1>
				</div>
			</div>
		<td>
			<div style="text-align: right">
			<a href="pembelianbahan.php" class="btn btn-primary .btn-lg" title="add"> Add </a>
			<br>
			<br>
			</div>
		</td>

		<table class="table table-hover table-paginate">
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Kode Pembelian Bahan</th>
					<th>Tanggal</th>
					<th>Barang</th>
					<th style="text-align: center">Jumlah</th>
					<th style="text-align: center">Harga</th>
					<th style="text-align: center">Total Harga</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>	
		<?php

			$query =mysqli_query($connection,"select * from pembelianbahan");
			$nomor =1;
			while($row =mysqli_fetch_array($query))
			{
				$kodepersediaan = $row['KodePersediaan'];
				$persediaan =mysqli_query($connection,"select * from persediaan where kodepersediaan ='$kodepersediaan'");
				$ambildata = mysqli_fetch_array($persediaan);
    			$namapersediaan = $ambildata['NamaPersediaan'];
				?>
				<tr>
				<td><?php echo $nomor;?></td>
				<td><?php echo $row['KodePembelianBahan'];?></td>
				<td><?php echo $row['Tanggal'];?></td>
				<td><?php echo $namapersediaan;?></td>
				<td style="text-align: center"><?php echo $row['Jumlah'];?></td>
				<td>Rp <?php echo number_format($row['Harga']);?></td>
				<td>Rp <?php echo number_format($row['TotalHarga']);?></td>
<!--untuk icon-->
<td>
	<a href="pembelianbahanedit.php?ubah=<?php echo $row["KodePembelianBahan"]?>" class="btn btn-success btn-sm" title="edit">
	<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  	<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  	<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
	</svg>
	</a>
</td>

	<td>
	<a href="pembelianbahanHapus.php?hapus=<?php echo$row["KodePembelianBahan"]?>"class="btn btn-danger btn-sm" title="delete">
	<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  	<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  	<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
	</svg>
	</a>
</td>
<!--akhir icon-->
				</tr>
				<?php $nomor=$nomor+1;?>
			<?php
		}
			?>
			</tbody>
		</table>
		</div>
		<div class="col-sm-1"></div>
	</div>
</div>
</div>
<br>
<?php include"footer.php";?>
<?php 
mysqli_close($connection);
ob_end_flush();
?>
</HTML>