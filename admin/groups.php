
<h2 style="color:#00FFCC;text-decoration:underline" align="center">Groups</h2>

<div class="row">
	<div class="col-sm-4">
		<select id="searchCenter" name="seachCenter" class="form-control" required>
			<option value="-1" disabled selected>Select Group</option>


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

<div class="row hid">
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div>
<hr>
<div class="row hid">
<div class="col-sm-9 table-responsive" id="nontable">
			
		</div>

</div>
<div class="row hid">

<hr>
<h3>Groups</h3>
</div>
<div class="row hid">
	<div id="table" class="col-sm-9 ">

	</div>
</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
$(document).ready(function(){
	var cir;
	$("#searchCenter").change(function() {
		var cid = this.value;
		cir=cid;
		var ch=choose(cid);
		console.log(ch);
		if(parseInt(cid)===-1){
			console.log("asdas");
			
		}
		else{
			$.ajax({
				type: 'post',
				url: 'php/group.php',
				data: 'c_id=' + cid
			}).done(function(table){
					$(".hid").css("visibility","visible");
					tabler = JSON.parse(table);
					console.log(table);
					$("#table").empty() ;
					$("#nontable").empty() ;
					var chooseDrop=0;
					var flag=1;
					var name="";
					var no=1;
					var gro=-1;
					var div=$('<div class="table-responsive"></div>');
					var table = $('<table class="table"></table>');

					
					var table2 = $('<table class="table"></table>');
					var head2 = $('<tr scope="col"></tr>');
					head2.append($('<th>#</th>'));
					head2.append($('<th>NIC</th>'));
					head2.append($('<th>Name</th>'));
					head2.append($('<th>Group</th>'));
					head2.append($('<th>ok</th>'));
					table2.append(head2);
					$(tabler).each(function (i, rowData) {
						var rowd = $('<tr data-group=-1></tr>');
						if(rowData[0]===-1){
							$(rowData).each(function (h,cellDatar) {
								


									switch(h) {
										case 0:
											break;
										case 1:
											rowd.append($('<td>'+no+'</td>'));	
											rowd.append($('<td>'+cellDatar+'</td>'));
											no=no+1;
											break;
										case 2:
											name=cellDatar;
											break;
										case 3:
											name=name+" "+cellDatar;
											rowd.append($('<td>'+name+'</td>'));
											break;
										default:
											rowd.append($('<td>'+cellDatar+'</td>'));
		
											} 


							});
							var trow=$('<td></td>');
							
							trow.append(ch.clone());
							rowd.append(trow);
							rowd.append($('<td><td>'));
							
							table2.append(rowd);

						}

						else{
							var row2 = $('<tr></tr>');
							
							
							var head = $('<tr scope="col"></tr>');


							
							if(gro===-1){
								row2.append($('<th colspan=5>Group <span id="data">'+rowData[0]+'</span></th>'));
								table.append(row2);
								head.append($('<th>#</th>'));
								head.append($('<th>NIC</th>'));
								head.append($('<th>Name</th>'));
								head.append($('<th>Group</th>'));
								head.append($('<th> </th>'));
								table.append(head);
								if(tabler.length===1){
									div.append(table);
								}
								
								
								gro=rowData[0];

									
							}
							else if(gro!==rowData[0]){


								no=1;
								//table.empty();
								div.append(table);
								row2.append($('<th colspan=5>Group '+(rowData[0])+'</th>'));
								table.append(row2);
								head.append($('<th>#</th>'));
								head.append($('<th>NIC</th>'));
								head.append($('<th>Name</th>'));
								head.append($('<th>Group</th>'));
								head.append($('<th> </th>'));
								table.append(head);
		
								gro=rowData[0];
								
								
							
								
							}
							else{
								gro=rowData[0];
							}
							var row = $('<tr data-group='+rowData[0]+'></tr>');
							var opti=$('<option value="" disabled selected>Choose</option>');
							$(rowData).each(function (j, cellData) {
								
								
								switch(j) {
									case 0:
										opti=$('<option value="" disabled selected>'+cellData+'</option>');
										break;
									case 1:
										row.append($('<td>'+no+'</td>'));	
										row.append($('<td>'+cellData+'</td>'));
										no=no+1;
										break;
									case 2:
										name=cellData;
										break;
									case 3:
										name=name+" "+cellData;
										row.append($('<td>'+name+'</td>'));
										break;
									default:
										row.append($('<td>'+cellData+'</td>'));
	
										} 



									


















								/*	if{
										;
										}
									else if(j===2){
									
									}
									else{
										row.append($('<td>'+cellData+'</td>'));
										}
										*/
							});
									var trow=$('<td></td>');
									
									trow.append(ch.clone());
									row.append(trow);
									row.append($('<td></td>'));
									

							table.append(row);
						}
					});
				$('#table').append(div);
				table2.append($('<tr ><td colspan=4><td></tr>'));
					var s1=$('<tr ></tr>');
					var s2=$('<td colspan=4></td>')
					s2.append($('<button id="addNewGroup" type="button" class="btn btn-warning" >Add new Group</button>'));
					s1.append(s2);
					table2.append(s1)
				$('#nontable').append(table2);
			});
		}
	});
	function changeB(currentRow ) {

		
		var col1=currentRow.find("td:eq(1)").text();
		var col2=currentRow.find("td:eq(3)").children("select").val()
		console.log(col1);
		console.log(col2);




		$.ajax({
				type: 'post',
				url: 'php/group.php',
				data: 'nic='+ col1+'&gid='+col2
			}).done(function(){
				var x=$("#searchCenter").val();
				$('#searchCenter').val(x).trigger('change');


		});
	}

	function choose(cid) {
		var sel=$('<select  class="mdb-select md-form colorful-select dropdown-primary k" ></select');
		$.ajax({
			type: 'post',
			url: 'php/group.php',
			data: 'cid=' + cid
		}).done(function(group){
				groups = JSON.parse(group);

				sel.append($('<option value="" disabled selected>Select</option>'));
				$(groups).each(function (i, rowData) {

					sel.append($('<option value='+ rowData[0]+'>'+rowData[0] +'</option>'));

										
				});
		});

		return sel;
	}



	
	$(document).on("click", "#addNewGroup", function(){
		console.log(cir);
		if(confirm("Are you Sure You want add new Group ?")){
			$.ajax({
				type: 'post',
				url: 'php/group.php',
				data: 'cid='+cir+'&newg=kl'
			}).done(function(){
					
					var x=$("#searchCenter").val();
					$('#searchCenter').val(x).trigger('change');
					});
			}
		});































	$(document).on("click", "#groupSelect", function(){

		var currentRow=$(this).closest("tr");
		changeB(currentRow);


	});
	$(document).on("change", ".k", function(){
		
		var currentRow=$(this).closest("tr");
		currentRow.find("td:eq(4)").empty();
		var val=parseInt($(this).val());
		var group=currentRow.data('group');
		 console.log(typeof(group));
		 console.log(typeof(val));
		
		if(val!==group){
			currentRow.find("td:eq(4)").empty().append($('<button id="groupSelect" type="button" class="btn btn-primary btn-xs" >Change</button>'));
		}
		
	
		
		

		


	});













});

</script>