<?php
include "INCLUDES/confiig.php";
    if(isset($_GET['hapus']))
    {
    	$kodehapus=$_GET["hapus"];
    	mysqli_query($connection, "DELETE FROM persediaanpakan
    		WHERE KodePersediaanPakan ='$kodehapus'");
    	echo"<script>alert('Data berhasil dihapus');
    	document.location='persediaanpakanview.php'</script>";
    }
?>