function ValidatePAN() { 
  var panVal = $('#textPanNo').val();
    var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;

    if(regpan.test(panVal)){
       //alert("valid pan card number");
    } else {
       alert("Invalid pan card number");
       $('#textPanNo').val('')
       return false;
    }
  }

  $(document).ready(function () {

    $("#add-model").validate(); // intialize plugin
    //errorClass: "error",
    // presumably, this would be called after you dynamically create the new elements
    $('input[type="text"]').each(function () {

        $(this).rules('add', {
            required: true,
            messages: {
                required: "This field is required"
            }
        });
    });
    $('select.required').each(function () {
        var message = $(this).attr('title');
        if($(this).val() == '') {                
              //alert(message);
              $(this).focus();
              breakout = true;
              return false;
        }
    });
});