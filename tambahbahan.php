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

    $datapersediaan = mysqli_query($connection,"select * from persediaan where not KodePersediaan = 'PD001'");
    $Tanggal = $_GET["tanggal"];

    if(isset($_POST["Batal"])){
		header("location:PengelolaanPakan.php?tanggal=$Tanggal");
	}

	if(isset($_POST['SimpanTemp'])){
		
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
    		die('Anda harus memasukkan Total Penggunaan');
    	}
 
    	$cekstok = mysqli_query($connection,"select * from persediaan where kodePersediaan = '$persediaan'");
    	$ambildata = mysqli_fetch_array($cekstok);
    	$stoksekarang = $ambildata['Stok'];
    	$kodepersediaan = $ambildata['KodePersediaan'];
    	$namapersediaan = $ambildata['NamaPersediaan'];

	    $stdpro = $ambildata['StandarProtein'];
	    $subtotalstdpro = $stdpro * $Total;

	    $kodejadi = $_GET["tambah"];

    	if($stoksekarang >= $Total)
    	{
    		mysqli_query($connection,"insert into pengelolaanpakandtemp (KodePengelolaan, KodePersediaan, TotalPenggunaan, SubTotalProtein)values ('$kodejadi', '$persediaan', '$Total', $subtotalstdpro)");
    		$totalstoksekarang = $stoksekarang-$Total;
    		$updatestokpersediaan = mysqli_query($connection,"update persediaan set stok='$totalstoksekarang' where kodePersediaan = '$kodepersediaan'");
    		header("location:PengelolaanPakan.php?tanggal=$Tanggal");
    	}
    	else {
    		echo"<script>alert('Stok $namapersediaan tersisa $stoksekarang');
    		document.location='tambahbahan.php?tanggal=$Tanggal'</script>";
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
			<h1 class="display-4">Input Bahan</h1>
		</div>
	</div>
			<!--penutup jumbotron-->

   	<form method="POST">
  
	 	<div class="form-group row">
		    <label for="persediaan" class="col-sm-2 col-form-label">Persediaan</label>
			    <div class="col-sm-4">
			      	<select class="form-control" id="kodePersediaan" name="inputpersediaan">
				      <?php while($row = mysqli_fetch_array($datapersediaan))
				      {?>
				      <option value="<?php echo $row["KodePersediaan"]?>">
				        <?php echo $row["NamaPersediaan"]?>
				      </option>
				    	<?php } ?>
				   	</select>
			    </div>
	 	</div>

	   	<div class="form-group row">
		    <label for="TotalPemasukan" class="col-sm-2 col-form-label">Total Penggunaan</label>
			    <div class="col-sm-4">
			      <input type="num" class="form-control" id="PenggunaanBahan" 
			      name="inputtotalpenggunaan"placeholder="Total Penggunaan">
			    </div>
	 	</div>

	   	<div class="form-group row">
	  		<div class="col-sm-2"></div>
	    	<div class="col-sm-10">
		      <input type="submit" class="btn btn-primary" value="Simpan" name="SimpanTemp">
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