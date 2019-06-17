<?php 
include('../connection.php');


mysqli_query($conn,"delete from loan where nic='".$_GET['nic']."' and l_num=".$_GET['num']);

header('location:index.php?page=display_loan');

?>