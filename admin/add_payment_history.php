
 <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

<h2 align="center" style="color:#00FFFF;text-decoration:underline">Add Payment</h2>
<div id="warn"  role="alert" style="visibility: hidden">
  
  </div>
<form method="post" id="sub">

	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4"><p id="err"></p><?php echo @$err;?></div>
	</div>
	
	
	<script>
		function loanamount(original,interest,week,tot)
		{

		var month=Number(week)/4;
		var interest1=(Number(original)*Number(interest))/100;
		var istmoth=(Number(original)/Number(month))+Number(interest1);
		
		var istweek=Number(istmoth)/4;


		document.getElementById("original").value=tot;
		document.getElementById("tt").value=Math.ceil(istweek);
		
		}
	</script>
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">NIC</div>
			<div class="col-sm-5">
				<input type="text" id="nic" name="nic" class="form-control " required/>
			</div>
			<span class="input-group-btn">
    			<button class="btn btn-default" type="button" id="nicb">Go!</button>
  			</span>
	</div>
	<div id="hidden" style="visibility: hidden">
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Total Amount To pay</div>
		<div class="col-sm-5">
		<input type="number" id="original" name="l_amount" class="form-control" readonly required/></div>

	</div>
	<div class="row" style="margin-top:10px">
		<div class="col-sm-4">Total Amount  paid</div>
		<div class="col-sm-5">
		<input type="number" id="paid" name="paid" class="form-control" readonly required/></div>

	</div>
	
	<div class="row" style="margin-top:10px">
		
		<div class="col-sm-4">Payment Rs.</div>
		<div class="col-sm-5" >
		<input type="numbers" id="tt" name="tpayment" class="form-control"  required/>
	
		</div>
	</div>
	
	<input type="hidden" id="l_num" name="l_num"/>

	
	<div class="row" style="margin-top:10px">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
		
		
<input type="submit" value="Payment" name="save" class="btn btn-success"/>

		<button  class="btn btn-success" onclick="resetfs()">Reset</button>
		</div>
	</div>
	</div>
</form>	

<hr><div id="table" class="row"></div>
<script>
function resetf() {
	$("#sub").trigger("reset");
	$('#nic').prop('readonly', false);
	$("#hidden").css("visibility", "hidden");
	$("#warn").removeClass().css("visibility", "hiddden").text("");
}
function resetfs() {
	$("#sub").trigger("reset");
	$('#nic').prop('readonly', false);
	$("#hidden").css("visibility", "hidden");
	$("#table").empty() ;
}
$(document).ready(function() {
	$("#nicb").click(function(){
				$("#table").empty() ;
				var nic = $("#nic").val();
				$.ajax({
					url: 'php/payment.php',
					method: 'post',
					data: 'nic=' + nic
				}).done(function(loan){
					console.log(loan);
					
					loan = JSON.parse(loan);
					if(loan[0].localeCompare('inv')!==0){
					$.ajax({
  						type: 'post',
  						url: 'php/table.php',
  						data: 'nic=' + nic+'& l_num=' + loan[6]
						  }).done(function(table){
							tabler = JSON.parse(table);
							console.log(table);
							
							
							var table = $('<table class="table"></table>');
							var head = $('<tr scope="col"></tr>');
							head.append($('<th>#</th>'));
							head.append($('<th>Payment</th>'));
							head.append($('<th>Date</th>'));
							table.append(head);
   							$(tabler).each(function (i, rowData) {

        					var row = $('<tr></tr>');
       						 $(rowData).each(function (j, cellData) {
								if(j===1 || j===4){
								

								}
								else{
									row.append($('<td>'+cellData+'</td>'));
								}
           						
        					});
        					table.append(row);
    						});
							$('#table').append(table);





					});	











					
					if(loan[0].localeCompare('inv')===0){
						$("#hidden").css("visibility", "hidden");
						$("#warn").removeClass().text("");
					}
					else if(loan[0]>0){
						$("#hidden").css("visibility", "visible");	
						loanamount(loan[2],loan[0],loan[1],loan[3]);
						$("#l_num").val(loan[6])
						$('#nic').prop('readonly', true);
						$("#paid").val(loan[5])
						/*
						if(loan[7].localeCompare('Under_paid')===0){
							$("#warn").removeClass().css("visibility", "visible").addClass("alert alert-warning").text("Under Paid ");
						}
						else if(loan[7].localeCompare('not_paid')===0){
							$("#warn").removeClass().css("visibility", "visible").addClass("alert alert-danger").text("Not Paid ");
						}
						*/
						console.log(loan[0]);
						console.log(loan[1]);
						console.log(loan[2]);
						console.log(loan[3]);
						console.log(loan[6]);

					}
					else{
						$("#err").text("Something went wrong");	
					}
				}
				else{
					console.log("asdasd");
					
				}
				})
			});
	
	$('form').on('submit', function (e) {
		e.preventDefault();
		$.ajax({
  			type: 'post',
  			url: 'php/form.php',
  			data: $('form').serialize()
		}).done(function(flag){ 
			console.log(flag);
			
			if(flag.localeCompare('1')===0){
				console.log(flag);
			$("#warn").removeClass().css("visibility", "visible").addClass("alert alert-warning").text("Unsuccessful ");
			}
			resetfs();



		});

	});

});
</script>