<?php
session_start();
    include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div id="filter">
    <select class="btn btn-primary dropdown-toggle" name="fetchval" id="fetchval">
                                    <option value="" disabled="" selected="">All Category</option>
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
    </div>
    <div class="container">
        <table class="table table-striped table-">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category ID</th>
                <th>Image</th>
                <th>Created_By</th>
                <th>Active</th>
            </tr>
            <?php
                $query="select * from product";
                $r=mysqli_query($conn,$query);
                while($row=mysqli_fetch_assoc($r))
                { ?>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['catid'] ?></td>
                    <td><img src="../uploads/<?php echo $row['image']; ?>" width="160" height="80"></td>
                    <td><?php echo $row['created_by'] ?></td>
                    <td><?php echo $row['active'] ?></td>
                <?php
                }
                ?>
            ?>
        </table>

    </div>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#fetchval").on('change',function()
            {
                var value=$(this).val();
                // alert(value);

                $ajax
                ({
                    url:"fillter.php",
                    type:"POST",
                    data:'request='+value,
                    beforeSend:function()
                    {
                        $(".container").html("<span>Working...</span>");    
                    },
                    success:function(data)
                    {
                        $(".container").html*(data);
                    }
                });
            });
        });

    </script>
    
</body>
</html>