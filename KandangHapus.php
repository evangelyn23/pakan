<?php
include "INCLUDES/confiig.php";
    if(isset($_GET['hapus']))
    {
    	$kodehapus=$_GET["hapus"];
    	mysqli_query($connection, "DELETE FROM kandang
    		WHERE KodeKandang ='$kodehapus'");
    	echo"<script>alert('Data berhasil dihapus');
    	document.location='KandangView.php'</script>";
    }
?>