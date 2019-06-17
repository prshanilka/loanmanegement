<?php 
include('../connection.php');


$q=mysqli_query($conn,"delete from member where nic='".$_GET['id']."'");

header('location:index.php?page=display_member');

?>