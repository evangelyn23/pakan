<!DOCTYPE html>

<?php
include "INCLUDES/confiig.php";
include "INCLUDES/library.php";
ob_start();
session_start();
if(!isset($_SESSION['emailuser']))
	header("location:login.php");

$name = $_SESSION['emailuser'];

if(isset($_SESSION['role']))
	$role = $_SESSION['role'];

$pembelian = mysqli_query($connection,"SELECT sum(TotalHarga) as total FROM pembelianbahan WHERE MONTH(Tanggal)=MONTH(CURRENT_DATE - INTERVAL - 0 MONTH)");
$row = mysqli_fetch_array($pembelian);

$pengelolaan = mysqli_query($connection,"SELECT sum(TotalPakan) as total FROM pengelolaanpakanh WHERE MONTH(Tanggal)=MONTH(CURRENT_DATE - INTERVAL - 0 MONTH)");
$row2 = mysqli_fetch_array($pengelolaan);

$penggunaan = mysqli_query($connection,"SELECT sum(TotalPenggunaan) as total FROM penggunaanpakan WHERE MONTH(Tanggal)=MONTH(CURRENT_DATE - INTERVAL - 0 MONTH)");
$row3 = mysqli_fetch_array($penggunaan);
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-widt, initial-scale=1.0">
	<title>PAKAN</title>
</head>

<body>

<?php include "headerOwner.php";?>


<div class="jumbotron jumbotron-fluid">
<div class="container">
<h1 class="display-4">Data Bulanan <?php echo getBulan(date('m'))?></h1>
</div>
</div>
<div class="row">
<div class="col-xl-4 col-md-6 mb-4">
             <div class="card border-left-success shadow h-100 py-2">
                 <div class="card-body">
                     <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                             <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                 Pembelian Bahan</div>
                             <div class="h5 mb-0 font-weight-bold text-gray-800"> Rp 
                             	<?php echo number_format($row["total"])?>,-
                             </div>
                         </div>
                         <div class="col-auto">
                             <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                         </div>
                     </div>
                 </div>
             </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pengelolaan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                            	<?php echo $row2["total"]?> KG
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Penggunaan
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    	<?php echo $row3["total"]?> KG
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

<?php include "footer.php";?>
</body>

<?php 
mysqli_close($connection);
ob_end_flush();
?>
</html>