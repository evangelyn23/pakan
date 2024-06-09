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
					Daftar pengelolaan pakan <?php echo $kodedetail?></h1>
				</div>
			</div>
		<td>
			<div>
				<a href="pengelolaanpakanH.php" class="btn btn-primary .btn-lg" title="add"> Back </a>
			<br>
			<br>
			</div>
		</td>

		<table class="table table-hover">
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Nama Persediaan</th>
					<th style="text-align: center;">Standar Protein</th>
					<th style="text-align: center;">Total Penggunaan</th>
					<th style="text-align: center;">Satuan</th>
					<th style="text-align: center;">Sub Total Protein</th>
				</tr>
			</thead>
			<tbody>
				
		<?php

			$query =mysqli_query($connection,"select * from pengelolaanpakand where KodePengelolaan = '$kodedetail'");
		
			$nomor =1;
			$hasiltotal =0;
			$TotalPakan = 0;
			while($row =mysqli_fetch_array($query))
			{
				$kodepersediaan = $row['KodePersediaan'];
				$persediaan =mysqli_query($connection,"select * from persediaan where kodepersediaan ='$kodepersediaan'");
				$ambildata = mysqli_fetch_array($persediaan);
    			$namapersediaan = $ambildata['NamaPersediaan'];
    			$standarprt = $ambildata['StandarProtein'];
    			$satuan = $ambildata['Satuan'];	
				$hasiltotal+=$row['SubTotalProtein'];	
				$TotalPakan+=$row['TotalPenggunaan'];
				?>
				<tr>
				<td><?php echo $nomor;?></td>
				<td><?php echo $namapersediaan;?></td>
				<td style="text-align: center;"><?php echo $standarprt;?></td>
				<td style="text-align: center;"><?php echo $row['TotalPenggunaan'];?></td>
				<td style="text-align: center;"><?php echo $satuan;?></td>
				<td style="text-align: center;"><?php echo $row['SubTotalProtein'];?></td>

				</tr>

				<?php $nomor=$nomor+1;?>
			<?php
		}
			?>
			</tbody>
			<tr>
			<th align="center" ><strong></strong></th>
			<th><strong></strong></th>
			<th><strong></strong></th>
			<th><strong></strong></th>
			<th><strong> Total Protein</strong></th>  
			<th style="background-color:whitesmoke;" align="right" ><strong><?php echo number_format($hasiltotal); ?></strong></th>
			</tr>
			<tr>
			<th align="center" ><strong></strong></th>
			<th  ><strong></strong></th>
			<th  ><strong></strong></th>
			<th  ><strong></strong></th>
			<th  ><strong> Total Pakan</strong></th>
			<th style="background-color:whitesmoke;" align="right" ><strong><?php echo number_format($TotalPakan); ?> <?php echo $satuan;?></strong></th>
			</tr>   
			<tr>
			<th align="center" ><strong></strong></th>
			<th  ><strong></strong></th>
			<th  ><strong></strong></th>
			<th  ><strong></strong></th>
			<th  ><strong> Protein/<?php echo $satuan;?></strong></th>
			<th style="background-color:whitesmoke;" align="right" ><strong> <?php echo $hasiltotal/ $TotalPakan; ?></strong></th>
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