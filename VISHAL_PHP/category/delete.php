<?php
include "../connection.php";

$did=$_GET['id'];
  $query = "SELECT * FROM category where id = '$did'";
  $data = mysqli_query($conn, $query);
  $total = mysqli_num_rows($data);
  if($total == 0)
  {
      echo "No Data Available";
      // header("location:home.php");
  }
  else
  {
      $sql = "DELETE FROM category WHERE id='$did'";
      if ($conn->query($sql) === TRUE) {
      echo '1';
      } else {
      echo "Error Deleting Record: " . $conn->error;
      }
  }
?>