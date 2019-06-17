<?php 
include('../connection.php');
extract($_POST);
if(isset($save))
{

	if($nic=="" || $fn=="" || $ln=="" || $group=="" || $gen=="" || $bdate=="")
	{
	$err="<font color='red'>fill all the fileds first</font>";	
	}
	else
	{
$sql=mysqli_query($conn,"select * from member where nic='$nic'");
$r=mysqli_num_rows($sql);
		if($r!=true)
		{
		mysqli_query($conn,"insert into member values('$nic','$fn','$ln','$gen','$group',now(),'$bdate','')");
		
$err="<font color='blue'>Congrates new member added successfully</font>";
		}
		
		else
		{

	$err="<font color='red'>This member already exists</font>";
		
		}
	}
}

?>
<h2>Add New Member</h2>
<form method="post" >
	
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4"><?php echo @$err;?></div>
	</div>
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Enter NIC Number</div>
		<div class="col-sm-5">
		<input type="text" name="nic" class="form-control nic-validate" required/></div>
		<span class="input-group-btn">
    			<button class="btn btn-default nic-validate-btn" type="button" id="nicb">Enter</button>
  			</span>
		<small class="nic-validate-error" style="color: red;"></small>
	</div>
<div class="row" id="hidden" style="visibility:hidden"> 
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Enter First Name</div>
		<div class="col-sm-5">
		<input type="text" name="fn" class="form-control" required/></div>
	</div>
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Enter Last Name</div>
		<div class="col-sm-5">
		<input type="text" name="ln" class="form-control" /></div>
	</div>
	
		<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Select Center</div>
		<div class="col-sm-5">
		<select name="group" class="form-control" required>
			<option value="">Select Center</option>
			<?php 
$q1=mysqli_query($conn,"select * from center");
while($r1=mysqli_fetch_assoc($q1))
{
echo "<option value='".$r1['c_id']."'>".$r1['c_location']."</option>";
}
			?>
		</select>
		</div>
	</div>
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Enter BirthDate</div>
		<div class="col-sm-5">
		<input type="date" name="bdate" class="form-control nic-birthday" readonly/></div>
	</div>
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Member Gender</div>
		<div class="col-sm-5">
		<input type="text" name="gen" class="form-control nic-gender" readonly/></div>
		</div>
	</div>
	
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
		
		
<input type="submit" value="Add New Member" name="save" class="btn btn-success"/>

		<input type="reset" class="btn btn-success"/>
		</div>
	</div>
	</div>
</form>	

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="../js/nic.js" ></script>
