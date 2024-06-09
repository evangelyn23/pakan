<?php
include "INCLUDES/confiig.php";
    if(isset($_GET['hapus']))
    {
    	$kodehapus=$_GET["hapus"];
    	mysqli_query($connection, "DELETE FROM persediaan
    		WHERE KodePersediaan ='$kodehapus'");
    	echo"<script>alert('Data berhasil dihapus');
    	document.location='persediaanview.php'</script>";
    }
?>