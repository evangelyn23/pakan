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
	$query =mysqli_query($connection,"SELECT max(kodekandang) as maxKode FROM Kandang");
	$data = mysqli_fetch_array($query);
	$maxkode = $data['maxKode'];
	$nourut = (int) substr($maxkode, 2, 3);
	$nourut++;
	$char = 'KD';
	$kodejadi = $char . sprintf("%03s", $nourut);


    if(isset($_POST['Simpan']))
    {
    	if(isset($_REQUEST['inputnama']))
    	{ 
    		$namakandang =$_REQUEST['inputnama'];
    	}

    	if (!empty($namakandang))
    	{
    		$namakandang =$_POST['inputnama'];
    	}
    	else {
    		die('Anda harus memasukkan nama kandang');
    	}
    	$keterangankandang = $_POST['inputketerangan'];
    	if($_REQUEST['inputkapasitas'] < 0){
    		die('Kapasitas harus diatas 0');
    	}
    	$kapasitas =$_POST['inputkapasitas'];
	    mysqli_query($connection,"insert into kandang values ('$kodejadi', '$namakandang', '$keterangankandang', '$kapasitas')");
	    header("location:kandangView.php");
    }

	if(isset($_POST['Batal'])){header("location:kandangView.php");}
?>


<HTML LANG="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Daftar Kandang </title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

	<div class="row">
	<div class="col-sm-1"></div>
  	<div class="col-sm-10">
  	
  	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Input Kandang</h1>
		</div>
	</div>

   	<form method="POST">
  
	 	<div class="form-group row">
	    	<label for="kodekandang" class="col-sm-2 col-form-label">Kode Kandang</label>
			    <div class="col-sm-10">
			      <input type="text" readonly class="form-control" id="kodeKandang" name="inputkode"
			      value="<?php echo $kodejadi?>">
			    </div>
	  	</div>

	   	<div class="form-group row">
		    <label for="namakandang" class="col-sm-2 col-form-label">Nama Kandang</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="namaKandang" 
			      name="inputnama"placeholder="Nama Kandang">
			    </div>
	 	</div>

	 	<div class="form-group row">
		    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="keterangan" 
			      name="inputketerangan"placeholder="Keterangan">
			    </div>
	 	</div>

	 	<div class="form-group row">
		    <label for="kapasitasKandang" class="col-sm-2 col-form-label">Kapasitas Kandang</label>
			    <div class="col-sm-10">
			      <input type="number" class="form-control" id="kapasitasKandang" 
			      name="inputkapasitas"placeholder="Kapasitas Kandang">
			    </div>
	 	</div>


	   	<div class="form-group row">
	  		<div class="col-sm-10"></div>
	    	<div class="col-sm-2">
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