<?php
    include '../connection.php';
    session_start(); 
    @$email = $_SESSION['email1'];
@$user = $_SESSION['user1'];
echo "$user";
    if(!$user == "1" || !$user == "2")
    {
        header("Location:../admin.php");
    }
$id= $_GET['id'];
if(isset($_REQUEST['edit'])){
    $name=$_POST["name"];
	$email=$_POST["email"];
	$password=$_POST["password"];
	$gender=$_POST["gender"];
	$hobbies=implode(',',$_POST["checkbox"]);

    $edit = "UPDATE `admin` SET `name`='$name',`email`='$email',`password`='$password',`gender`='$gender',`hobbies`='$hobbies' WHERE `id`='$id'"; 
    $result1 = $conn->query($edit); 

    if ($result1 == TRUE) {
        header("Location:../home.php");
    }else{
        echo "Error:" . $edit . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Create New Admin</title>
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
                     <?php echo "$email" ?> <a href="../logout.php" class="btn btn-success" onClick="return confirm('Are You Sure You Want to logout?');" title="<?php echo "$email" ?>">Logout</a>
                <?php
                } else {
                ?>
                     <? echo "$email"; ?> <a href="../admin.php" class="btn btn-primary">Login</a>
                <?php
                }
                ?>                    
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="index.php"> Back</a>
                </div>
            </div>
            </div>
            <form action="" method="POST">
                <?php                
                    $sql= "select * from admin where id='$id'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Enter First Name" value="<?=$row['name']?>" required>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Email:</strong>
                            <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?=$row['email']?>" required>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Gender:</strong>
                            <div class="input-group">
                                <input type="radio"name="gender" id="male" value="male" <?php if($row['gender']=="male"){ echo "checked";}?>>Male
                                <input type="radio" name="gender" id="female" value="female" <?php if($row['gender']=="female"){ echo "checked";}?>>Female
                            </div>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Hobbies:</strong><br>
                            <input type="checkbox" name="checkbox[]" value="Cricket" <?php if(in_array("Cricket",explode(",",$row['hobbies']))){echo "checked";}?>>Cricket<br>
                            <input type="checkbox" name="checkbox[]" value="Singing" <?php if(in_array("Singing",explode(",",$row['hobbies']))){echo "checked";}?>>Singing<br>
                            <input type="checkbox" name="checkbox[]" value="Swimming" <?php if(in_array("Swimming",explode(",",$row['hobbies']))){echo "checked";}?>>Swimming<br>
                            <input type="checkbox" name="checkbox[]" value="Shopping" <?php if(in_array("Shopping",explode(",",$row['hobbies']))){echo "checked";}?>>Shopping<br>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Password:</strong>
                            <input type="password" name="password" class="form-control" value="<?=$row['password']?>" required>
                            <span class="text-danger"></span>
                        </div>
                    </div> -->
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