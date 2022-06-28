<?php
include 'connection.php';
session_start();
@$usertype = $_SESSION['utype'];
if (isset($_POST['request'])) {
    $category = $_POST['request'];

    // print_r($category);
    // exit;

    // $query="SELECT * FROM product where `id` = '$category' AND `active` = 'yes'";
    $query = "SELECT * FROM product WHERE catid = $category ";
    // print_r($query);

    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table class="table" id="   " width="100%">
        <thead class="thead-primary">
            <tr>

                <td class="tabcon"><b>ID</b></td>
                <td class="tabcon"><b>Name</b></td>
                <td class="tabcon"><b>Category Id</b></td>
                <td class="tabcon"><b>Image</b></td>
                <td class="tabcon"><b>Created By</b></td>
                <td class="tabcon"><b>Active</b></td>
                <?php if ($usertype == "1" || $usertype == "2") {
                ?>
                <td class="tabcon"><b>Update</b></td>
                <td class="tabcon"><b>Delete</b></td>
                <?php
                }
                ?>




                <?php
                // session_start();
                if (mysqli_num_rows($result) > 0) {
                    // echo "console_log($result)";
                    while ($row = mysqli_fetch_assoc($result)) {



                ?>

            </tr>
        </thead>
        <tbody>
            <tr class="alert" role="alert">


                <td class="tabcon"><?php echo $row['id'] ?></td>
                <td class="tabcon"><?php echo $row['name'] ?></td>
                <td class="tabcon"><?php echo $row['id'] ?></td>
                <td class="tabcon"><img src="uploads/<?php echo $row['image'] ?>" height="90px;" width="90px;"
                        border-radius:15px; /></td>
                <td class="tabcon"><?php echo $row['created_by'] ?></td>
                <td class="tabcon"><?php echo $row['active'] ?></td>
                <?php if ($usertype == "1" || $usertype == "2") {
                ?>
                <td class="tabcon"><a href="../product_edit.php?id=<?php echo $row['id']; ?>" title="Edit"><button
                            style="background-color: skyblue;">Edit</button></a>
                </td>
                <!-- <td class="tabcon"><a href="delete.php?id=</ ?php echo $row['id']; ?>" title="Delete"><button style="background-color: red;">Delete</button></a></td> -->
                <td class="tabcon"><a href="../product_delete.php?id=<?php echo $row['id']; ?>"
                        onclick="return confirm('Are you sure want to delete?')" title="delete"><button
                            style="background-color: red;">Delete</button></a>
                </td>
            </tr>
        </tbody>
        </tr>
        <?php
                        }
                    }
                } else {
                    echo "0 row found....";
                }
?>
        <br>
    </table>
</body>

</html>