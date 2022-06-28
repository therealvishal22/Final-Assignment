<?php
session_start(); 
@$email = $_SESSION['email1'];
@$user = $_SESSION['user1'];
echo "$user";
if(!$user == "1" || !$user == "2"){
    header("Location:../admin.php");
}

include '../connection.php';
$id= $_GET['id'];
if(isset($_REQUEST['edit'])){
    $name=$_POST["name"];
	$catid=$_POST["catid"];
	$image=$_POST["image"];

	$active=$_POST["active"];
	
    $edit = "UPDATE `product` SET `name`='$name',`catid`='$catid',`image`='$image',`active`='$active' WHERE `id`='$id'"; 
    $result1 = $conn->query($edit); 

    if ($result1 == TRUE) {
        header("Location:index.php");
    }else{
        echo "Error:" . $edit . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Create New Product</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit</h2>
                        <?php
                if (!empty($email)) {
                ?>
                     <?php echo "$email" ?> <a href="logout.php" class="btn btn-success" onClick="return confirm('Are You Sure You Want to logout?');" title="<?php echo "$email" ?>">Logout</a>
                <?php
                } else {
                ?>
                     <? echo "$email"; ?> <a href="admin.php" class="btn btn-primary">Login</a>
                <?php
                }
                ?>                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="index.php"> Back</a>
                    </div>
                </div>
            </div>
            <form action="" method="POST">
                <?php                
                    $sql= "select * from product where id='$id'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?=$row['name']?>" required>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Category ID:</strong>
                            <input type="text" id="catid" name="catid" value="<?=$row['catid']?>" class="form-control" placeholder="Enter Category ID" required autofocus>
                            <span class="text-danger" id="nameval"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Image:</strong>
                            <input type="file" id="image" name="image" value="<?=$row['image']?>" class="form-control" placeholder="Insert Image"  autofocus>
                            <span class="text-danger" id="nameval"></span>
                        </div>
                    </div>
                    <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Created_By:</strong>
                            <input type="text" id="created_by" name="created_by" value="</?=$row['created_by']?>" class="form-control" required autofocus>
                            <span class="text-danger" id="nameval"></span>
                        </div>
                    </div> -->
                
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Active:</strong>
                            <div class="input-group">
                                <input type="radio"name="active" id="yes" value="Yes" <?php if($row['active']=="Yes"){ echo "checked";}?>>Yes
                                <input type="radio" name="active" id="no" value="No" <?php if($row['active']=="NO"){ echo "checked";}?>>NO
                            </div>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <?php
                        }
                            } else {
                                echo "Error";
                            }
                    ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" name="edit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>