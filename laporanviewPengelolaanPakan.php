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
	
if($role == 'Owner')
	include "headerOwner.php";

if($role == 'Admin')
	include "header.php";
?>

<div class="container-fluid">
<div class="card shadow mb-4">

<?php 
include "INCLUDES/confiig.php";

$SqlPeriode = ""; 
$awalTgl	= ""; 
$akhirTgl	= ""; 
$tglAwal	= ""; 
$tglAkhir	= "";

if(isset($_POST['btnTampil'])) {
	$tglAwal 	= isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "01-".date('m-Y');
	$tglAkhir 	= isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : date('d-m-Y');
	$SqlPeriode = " where Tanggal BETWEEN '".$tglAwal."' AND '".$tglAkhir."'";
}
else {
	$awalTgl 	= "01-".date('m-Y');
	$akhirTgl 	= date('d-m-Y'); 
	$SqlPeriode = " where Tanggal BETWEEN '".$awalTgl."' AND '".$akhirTgl."'";
}

?>
<HTML LANG="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Data Pengelolaan Pakan </title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<main class="page shopping-cart-page">
    <div class="container-fluid">
    <br>
    <h3 class="text-dark mb-4">Data Pengelolaan Pakan</h3>
	<h4>Periode Tanggal <b><?php echo ($tglAwal); ?></b> s/d <b><?php echo ($tglAkhir); ?></b></h4><br>
    <div class="card shadow">
    <div class="card-body">
	<form method="post" name="form10" target="_self">			
	<div class="row">
	<div class="col-lg-3">
	<input name="txtTglAwal" type="date" class="form-control" value="<?php echo $awalTgl; ?>" size="10" /> 
	</div>
	<div class="col-lg-3">
	<input name="txtTglAkhir" type="date" class="form-control" value="<?php echo $akhirTgl; ?>" size="10" />
	</div>
	<div class="col-lg-3">			
	<input name="btnTampil" class="btn btn-success" type="submit" value="Tampilkan" />
	</div>	  
	</div>
	</form>
    <div class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
        <table class="table dataTable my-0">
             <thead>
                 <tr>
                     <th>No</th>
                     <th>Kode Pengelolaan</th>
                     <th>Tanggal</th>			
                     <th>Total Protein</th>
                     <th>Total Pakan</th>
                     <th>Hasil Pengelolaan</th>
                 </tr>
             </thead>
             <tbody>
			<?php
			$Sql 	= "SELECT * FROM pengelolaanpakanh ph join persediaanpakan k on ph.kodepersediaanpakan = k.kodepersediaanpakan $SqlPeriode";								
			$myQry 	= mysqli_query($connection, $Sql);
			$nomor  = 0; 
			while ($myData = mysqli_fetch_array($myQry)) {		
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
			} $nomor++;
			?>
            </tbody>
        </table>
        </div>
						
	<div class="row">
		  <div class="col-lg-3">
		  <a href="laporancetak.php?awal=<?php echo $tglAwal; ?>&&akhir=<?php echo $tglAkhir; ?>" target="_blank" alt="Edit Data" class="btn btn-primary">Cetak Laporan</a>
		  </div>
	 </div>              
                    </div>
                </div>
            </div>                  
    </main>

</div>
</div>
<?php include"footer.php";?>
<?php 
mysqli_close($connection);
ob_end_flush();
?>
 </HTML>