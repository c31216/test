
$(function(){
	var $vaccine_id = $('option').val();
	$('input[name=expected_vaccine]').val($vaccine_id);
	$('input.btn').click(function(){
		$selected_id = $('select').find(":selected").attr('value');
		
		$vaccine_name = $('option').text();

		$expected_vaccine = $('#vaccines option[value='+$vaccine_id+']').text();

		$('#a').on('change', function (e) {
	    	valueSelected = this.value;
	    	if (valueSelected==$vaccine_id) {
	    		$('select').removeClass('empty');
	    		$('select').addClass('custom_success');
	    		$("#empty_msg").text('');
	    	}else{
	    		$('select').addClass('empty');
	    		$('select').removeClass('custom_success');
	    		$("#empty_msg").text('Please take '+ $expected_vaccine + ' first');
	    	}
		});

		if (Number($selected_id) != $vaccine_id) {
			$("#empty_msg").text('Please take '+ $expected_vaccine + ' first');
			$('select').addClass('empty');
			return false;
		}

		

	});



});




// $(function(){

// 	$('input.btn').click(function(){
// 		$selected_id = $('select').find(":selected").attr('value');
// 		if ($selected_id == 'empty') {
// 			$("#empty_msg").text('All Vaccines Has Already Been Taken');

// 			$('select').addClass(function() {
// 			    return 'empty';
// 			});

// 		}
// 	});

// });

