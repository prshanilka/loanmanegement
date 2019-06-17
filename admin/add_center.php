<?php 
extract($_POST);
if(isset($save))
{

$sql=mysqli_query($conn,"select * from center where c_location='$g_name'");
$r=mysqli_num_rows($sql);
		if($r!=true)
		{
		mysqli_query($conn,"INSERT INTO center (`c_location`) VALUES ('$g_name')");

		
		
$err="<font color='blue'>Congrates new Group added successfully</font>";
		}
		
		else
		{

	$err="<font color='red'>This Center already exists </font>";
		
	
	}
}

?>
<script src="add_group.js"></script>
<h2 style="color:#00FFFF;text-decoration:underline;" align="center">Add New Center</h2>
<form method="post">
	
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4"><?php echo @$err;?></div>
	</div>
	
	
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Enter Center Location</div>
		<div class="col-sm-5">
		<input type="text" name="g_name" pattern="[a-z A-Z]*" class="form-control" required/></div>
	</div>
	
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
		
		
<input type="submit" value="Add New Group" name="save" class="btn btn-success"/>
		<input type="reset" class="btn btn-success"/>
		</div>
	</div>
</form>	