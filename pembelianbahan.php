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

	$query =mysqli_query($connection,"SELECT max(kodePembelianBahan) as maxKode FROM pembelianbahan");
	$data = mysqli_fetch_array($query);
	$maxkode = $data['maxKode'];

	$nourut = (int) substr($maxkode, 2, 3);
	$nourut++;
	$char = 'PB';
	$kodejadi = $char . sprintf("%03s", $nourut);

	if(isset($_POST["Batal"])){
		header("location:pembelianbahanview.php");
	}

    if(isset($_POST['Simpan']))
    {
    	if(isset($_REQUEST['inputTanggal']))
    	{
    	$Tanggal =$_REQUEST['inputTanggal'];}

    	if (!empty($Tanggal))
    	{
    		$Tanggal =$_POST['inputTanggal'];
    	}

    	else{
    		die('Anda harus memasukkan tanggal');
    	}

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

    	if(isset($_REQUEST['inputjumlah']))
    	{
    	$Jumlah =$_REQUEST['inputjumlah'];}

    	if (!empty($Jumlah))
    	{
    		$Jumlah =$_POST['inputjumlah'];
    	}

    	else{
    		die('Anda harus memasukkan Jumlah Pembelian');
    	}

    	if(isset($_REQUEST['inputharga']))
    	{
    	$Harga =$_REQUEST['inputharga'];}

    	if (!empty($Harga))
    	{
    		$Harga =$_POST['inputharga'];
    	}

    	else{
    		die('Anda harus memasukkan harga Pembelian');
    	}

    	$Total = $Jumlah * $Harga;


    mysqli_query($connection,"insert into pembelianbahan values ('$kodejadi', '$Tanggal', '$persediaan', '$Jumlah', '$Harga', '$Total')");

    $cekstok = mysqli_query($connection,"select * from persediaan where kodePersediaan = '$persediaan'");
    $ambildata = mysqli_fetch_array($cekstok);
    $stoksekarang = $ambildata['Stok'];
    $totalstoksekarang = $stoksekarang+$Jumlah;

    $updatestokpersediaan = mysqli_query($connection,"update persediaan set stok='$totalstoksekarang' where kodePersediaan = '$persediaan'");

    header("location:pembelianbahanview.php");

    }

     $datapersediaan = mysqli_query($connection,"select * from persediaan");
?>


<HTML LANG="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Daftar Pembelian Bahan</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

	<div class="row">

	<div class="col-sm-1"></div>
  	<div class="col-sm-10">
  	
  	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Input Pembelian Bahan</h1>
		</div>
	</div>

   	<form method="POST">
  
	 	<div class="form-group row">
	    	<label for="kodePemasukanBarang" class="col-sm-3 col-form-label">Kode Pembelian Bahan</label>
			    <div class="col-sm-9">
			      <input type="text" readonly class="form-control" id="kodePemasukanBarang" name="inputPemasukanBarang"
			      value="<?php echo $kodejadi?>">
			    </div>
	  	</div>

	   	<div class="form-group row">
		    <label for="Tanggal" class="col-sm-3 col-form-label">Tanggal</label>
			    <div class="col-sm-9">
			      <input type="date" class="form-control" id="Tanggal" 
			      name="inputTanggal"placeholder="">
			    </div>
	 	</div>

	 	<div class="form-group row">
		    <label for="persediaan" class="col-sm-3 col-form-label">Persediaan</label>
			    <div class="col-sm-9">
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
		    <label for="TotalPemasukan" class="col-sm-3 col-form-label">Jumlah Pembelian</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="Pembelian" 
			      name="inputjumlah"placeholder="Jumlah Pembeliaan">
			    </div>
	 	</div>

	 	<div class="form-group row">
		    <label for="TotalPemasukan" class="col-sm-3 col-form-label">Harga</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="Harga" 
			      name="inputharga"placeholder="Harga Pembelian">
			    </div>
	 	</div>

	   	<div class="form-group row">
	  		<div class="col-sm-9"></div>
	    	<div class="col-sm-3">
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