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

	$datakandang = mysqli_query($connection,"select * from kandang");
	$datapersediaanpakan = mysqli_query($connection,"select * from persediaanpakan");

	$query =mysqli_query($connection,"SELECT max(kodePenggunaanPakan) as maxKode FROM penggunaanpakan");
	$data = mysqli_fetch_array($query);
	$maxkode = $data['maxKode'];

	$nourut = (int) substr($maxkode, 2, 3);
	$nourut++;
	$char = 'PG';
	$kodejadi = $char . sprintf("%03s", $nourut);

	if(isset($_POST["Batal"])){
		$query =mysqli_query($connection,"select * from penggunaanpakandtemp where KodePenggunaanPakan = '$kodejadi'");	
				
		while($row =mysqli_fetch_array($query))
		{
		$kodepersediaan= $row['KodePersediaanPakan'];
		$penggunaan= $row['TotalPenggunaan'];
	    $cekstok = mysqli_query($connection,"select * from persediaanpakan where kodePersediaanPakan = '$kodepersediaan'");
   		$ambildata = mysqli_fetch_array($cekstok);
    	$stoksekarang = $ambildata['Stok'];
    	$totalstoksekarang = $stoksekarang+$penggunaan;

		mysqli_query($connection, "update persediaanpakan set stok='$totalstoksekarang' where kodePersediaanPakan = '$kodepersediaan'");
    	}
    	mysqli_query($connection,"delete from penggunaanpakandtemp where KodePenggunaanPakan = '$kodejadi'");

		header("location:penggunaanpakanh.php");
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
    	
    	$TotaLPenggunaan =$_POST['inputtotalpenggunaan'];

	    $insertpenggunaan = mysqli_query($connection,"insert into penggunaanpakan(KodePenggunaanPakan, TotalPenggunaan, Tanggal) values ('$kodejadi', '$TotaLPenggunaan', '$Tanggal')");

	    $query2 =mysqli_query($connection,"select * from penggunaanpakan where KodePenggunaanPakan = '$kodejadi'");

	    if (mysqli_num_rows($query2)>0){
    	mysqli_query($connection,"insert into penggunaanpakand select * from penggunaanpakandtemp");
    	mysqli_query($connection,"delete from penggunaanpakandtemp");
    	}
	    header("location:penggunaanpakanh.php");
    }

    if(isset($_POST['tambah']))
    {
    	if(isset($_REQUEST['inputTanggal']))
    	{
    	$Tanggal =$_REQUEST['inputTanggal'];}

    	if (!empty($Tanggal))
    	{
    		$Tanggal =$_POST['inputTanggal'];
    	}

    	header("location:tambahpenggunaan.php?tambah=$kodejadi&tanggal=$Tanggal");
    }

    if(isset($_POST['hapus']))
    {
    	$nomor = $_POST['inputnomor'];

    	header("location:hapuspenggunaan.php?hapus=$nomor");
    }

    if(isset($_POST['SimpanTemp'])){

    	$kode =$_REQUEST['inputkodepenggunaan'];

    	$KodeKandang =$_REQUEST['inputkandang'];

		$PersediaanPakan =$_REQUEST['inputPersediaanPakan'];

    	if(isset($_REQUEST['inputpenggunaan']))
    	{
    	$Total =$_REQUEST['inputpenggunaan'];}

    	if (!empty($Total))
    	{
    		$Total =$_POST['inputpenggunaan'];
    	}

    	else{
    		die('Anda harus memasukkan Penggunaan');
    	}
 
    	$cekstok = mysqli_query($connection,"select * from persediaanpakan where kodePersediaanpakan = '$PersediaanPakan'");
    	$ambildata = mysqli_fetch_array($cekstok);
    	$stoksekarang = $ambildata['Stok'];
		$namapersediaan = $ambildata['NamaPersediaanPakan'];
	    $kodepenggunaan = $_GET["tambah"];

    	if($stoksekarang >= $Total)
    	{
    		$existed = mysqli_query($connection,"select * from persediaanpakan p join penggunaanpakandtemp pt on p.kodePersediaanpakan = pt.KodePersediaanpakan where pt.kodePersediaanpakan = '$PersediaanPakan' and pt.kodeKandang = '$KodeKandang'");
    		if(mysqli_num_rows($existed)>0){
    			$ambildata2 = mysqli_fetch_array($existed);
    			$nomor = $ambildata2['Nomor'];
    			$total2 = $ambildata2['TotalPenggunaan'];
    			$totalsekarang = $total2 + $Total;
    			mysqli_query($connection,"update penggunaanpakandtemp set TotalPenggunaan='$totalsekarang' WHERE Nomor ='$nomor'");
    		}
    		else{
    			mysqli_query($connection,"insert into penggunaanpakandtemp (KodePenggunaanPakan, KodeKandang, KodePersediaanPakan, TotalPenggunaan)values ('$kode', '$KodeKandang', '$PersediaanPakan', $Total)");
    		}
    		$totalstoksekarang = $stoksekarang-$Total;
    		$updatestokpersediaan = mysqli_query($connection,"update persediaanpakan set stok='$totalstoksekarang' where kodePersediaanPakan= '$PersediaanPakan'");
    		header("location:penggunaanpakand.php");
    	}
    	else {
    		echo"<script>alert('Stok $namapersediaan tersisa $stoksekarang');
    		document.location='penggunaanpakand.php'</script>";
    	}	
	}

	if(isset($_POST['updatedata'])){
		$nomor =$_POST['update_id'];
    	$Total =$_POST['penggunaanmodal'];

    	$cekstok = mysqli_query($connection,"select * from persediaanpakan p join penggunaanpakandtemp pt on p.kodePersediaanpakan = pt.kodePersediaanpakan where pt.nomor = '$nomor'");
    	$ambildata = mysqli_fetch_array($cekstok);
    	$stoksekarang = $ambildata['Stok'];
    	$kodePersediaanpakan = $ambildata['KodePersediaanPakan'];
    	$ambilpenggunaan = $ambildata['TotalPenggunaan'];

    	$stokedit = $stoksekarang+$ambilpenggunaan-$Total;
    	$stokyangbisadiedit = $stoksekarang+$ambilpenggunaan;

    	if($stokedit > 0)
    	{
    		mysqli_query($connection,"update penggunaanpakandtemp set TotalPenggunaan='$Total' WHERE Nomor ='$nomor'");
    		mysqli_query($connection,"update persediaanpakan set stok='$stokedit' where kodePersediaanpakan = '$kodePersediaanpakan'");
    		header("location:penggunaanpakand.php");
    	}

    	else{
    		echo"<script>alert('Stok pakan tersisa $stokyangbisadiedit');</script>";
    	}
	}
