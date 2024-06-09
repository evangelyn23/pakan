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
	<title> Daftar Penggunaan Pakan</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!-- Bootstrap CSS -->
	<!-- Bootstrap DataTables CSS -->
	<!-- Jquery -->
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
	<div class="col-sm-1">
  	</div>
  	<div class="col-sm-10">
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-10">
			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4">
					Daftar Penggunaan Pakan</h1>
				</div>
			</div>
		<td>
			<div style="text-align: right">
			<a href="penggunaanpakand.php" class="btn btn-primary .btn-lg" title="add"> Add </a>
			<br>
			<br>
			</div>
		</td>

		<table class="table table-striped table-bordered table-paginate" cellspacing="0" width="100%">
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Kode Penggunaan</th>
					<th style="text-align: center">Tanggal</th>
					<th style="text-align: center">Total Penggunaan</th>
					<th style="text-align: center">Action</th>
				</tr>
			</thead>

			<tbody>
				
		<?php

			$query =mysqli_query($connection,"select * from penggunaanpakan");
		
			$nomor =1;
			while($row =mysqli_fetch_array($query))
			{
				?>
				<tr>
				<td><?php echo $nomor;?></td>
				<td><?php echo $row['KodePenggunaanPakan'];?></td>
				<td><?php echo $row['Tanggal'];?></td>
				<td style="text-align: center"><?php echo $row['TotalPenggunaan'];?></td>
<td style="text-align: center">
	<a href="penggunaanpakandetail.php?detail=<?php echo $row["KodePenggunaanPakan"]?>" class="btn btn-link btn-sm" title="detail">
	View Detail
	</a>
</td>
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