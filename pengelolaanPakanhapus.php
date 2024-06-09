<?php
include "INCLUDES/confiig.php";
    if(isset($_GET['hapus']))
    {
    	$kodehapus = $_GET["hapus"];
        
    	$cekpenggunaan = mysqli_query($connection, "select * from pengelolaanpakandtemp where nomor = '$kodehapus'");
		$ambilpenggunaan = mysqli_fetch_array($cekpenggunaan);
    	$penggunaan = $ambilpenggunaan['TotalPenggunaan'];
        $kodePersediaan = $ambilpenggunaan['KodePersediaan'];

    	$cekstok = mysqli_query($connection,"select * from persediaan where kodePersediaan= '$kodePersediaan'");
    	$ambildata = mysqli_fetch_array($cekstok);
    	$stoksekarang = $ambildata['Stok'];

    	$tambahstok = $penggunaan+$stoksekarang;

    	mysqli_query($connection, "DELETE FROM pengelolaanpakandtemp WHERE nomor ='$kodehapus'");
    	mysqli_query($connection, "update persediaan set stok='$tambahstok' where KodePersediaan = '$kodePersediaan'");

    	echo"<script>alert('Data berhasil dihapus');
    	document.location='PengelolaanPakan.php'</script>";
    }
?>