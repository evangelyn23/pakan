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

	$datapersediaan = mysqli_query($connection,"select * from persediaan p left join pengelolaanpakandtemp pt on p.kodePersediaan = pt.kodePersediaan where p.KodePersediaan not in (select kodePersediaan from pengelolaanpakandtemp)");

	$query =mysqli_query($connection,"SELECT max(kodePengelolaan) as maxKode FROM pengelolaanpakanh");
	$data = mysqli_fetch_array($query);
	$maxkode = $data['maxKode'];

	$nourut = (int) substr($maxkode, 2, 3);
	$nourut++;
	$char = 'PP';
	$kodejadi = $char . sprintf("%03s", $nourut);

	$Tanggal = $_GET["tanggal"];

	$datapersediaanPakan = mysqli_query($connection,"select * from persediaanPakan");

	if(isset($_POST["Batal"])){

		$query =mysqli_query($connection,"select * from pengelolaanpakand where KodePengelolaan = '$kodejadi'");	
				
		while($row =mysqli_fetch_array($query))
		{
		$kodepersediaan= $row['KodePersediaan'];
		$penggunaan= $row['TotalPenggunaan'];
	    $cekstok = mysqli_query($connection,"select * from persediaan where kodePersediaan = '$kodepersediaan'");
   		$ambildata = mysqli_fetch_array($cekstok);
    	$stoksekarang = $ambildata['Stok'];
    	$totalstoksekarang = $stoksekarang+$penggunaan;

		mysqli_query($connection, "update persediaan set stok='$totalstoksekarang' where kodePersediaan = '$kodepersediaan'");
    	}
    	mysqli_query($connection,"delete from pengelolaanpakand where KodePengelolaan = '$kodejadi'");

		header("location:pengelolaanpakanh.php");
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

    	if(isset($_REQUEST['inputpersediaanPakan']))
    	{
    	$persediaanPakan =$_REQUEST['inputpersediaanPakan'];}

    	if (!empty($persediaanPakan))
    	{
    		$persediaanPakan =$_POST['inputpersediaanPakan'];
    	}

    	else{
    		die('Anda harus memasukkan persediaan pakan');
    	}
    	
    	$TotalProtein =$_POST['inputtotalprotein'];
    	$TotalPakan =$_POST['inputtotalpakan'];	

    	echo"<script>alert($kodejadi, $persediaanPakan,$Tanggal,$TotalProtein, $TotalPakan);
    		document.location='PengelolaanPakan.php?tanggal=$Tanggal'</script>";

 //    $query = mysqli_query($connection,"insert into pengelolaanpakanh values ('$kodejadi', '$persediaanPakan', '$Tanggal','$TotalProtein', '$TotalPakan')");

    
 //    $cekstok = mysqli_query($connection,"select * from persediaan where kodePersediaan = 'PD001'");
 //    $ambildata = mysqli_fetch_array($cekstok);
 //    $stoksekarang = $ambildata['Stok'];
 //    $totalstoksekarang = $stoksekarang+$TotalPakan;

 //    $updatestokpersediaan = mysqli_query($connection,"update persediaan set stok='$totalstoksekarang' where kodePersediaan = 'PD001'");

	// $query2 =mysqli_query($connection,"select * from pengelolaanpakanh where KodePengelolaan = '$kodejadi'");

 //    if (mysqli_num_rows($query2)>0){
 //    	mysqli_query($connection,"insert into pengelolaanpakand select * from pengelolaanpakandtemp");
 //    	mysqli_query($connection,"delete from pengelolaanpakandtemp");
 //    }
 //    else {
 //    		echo"<script>alert('Stok pakan tersisa')";
 //    	}

 //    header("location:pengelolaanpakanh.php");

    }


    if(isset($_POST['hapus']))
    {
    	$Tanggal =$_POST['inputTanggal'];
    	$nomor =$_POST['inputnomor'];

    	header("location:pengelolaanPakanhapus.php?hapus=$nomor&tanggal=$Tanggal");
    }


    if(isset($_POST['updatedata'])){
		$nomor =$_POST['update_id'];
		$Total =$_REQUEST['totalpenggunaanmodal'];

		$cekpersediaan = mysqli_query($connection,"select * from persediaan p join pengelolaanpakandtemp pt on p.kodePersediaan = pt.kodePersediaan where pt.nomor = '$nomor'");
    	$ambildata = mysqli_fetch_array($cekpersediaan);
    	$stoksekarang = $ambildata['Stok'];
    	$kodepersediaan = $ambildata['KodePersediaan'];
    	$namapersediaan = $ambildata['NamaPersediaan'];
    	$ambilpenggunaan = $ambildata['TotalPenggunaan'];


	    $stdpro = $ambildata['StandarProtein'];
	    $subtotalstdpro = $stdpro * $Total;

	    $stokedit = $stoksekarang+$ambilpenggunaan-$Total;
    	$stokyangbisadiedit = $stoksekarang+$ambilpenggunaan;

    	if($stoksekarang >= $Total)
    	{
    		mysqli_query($connection,"update pengelolaanpakandtemp set TotalPenggunaan='$Total', SubTotalProtein='$subtotalstdpro' WHERE Nomor ='$nomor'");
    		mysqli_query($connection,"update persediaan set stok='$stokedit' where kodePersediaan = '$kodepersediaan'");
    		header("location:PengelolaanPakan.php?tanggal=$Tanggal");
    	}
    	else {
    		echo"<script>alert('Stok $namapersediaan tersisa $stokyangbisadiedit');
    		document.location='PengelolaanPakan.php?tanggal=$Tanggal'</script>";
    	}
	}

	if(isset($_POST['SimpanTemp'])){

		$kode =$_REQUEST['inputPemasukanBarang'];

		$persediaan =$_REQUEST['inputpersediaan'];

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
    		mysqli_query($connection,"insert into pengelolaanpakandtemp (KodePengelolaan, KodePersediaan, TotalPenggunaan, SubTotalProtein)values ('$kode', '$persediaan', '$Total', $subtotalstdpro)");
    		$totalstoksekarang = $stoksekarang-$Total;
    		$updatestokpersediaan = mysqli_query($connection,"update persediaan set stok='$totalstoksekarang' where kodePersediaan = '$kodepersediaan'");
    		header("location:PengelolaanPakan.php?tanggal=$Tanggal");
    	}
    	else {
    		echo"<script>alert('Stok $namapersediaan tersisa $stoksekarang');
    		document.location='PengelolaanPakan.php?tanggal=$Tanggal'</script>";
    	}

    	
	}
