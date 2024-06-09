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
    $editpersediaan = mysqli_query($connection, "SELECT * FROM persediaanPakan WHERE KodePersediaanPakan ='$kodeedit'");
    $rowedit = mysqli_fetch_array($editpersediaan);
	if(isset($_POST["Batal"])){
		header("location:persediaanpakanview.php");
	}

    if(isset($_POST['Simpan']))
    {
    	if(isset($_REQUEST['inputnama']))
    	{
    	$namaPersediaan =$_REQUEST['inputnama'];}

    	if (!empty($namaPersediaan))
    	{
    		$namaPersediaan =$_POST['inputnama'];
    	}

    	else{
    		die('Anda harus memasukkan nama Persediaan');
    	}

    	if(isset($_REQUEST['inputsatuan']))
    	{
    	$satuan =$_REQUEST['inputsatuan'];}

    	if (!empty($satuan))
    	{
    		$satuan =$_POST['inputsatuan'];
    	}

    	else{
    		die('Anda harus memasukkan satuan');
    	}

    	if(isset($_REQUEST['inputStok']))
    	{
    	$stok =$_REQUEST['inputStok'];}

    	if (!empty($stok))
    	{
    		if($stok<0){
    			die('Stok harus diatas 0');
    		}
    		$stok =$_POST['inputStok'];
    	}

    	else{
    		die('Anda harus memasukkan stok');
    	}

	mysqli_query($connection, "update PersediaanPakan set NamaPersediaanPakan='$namaPersediaan', Satuan = '$satuan', Stok = '$stok'
		where KodePersediaanPakan = '$kodeedit'");
    header("location:persediaanpakanView.php");

    }
?>


<HTML LANG="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Daftar Persediaan Pakan</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

	<div class="row">
	<div class="col-sm-1"></div>
  	<div class="col-sm-10">
  	
  	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Edit Persediaan Pakan</h1>
		</div>
	</div>

   	<form method="POST">
	 	<div class="form-group row">
	    	<label for="kodePersediaan" class="col-sm-3 col-form-label">Kode Persediaan Pakan</label>
			    <div class="col-sm-7">
			      <input type="text" readonly class="form-control" id="kodePersediaan" name="inputPersediaan"
			      value="<?php echo $rowedit["KodePersediaanPakan"]?>">
			    </div>
	  	</div>

	   	<div class="form-group row">
		    <label for="namaPersediaan" class="col-sm-3 col-form-label">Nama Persediaan Pakan</label>
			    <div class="col-sm-7">
			      <input type="text" class="form-control" id="namaPersediaan" 
			      name="inputnama" value="<?php echo $rowedit["NamaPersediaanPakan"]?>">
			    </div>
	 	</div>


	 	<div class="form-group row">
		    <label for="Satuan" class="col-sm-3 col-form-label">Satuan</label>
			    <div class="col-sm-7">
			      <input type="text" class="form-control" id="Satuan" readonly
			      name="inputsatuan" value="<?php echo $rowedit["Satuan"]?>">
			    </div>
	 	</div>

	 	<div class="form-group row">
		    <label for="Stok" class="col-sm-3 col-form-label">Stok</label>
			    <div class="col-sm-7">
			      <input type="text" class="form-control" id="Stok" 
			      name="inputStok" value="<?php echo $rowedit["Stok"]?>">
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