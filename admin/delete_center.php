<?php 
include('../connection.php');

/*mysqli_query($conn,"delete from loan where c_id='".$_GET['c_id']."'");

mysqli_query($conn,"delete from member where c_id='".$_GET['c_id']."'");*/

mysqli_query($conn,"delete from center where c_id='".$_GET['id']."'");

header('location:index.php?page=display_center');

?>