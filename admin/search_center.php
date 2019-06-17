<?php 
$search=$_POST['searchGroup'];
$x=substr($search, 1, 2);
$q=mysqli_query($conn,"select * from center where c_id='$x' or c_location='$search'");
$rr=mysqli_num_rows($q);
if(!$rr)
{
echo "<h2 style='color:red'>No any Records exists !!!</h2>";
}
else
{
?>
<script>
	function DeleteCenter(id)
	{
		if(confirm("You want to delete this center ?"))
		{
		window.location.href="delete_center.php?id="+id;
		}
	}
</script>
<h2 style="color:#00FFCC; text-decoration:underline" align="center" >Results Found</h2>

<table class="table table-bordered">
	
	
	<tr>
		<td colspan="16"><a href="index.php?page=display_center">Go Back to Center Page</a></td>
	</tr>
	<Tr class="active">
		<th>#</th>
		<th>Center ID</th>
		<th>Center Location</th>
		<th>Delete</th>
		<!--<th>Update</th>-->
	</Tr>
		<?php 



while($row=mysqli_fetch_assoc($q))
{

echo "<Tr>";
echo "<td>".$i."</td>";
echo "<td>U". $row["c_id"]."</td>";
echo "<td>". $row["c_location"]."</td>";
?>

<Td><a href="javascript:DeleteCenter('<?php echo $row['c_id']; ?>')" style='color:Red'><span class='glyphicon glyphicon-trash'></span></a></td>

<!--<Td><a href="index.php?page=update_group" style='color:green'><span class='glyphicon glyphicon-edit'></span></a></td>-->

<?php 
echo "</Tr>";
$i++;
}
		?>
		
</table>
<?php }?>