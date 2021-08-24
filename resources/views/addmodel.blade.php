@extends('layouts.layout')

  @section('content')
  <div class="main-content">
    <!-- Navbar -->
    @include('includes.header')
    <!-- End Navbar -->
    <div class="container-fluid mt--7" id="form_section">
      <!-- Table -->
      <div class="row">
        <div class="col">
           <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h1 class="mb-0 display-4">Add Model</h1>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h1 class="display-4 mb-4">General</h1>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Customer Name</label>
                        <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="Username" value="lucky.jesse">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">File Application No (FAN No)</label>
                        <input type="email" id="input-email" class="form-control form-control-alternative" placeholder="jesse@example.com">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">PAN</label>
                        <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="First name" value="Lucky">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Type</label>
                        <select class="form-control" name="type">
                            <option>Financial Based</option>
                            <option>Non Financial Based</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h1 class="display-4 mb-4">Material Risk <span class="float-right text-black">Score : 15</span></h1>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Industry Outlook - Micro level</label>
                      </div>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="Industry Outlook - Micro level">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                          <select class="form-control" name="ans">
                              <option>Power</option>
                              <option>Non Power</option>
                          </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Industry Outlook - TMF Research</label>
                      </div>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="Industry Outlook - TMF Research">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                          <select class="form-control" name="ans">
                              <option>Pharma</option>
                              <option>Non Pharma</option>
                          </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Application Usage</label>
                      </div>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="Application Usage">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                          <input type="text" class="form-control" name="ans" value="Same Application">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Association With various Principals</label>
                      </div>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="Association With various Principals">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                            <input type="text" class="form-control" name="ans" value="1">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">No of Industry Customer Is Associated</label>
                      </div>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="No of Industry Customer Is Associated">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                          <select class="form-control" name="ans">
                              <option>Not Applicable</option>
                              <option>Applicable</option>
                          </select>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                
                <h1 class="display-4 mb-4">Business Risk <span class="float-right text-black">Score : 15</span></h1>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Experience in Business</label>
                      </div>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="Experience in Business">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                          <input type="text" class="form-control" name="ans" value="17 Years">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">New work order Availability</label>
                      </div>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="New work order Availability">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                          <select class="form-control" name="ans">
                              <option>Verbal Contract</option>
                              <option>Normal contract</option>
                          </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Period of Association (vintage)</label>
                      </div>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="Period of Association (vintage)">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                          <input type="text" class="form-control" name="ans" value="8 Years">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                
                <h1 class="display-4 mb-4">Promotor Risk <span class="float-right text-black">Score : 15</span></h1>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Personal Guarantee</label>
                      </div>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="Personal Guarantee">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                          <select class="form-control" name="ans">
                              <option>Pesonal guarantee of key person</option>
                              <option>Pesonal guarantee of Non key person</option>
                          </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Personal Net Worth Of Certified By CA</label>
                      </div>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="Personal Net Worth Of Certified By CA">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                          <input type="text" class="form-control" name="ans" value="7 Times">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Promotor Invetsment in the Business</label>
                      </div>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="Promotor Invetsment in the Business">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                          <input type="text" class="form-control" name="ans" value="60%">
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Succession Plan</label>
                      </div>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="Succession Plan">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                          <select class="form-control" name="ans">
                              <option>Blood Relative</option>
                              <option>Non Relative</option>
                          </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">Constitution Of Business</label>
                      </div>
                    </div>
                    <div class="col-lg-1">
                        <button type="button" class="btn btn-secondary tootltip_btn" data-toggle="tooltip" data-placement="top" title="Constitution Of Business">
                            <i class="fa fa-question"></i>
                        </button>
                    </div>
                    <div class="col-lg-7">
                      <div class="form-group">
                          <select class="form-control" name="ans">
                              <option>Individual</option>
                              <option>Group</option>
                          </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label" for="input-city">Rationale</label>
                            </div>
                        </div>
                        <div class="offset-lg-1 col-lg-7">
                            <div class="form-group">
                                <textarea  class="form-control form-control-alternative" placeholder="A few words about you ...">
                                    The feedback should be sent to mail id shashank.saurabh@tmf.co.in
                                </textarea>
                            </div>
                        </div>
                    </div>
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
      </div>
      @endsection 