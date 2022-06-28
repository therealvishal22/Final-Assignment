<?php
session_start();
include '../connection.php';
@$email = $_SESSION['email1'];
@$user = $_SESSION['user1'];
echo "$user";
if(!$user == "1" || !$user == "2"){
    header("Location:../admin.php");
}
if (isset($_POST) && count($_POST) > 0) {

    print_r($_POST);
    $name = $_POST["name"];
    $category_id = $_POST["category_id"];
    $createdbyuser = $_SESSION['email'];
    $active = $_POST["active"];
    $image = $_FILES["image"]["name"];

    if ($name != ""  && $category_id != "" && $active != "" && $image != "") {

        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $filetype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large." . "<br>";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($filetype != "png" && $filetype != "jpeg" && $filetype != "jpg") {
            echo "Sorry, only PNG, JPEG and JPG files are allowed." . "<br>";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file." . "<br>";
            }
        }
        if ($name != "" && $category_id != "" && $image != "" && $createdbyuser != "" && $active != "") {
            $sql = "INSERT INTO product VALUES (NULL,'$name','$category_id','$image','$createdbyuser','$active')";
            if (mysqli_query($conn, $sql)) {
                // echo "<h3>data stored in a database successfully.</h3>";
                header("Location:index.php");
            } else {
                echo "ERROR: Sorry $sql. " . mysqli_error($conn);
            }
            mysqli_close($conn);
        } 
    } else {
        echo("Please input all Required fields..!!");
    }
}
?>



<?php

// include '../connection.php';
// session_start(); 
// $email=$_SESSION['email'];
// echo $email;

// if(!$_SESSION['email']){
//     header("Location:../admin.php");
// }

//  if(isset($_POST['submit']) && count($_POST)>0){
//  	$name= $_POST["name"];
//  	$catid= $_POST["catid"];
//     $image = $_FILES["image"]["name"];
//  	$created_by=$email;
//     $active=$_POST["active"];

    
//  	// exit();
//  	if($name != "" && $catid != "" && $image != "" && $created_by != "" && $active != "")
//     {

//  		$sql = "INSERT INTO product VALUES (NULL,'$name','$catid','$image','$created_by','$active')";
//          echo $sql;
//         //  exit;
//         if(mysqli_query($conn, $sql))
//         {
//  			header("Location:index.php");
//         } 
//         else
//         {
//              echo "ERROR: Sorry $sql. ". mysqli_error($conn);
//         }
//  		 mysqli_close($conn);
//  	}
//  	else
//     {
//  		echo "Enter Required Fields";
//  	}
// }
?> 
<!DOCTYPE html>
<html>
    <head>
        <title>Create New Product</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk="   crossorigin="anonymous"></script>
        <script src ="../js/validation.js"></script>
    </head>
    <body>
        <div class="container">        
            
          
            <form name="product" action="#" method="POST"  enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h3>Add New Product</h3>
                    <a class="btn btn-primary" href="index.php" style="margin-left: 85%;"> Back</a>
                    <div class="form-group">
                        <strong>Product Name:</strong>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter First Name" required autofocus>
                        <!-- <span class="text-danger" id="pnameval"></span> -->
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Category Id</strong>
                        <select name="category_id" id="category_id" class="form-control">
                        <option value=""  selected="">Select Category</option>
                            <?php
                            //select only active categories form category table 
                            $sql = "SELECT * FROM category where active='Yes'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['c_name'] ?></option>
                            <?php }
                            }
                            ?>
                        </select>
                        <span class="text-danger" id="category_idval"></span>
                    </div>
                </div>
                <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Created By UserId:</strong>
                        <span  id="createdbyuserval" name="user"></?php echo $user; ?></span>
                    </div>
                </div> -->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Active</strong>
                        <select name="active" id="active" class="form-control">
                            <option value="">Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        <span class="text-danger" id="activeval"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Select Image:</strong>
                        <input type="file" id="image" name="image" class="form-control" required accept=".jpg,.jpeg,.png">
                        <span>Only PNG, JPEG and JPG files are allowed</span>
                        <span class="text-danger" id="imageval"></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" id="Btnsubmit" name="btnsubmit" class="btn btn-primary">Submit</button>
                    
                </div>
            </div>
        </form>
       
    </body>
</html>