<?php

include "INCLUDES/confiig.php";

    if(isset($_GET['hapus']))
    {
    	$kodehapus = $_GET["hapus"];
        
    	$cekpenggunaan = mysqli_query($connection, "select * from penggunaanpakandtemp where nomor = '$kodehapus'");
		$ambilpenggunaan = mysqli_fetch_array($cekpenggunaan);
    	$penggunaan = $ambilpenggunaan['TotalPenggunaan'];
        $kodePersediaanpakan = $ambilpenggunaan['KodePersediaanPakan'];

    	$cekstok = mysqli_query($connection,"select * from persediaanpakan where kodePersediaanpakan = '$kodePersediaanpakan'");
    	$ambildata = mysqli_fetch_array($cekstok);
    	$stoksekarang = $ambildata['Stok'];

    	$tambahstok = $penggunaan+$stoksekarang;

    	mysqli_query($connection, "DELETE FROM penggunaanpakandtemp WHERE nomor ='$kodehapus'");
    	mysqli_query($connection, "update persediaanpakan set stok='$tambahstok' where KodePersediaanPakan = '$kodePersediaanpakan'");

    	echo"<script>alert('Data berhasil dihapus');
    	document.location='penggunaanpakand.php'</script>";

    }
?>