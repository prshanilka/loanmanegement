<?php 
$search=$_POST['seachLoan'];
//echo $search;	
$q=mysqli_query($conn,"select * from center  where c_id='$search'");
$rr=mysqli_num_rows($q);
if(!$rr)
{
echo "<h2 style='color:red'>No Results found !!!</h2>";

}
else
{
?>
<script>
	function Deleteloan(id)
	{
		if(confirm("You sure want to permanently  delete this Record ?"))
		{
		window.location.href="delete_loan_record.php?id="+id;
		}
	}
</script>
<h2 style="color:#00FFCC; text-decoration:underline" align="center" >Results Found</h2>

<table class="table table-bordered">
	
	<tr>
		<td colspan="9"><a href="index.php?page=display_loan">Go Back </a></td>
	</tr>
	<Tr class="active">
		<th>NIC</th>
		<th>Amount</th>
		<th>Time (Weeks)</th>
		<th>Loan No # </th>
		<th>Date</th>
		<th>Top Up</th>
		<th>Delete</th>
		
	</Tr>
		<?php 


$i=1;

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
 } 

$sql = "SELECT * FROM loan  WHERE nic IN(SELECT  DISTINCT nic from member WHERE c_id=".$search." ) ";
$result = $conn->query($sql);
  // output data of each row
while($row = $result->fetch_assoc()) {
		if($row['l_total']==0){
			continue;
		}
		else {
			# code...
		
		 echo "<Tr>";
		 echo "<td>".$row['nic']."</td>";

		 $q1=mysqli_query($conn,"select * from loantype where l_id='".$row['l_id']."'");
		 $r1=mysqli_fetch_assoc($q1);
		 echo "<td>".$r1['l_amount']."</td>";

		 $q2=mysqli_query($conn,"select * from center where c_id='".$row['nic']."'");
		 $r2=mysqli_fetch_assoc($q2);
		 
		 echo "<td>".$r1['l_time']."</td>";	
		 echo "<td>".$row['l_num']."</td>";
		 echo "<td>".$row['l_date']."</td>";
		}

?>
<Td><button id="topup" type="button" class="btn btn-outline-primary">TopUp</button></td>
<Td><a href="javascript:Deleteloan('<?php echo $row['l_id']; ?>')" style='color:Red'><span class='glyphicon glyphicon-trash'></span></a></td>


<?php 

echo "</Tr>";
$i++;
}
		?>
		
</table>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
$(document).ready(function() {
	$("#topup").click(function(){
				$.ajax({
					url: 'php/topup.php',
					method: 'post',
					data: 'nic=' + nic
				}).done(function(loan){
					console.log(loan);
				});
	}
}
</script>
<?php }?>