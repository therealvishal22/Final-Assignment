<?php
include 'connection.php';
session_start(); 
// if(isset($_REQUEST) && count($_REQUEST)>0){
//     $useremail = $_POST['txtemail'];  
//     $userpassword = $_POST['txtpassword'];  
//     if($_SESSION['email']="testuser@kcsitglobal.com"){
//         $sql = "select * from super_admin where email = '$useremail' and password = '$userpassword'";
//         $result = mysqli_query($conn, $sql);
//         if (mysqli_num_rows($result) > 0) {
//             while($row = mysqli_fetch_assoc($result)) {
//                 $_SESSION['email']=$useremail;
//                 header("Location:admin/home.php");
//             }
//         }
//         else {
//             $sql = "select * from admin where email = '$useremail' and password = '$userpassword'";
//             $result = mysqli_query($conn, $sql);
//             if (mysqli_num_rows($result) > 0) {
//             while($row = mysqli_fetch_assoc($result)) {
//                 $_SESSION['email']=$useremail;
//                 header("Location:admin/home.php");
//                 }
//             }
//             else {
//                 $error= "Email or Password Invalid."."<br>";
//             }
//         }   
//     }
// }
if(isset($_POST) && count($_POST)>0){

    $useremail=$_POST['txtemail'];
    $userpassword=$_POST['txtpassword'];

    $qry = "SELECT * FROM admin WHERE email='".$useremail."' AND password='".$userpassword."'";
    // var_dump($qry);
    // exit();
    $rs = mysqli_query($conn,$qry);

    if(mysqli_num_rows($rs)>0)
    {

        $row =mysqli_fetch_assoc($rs);
        // echo $row['utype'];
        // exit;
        $_SESSION['email']=$useremail;
        $_SESSION['name1']=$row['name'];
        $_SESSION['email1']=$row['email'];
        $_SESSION['user1']=$row['u_type'];
        $_SESSION['id1']=$row['id'];
        
        $user=$row['u_type'];
        //echo $utype;
        // exit;
    
        if ($utype==1)
        {
            $_SESSION['user']==2;
            header("location:home.php");
            
        }
        else
        {
            $_SESSION['admin']==1;
            header("location:home.php");
            
        }
    }else{

        //echo "INVALID LOGIN";
        header("location:admin.php?msg=Invalid Username OR Password");
        
    }
}

?>
<html>
    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href="css/bootstrap/bootstrap.css" type="text/css" rel="stylesheet" />
		<link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>	
        <script src ="js/admin.js"></script>	
        <style type="text/css">
            #cnform{box-shadow:0px 0px 3px gray;margin-top:30px;margin-bottom:30px;}
			i.fa,b{color:teal;}
        </style>
    </head>
    <body>
		<form action="" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6 col-xs-12" id="cnform">
                        <h3 class="text-center"><i class="fa fa-user-plus"></i>Login</h3><hr>  
                        <small class="text-danger"><?php $error?></small>
                        <div class="form-group">
                            <b>Email</b>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input id="email" type="text" name="txtemail"placeholder="Enter email id here" maxlength="50" class="form-control" />
                            </div>
                            <small id="emailval" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <b>Password</b>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input id="password" type="password" name="txtpassword" placeholder="Enter password here" maxlength="12" class="form-control" />
                            </div>
                            <small id="passwordval" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" id="cnaclick"><i class="fa fa-user-plus" style="color:white;"></i>
                        </div>
                    </div>
                </div>
            </div>
		</form>
    </body>
</html>