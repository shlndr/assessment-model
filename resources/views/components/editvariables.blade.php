@php
$RAM_CAT_DESC = "";
$i=0;
@endphp
<div class="card-body">
@foreach($variablesNvalues as $marketData)

@php

if($RAM_CAT_DESC != $marketData['RAM_CAT_DESC'])
{
$i = $i +1;
$RAM_CAT_DESC = $marketData['RAM_CAT_DESC'];

@endphp
@foreach($scoreval as $scores)
@if($scores->RAM_CAT_DESC == $RAM_CAT_DESC)

<div class="card-category bg-transparent row">
  <h3 class="mb-0 col-md-8">{{ $RAM_CAT_DESC }}</h3>
  <span class="text-right text-black col-md-4">Score : <span class="text-black" id="score_{{ $i }}">{{ $scores->total }}</span></span>
</div>

@endif
@endforeach
@php
}else{
	
}
@endphp


<div class="row">
<div class="form-group col-md-3"> {{ $marketData['RAM_CAT_QUESTION_SHORT_DESC'] }}</div>
<div class="form-group col-md-1">
	<a class="tooldesc" data-container="body" data-toggle="popover" data-color="primary" data-placement="top" data-content="{{ $marketData['RAM_CAT_QUESTION_LONG_DESC'] }}">
	  <i class="fa fa-question-circle"></i>
	</a>
</div>
<div class="form-group col-md-8">
		@if (count($marketData['RAM_VALUE']) < 1)
		@foreach($tranDetails as $trans)
		@if($trans->RAM_TRAN_LOV_ID == null && $marketData['RAM_CAT_QUESTION_SHORT_DESC'] == $trans->RAM_CAT_QUESTION_SHORT_DESC)		
		@if($marketData['RAM_CAT_MOD_ID'] == '236c40da-9')
		@if($marketData['RAM_CAT_QUESTION_ID'] == 'df34e12e-9' )
		
		<input type="text" id="{{ $marketData['RAM_CAT_QUESTION_ID'] }}" class="form-control" maxlength="3" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="category_{{ $marketData['RAM_CAT_QUESTION_ID'] }}" value=" {{ $trans->RAM_TRAN_LOV_Weightage_ID }}" readonly>
		@else
		<input type="text" id="{{ $marketData['RAM_CAT_QUESTION_ID'] }}" class="form-control" onblur="sumfxFun('{{ $marketData['RAM_CAT_QUESTION_ID'] }}')" maxlength="3" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="category_{{ $marketData['RAM_CAT_QUESTION_ID'] }}" value=" {{ $trans->RAM_TRAN_LOV_Weightage_ID }}">
		@endif
		@else
		@if($marketData['RAM_CAT_QUESTION_ID'] == 'b257c196-9')
		<input type="text" id="{{ $marketData['RAM_CAT_QUESTION_ID'] }}" class="form-control" maxlength="3" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="category_{{ $marketData['RAM_CAT_QUESTION_ID'] }}" value=" {{ $trans->RAM_TRAN_LOV_Weightage_ID }}" readonly >
		@else
		<input type="text" id="{{ $marketData['RAM_CAT_QUESTION_ID'] }}" class="form-control" onblur="sumtxFun('{{ $marketData['RAM_CAT_QUESTION_ID'] }}')" maxlength="3" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="category_{{ $marketData['RAM_CAT_QUESTION_ID'] }}" value=" {{ $trans->RAM_TRAN_LOV_Weightage_ID }}">
		@endif
		@endif
						
		@endif
		@endforeach
		@else

		<select class="form-control" name="category_{{ $marketData['RAM_CAT_QUESTION_ID'] }}" id="category_{{ $marketData['RAM_CAT_QUESTION_ID'] }}" onchange="scoreVal('{{ $marketData['RAM_CAT_QUESTION_ID'] }}')" >
		  <option disabled selected>Select</option>	
			@foreach($marketData['RAM_VALUE'] as $data)
			@php $lovId = ''; @endphp
                @foreach($tranDetails as $trans)   
                	@if($data->RAM_LOV_ID == $trans->RAM_TRAN_LOV_ID)
                	@php $lovId = $trans->RAM_TRAN_LOV_ID; @endphp
				    <option value="{{ $data->RAM_LOV_ID }}" data-scoreId="{{ $i }}" data-lovId="{{ $data->RAM_LOV_ID }}" data-weight="{{ $data->RAM_LOV_Weightage }}" selected>{!! $data->RAM_LOV_DESC !!}</option>
				    @endif
				    @endforeach
				    @if($lovId != $data->RAM_LOV_ID)
				    <option value="{{ $data->RAM_LOV_ID }}" data-scoreId="{{ $i }}" data-lovId="{{ $data->RAM_LOV_ID }}" data-weight="{{ $data->RAM_LOV_Weightage }}">{!! $data->RAM_LOV_DESC !!}</option>
					@endif
			@endforeach
		</select>
		@endif
</div>
</div>
@endforeach

</div>

<script>
$(document).ready(function(){

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

});
</script>
<script>
$(document).ready(function(){

	var cat1 = '<?php echo $variablesNvalues[0]["RAM_CAT_MOD_ID"];?>';
	if(cat1 == '236c40da-9')
	{
	    var selectCat1 = $('#category_b91988a6-9').select2({
  sorter: function(data) {
    return data.sort(function (a, b) {
        if (a.text > b.text) {
            return 1;
        }
        if (a.text < b.text) {
            return -1;
        }
        return 0;
    });
  }
});
	    selectCat1.data('select2').$selection.css('height', '46px');

	    var selectCat2 = $('#category_b919a14a-9').select2({
  sorter: function(data) {
    return data.sort(function (a, b) {
        if (a.text > b.text) {
            return 1;
        }
        if (a.text < b.text) {
            return -1;
        }
        return 0;
    });
  }
});
	    selectCat2.data('select2').$selection.css('height', '46px');
	}
	else
	{
		var selectCat1 = $('#category_1277151d-9').select2({
  sorter: function(data) {
    return data.sort(function (a, b) {
        if (a.text > b.text) {
            return 1;
        }
        if (a.text < b.text) {
            return -1;
        }
        return 0;
    });
  }
});
	    selectCat1.data('select2').$selection.css('height', '46px');

	    var selectCat2 = $('#category_127e43ed-9').select2({
  sorter: function(data) {
    return data.sort(function (a, b) {
        if (a.text > b.text) {
            return 1;
        }
        if (a.text < b.text) {
            return -1;
        }
        return 0;
    });
  }
});
	    selectCat2.data('select2').$selection.css('height', '46px');

	}

    

  });
</script>