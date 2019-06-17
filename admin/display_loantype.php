<?php 
$q=mysqli_query($conn,"select * from loantype");
$rr=mysqli_num_rows($q);
if(!$rr)
{
echo "<h2 style='color:red'>No any Loan Records exists !!!</h2>";
echo "<a style='text-decoration:underline' href='index.php?page=add_loan'>Allot New Loan ?</a>";
}
else
{
?>
<script>
	function ChangeAvali(id)
	{
		if(confirm("Do You want to Deactive This Loan "))
		{
		window.location.href="chage_avalibility.php?id="+id;
		}
	}
</script>

<h2 style="color:#00FFCC;text-decoration:underline" align="center">All Loan Details</h2>

<table class="table table-bordered">
	<tr>
		<td colspan="12">
		
		<a title="Add New Loan Records" href="index.php?page=add_loantype"><span class="glyphicon glyphicon-plus"</a>
		&nbsp; &nbsp; 
		
		</td>
	</tr>
	<Tr class="active">
		<th>Original Amount</th>
		<th>Interest(%)</th>
		<th>Time(Week)</th>
		<th>Total Interest</th> 
		<th>instalment(Per Week)</th>
		<th>Total Payment</th>
		<th>Avalibility</th>
		<th>Update</th>
	</Tr>
	
		<?php
    		if ($conn->connect_error) {
   				die("Connection failed: " . $conn->connect_error);
 			 } 
  			$sql = "SELECT * FROM loantype";
  			$result = $conn->query($sql);
   			// output data of each row
   			while($row = $result->fetch_assoc()) {
   			$a=$row['l_amount'];
   			$s=$row['l_interest'];
   			$t=$row['l_time'];
   			$inter=	$a*$s/100;
   			$totalpw=(($a/($t/4))+$inter)/4;
   			$total=ceil($totalpw)*$t;
            echo "<Tr>";
echo "<td>Rs.".$row['l_amount']."</td>";
echo "<td>".$row['l_interest']."%</td>";
echo "<td>".$row['l_time']."</td>";
echo "<td>Rs.".$inter."</td>";
echo "<td>Rs.".ceil($totalpw)."</td>";

echo "<td>Rs.".ceil($total)."</td>";
if (strcmp($row['l_avalibality'],'Available')==0) {
	$css="background-color:green;color:white;";
}
else {
	$css="background-color:red;color:white;";
}
echo "<td style=\"".$css."\">".$row['l_avalibality']."</td>";        



?>

<Td><a href="javascript:ChangeAvali('<?php echo $row['l_id']; ?>')" style='color:Red'><span class='glyphicon glyphicon-refresh'></span></a></td>
<?php 

echo "</Tr>";
}

		?>
		
</table>
<?php }?>

