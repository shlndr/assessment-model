var catArray = [];
var weightageArray = [];
function typeVal()
{
   $('#total-score').html(0);
    var typeId = $('select[name="type"]').val();
    //console.log(typeId);
    if(typeId != '')
    {
        $('#variables').html('');    
	    $.ajax({
        type: "GET",
        url: APP_URL + "/models/get-variables",
        dataType:"html",
        data:{'typeId':typeId},

        success : function(data){
            $('#variables').html(data);
            $('#variables').slideDown('slow');	                
        }
	    });
    }

}
function getUrlParameter(sParam)
{
    //var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    
}

function stickFunct(variable)
{    
    if(variable == 'custName')
    {
       var custval = $('#cust_name').val();
       $('#custname').html(custval);
    }
    else
    {
        var panno = $('#textPanNo').val();
       $('#panno').html(panno);
    }
}
function edittypeVal()
{
   // console.log('abcd');
    var typeId = $('select[name="type"]').val();
    var custId = getUrlParameter('custId');
    //console.log(typeId);
    if(typeId != '' && typeId != null)
    {
        $('#variables').html('');    
        $.ajax({
        type: "GET",
        url: APP_URL + "/models/edit-get-variables",
        dataType:"html",
        data:{'custId':custId},

        success : function(data){
            $('#variables').html(data);                 
        }
        });
    }

}
 $(document).ready(function(){

    edittypeVal();
 });
function scoreVal(catId)
{ 
    // debugger;
    var weightage = parseFloat($('option:selected','select[name="category_'+catId+'"]').attr("data-weight"));
    var scoreId = $('option:selected','select[name="category_'+catId+'"]').attr("data-scoreId");
    var lovId = $('option:selected','select[name="category_'+catId+'"]').attr("data-lovid");
    var score  = parseFloat($('#score_'+scoreId).text());
    
    var sum = 0;
    

    if(jQuery.inArray(catId,catArray)!='-1')
    {
        for (var i = 0; i < weightageArray.length+1; i++) {
            if(weightageArray[i]['categoryId'] == catId)
            {
                var returnval = parseFloat(weightageArray[i]['weightval']);
                sum = score - returnval;
                sum = sum + weightage;
                weightageArray.splice(i,1);
                weightageArray.push({categoryId:catId,weightval:weightage});
                break;
            }
        };
        
    }
    else
    {
        weightageArray.push({categoryId:catId,weightval:weightage});
        catArray.push(catId);

        sum = weightage + score;
    }

    $('#score_'+scoreId).text(sum);

    var score1 = parseFloat($('#score_1').text());
    var score2 = parseFloat($('#score_2').text());
    var score3 = parseFloat($('#score_3').text());
    var score4 = parseFloat($('#score_4').text());
    var score5 = parseFloat($('#score_5').text());
    var score6 = parseFloat($('#score_6').text());
    var score7 = parseFloat($('#score_7').text());
    var score8 = parseFloat($('#score_8').text());
    
    if(isNaN(score8))
    {
        score8 = 0;
    }
    
    var TotalScore = score1 + score2 + score3 + score4 + score5 + score6 + score7 + score8;
    $('#total-score').html(TotalScore);
    //$('#totalmarks').html(TotalScore);
}

function sumtxFun(catId)
{
    var existingVehicle = $('#b23c1286-9').val();
    var existingFinanceVehicle = $('#b241af79-9').val();
    var freeVehicle = $('#b247a0db-9').val();
    var noFreeCv = $('#b24c0b7a-9').val();
    var proposedFunding = $('#b251d31d-9').val();
    // if(jQuery.inArray(catId,sumArray)!='-1')
    // {
        if(existingVehicle != '' && existingFinanceVehicle != '' && freeVehicle != '' && noFreeCv != '' && proposedFunding != '')
        {
            //var sub = existingVehicle - existingFinanceVehicle;
            //var result = existingVehicle + sub;
            // $('#b247a0db-9').val(sub);
            // if(noFreeCv != '')
            // {
                //debugger;

                // var getval = noFreeCv - sub; 
                // var addition = parseInt(existingVehicle) + getval;
                //  //console.log(addition);
                // $('#b251d31d-9').val(addition);

                var division = noFreeCv/proposedFunding;
                var getdiv = division *100;
                $('#b257c196-9').val(Math.ceil(getdiv));

            //}

            
        }
    //}
}
function sumfxFun(catId)
{
    var existingVehicle = $('#0265488e-9').val();
    var existingFinanceVehicle = $('#280e9987-9').val();
    var freeVehicle = $('#b247a0db-9').val();
    var noFreeCv = $('#df2101ea-9').val();
    var proposedFunding = $('#df2cda6c-9').val();
    // if(jQuery.inArray(catId,sumArray)!='-1')
    // {
        if(existingVehicle != '' && existingFinanceVehicle != '' && freeVehicle != '' && noFreeCv != '' && proposedFunding != '')
        {
            // var sub = existingVehicle - existingFinanceVehicle;
            // //var result = existingVehicle + sub;
            // $('#4c99482f-9').val(sub);
            // if(noFreeCv != '')
            // {
            //     //debugger;

            //     var getval = noFreeCv - sub; 
            //     var addition = parseInt(existingVehicle) + getval;
            //      //console.log(addition);
            //     $('#df2cda6c-9').val(addition);

                var division = noFreeCv/proposedFunding;
                var getdiv = division *100;
                $('#df34e12e-9').val(Math.ceil(getdiv));

            //}

            
        }
    //}
}
