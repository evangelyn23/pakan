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

	if(isset($_POST['add']))
    {
    $query =mysqli_query($connection,"SELECT max(kodePengelolaan) as maxKode FROM pengelolaanpakanh");
	$data = mysqli_fetch_array($query);
	$maxkode = $data['maxKode'];

	$nourut = (int) substr($maxkode, 2, 3);
	$nourut++;
	$char = 'PP';
	$kodejadi = $char . sprintf("%03s", $nourut);

		$cekstok = mysqli_query($connection,"select * from persediaan where kodePersediaan = 'PD008'");
    	$ambildata = mysqli_fetch_array($cekstok);
    	$stoksekarang = $ambildata['Stok'];

    	if($stoksekarang >= 50)
    	{mysqli_query($connection,"insert into pengelolaanpakandtemp (KodePengelolaan, KodePersediaan, TotalPenggunaan, SubTotalProtein)values ('$kodejadi', 'PD008', 50, 100)");}

    	$cekstok2 = mysqli_query($connection,"select * from persediaan where kodePersediaan = 'PD009'");
    	$ambildata2 = mysqli_fetch_array($cekstok);
    	$stoksekarang2 = $ambildata['Stok'];

    	if($stoksekarang2 >= 30)
    	{mysqli_query($connection,"insert into pengelolaanpakandtemp (KodePengelolaan, KodePersediaan, TotalPenggunaan, SubTotalProtein)values ('$kodejadi', 'PD009', 30, 60)");}

    	$cekstok3 = mysqli_query($connection,"select * from persediaan where kodePersediaan = 'PD010'");
    	$ambildata3 = mysqli_fetch_array($cekstok);
    	$stoksekarang3 = $ambildata['Stok'];

    	if($stoksekarang2 >= 30)
    	{mysqli_query($connection,"insert into pengelolaanpakandtemp (KodePengelolaan, KodePersediaan, TotalPenggunaan, SubTotalProtein)values ('$kodejadi', 'PD010', 20, 24)");}

	    header("location:pengelolaanpakan.php");
    }
    if(isset($_POST['Batal'])){header("location:pengelolaanpakan.php");}
?>

<HTML LANG="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Daftar Pengelolaan Pakan</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!-- Bootstrap DataTables CSS -->
	<!-- Jquery -->
	<script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<!-- Jquery DataTables -->
	<script type="text/javascript" language="javascript" src="http:////cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
	<!-- Bootstrap dataTables Javascript -->
	<script type="text/javascript" language="javascript" src="http://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>

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
					Daftar Pengelolaan Pakan</h1>
				</div>
			</div>
		<td>
			<div style="text-align: right">
			<form method="POST">
			<input type="submit" class="btn btn-primary" value="add" name="add">
		    </form>
			<br>
			<br>
			</div>
		</td>

		<table class="table table-striped table-bordered table-paginate" cellspacing="0" width="100%">
			<thead class="thead-dark">
				<tr>
					<th>No</th>
					<th>Kode Pengelolaaan</th>
					<th style="text-align: center">Tanggal</th>
					<th style="text-align: center">Total Protein</th>
					<th style="text-align: center">Total Pakan</th>
					<th style="text-align: center">Hasil Pengelolaan</th>
					<th style="text-align: center">Action</th>
				</tr>
			</thead>

			<tbody>	
			<?php
			$query =mysqli_query($connection,"select * from pengelolaanpakanh ph join persediaanpakan k on ph.kodepersediaanpakan = k.kodepersediaanpakan");
		
			$nomor =1;
			while($row =mysqli_fetch_array($query))
			{
				?>
				<tr>
				<td><?php echo $nomor;?></td>
				<td><?php echo $row['KodePengelolaan'];?></td>
				<td><?php echo $row['Tanggal'];?></td>
				<td style="text-align: center"><?php echo $row['TotalProtein'];?></td>
				<td style="text-align: center"><?php echo $row['TotalPakan'];?></td>
				<td style="text-align: center"><?php echo $row['NamaPersediaanPakan'];?></td>
				<td style="text-align: center">
					<a href="pengelolaanpakandetail.php?detail=<?php echo $row["KodePengelolaan"]?>" class="btn btn-link btn-sm" title="detail">
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