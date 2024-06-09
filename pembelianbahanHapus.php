<?php
include "INCLUDES/confiig.php";
    if(isset($_GET['hapus']))
    {
    	$kodehapus=$_GET["hapus"];

    	$persediaan = mysqli_query($connection, "select * FROM pembelianbahan
    		WHERE KodePembelianBahan ='$kodehapus'");
    	$ambildata = mysqli_fetch_array($persediaan);
    	$namapersediaan = $ambildata['KodePersediaan'];
    	$dibeli = $ambildata['Jumlah'];

    	$cekpersediaan = mysqli_query($connection, "select * FROM persediaan
    		WHERE KodePersediaan ='$namapersediaan'");
    	$ambildata2 = mysqli_fetch_array($cekpersediaan);
    	$stokpersediaan = $ambildata2['Stok'];

    	$stoksekarang = $stokpersediaan - $dibeli;

    	if($dibeli>$stokpersediaan){
    		echo"<script>alert('Stok $namapersediaan tersisa $stokpersediaan');
    		document.location='pembelianbahanview.php'</script>";
    	}
    	else{
			mysqli_query($connection,"update persediaan set stok='$stoksekarang' where kodePersediaan = '$namapersediaan'");
    		mysqli_query($connection, "DELETE FROM pembelianbahan
    		WHERE KodePembelianBahan ='$kodehapus'");
    		echo"<script>alert('Data berhasil dihapus');
    		document.location='pembelianbahanview.php'</script>";
    	}    	
    }
?>