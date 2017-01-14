
$(function(){
	$('#search').keyup(function(){
		var value = $(this).val();
		// url1 = url + '/' + value;

		$.ajax({
          type: 'GET',
          url: url,
          data: {search:value},
          success: function(data){
          	if (value == '') {
          		$("#p_list tr").show();
          		$("tbody#search").html('');
          	}else if (data.no!=="") {
              $("#p_list tr").hide();
            	$("tbody#search").html(data);
          	}
          }
           
        });
        return false;

	});

  $("input[name=sort]").click(function(){
    var sort = $(this).val();
    $.ajax({
          type: 'GET',
          url: url,
          data: {sort:sort},
          success: function(data){
            
              $("#p_list tr").hide();
              $("tbody#search").html(data);

          }
        });
  });


});