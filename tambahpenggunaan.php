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
    $datakandang = mysqli_query($connection,"select * from kandang");

    if(isset($_POST["Batal"])){
		header("location:penggunaanpakand.php?tanggal=$Tanggal");
	}

	if(isset($_POST['Simpan'])){
		
    	if(isset($_REQUEST['inputkandang']))
    	{
    	$kandang =$_REQUEST['inputkandang'];}

    	if (!empty($kandang))
    	{
    		$kandang =$_POST['inputkandang'];
    	}

    	else{
    		die('Anda harus memasukkan kandang');
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
 
    	$cekstok = mysqli_query($connection,"select * from persediaan where kodePersediaan = 'PD001'");
    	$ambildata = mysqli_fetch_array($cekstok);
    	$stoksekarang = $ambildata['Stok'];

	    $kodepenggunaan = $_GET["tambah"];

    	if($stoksekarang >= $Total)
    	{
    		mysqli_query($connection,"insert into penggunaanpakand (KodePenggunaanPakan, KodeKandang, KodePersediaan, TotalPenggunaan)values ('$kodepenggunaan', '$kandang', 'PD001', $Total)");
    		$totalstoksekarang = $stoksekarang-$Total;
    		$updatestokpersediaan = mysqli_query($connection,"update persediaan set stok='$totalstoksekarang' where kodePersediaan = 'PD001'");
    		header("location:penggunaanpakand.php?tanggal=$Tanggal");
    	}
    	else {
    		echo"<script>alert('Stok $namapersediaan tersisa $stoksekarang');
    		document.location='tambahpenggunaan.php?tanggal=$Tanggal'</script>";
    	}

    	
	}
?>


<HTML LANG="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Daftar Penggunaan </title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

	<div class="row">

	<div class="col-sm-1"></div>
  	<div class="col-sm-10">
  	
  	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Input Penggunaan</h1>
		</div>
	</div>
			<!--penutup jumbotron-->

   	<form method="POST">
  
  		<div class="form-group row">
		    <label for="kandang" class="col-sm-2 col-form-label">Kandang</label>
			    <div class="col-sm-4">
			      	<select class="form-control" id="kodeKandang" name="inputkandang">
				      <?php while($row = mysqli_fetch_array($datakandang))
				      {?>
				      <option value="<?php echo $row["KodeKandang"]?>">
				        <?php echo $row["NamaKandang"]?>
				      </option>
				    	<?php } ?>
				   	</select>
			    </div>
	 	</div>

	   	<div class="form-group row">
		    <label for="TotalPemasukan" class="col-sm-2 col-form-label">Total Penggunaan</label>
			    <div class="col-sm-4">
			      <input type="num" class="form-control" id="PenggunaanPakan" 
			      name="inputtotalpenggunaan"placeholder="Total Penggunaan">
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