?>


<HTML LANG="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Daftar Pengelolaan Pakan</title>
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
			<h1 class="display-4">Input Pengelolaan Pakan</h1>
		</div>
	</div>
			<!--penutup jumbotron-->

   	<form method="POST">
  
	 	<div class="form-group row">
	    	<label for="kodePemasukanBarang" class="col-sm-3 col-form-label">Kode Pengelolaan Pakan</label>
			    <div class="col-sm-4">
			      <input type="text" readonly class="form-control" id="kodePemasukanBarang" name="inputPemasukanBarang"
			      value="<?php echo $kodejadi?>">
			    </div>
	  	</div>

	   	<div class="form-group row">
		    <label for="Tanggal" class="col-sm-3 col-form-label">Tanggal</label>
			    <div class="col-sm-4">
			      <input type="date" class="form-control" id="Tanggal" 
			      name="inputTanggal"placeholder="" value ="<?php echo $Tanggal?>">
			    </div>
	 	</div>

	
		<td>
			<div class="mb-3 bg-light" style="text-align: right">

			<!-- Trigger the modal with a button -->
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add</button>

			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <h4 class="modal-title">Tambah bahan</h4>

			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			      </div>
			      <div class="modal-body">
			        <form method="POST">

			       <input type="hidden" readonly class="form-control" id="kodePemasukanBarang" name="inputPemasukanBarang"
			      value="<?php echo $kodejadi?>">
  
			 	<div class="form-group row">
				    <label for="persediaan" class="col-sm-4 col-form-label">Persediaan</label>
					    <div class="col-sm-8">
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
				    <label for="TotalPemasukan" class="col-sm-4 col-form-label">Total Penggunaan</label>
					    <div class="col-sm-8">
					      <input type="num" class="form-control" id="PenggunaanBahan" 
					      name="inputtotalpenggunaan"placeholder="Total Penggunaan">
					    </div>
			 	</div>

			   	<div class="form-group row">
			  		<div class="col-sm-2"></div>
			    	<div class="col-sm-10">
				      <input type="submit" class="btn btn-primary" value="SimpanTemp" name="SimpanTemp">
			    	</div>
			  	</div>
			</form>
			      </div>
			    </div>

			  </div>
			</div>
			</div>
		</td>

		<!-- Tabel  -->

	 	<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>ID</th>
					<th>Bahan</th>
					<th>Standar Protein</th>
					<th>Penggunaan</th>
					<th>Sub Total Protein</th>
					<th colspan="2" style="text-align: center;">Action</th>
				</tr>
			</thead>

			<tbody>
				
			<?php

				$query =mysqli_query($connection,"select * from pengelolaanpakandtemp where KodePengelolaan = '$kodejadi'");	
				
				$totalprotein = 0;
				$totalpakan = 0;
				while($row =mysqli_fetch_array($query))
				{
	    		$No = $row['Nomor'];
				$cekstdpro = mysqli_query($connection,"select * from persediaan p join pengelolaanpakandtemp pt on p.KodePersediaan = pt.KodePersediaan WHERE pt.Nomor= '$No'");

    			$ambildata = mysqli_fetch_array($cekstdpro);
    			$persediaan = $ambildata['NamaPersediaan'];
	    		$stdpro = $ambildata['StandarProtein'];
	    		$totalprotein = $row['SubTotalProtein'] + $totalprotein;
	    		$totalpakan = $row['TotalPenggunaan'] + $totalpakan;
					?>
					<tr>
					<td><?php echo $No;?></td>
					<td><?php echo $persediaan;?></td>
					<td><?php echo number_format($stdpro);?></td>
					<td><?php echo number_format($row['TotalPenggunaan']);?></td>
					<td><?php echo number_format($row['SubTotalProtein']);?></td>
					<!--untuk icon-->
					<td>
						<input type="hidden" class="form-control" id="inputnomor" 
			      		name="inputnomor" value="<?php echo$row["Nomor"]?>">

						<button type="button" class="btn btn-success editbtn"> EDIT </button>
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
		    <label for="Tanggal">Total Protein</label>
			</div>
			<div class="col-sm-3">
				<input type="text" readonly class="form-control" id="totalprotein" name="inputtotalprotein"
			      value="<?php echo $totalprotein?>">
			</div>
	 	</div>
	 	<div class="form-group row">
			<div class="col-sm-6">
			</div>
			<div class="col-sm-2">
		    <label for="Tanggal">Total Pakan</label>
			</div>
			<div class="col-sm-3">
			      <input type="text" readonly class="form-control" id="totalpakan" name="inputtotalpakan"
			      value="<?php echo $totalpakan?>">
			</div>
	 	</div>

	 	<div class="form-group row">
			<div class="col-sm-6">
			</div>
			<div class="col-sm-2">
		    <label for="Tanggal">Hasil Pakan</label>
			</div>
			<div class="col-sm-3">
			    <select class="form-control" id="inputpersediaanPakan" name="inputpersediaanPakan">
				      <?php while($row = mysqli_fetch_array($datapersediaanPakan))
				      {?>
				      <option value="<?php echo $row["KodePersediaanPakan"]?>">
				        <?php echo $row["NamaPersediaanPakan"]?>
				      </option>
				    	<?php } ?>
				</select>
			</div>
	 	</div>

	   	<div class="form-group row">
	  		<div class="col-sm-10"></div>
	    	<div class="col-sm-2">
		      <input type="submit" class="btn btn-success" value="Simpan" name="Simpan">
		      <input type="submit" class="btn btn-danger" value="Batal" name="Batal">
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
				   		 <label for="Persediaan" class="col-sm-4 col-form-label">Persediaan</label>
					    <div class="col-sm-8">
					      <input type="text" name="persediaanmodal" id="persediaanmodal" class="form-control"
                                placeholder="Persediaan" disabled>
					    </div>
						</div>

                        <div class="form-group row">
				   		 <label for="TotalPemasukan" class="col-sm-4 col-form-label">Total Penggunaan</label>
					    <div class="col-sm-8">
					      <input type="text" name="totalpenggunaanmodal" id="totalpenggunaanmodal" class="form-control"
                                placeholder="TotalPenggunaan">
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
                $('#persediaanmodal').val(data[1]);
                $('#totalpenggunaanmodal').val(data[3]);

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