?>


<HTML LANG="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Daftar Penggunaan Pakan</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>

	<div class="row">

	<div class="col-sm-1"></div>
  	<div class="col-sm-10">
  	
  	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Input Penggunaan Pakan</h1>
		</div>
	</div>

   	<form method="POST">
  
	 	<div class="form-group row">
	    	<label for="kodePemasukanBarang" class="col-sm-3 col-form-label">Kode Penggunaan Pakan</label>
			    <div class="col-sm-4">
			      <input type="text" readonly class="form-control" id="kodePenggunaanPakan" name="inputPenggunaanPakan"
			      value="<?php echo $kodejadi?>">
			    </div>
	  	</div>

	   	<div class="form-group row">
		    <label for="Tanggal" class="col-sm-3 col-form-label">Tanggal</label>
			    <div class="col-sm-4">
			      <input type="date" class="form-control" id="Tanggal" 
			      name="inputTanggal"placeholder="" value ="<?php echo date('Y-m-d')?>">
			    </div>
	 	</div>

		<td>
		<div class="mb-3 bg-light" style="text-align: right">

			<!-- Trigger the modal with a button -->
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Tambah</button>
		<br>
		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title">Tambah Penggunaan</h4>

				<button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>
		      <div class="modal-body">
		        <form method="POST">
		        	<input type="hidden" readonly class="form-control" id="kodePenggunaan" name="inputkodepenggunaan"
					      value="<?php echo $kodejadi?>">
		  
					 	<div class="form-group row">
					    <label for="kandang" class="col-sm-4 col-form-label d-flex">Kandang</label>
						    <div class="col-sm-8">
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
					    <label for="kandang" class="col-sm-4 col-form-label d-flex">Persediaan Pakan</label>
						    <div class="col-sm-8">
						      	<select class="form-control" id="kodePersediaanPakan" name="inputPersediaanPakan">
							      <?php while($row = mysqli_fetch_array($datapersediaanpakan))
							      {?>
							      <option value="<?php echo $row["KodePersediaanPakan"]?>">
							        <?php echo $row["NamaPersediaanPakan"]?>
							      </option>
							    	<?php } ?>
							   	</select>
						    </div>
				 		</div>

				   	<div class="form-group row">
					    <label for="TotalPemasukan" class="col-sm-4 col-form-label d-flex">Penggunaan</label>
						    <div class="col-sm-8">
						      <input type="num" class="form-control" id="PenggunaanPakan" 
						      name="inputpenggunaan" placeholder="Penggunaan">
						    </div>
				 	</div>

					   	<div class="form-group row">
					  		<div class="col-sm-2"></div>
					    	<div class="col-sm-10">
						      <input type="submit" class="btn btn-primary" value="Simpan" name="SimpanTemp">
					    	</div>
					  	</div>
				</form>
		      </div>
		    </div>

		  </div>
		</div>

		<br>
				</td>

		<!-- Tabel  -->

	 	<table class="table table-hover table-danger">
			<thead class="thead-dark">
				<tr>
					<th hidden>Id</th>
					<th>Nama Kandang</th>
					<th>Nama Persediaan</th>
					<th>Penggunaan</th>
					<th colspan="2" style="text-align: center;">Action</th>
				</tr>
			</thead>

			<tbody>
				
			<?php

				$query =mysqli_query($connection,"select * from penggunaanpakandtemp where KodePenggunaanPakan ='$kodejadi'");	
				
				$total = 0;
				while($row =mysqli_fetch_array($query))
				{
	    		$No = $row['Nomor'];

	    		$datakandang = mysqli_query($connection,"select * from kandang k join penggunaanpakandtemp pd on k.KodeKandang = pd.KodeKandang WHERE pd.Nomor= '$No'");
    			$ambildatakandang = mysqli_fetch_array($datakandang);
    			$kandang = $ambildatakandang['NamaKandang'];

				$datapersediaan = mysqli_query($connection,"select * from persediaanpakan p join penggunaanpakandtemp pd on p.KodePersediaanPakan = pd.KodePersediaanPakan WHERE pd.Nomor= '$No'");
    			$ambildatapersediaan = mysqli_fetch_array($datapersediaan);
    			$persediaan = $ambildatapersediaan['NamaPersediaanPakan'];
	    		
	    		$total= $row['TotalPenggunaan'] + $total;
					?>
					<tr>
					<td hidden><?php echo $No;?></td>
					<td><?php echo $kandang;?></td>
					<td><?php echo $persediaan;?></td>
					<td><?php echo number_format($row['TotalPenggunaan']);?></td>
					<!--untuk icon-->
					<td>
						<input type="hidden" class="form-control" id="inputnomor" 
			      		name="inputnomor" value="<?php echo$row["Nomor"]?>">
						<button type="button" class="btn btn-success editbtn"> Edit </button>
					</td>

					<td>
						<input type="hidden" class="form-control" id="inputnomor" 
			      		name="inputnomor" value="<?php echo$row["Nomor"]?>">
						<input type="submit" class="btn btn-danger" value="hapus" name="hapus">
					</td>
					<!--akhir icon-->
					</tr>
				<?php
			}
				?>

			</tbody>
		</table>
		<div class="form-group row">
			<div class="col-sm-6">
			</div>
			<div class="col-sm-2">
		    <label for="Tanggal">Total Penggunaan</label>
			</div>
			<div class="col-sm-3">
				<input type="text" readonly class="form-control" id="totalpenggunaan" name="inputtotalpenggunaan"
			      value="<?php echo number_format($total)?>">
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

