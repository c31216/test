$(document).on('click', ".edit", function () { 

    $('.edit').editable(edit_submit, {
     // type     : 'textarea',
     // onblur   : 'submit',
     // event: 'dblclick',
     select : true,
     submitdata : function(value, settings) {
       return {_method: "PUT",_token:token,col:$(this).attr("class").split(' ')[1]};


   }
 });

});

$(document).on('click', ".date", function () { 

   $('.date').editable(edit_submit, {
     select : true,
     type: 'datepicker',
     data: function(value, settings) {
      return value;
    },
     submitdata : function(value, settings) {
       return {_method: "PUT",_token:token,col:$(this).attr("class").split(' ')[1]};
   }
 });

});

 $('.edit').editable(edit_submit, {
     // type     : 'textarea',
     // onblur   : 'submit',
     event: 'click',
     indicator : 'saving ...',
     select : true,
     submitdata : function(value, settings) {
       return {_method: "PUT",_token:token,col:$(this).attr("class").split(' ')[1]};
   	},callback : function(value, settings) {
         $(this).addClass('success');
     }
 });
 $.editable.addInputType('datepicker', {
    element: function(settings, original) {
        var input = $('<input/>');
        $(this).append(input);
        return (input);
    },
    plugin: function(settings, original) {
        settings.onblur = 'ignore';
        $(this).find('input').datepicker({
             autoclose: true,
            format: 'yyyy-mm-dd',
        });
    },
});


$('.date').editable(edit_submit, {

    event: 'click',
    type: 'datepicker',
    data: function(value, settings) {
      return value;
    },
     submitdata : function(value, settings) {
       return {_method: "PUT",_token:token,col:$(this).attr("class").split(' ')[1]};
	   },callback : function(value, settings) {
         $(this).addClass('success');
    }
 });

 $(document).on("keyup", "input", function(e){
  if (e.keyCode === 10 || e.keyCode === 13){
    return false;
  } 
        

    $(this).removeClass("required");
});