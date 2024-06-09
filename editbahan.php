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

	$Tanggal = $_GET["tanggal"];

	if(isset($_POST["Batal"])){
		header("location:PengelolaanPakan.php?tanggal=$Tanggal");
	}

  	$kodeedit = $_GET["ubah"];
    $editbahan = mysqli_query($connection, "SELECT * FROM pengelolaanpakand WHERE Nomor ='$kodeedit'");
    $rowedit = mysqli_fetch_array($editbahan);
    $ambilpenggunaan = $rowedit['TotalPenggunaan'];

	$datapersediaan = mysqli_query($connection,"select * from persediaan where not KodePersediaan = 'PD001'");
    $datapersediaanedit = mysqli_query($connection,"select * from persediaan p join pengelolaanpakand pt on p.KodePersediaan = pt.KodePersediaan where pt.Nomor = $kodeedit");
    $rowedit2 = mysqli_fetch_array($datapersediaanedit);

	if(isset($_POST['Simpan'])){
		if(isset($_REQUEST['inputpersediaan']))
    	{
    	$persediaan =$_REQUEST['inputpersediaan'];}

    	if (!empty($persediaan))
    	{
    		$persediaan =$_POST['inputpersediaan'];
    	}

    	else{
    		die('Anda harus memasukkan persediaan');
    	}

    	if(isset($_REQUEST['inputtotalpenggunaan']))
    	{
    	$Total =$_REQUEST['inputtotalpenggunaan'];}

    	if (!empty($Total))
    	{
    		$Total =$_POST['inputtotalpenggunaan'];
    	}

    	else{
    		die('Anda harus memasukkan Total Pemasukan');
    	}

    	$cekpersediaan = mysqli_query($connection,"select * from persediaan where kodePersediaan = '$persediaan'");
    	$ambildata = mysqli_fetch_array($cekpersediaan);
    	$stoksekarang = $ambildata['Stok'];
    	$kodepersediaan = $ambildata['KodePersediaan'];
    	$namapersediaan = $ambildata['NamaPersediaan'];

	    $stdpro = $ambildata['StandarProtein'];
	    $subtotalstdpro = $stdpro * $Total;

	    $stokedit = $stoksekarang+$ambilpenggunaan-$Total;
    	$stokyangbisadiedit = $stoksekarang+$ambilpenggunaan;

    	if($stoksekarang >= $Total)
    	{
    		mysqli_query($connection,"update pengelolaanpakand set KodePersediaan='$persediaan', TotalPenggunaan='$Total', SubTotalProtein='$subtotalstdpro' WHERE Nomor ='$kodeedit'");
    		mysqli_query($connection,"update persediaan set stok='$stokedit' where kodePersediaan = '$kodepersediaan'");
    		header("location:PengelolaanPakan.php?tanggal=$Tanggal");
    	}
    	else {
    		echo"<script>alert('Stok pakan tersisa $stokyangbisadiedit');
    		document.location='editbahan.php?tanggal=$Tanggal'</script>";
    	}
	}

	
?>


<HTML LANG="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Daftar Bahan </title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

	<div class="row">

	<div class="col-sm-1"></div>
  	<div class="col-sm-10">
  	
  	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Edit Bahan</h1>
		</div>
	</div>
			<!--penutup jumbotron-->

   	<form method="POST">
  
	 	<div class="form-group row">
		    <label for="persediaan" class="col-sm-2 col-form-label">Persediaan</label>
			    <div class="col-sm-4">
			      	<select disabled="true" class="form-control" id="kodePersediaan" name="inputpersediaan">
			      	
			      	<option value="<?php echo $rowedit["KodePersediaan"]?>">
				        <?php echo $rowedit2["NamaPersediaan"]?>
				     </option>

					<input type="hidden" class="form-control" id="kodePersediaan" 
			      name="inputpersediaan" value="<?php echo $rowedit["KodePersediaan"]?>">
				   	</select>
			    </div>
	 	</div>

	   	<div class="form-group row">
		    <label for="TotalPemasukan" class="col-sm-2 col-form-label">Total Penggunaan</label>
			    <div class="col-sm-4">
			      <input type="num" class="form-control" id="PenggunaanBahan" 
			      name="inputtotalpenggunaan" value="<?php echo $rowedit["TotalPenggunaan"]?>">
			    </div>
	 	</div>

	   	<div class="form-group row">
	  		<div class="col-sm-2"></div>
	    	<div class="col-sm-10">
		      <input type="submit" class="btn btn-primary" value="Simpan" name="Simpan">
	 		  <input type="submit" class="btn btn-secondary" value="Batal" name="Batal">
	    	</div>
	  	</div>
	</form>

	</div>
	</div>
</div>
</div>
<?php include"footer.php";?>
<?php 
mysqli_close($connection);
ob_end_flush();
?>
</HTML>