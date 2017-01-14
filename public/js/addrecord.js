$(document).ready(function(){

	var d = new Date();

	var month = d.getMonth()+1;
	var day = d.getDate();

	var output = d.getFullYear() + '-' +
	    ((''+month).length<2 ? '0' : '') + month + '-' +
	    ((''+day).length<2 ? '0' : '') + day;

	var clicked_addrecord;
	var addrecord = $("#add-record");
	addrecord.click(function(e){
		e.preventDefault();
		clicked_addrecord = true;
		$("#p_list").prepend('<tr id="active"><td><input type="text" name="registration_date" value="'+output+'" data-toggle="datepicker" class="col-xs-12" ></input></td>'+
								'<td><input type="text" name="pat_bdate" data-toggle="datepicker" value="'+output+'" id="daterange" class="col-xs-12 docs-date"></input></td>'+
								'<td><input type="text" name="pat_lname" class="col-xs-12"></input></td>'+
								'<td><input type="text" name="pat_fname" class="col-xs-12""></input></td>'+
								'<td><input type="number" name="weight" value="0" class="col-xs-12"></input></td>'+
								'<td><input type="number" name="height" value="0" class="col-xs-12"></input></td>'+
								'<td><input type="number" name="age" value="0" class="col-xs-12"></input></td>'+
								'<td><input type="text" name="sex" maxlength="1" class="col-xs-12"></input></td>'+
								'<td><input type="text" name="mother_name" class="col-xs-12"></input></td>'+
								'<td><input type="text" name="address" class="col-xs-12"></input></td>'+
								'<td id="hidden"><input type="text" name="pat_uname" class="col-xs-12"></input></td>'+
								'<td id="hidden"><input type="text" name="pat_pass" class="col-xs-12"></input></td>'+ csrf+
							'</tr>');
		event.stopPropagation();
		$("tr#active td input[name=pat_lname]").focus();
		addrecord.hide();
	  	$('[data-toggle="datepicker"]').datepicker({
	  		format: 'yyyy-mm-dd'
	  	});

	  	$('#active input').keypress(function(event){

		  if(event.keyCode == 13){

		    pat_bdate = $("input[name=pat_bdate]").val();
			var pat_lname = $("input[name=pat_lname]").val();
			var pat_fname = $("input[name=pat_fname]").val();
			var weight = $("input[name=weight]").val();
			var height = $("input[name=height]").val();
			var age = $("input[name=age]").val();
			var sex = $("input[name=sex]").val();
			var mother_name = $("input[name=mother_name]").val();
			var address = $("input[name=address]").val();
			var registration_date = $("input[name=registration_date]").val();
			var pat_uname = $("input[name=pat_uname]").val();
			var pat_pass = $("input[name=pat_pass]").val();

			var pat_bdate = pat_bdate.replace(/\//g, "-");
			var dateAr = pat_bdate.split('-');
			var pat_bdate = dateAr[0] + '-' + dateAr[1] + '-' + dateAr[2].slice(-2);

			
			$('tr td input').filter(function() {
			    return !this.value;
			}).attr("placeholder", "Required").addClass("required");

			$.ajax({
	          type: 'POST',
	          url: add,
	          data: {pat_uname:pat_uname,pat_pass:pat_pass,registration_date:registration_date,pat_bdate:pat_bdate,pat_lname:pat_lname,pat_fname:pat_fname,weight:weight,height:height,age:age,sex:sex,mother_name:mother_name,address:address,_token:token},
	          success: function(id){
	          	$("input[name=pat_pass]").remove();
	          	$("input[name=pat_uname]").remove();

	          	$( "input[name!='registration_date'][name!='pat_bdate']").closest('td').addClass('edit');

	          	$("input[name='registration_date']").closest("td").addClass("date");
	          	$("input[name='pat_bdate']").closest("td").addClass("date");

	          	$("tr#active td input").each(function(){
	          		$(this).closest('td').append($(this).val()).addClass($(this).attr('name')).attr('id', id);
	          	});
	          	
	          	$("tr#active").addClass('success');
	          	$("tr#active td input").remove();
	          	$( "tr#active #hidden" ).each(function() {
				  $( this ).remove();
				});
				$( "tr #hidden" ).each(function() {
				  $( this ).remove();
				});

	          	
	          	$("tr#active").append('<td><a href="posts/'+id+'"><p>View Profile</p></a></td>'+
	          						  '<td><a href="checkup/'+id+'"><p>Check Up</p></a></td>'+
	          						  '<td><a href="immunization/'+id+'"><p>Immunize</p></a></td>'
	          						  );
	          	$("tr#active").removeAttr("id");
	          	addrecord.show();
	          	clicked_addrecord = false;
	          }
	           
	        });
		  }
		});


	});	
	
	$(window).click(function(e)
	{
		if (clicked_addrecord) {

			if ( e.target.nodeName=="INPUT" ) {
			    return;
			}
			$("tr#active").remove();
			addrecord.show();
       	}
	});
});