<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit bahan </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">

                        <div class="form-group row">
				   		 <label for="Persediaan" class="col-sm-4 col-form-label">Kandang </label>
					    <div class="col-sm-8">
					      <input type="text" name="kandangmodal" id="kandangmodal" class="form-control" disabled>
					    </div>
						</div>

						<div class="form-group row">
				   		<label for="Persediaan" class="col-sm-4 col-form-label">Persediaan Pakan</label>
					    <div class="col-sm-8">
					      <input type="text" name="persediaanmodal" id="persediaanmodal" class="form-control"disabled>
					    </div>
						</div>

                        <div class="form-group row">
				   		 <label for="TotalPemasukan" class="col-sm-4 col-form-label">Penggunaan</label>
					    <div class="col-sm-8">
					      <input type="text" name="penggunaanmodal" id="penggunaanmodal" class="form-control">
					    </div>
			 		</div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="updatedata" value="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

<script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_id').val(data[0]);
                $('#kandangmodal').val(data[1]);
                $('#persediaanmodal').val(data[2]);
                $('#penggunaanmodal').val(data[3]);

                var nomor = $("#inputnomor").val();
                console.log(nomor);
            });
        });
    </script>
<?php include"footer.php";?>
<?php 
mysqli_close($connection);
ob_end_flush();
?>
</HTML>