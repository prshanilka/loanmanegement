<?php 
include("../connection.php");
extract($_POST);
if(isset($save))
{

	if($nic=="" || $loantype=="" ||$tot=="")
	{
	
	$err="<font color='red'>fill all the fileds first</font>";	
	}
	elseif ($flag==0) {

			mysqli_query($conn,"insert into loan values('$nic',1,'$loantype',now(),$tot)");
		
		
	}
	else
	{

		$flag=(int)$flag+1;
		mysqli_query($conn,"insert into loan values('$nic',$flag,'$loantype',now(),$tot)");
		
		
	}
}

?>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>



<h2 align="center" style="color:#00FFFF;text-decoration:underline">Allow Loan</h2>
<form method="post">
	
	<div class="row">
		<div id="warn"  role="alert" style="visibility: hidden"></div>
		<div class="col-sm-4" id="error"><span style="color:red;"></span><?php echo @$err;?></div>
	</div>
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">NIC</div>
			<div class="col-sm-5 ui-widget">
				<input type="text" id="nic" name="nic" class="form-control" required/>
			</div>
			<span class="input-group-btn">
    			<button class="btn btn-default" type="button" id="nicb">Go!</button>
  			</span>
	</div>

<div id="hidden" style="visibility: hidden"> 
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Select Loan</div>
		<div class="col-sm-5">
		<table class="table table-bordered">
			<tr>
				<th>Select</th>
				<th>Amount</th>
				<th>Interest</th>
				<th>Time(Weeks)</th>
				
			</tr>

			<?php 
$q1=mysqli_query($conn,"select * from loantype");
while($r1=mysqli_fetch_assoc($q1))
{
	
	if(strcmp($r1['l_avalibality'],'Available')==0)
	{
		echo "<tr>";
		echo "<td><input type='radio'   name='loantype' value='".$r1['l_id']."'/>";
		echo "<td>Rs.".$r1['l_amount']."/=</td>";
		echo "<td>".$r1['l_interest']."%</td>";
		echo "<td>".$r1['l_time']."</td>";
		
	
		echo "</tr>";
	}
}
			?>
	
		</table>
		</div>
	</div> 


	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Name </div>
		<div class="col-sm-5">
		<input type="text" id="name" name="name" class="form-control" required readonly/></div>
	</div>
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Center</div>
		<div class="col-sm-5">
		<input type="text" id="cen" name="center" class="form-control"  readonly/></div>
	</div>
		<input type="hidden" id="flag" name="flag"  />
		<input type="hidden" id="amount" name="amount"  />
		<input type="hidden" id="tot" name="tot"  />


	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Group </div>
		<div class="col-sm-5">
		<input type="text" id="group" name="name" class="form-control"  readonly/></div>
	</div>
<!--

	<script>
	loanamount()
		{
		var original=document.getElementById("original").value;	
		var interest=document.getElementById("interest").value;	
		var year=document.getElementById("payment_term").value;	
		
		var interest1=(Number(original)*Number(interest)*Number(year))/100;
		var total=Number(original)+Number(interest1);
		
		var emi=total/(year*12);
		document.getElementById("total_paid").value=total;
		document.getElementById("emi_per_month").value=emi;
		
		}
	</script>
	
-->
	
	


	
	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-8">
			<button  type="button" id="submit" name="save" class="btn btn-success ">Allow New Loan</button>
				<input type="reset" class="btn btn-success "/>
		</div>
</div>
</div>
</form>	
<script>
 	$(document).ready(function() {
   $( "#nic" ).autocomplete({
        source: 'php/autoc.php'
    });

		$("#nicb").click(function(){
				var nic = $("#nic").val();
				$.ajax({
					url: 'php/autoc.php',
					method: 'post',
					data: 'nic=' + nic
				}).done(function(member){
					member = JSON.parse(member);
					
					$("#name").empty();
					$("#name").val(member[0]+" "+member[1]);
					$("#cen").val(member[2]);
					$("#group").val(member[5]);


					
					if (member[3]>0) 
					{
						$("#hidden").css("visibility","hidden");
						$("#warn").removeClass().css("visibility", "visible").addClass("alert alert-danger").text("This Member Alredy paying for loan");
						$("#submit").addClass('disabled');
						
					}
					else if(member[0]===null && member[1]===null){
						$("#hidden").css("visibility","hidden");
						$("#warn").removeClass().css("visibility", "visible").addClass("alert alert-danger").text("This Member Alredy paying for loan");
					}
					else{$("#submit").css("visibility","hidden");	
						
						$("#warn").removeClass().css("visibility", "hidden").addClass("alert alert-success").text("");
						$("#submit").removeClass('disabled');
						$("#hidden").css("visibility","visible");	
						$('#error').children('span').text('');
						$("#flag").val(member[4]);
						console.log(member[4]);
						
						
						
				
						
					}

				})

			});
			var loanty=-1;
			$('input[type=radio][name=loantype]').change(function(){
				$("#submit").css("visibility","visible");	
					var lid = this.value;
					loanty=lid;
					console.log(lid);
				$.ajax({
					url: 'php/autoc.php',
					method: 'post',
					data: 'lid=' + lid
				}).done(function(loan){
					loan = JSON.parse(loan);
					$("#tot").val(loan[0]);
					var x=$("#tot").val()
					
				

			
					
				})
				});



				$("#submit").click(function(){
					if(!$("#group").val() ){
						$("#warn").removeClass().css("visibility", "visible").addClass("alert alert-warning").text("Add This Member to Group");
					}

					else{

						var flag=parseInt($("#flag").val());
						flag=flag+1;
						//console.log(flag);
						var tot=$("#tot").val();
						var group=$("#group").val();
						var nic=$("#nic").val();
						//console.log(loanty);
						//console.log(tot);
						//console.log(group);
						
						$.ajax({
							url: 'php/autoc.php',
							method: 'post',
							data: 'flag='+flag+'&loantype='+loanty+'&tot='+tot+'&group='+group+'&nicn='+nic
						}).done(function(sus){
							console.log(typeof(sus));
							
							if(parseInt(sus)=== 1){
								alert("Sucessfull !");
								location.reload();
							}
							else{
								alert("Unsucessfull Contact Admin !");
								location.reload();
							}
							
						

					
							
						});
						
					}
				});











 });
</script>