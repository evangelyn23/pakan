<!DOCTYPE html>
<html lang="en">

<head>
<?php 
    include "INCLUDES/confiig.php";
    ob_start();
    session_start();

    if(isset($_POST["submitlogin"]))
    {
        $username= $_POST["username"];
        $passuser= $_POST["pass"];
        $sql_login= mysqli_query($connection,"SELECT * from admin where Username='$username' and Password ='$passuser'");

        if (mysqli_num_rows($sql_login)>0)
         {
            $row_login= mysqli_fetch_array($sql_login);
            $role= $row_login['Role'];
            if($role == 'Admin'){
                $_SESSION['kodeuser'] =$row_login['ID'];
                $_SESSION['emailuser'] =$row_login['Username'];
                $_SESSION['role'] =$role;
                header("location:index.php");
            }

            if($role == 'Owner'){
                $_SESSION['kodeuser'] =$row_login['ID'];
                $_SESSION['emailuser'] =$row_login['Username'];
                $_SESSION['role'] =$role;
                header("location:indexOwner.php");
            }

            if($role == 'Spv'){
                $_SESSION['kodeuser'] =$row_login['ID'];
                $_SESSION['emailuser'] =$row_login['Username'];
                $_SESSION['role'] =$role;
                header("location:indexSpv.php");
            }
        }
    }
    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">CV SEHATI FARM</h1>
                                        <h1 class="h4 text-gray-900 mb-2">--------------</h1>
                                        <h1 class="h4 text-gray-900 mb-4">Feed Management System</h1>
                                    </div>
                                    <form method="POST"class="user">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="exampleInputEmail" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="pass" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <input type="submit" name="submitlogin" class="btn btn-primary btn-user btn-block" value="Login">
                                    </form>                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
<?php 
mysqli_close($connection);
ob_end_flush();
?>
</html>