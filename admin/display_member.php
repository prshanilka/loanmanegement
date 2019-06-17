<?php 
include('../connection.php');
$q=mysqli_query($conn,"select * from member");
$rr=mysqli_num_rows($q);
if(!$rr)
{
echo "<h2 style='color:red'>No  Members exists !!!</h2>";
echo "<a style='text-decoration:underline' href='index.php?pagi=add_group_member'>Add New Member ?</a>";}
else
{



?>
<script>
	function DeleteMember(id)
	{
		if(confirm("You want to delete this Member ?"))
		{
		window.location.href="delete_group_member.php?id="+id;
		}
	}
</script>
<h2 style="color:#00FFCC">All  Members</h2>

<table class="table table-bordered">
	<tr>
		<form method="post" action="index.php?page=search_member">
		<td colspan="4">
		<input type="text" placeholder="Search Member" name="searchMember" class="form-control"required />
		</td>
		<td colspan="4">
		<input type="submit" value="Search Member" name="sub" class="btn btn-success" />
		</td>
		</form>
	</tr>
	<tr>
		<td colspan="8"><a href="index.php?page=add_member">Add New Member</a></td>
	</tr>
	<Tr class="active">
		<th>NIC</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Gender</th>
		<th>Center</th>
		<th>Date</th>
		<th>Delete</th>
		<th>Update</th>
	</Tr>
		<?php
    		if ($conn->connect_error) {
   				die("Connection failed: " . $conn->connect_error);
 			 } 
  			$sql = "SELECT * FROM member";
  			$result = $conn->query($sql);
   			// output data of each row
   			while($row = $result->fetch_assoc()) {

            echo "<Tr>";
echo "<td>".$row['nic']."</td>";
echo "<td>".$row['first_name']."</td>";
echo "<td>".$row['last_name']."</td>";
echo "<td>".$row['gender']."</td>";

$q1=mysqli_query($conn,"select * from center where c_id='".$row['c_id']."'");
$r1=mysqli_fetch_assoc($q1);

echo "<td>".$r1['c_location']."</td>";
echo "<td>".$row['join_date']."</td>";
        
         

?>

<Td><a href="javascript:DeleteMember('<?php echo $row['nic']; ?>')" style='color:Red'><span class='glyphicon glyphicon-trash'></span></a></td>

<Td><a href="index.php?page=update_member&nic=<?php echo $row['nic']; ?>" style='color:green'><span class='glyphicon glyphicon-edit'></span></a></td>
<?php 

echo "</Tr>";
}

		?>
		
</table>
<?php }?>