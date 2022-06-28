<?php

include '../connection.php';
session_start(); 
@$email = $_SESSION['email1'];
@$user = $_SESSION['user1'];
echo "$user";
if(!$user == "1" || !$user == "2"){
    header("Location:../admin.php");
}
 if(isset($_POST['submit']) && count($_POST)>0){
 	$name=$_POST["name"];
    $active=$_POST["active"];
 	
 	if($name != "" && $active != "")
    {
 		$sql = "INSERT INTO category VALUES (NULL,'$name','$active')";
        if(mysqli_query($conn, $sql))
        {
 			header("Location:index.php");
        } 
        else
        {
             echo "ERROR: Sorry $sql. ". mysqli_error($conn);
        }
 		 mysqli_close($conn);
 	}
 	else
    {
 		echo "Enter Required Fields";
 	}
}
?> 
<!DOCTYPE html>
<html>
    <head>
        <title>Create New Category</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk="   crossorigin="anonymous"></script>
        <script src ="../js/validation.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <span class="text-danger" id="error"></span>
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Add New Category</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="index.php"> Back</a>
                    </div>
                </div>
            </div>
            <form action="" method="POST">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Category Name:</strong>
                            <input type="text" id="category"name="name" class="form-control" placeholder="Enter Category Name" required autofocus>
                            <span class="text-danger" id="nameval"></span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Active:</strong>
                            <div class="input-group">
                                <input type="radio"name="active" id="yes" value="Yes">
                                <span >Yes</i></span><br>
                                <input type="radio" name="active" id="no" value="NO" >
                                <span > No</i></span>
                            </div>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                   
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>