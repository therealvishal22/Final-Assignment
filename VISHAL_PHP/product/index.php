<?php
    include("../connection.php");
    session_start();
    @$email = $_SESSION['email1'];
@$user = $_SESSION['user1'];
echo "$user";
    if(!$user == "1" || !$user == "2")
    {
        header("Location:../admin.php");
    }
?>

<!DOCTYPE html> 
<html>
    <head>
        <title>Product Page</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                                document.getElementById("txtmsg").innerHTML = "Record Deleted Successfully";
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
                <center><h2 style="font-weight: bold;color:brown">Product Page</h2></center>
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
                ?>                    </div>
                    <?php 
                    if($user == "1" || $user == "2"){?>
                    <div class="pull-right">
                        <a class="btn btn-success" href="create.php"> Create New Product</a>
                        <a class="btn btn-success" href="../home.php"> Back </a>   
                    </div>
                    <?php }?>
                </div>
            </div>
            <table class="table table-bordered">
                <tr style="color:orange;background-color:gray;">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category ID</th>
                    <th>Image</th>
                    <th>Created_By</th>
                    <th>Active</th>
                    <?php 
                        if($user == "1" || $user == "2"){
                    ?>
                    <th width="280px">Action</th>
                    <?php }?>
                </tr>
                <?php
                
                $sql = "SELECT p.id,p.name,c.c_name,p.image,p.created_by,p.active  FROM product p INNER JOIN category c ON p.catid = c.id INNER JOIN admin a ON p.created_by = a.email where c.active= 'Yes' and p.active= 'Yes' ORDER BY id DESC";
                
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {?>
                    <tr>
                        <td><?= $row['id']?></td>
                        <td><?= $row['name']?></td>
                        <td><?= $row['c_name']?></td>
                        <td><img src="../uploads/<?php echo $row['image']; ?>" width="160" height="80"></td>
                        <td><?= $row['created_by']?></td>
                        <td><?= $row['active']?></td>
                        <?php
                        if($user == "1" || $user == "2"){?>
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