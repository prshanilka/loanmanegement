<?php 
include('../connection.php');

$d=$_GET['id'];
$sql=mysqli_query($conn,"select * from loantype where l_id='".$d."'");
$res=mysqli_fetch_array($sql);
if (strcmp("Available",$res['l_avalibality'])==0) {
	mysqli_query($conn,"UPDATE loantype set l_avalibality='Not Available' where l_id='".$d."'");
}
else{

	mysqli_query($conn,"UPDATE loantype set l_avalibality='Available' where l_id='".$d."'");
}
header('location:index.php?page=display_loantype');

?>