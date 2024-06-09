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

	$kodeedit = $_GET["ubah"];
	if(isset($_POST["Batal"])){
		header("location:KandangView.php");
	}
    if(isset($_POST['Ubah']))
    {
    	if(isset($_REQUEST['inputnama']))
    	{
    	$namakandang =$_REQUEST['inputnama'];}

    	if (!empty($namakandang))
    	{
    		$namakandang =$_POST['inputnama'];
    	}
    	else{
    		die('Anda harus memasukkan nama kandang');
    	}

    	$Keterangan =$_POST['inputKeterangan'];
    	if($_REQUEST['inputkapasitas'] < 0){
    		die('Kapasitas harus diatas 0');
    	}
    	$kapasitas =$_POST['inputkapasitas'];
		mysqli_query($connection, "update kandang set NamaKandang='$namakandang', Keterangan ='$Keterangan', KapasitasKandang = '$kapasitas'
		where KodeKandang = '$kodeedit'");
   		header("location:KandangView.php");
	}
    
    $editkandang = mysqli_query($connection, "SELECT * FROM kandang WHERE KodeKandang ='$kodeedit'");
    $rowedit = mysqli_fetch_array($editkandang);
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
			<h1 class="display-4">Edit Kandang</h1>
		</div>
	</div>

   	<form method="POST">
	 	<div class="form-group row">
	    	<label for="kodedestinasi" class="col-sm-2 col-form-label">Kode Kandang</label>
			    <div class="col-sm-10">
			      <input type="text" readonly class="form-control" id="kodeKandang" name="inputkode"
			      value="<?php echo $rowedit["KodeKandang"]?>">
			    </div>
	  	</div>

	   	<div class="form-group row">
		    <label for="namakandang" class="col-sm-2 col-form-label">Nama Kandang</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="namadestinasi" name="inputnama"
			      value="<?php echo $rowedit["NamaKandang"]?>">
			    </div>
	 	</div>

		<div class="form-group row">
		    <label for="Keterangan" class="col-sm-2 col-form-label">Keterangan</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="Keterangankandang" name="inputKeterangan"
			      value="<?php echo $rowedit["Keterangan"]?>">
			    </div>
	 	</div>

	 	<div class="form-group row">
		    <label for="kapasitasKandang" class="col-sm-2 col-form-label">Kapasitas Kandang</label>
			    <div class="col-sm-10">
			      <input type="number" class="form-control" id="kapasitasKandang" name="inputkapasitas"
			      value="<?php echo $rowedit["KapasitasKandang"]?>">
			    </div>
	 	</div>

	   	<div class="form-group row">
	  		<div class="col-sm-10"></div>
	    	<div class="col-sm-2">
		      <input type="submit" class="btn btn-primary" value="Ubah" name="Ubah">
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