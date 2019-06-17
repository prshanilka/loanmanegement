<?php 

$q=mysqli_query($conn,"select * from loan");
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
	function Deleteloan(nic,num)
	{
		if(confirm("You want to delete this Record ?"))
		{
		window.location.href="delete_loan_record.php?nic="+nic+"&num="+num;
		}
	}
</script>
<h2 style="color:#00FFCC;text-decoration:underline" align="center">All Loan Details</h2>

<table class="table table-bordered">
	<tr>
		<form method="post" action="index.php?page=search_loan">
		<td colspan="5">
		<select name="seachLoan" class="form-control" required>
			<option value="">Select Group</option>
			<?php 
			
$q1=mysqli_query($conn,"select * from center");
while($r1=mysqli_fetch_assoc($q1))
{
echo "<option value='".$r1['c_id']."'>".$r1['c_location']."</option>";
}
			?>
		</select>
		</td>
		<td colspan="2">
		<input type="submit" value="Search Loan" name="sub" class="btn btn-success" />
		</td>
		</form>
	</tr>
	<tr>
		<td colspan="7">
		
		<a title="Add New Loan Records" href="index.php?page=add_loan"><span class="glyphicon glyphicon-plus"</a>
		&nbsp; &nbsp; 
		
		<a title="Print all Loan Records" href="print_loan_record.php"><span class="glyphicon glyphicon-print"</a>
		
		</td>
	</tr>
	<Tr class="active">
		<th>NIC</th>
		<th>Amount</th>
		<th>Center</th>
		<th>Time (Weeks)</th>
		<th>Loan No # </th>
		<th>Date</th>
		<th>Delete</th>
	</Tr>
      

	</Tr>
		<?php
		error_reporting(1);
		$rec_limit =10;
		
		/* Get total number of records */
	
		$sql = "SELECT count(nic) FROM loan ";
		$retval = mysqli_query($conn,$sql);
		
		if(! $retval )
 		{
			 die('Could not get data: ' . mysqli_error());
		}
		$row = mysqli_fetch_array($retval, MYSQL_NUM );
		$rec_count = $row[0];
		
		if( isset($_GET{'pagi'} ) ) {
			 $pagi = $_GET{'pagi'} + 1;
			 $offset = $rec_limit * $pagi ;
		}else {
			 $pagi = 0;
			 $offset = 0;
		}
		

		$left_rec = $rec_count - ($pagi * $rec_limit);


    		if ($conn->connect_error) {
   				die("Connection failed: " . $conn->connect_error);
				} 

  			$sql = "SELECT * FROM loan where l_total!=0 limit ".$offset.",".$rec_limit;
  			$result = $conn->query($sql);
				 // output data of each row
   			while($row = $result->fetch_assoc()) {

						echo "<Tr>";
						echo "<td>".$row['nic']."</td>";

						$q1=mysqli_query($conn,"select * from loantype where l_id='".$row['l_id']."'");
						$r1=mysqli_fetch_assoc($q1);
						echo "<td>".$r1['l_amount']."</td>";

						$q2=mysqli_query($conn,"select * from center where c_id IN(SELECT c_id from member WHERE nic='".$row['nic']."')");
						$r2=mysqli_fetch_assoc($q2);
						echo "<td>".$r2['c_location']."</td>";
						echo "<td>".$r1['l_time']."</td>";	
						echo "<td>".$row['l_num']."</td>";
						echo "<td>".$row['l_date']."</td>";
/*
$q1=mysqli_query($conn,"select * from center where c_id='".$row['c_id']."'");
$r1=mysqli_fetch_assoc($q1);

echo "<td>".$r1['c_location']."</td>";
echo "<td>".$row['join_date']."</td>";
  */      
         

?>

<Td><a href="javascript:Deleteloan('<?php echo $row['nic'];  ?>','<?php echo $row['l_num'];  ?>')" style='color:Red'><span class='glyphicon glyphicon-trash'></span></a></td>


<?php 

echo "</Tr>";
$inc++;
}

	
echo "<tr><td colspan='7'>";
if( $pagi > 0 )
 {
         $last = $pagi - 2;
      echo "<a href = \"index.php?page=display_loan&pagi=$last\">Last 10 Records</a> |";
        echo "<a href = \"index.php?page=display_loan&pagi=$pagi\">Next 10 Records</a>";
         
		 }
		 else if( $pagi == 0 )
		  {
     echo "<a href = \"index.php?page=display_loan&pagi=$pagi\">Next 10 Records</a>";
         }
		 else if( $left_rec < $rec_limit ) {
            $last = $pagi - 2;
            echo "<a href = \"index.php?page=display_loan&pagi=$last\">Last 10 Records</a>";
         }
        echo "</td></tr>"; 
		?>
		
</table>
<?php }?>