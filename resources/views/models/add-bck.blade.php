@extends('layouts.layout')

  @section('content')
  
  <div class="main-content">
    @include('includes.header')
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <form id="add-model" name="add-model">
            <div class="card-header border-0">
                <div class="row">
                    <h3 class="form-group col-md-12 mb-0">General</h3>
                    

                    @foreach($items as $item)
                    <div class="form-group col-md-4">
                        {{ $item->RAM_CAT_QUESTION_SHORT_DESC }}
                    </div>
                    @if($item->RAM_CAT_QUESTION_SHORT_DESC == 'PAN')
                    <div class="form-group col-md-8">
                        <input type="text" class="form-control" minlength="14" maxlength="14">
                    </div>
                    @elseif($item->RAM_CAT_QUESTION_SHORT_DESC == 'Type')
                    <div class="form-group col-md-8">
                        <select class="form-control" name="type" id="{{ $item->RAM_CAT_QUESTION_SHORT_DESC }}">
                            <option disabled selected></option>
                            @foreach($models as $model)                          
                                <option value={{$model->RAM_MOD_ID }} >{{ $model->RAM_MOD_DESC }}</option>
                            @endforeach
                        </select>
                    </div>                    
                    @elseif($item->RAM_CAT_QUESTION_SHORT_DESC == 'Company')
                    <div class="form-group col-md-8">
                        <select class="form-control" name="company" id="{{ $item->RAM_CAT_QUESTION_SHORT_DESC }}">
                            <option disabled selected></option>                                                   
                            <option value="5000">5000</option>
                            <option value="5000">8000</option>                            
                        </select>
                    </div>                    
                    @elseif($item->RAM_CAT_QUESTION_SHORT_DESC == 'Branch')
                    <div class="form-group col-md-8">
                        <select class="form-control" name="branch" id="{{ $item->RAM_CAT_QUESTION_SHORT_DESC }}">
                            <option disabled selected></option>
                            @foreach($branch as $branchData)                            
                            <option value={{ $branchData->RAM_BRANCH_ID }}> {{ $branchData->LSO_OFFICE_NAME_C }} </option>                            
                            @endforeach
                        </select>
                    </div>                   
                    @elseif($item->RAM_CAT_QUESTION_SHORT_DESC == 'Customer Segment')
                    <div class="form-group col-md-8">
                        <select class="form-control" name="custseg" id="{{ $item->RAM_CAT_QUESTION_SHORT_DESC }}">
                            <option disabled selected></option>
                            <option value="custseg1">Customer Segment 1</option>                            
                            <option value="custseg2">Customer Segment 2</option>                            
                            <option value="custseg3">Customer Segment 3</option>
                        </select>
                    </div>                    
                    @else
                    <div class="form-group col-md-8">
                        <input type="text" class="form-control">
                    </div>
                    @endif
                    @endforeach                                     
                                      
                </div>              
            </div>
            <hr class="my-4" />
            
            <h1 class="form-group col-md-12">Market Risk <span class="float-right text-black">Score : <span id="score">15</span></span></h1>
                

                <div class="card-header border-0">
                    @foreach($market as $marketData)
                  <div class="row">
                    <div class="form-group col-md-4"> {{ $marketData->RAM_CAT_QUESTION_SHORT_DESC }}</div>
                    <div class="form-group col-md-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="{{ $marketData->RAM_CAT_QUESTION_LONG_DESC }}">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="form-group col-md-7">
                          <select class="form-control" name="market" id="market">
                              <option disabled selected></option>
                            @foreach($values as $value)  
                                @if($value->RAM_LOV_QUEST_ID == $marketData->RAM_CAT_QUESTION_ID)                      
                                <option value={{ $value->RAM_LOV_QUEST_ID }} >{{ $value->RAM_LOV_DESC }}</option>
                                @endif
                            @endforeach
                          </select>
                    </div>
                  </div>
                @endforeach

                </div>
                <hr class="my-4" />

                <h1 class="form-group col-md-12">Business Risk <span class="float-right text-black">Score : <span id="score">15</span></span></h1>
                <div class="card-header border-0">
                    @foreach($business as $businessData)
                  <div class="row">
                    <div class="form-group col-md-4">
                      {{ $businessData->RAM_CAT_QUESTION_SHORT_DESC }}
                    </div>
                    <div class="form-group col-md-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="{{ $businessData->RAM_CAT_QUESTION_LONG_DESC }}">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="form-group col-md-7">
                          <select class="form-control" name="business" id="business">
                              <option disabled selected></option>
                            @foreach($values as $value)  
                                @if($value->RAM_LOV_QUEST_ID == $businessData->RAM_CAT_QUESTION_ID)                      
                                <option value={{ $value->RAM_LOV_QUEST_ID }} >{{ $value->RAM_LOV_DESC }}</option>
                                @endif
                            @endforeach
                          </select>
                    </div>
                  </div>
                  @endforeach
                </div>
                
                <hr class="my-4" />

                <h1 class="form-group col-md-12">Promotor Risk <span class="float-right text-black">Score : <span id="score">15</span></span></h1>
                

                <div class="card-header border-0">
                    @foreach($promotor as $promotorData)
                  <div class="row">
                    <div class="form-group col-md-4">
                      {{ $promotorData->RAM_CAT_QUESTION_SHORT_DESC }}
                    </div>
                    <div class="form-group col-md-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="{{ $promotorData->RAM_CAT_QUESTION_LONG_DESC }}">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="form-group col-md-7">
                          <select class="form-control" name="promotor" id="promotor">
                              <option disabled selected></option>
                            @foreach($values as $value)  
                                @if($value->RAM_LOV_QUEST_ID == $promotorData->RAM_CAT_QUESTION_ID)                      
                                <option value={{ $value->RAM_LOV_QUEST_ID }} >{{ $value->RAM_LOV_DESC }}</option>
                                @endif
                            @endforeach
                          </select>
                    </div>
                  </div>
                  @endforeach
                </div>
                
                <hr class="my-4" />



                <h1 class="form-group col-md-12">Repayment Risk <span class="float-right text-black">Score : <span id="score">15</span></span></h1>
                

                <div class="card-header border-0">
                    @foreach($repayment as $repaymentData)
                  <div class="row">
                    <div class="form-group col-md-4">
                      {{ $repaymentData->RAM_CAT_QUESTION_SHORT_DESC }}
                    </div>
                    <div class="form-group col-md-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="{{ $repaymentData->RAM_CAT_QUESTION_LONG_DESC }}">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="form-group col-md-7">                      
                          <select class="form-control" name="repayment" id="repayment">
                              <option disabled selected></option>
                            @foreach($values as $value)  
                                @if($value->RAM_LOV_QUEST_ID == $repaymentData->RAM_CAT_QUESTION_ID)                      
                                <option value={{ $value->RAM_LOV_QUEST_ID }} >{{ $value->RAM_LOV_DESC }}</option>
                                @endif
                            @endforeach
                          </select>
                    </div>
                  </div>
                  @endforeach
                </div>
                
                <hr class="my-4" />
                

                <h1 class="form-group col-md-12">Financial Risk <span class="float-right text-black">Score : <span id="score">15</span></span></h1>
                

                <div class="card-header border-0">
                    @foreach($financial as $financialData)
                  <div class="row">
                    <div class="form-group col-md-4">
                      {{ $financialData->RAM_CAT_QUESTION_SHORT_DESC }}
                    </div>
                    <div class="form-group col-md-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="{{ $financialData->RAM_CAT_QUESTION_LONG_DESC }}">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="form-group col-md-7">
                          <select class="form-control" name="financial" id="financial">
                              <option disabled selected></option>
                            @foreach($values as $value)  
                                @if($value->RAM_LOV_QUEST_ID == $financialData->RAM_CAT_QUESTION_ID)                      
                                <option value={{ $value->RAM_LOV_QUEST_ID }} >{{ $value->RAM_LOV_DESC }}</option>
                                @endif
                            @endforeach
                          </select>
                    </div>
                  </div>
                  @endforeach
                </div>
                
                <hr class="my-4" />
            
                

                <h1 class="form-group col-md-12">Asset Risk <span class="float-right text-black">Score : <span id="score">15</span></span></h1>
                

                <div class="card-header border-0">
                    @foreach($asset as $assetData)
                  <div class="row">
                    <div class="form-group col-md-4">
                      {{ $assetData->RAM_CAT_QUESTION_SHORT_DESC }}
                    </div>
                    <div class="form-group col-md-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="{{ $assetData->RAM_CAT_QUESTION_LONG_DESC }}">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="form-group col-md-7">
                          <select class="form-control" name="asset" id="asset">
                              <option disabled selected></option>
                            @foreach($values as $value)  
                                @if($value->RAM_LOV_QUEST_ID == $assetData->RAM_CAT_QUESTION_ID)                      
                                <option value={{ $value->RAM_LOV_QUEST_ID }} >{{ $value->RAM_LOV_DESC }}</option>
                                @endif
                            @endforeach
                          </select>
                    </div>
                  </div>
                  @endforeach
                </div>
                
                <hr class="my-4" />
            

            <h1 class="form-group col-md-12">Profile Risk <span class="float-right text-black">Score : <span id="score">15</span></span></h1>
                

                <div class="card-header border-0">
                    @foreach($profilerisk as $profileData)
                  <div class="row">
                    <div class="form-group col-md-4">
                      {{ $profileData->RAM_CAT_QUESTION_SHORT_DESC }}
                    </div>
                    <div class="form-group col-md-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="{{ $profileData->RAM_CAT_QUESTION_LONG_DESC }}">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="form-group col-md-7">
                          <select class="form-control" name="profile" id="profile">
                              <option disabled selected></option>
                            @foreach($values as $value)  
                                @if($value->RAM_LOV_QUEST_ID == $profileData->RAM_CAT_QUESTION_ID)                      
                                <option value={{ $value->RAM_LOV_QUEST_ID }} >{{ $value->RAM_LOV_DESC }}</option>
                                @endif
                            @endforeach
                          </select>
                    </div>
                  </div>
                  @endforeach
                </div>
                
                <hr class="my-4" />

                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col text-center">
                        <button type="button" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      <script src="{{ url('/js/custom.js') }}"></script>
@endsection