<?php 
extract($_POST);
if(isset($save))
{

	if($l_amount=="" || $l_interest=="" || $l_time=="" )
	{
	$err="<font color='red'>fill all the fileds first</font>";	
	}
	else
	{	$ava="Available";
		$c=$l_time*4;
		mysqli_query($conn,"INSERT INTO `loantype`(`l_interest`, `l_time`, `l_amount`, `l_avalibality`) VALUES (' $l_interest','$c','$l_amount','$ava')");
		
	$err="<font color='blue'>Congrates Loan Added</font>";
		
		
	}
}

?>
<h2 align="center" style="color:#00FFFF;text-decoration:underline">Allowt Loan</h2>
<form method="post">
	
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4"><?php echo @$err;?></div>
	</div>
	
	
	<script>
		function loanamount()
		{
		var original=document.getElementById("original").value;	
		var interest=document.getElementById("interest").value;	
		var month=document.getElementById("time").value;	
		var week=Number(month)*4;
		var interest1=(Number(original)*Number(interest))/100;
		var istmoth=(Number(original)/Number(month))+Number(interest1);
		
		var istweek=((Number(original)/Number(month))+Number(interest1))/4;
		var totala=Math.ceil(istweek)*week;
		document.getElementById("totalint").value=Math.ceil(interest1);
		document.getElementById("emi_per_month").value=Math.ceil(istmoth);
		document.getElementById("emi_per_week").value=Math.ceil(istweek);
		document.getElementById("tt").value=totala;
		
		}
	</script>
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Amount</div>
		<div class="col-sm-5">
		<input type="number" id="original" name="l_amount" class="form-control" required/></div>
	</div>
	
	
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Intereset(%)</div>
		<div class="col-sm-5">
		<input type="number" name="l_interest" id="interest" value="10"  class="form-control" required/></div>
	</div>
	

	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Payment Schedule(Month)</div>
		<div class="col-sm-5">
		<select onchange="loanamount()" name="l_time" id="time" class="form-control" required>
			<option value="">Payment Schedule(Month)</option>
			<?php
				for($i=1;$i<=12;$i++)
				{
				echo "<option value='".$i."'>".$i."</option>";
				}
			 ?>
		</select>
		</div>
	</div>
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Total Intereset Rs.</div>
		<div class="col-sm-5">
		<input type="number" id="totalint" name="totalinterest" class="form-control" readonly/></div>
	</div>
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Instalment(Per Month) Rs.</div>
		<div class="col-sm-5">
		<input type="number" id="emi_per_month" name="emi_per_month" class="form-control" readonly/></div>
	</div>
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Instalment(Per week) Rs.</div>
		<div class="col-sm-5">
		<input type="number" id="emi_per_week" name="emi_per_month" class="form-control" readonly/></div>
	</div>
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Total Payment Rs.</div>
		<div class="col-sm-5">
		<input type="numbers" id="tt" name="tpayment" class="form-control"  readonly/>
	
		</div>
	</div>
	
	
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
		
		
<input type="submit" value="Add New Loan" name="save" class="btn btn-success"/>
		<input type="reset" class="btn btn-success"/>
		</div>
	</div>
</form>	