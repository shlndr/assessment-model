@extends('layouts.layout')
@section('content')
<style type="text/css">
.sticky {
  position: fixed;
  top: 0;
  width: 82.3%;
}
.sticky + .content {
  padding-top: 102px;
}
.headers {
  padding: 10px 16px;
  background: #555;
  color: #f1f1f1;
  z-index: 999;
   margin-right: 120px;
    margin-left: 120px !important;
}
.stck{
   margin-right: 140px;
   color: #fff;
}
b{
   color:#fff;
}
</style>
<div class="header">
  <div class="container">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-6">
          <h6 class="h2 text-black d-inline-block mb-0">Fresh Scoring</h6>
        </div>
        <div class="col-lg-6 col-6 text-right">
          <a href="{{ url('models') }}" class="btn btn-outline-primary">Back to Dashboard</a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="headers" id="myHeader">
  <h2><b>Customer Name: </b><span class="stck" id="custname"> </span><b>Pan No: </b><span class="stck" id="panno"></span><b>Total Risk Score: </b><span class="stck" id="total-score"></span></h2>
</div>
<div class="container mt-2">
   <!-- Table -->
   <div class="row">
      <div class="col">

         <div class="card">
            <form id="add-model" name="add-model" action="{{ url('models/save') }}" method="post">
               {{ csrf_field() }}
               <div class="card-header bg-transparent">
                 <h3 class="mb-0">Customer Information</h3>
               </div>
               <div class="card-body border-0">
                  <div class="row">
                     @foreach($items as $item)
                     <div class="form-group col-md-4">
                        {{ $item->RAM_CAT_QUESTION_SHORT_DESC }}<span style="color:#f00;"> *</span>
                     </div>
                     @if($item->RAM_CAT_QUESTION_SHORT_DESC == 'PAN')
                     <div class="form-group col-md-8">
                        <input type="text" class="form-control" id="textPanNo" name="pan_no" minlength="10" maxlength="10" onkeypress="stickFunct('panNo')" onblur="ValidatePAN(this);">
                     </div>
                     @elseif($item->RAM_CAT_QUESTION_SHORT_DESC == 'Type')
                     <div class="form-group col-md-8">
                        <select class="form-control required" name="type" id="type" onchange="typeVal()" title="This is required field">
                           <option disabled selected>Select Type</option>
                           @foreach($models as $model)                          
                           <option value={{$model->RAM_MOD_ID }} >{{ $model->RAM_MOD_DESC }}</option>
                           @endforeach
                        </select>
                     </div>
                     @elseif($item->RAM_CAT_QUESTION_SHORT_DESC == 'Company')
                     <div class="form-group col-md-8">
                        <select class="form-control required" title="This is required field" name="company" id="{{ $item->RAM_CAT_QUESTION_SHORT_DESC }}">
                           <option disabled selected>Select Company</option>
                           <option value="5000">5000</option>
                           <option value="8000">8000</option>
                        </select>
                     </div>
                     @elseif($item->RAM_CAT_QUESTION_SHORT_DESC == 'Branch')
                     <div class="form-group col-md-8">
                        <select class="form-control required" title="This is required field" name="branch" id="{{ $item->RAM_CAT_QUESTION_SHORT_DESC }}">
                           <option disabled selected>Select Branch</option>
                           @foreach($branch as $branchData)                            
                           <option value={{ $branchData->RAM_BRANCH_ID }}> {{ $branchData->LSO_OFFICE_NAME_C }} </option>
                           @endforeach
                        </select>
                     </div>
                     @elseif($item->RAM_CAT_QUESTION_SHORT_DESC == 'Customer Segment')
                     <div class="form-group col-md-8">
                        <select class="form-control required" title="This is required field" name="custseg" id="{{ $item->RAM_CAT_QUESTION_SHORT_DESC }}">
                           <option disabled selected>Select Customer Segment</option>
                           @foreach($segment as $segmentData)
                           <option value="{{ $segmentData->name }}">{{ $segmentData->name }}</option>
                           @endforeach
                        </select>
                     </div>
                     @elseif($item->RAM_CAT_QUESTION_SHORT_DESC == 'Customer Name')
                     <div class="form-group col-md-8">
                        <input type="text" class="form-control" id="cust_name" name="cust_name" onkeypress="stickFunct('custName')">
                     </div>
                     @else
                     <div class="form-group col-md-8">
                        <input type="text" class="form-control" name="fan_no">
                     </div>
                     @endif
                     @endforeach                                     
                  </div>
               </div>
               <div id="variables"></div>
         </div>
         <div class="pl-lg-4">
         <div class="row">
         <div class="col text-center">
         <button type="submit" class="btn btn-primary">Submit</button>
         </div>
         </div>
         </div>
         </form>
      </div>
   </div>
</div>
<script>
   document.getElementById('myHeader').style.display = 'none';

window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
   document.getElementById('myHeader').style.display = 'block';
    header.classList.add("sticky");
  } else {
   document.getElementById('myHeader').style.display = 'none';

    header.classList.remove("sticky");
  }
}
</script>
@endsection
@section('scriptsrc')
<script src="{{ asset('/js/validate.js') }}"></script>
<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>  
<script src="{{ asset('/js/additional-methods.min.js') }}"></script> 
<script src="{{ asset('/js/custom.js') }}"></script>

@endsection
@section('scripts')
@endsection