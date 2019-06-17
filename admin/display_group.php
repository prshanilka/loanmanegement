<?php
include('../connection.php'); 
$q=mysqli_query($conn,"select * from center");
$rr=mysqli_num_rows($q);
if(!$rr)
{
echo "<h2 style='color:red'>No any Centers exists !!!</h2>";
echo "<a style='text-decoration:underline' href='index.php?page=add_center'>Add New Center ?</a>";
}
else
{
?>
<script>
	function DeleteCenter(id)
	{
		if(confirm("You want to delete this Center ?"))
		{
		window.location.href="delete_center.php?id="+id;
		}
	}
</script>
<h2 style="color:#00FFCC">All Centers</h2>

<table class="table table-bordered">
	<tr>
		<form method="post" action="index.php?page=search_group">
		<td colspan="8">
		<input type="text"  placeholder="Search Center" name="searchGroup" class="form-control" required />
		</td>
		<td colspan="8">
		<input type="submit" value="Search Group" name="sub" class="btn btn-success" />
		</td>
		</form>
	</tr>
	
	<tr>
		<td colspan="16"><a href="index.php?page=add_center">Add New Center</a></td>
	</tr>
	<Tr class="active">
		<th>Center ID</th>
		<th>Center Location</th>
		<th></th>

		<!--<th>Update</th>-->
	</Tr>

<?php

  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  } 
  $sql = "SELECT * FROM center";
  $result = $conn->query($sql);
   // output data of each row
   while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["c_id"]. "</td><td>" . $row["c_location"] . "</td>";


	




?>

<td><a href="javascript:DeleteCenter('<?php echo $row['c_id']; ?>')" style='color:Red'><span class='glyphicon glyphicon-trash'></span></a></td>


<?php 

echo "</Tr>";

}
		?>
		
</table>

<?php }?>