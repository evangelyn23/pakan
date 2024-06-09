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

$kodedetail = $_GET["detail"];
?>


<HTML LANG="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Daftar persediaan </title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

	<div class="row">
  	<div class="col-sm-12">
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-10">
			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4">
					Daftar penggunaan pakan <?php echo $kodedetail?></h1>
				</div>
			</div>
		<td>
			<div>
				<a href="penggunaanpakanh.php" class="btn btn-primary .btn-lg" title="add"> Back </a>
			<br>
			<br>
			</div>
		</td>

		<table class="table table-hover">
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Nama Kandang</th>
					<th>Nama Persediaan</th>
					<th>Sub Total Penggunaan</th>
					<th>Satuan</th>
				</tr>
			</thead>
			<tbody>
		<?php

			$query =mysqli_query($connection,"select * from penggunaanpakand where KodePenggunaanPakan = '$kodedetail'");
			$nomor =1;
			$TotalPakan=0;
			while($row =mysqli_fetch_array($query))
			{
				$kodepersediaan = $row['KodePersediaanPakan'];
				$persediaan =mysqli_query($connection,"select * from persediaanpakan where kodepersediaanpakan ='$kodepersediaan'");
				$ambildata = mysqli_fetch_array($persediaan);
    			$namapersediaan = $ambildata['NamaPersediaanPakan'];
    			$satuan = $ambildata['Satuan'];
    			$TotalPakan+=$row['TotalPenggunaan'];

    			$kodekandang = $row['KodeKandang'];
				$kandang =mysqli_query($connection,"select * from kandang where KodeKandang ='$kodekandang'");
				$ambildata2 = mysqli_fetch_array($kandang);
    			$namakandang = $ambildata2['NamaKandang'];
				?>
				<tr>
				<td><?php echo $nomor;?></td>
				<td><?php echo $namakandang;?></td>
				<td><?php echo $namapersediaan;?></td>
				<td><?php echo $row['TotalPenggunaan'];?></td>
				<td><?php echo $satuan;?></td>
				</tr>
				<?php $nomor=$nomor+1;?>
			<?php
		}
			?>
			</tbody>
			<tr>
	<th align="center" ><strong></strong></th>
	<th  ><strong></strong></th>
	<th  ><strong> Total Penggunaan</strong></th>
	<th style="background-color:whitesmoke;" align="right" ><strong><?php echo number_format($TotalPakan);?></strong></th>
	<th style="background-color:whitesmoke;" align="right" ><strong><?php echo $satuan;?></strong></th>
	</tr> 
		</table>
		</div>
		<div class="col-sm-1"></div>
	</div>
</div>
</div>
<?php include"footer.php";?>
<?php 
mysqli_close($connection);
ob_end_flush();
?>
</HTML>