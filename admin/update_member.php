<?php 
extract($_POST);
if(isset($save))
{

mysqli_query($conn,"update center set first_name='$fn',last_name='$ln',gender='$gen',c_id='$group' where nic='".$_GET['nic']."' ");
		
$err="<font color='blue'>Members Updated</font>";
		
}

$sql=mysqli_query($conn,"select * from member where nic='".$_GET['nic']."'");
$r=mysqli_fetch_array($sql);

?>
<h2 align="center">Update Group Member</h2>
<form method="post">
	
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4"><?php echo @$err;?></div>
	</div>
	
	
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Enter Member First Name</div>
		<div class="col-sm-5">
		<input type="text" value="<?php echo $r[1]; ?>" name="fn" class="form-control" required/></div>
	</div>
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Enter Member Last Name</div>
		<div class="col-sm-5">
		<input type="text" value="<?php echo $r[2]; ?>" name="ln" class="form-control" /></div>
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
?>
<option <?php if($r[4]==$r1['c_id']){echo "selected";} ?> 
value="<?php echo  $r1['c_id'];?> "><?php echo $r1['c_location']; ?></option>
<?php 
}
			?>
		</select>
		</div>
	</div>
	
		<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Enter Member Join Date</div>
		<div class="col-sm-5">
		<input type="date" value="<?php echo $r[5]; ?>" name="ln" class="form-control" /></div>
	</div>

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Select Member Gender</div>
		<div class="col-sm-5">
		Male <input type="radio" <?php if($r[3]=="m"){echo "checked";} ?> name="gen" value="m" required/>
	Female <input type="radio" <?php if($r[3]=="f"){echo "checked";} ?> name="gen" value="f" />
		</div>
	</div>
	
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
		
		
<input type="submit" value="Update Member" name="save" class="btn btn-success"/>
		<input type="reset" class="btn btn-success"/>
		</div>
	</div>
</form>	