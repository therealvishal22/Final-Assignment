<?php
session_start();
// if(!$_SESSION['email']){
//     header("Location:admin.php");
// }
@$email = $_SESSION['email1'];
@$user = $_SESSION['user1'];
echo "$user";
?>
<!DOCTYPE html> 
<html>
    <head>
        <title>Admin Page</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
        <script>
            function deleterow(str) {
                if(confirm('Are you sure want to delete?')){
                    if (str.length == 0) {
                        document.getElementById("txtmsg").innerHTML = "";
                        return;
                    } 
                    else {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if(this.responseText==1){ 
                                document.getElementById("txtmsg").innerHTML = "Record deleted successfully";
                                setInterval('window.location.reload()', 1000);
                            }
                            else{
                                document.getElementById("txtmsg").innerHTML = this.responseText;
                            }
                    }
                }
            };
            xmlhttp.open("GET", "delete.php?id=" + str, true);
            xmlhttp.send();
        }
    }
    </script>
    </head>
    <body>
    <span id="txtmsg"></span>
        <div class="container">
            <div class="row" style="margin-top: 5rem;">
                <div class="col-lg-12 margin-tb">
                    <center><h2 style="font-weight: bold;color:brown">Admin Page</h2></center>
                    <hr>
                    <div class="pull-left">
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
                    <?php 
                    if($user == "1"){?>
                    <div class="pull-right">
                        <a class="btn btn-success" href="create.php"> Create New Admin</a>
                        <a class="btn btn-success" href="../home.php"> Back </a> 
                    </div>
                    <?php }?>
                    <?php 
                    if($user == "2"){?>
                    <div class="pull-right">
                       
                        <a class="btn btn-success" href="../product/index.php"> Product </a> 
                        <a class="btn btn-success" href="../category/index.php"> Category </a> 


                    </div>
                    <?php }?>
                </div>
            </div>
            <br>
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Hobbies</th>
                    <?php 
                    if($user == "1"){?>
                    <th width="280px">Action</th>
                    <?php }?>
                </tr>
                <?php
                include '../connection.php';
                $sql = "SELECT * FROM admin where u_type='2'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {?>
                    <tr>
                    <td><?= $row['id']?></td>
                    <td><?= $row['name']?></td>
                    <td><?= $row['email']?></td>
                    <td><?= $row['gender']?></td>
                    <td><?= $row['hobbies']?></td>
                    <?php
                    if($user == "1"){?>
                    <td><a href='edit.php?id=<?=$row['id']?>' class="btn btn-primary">Edit</a>
                    <button class="btn btn-danger" onclick="deleterow(<?=$row['id']?>);">Delete</button></td>
                    <?php }?>
                </tr>
                <?php }
                } ?>
            </table>  
        </div>
    </body>
</html>