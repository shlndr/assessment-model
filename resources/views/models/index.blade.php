@extends('layouts.layout')
@section('content')
<style type="text/css">
.card{border-top: none;}
</style>
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet"  />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<div class="header pb-6">
  <div class="container">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-2 col-12">
          <h6 class="h2 text-black d-inline-block mb-0">RAM Dashboard</h6>
        </div>
        <div class="col-lg-2 col-12 text-right">
          <div class="form-group mb-0">
             <div class="input-group">
                <input class="form-control border" placeholder="Search" type="text" id="searchbox">
<!--                 <span class="focus-border">
                <i></i>
                </span> -->
             </div>
          </div>
          <!-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
        </div>
        <div class="col-lg-6 col-12 text-right">
          <div class="row">
            <div class="input-group col-md-6 col-12">
              <input class="form-control py-2 border" name="from_date" id="min" placeholder="From" autocomplete="off">
            </div>
            <div class="input-group col-md-6 col-12">
              <input class="form-control py-2 border" name="to_date" id="max" placeholder="To" autocomplete="off">
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-1 text-right">
          <a href="{{ url('models/add') }}" class="btn btn-primary">Create New</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container mt--6">
  <!-- Table -->
  <div class="row">
     <div class="col">
        <div class="card">
           <div class="table-responsive">
              <table class="table align-items-center table-striped" id="myTable">
                 <thead class="thead-light">
                    <tr>
                       <th scope="col">Customer Name</th>
                       <th scope="col">FAN N0</th>
                       <th scope="col">PAN No</th>
                       <th scope="col">Date</th>
                       <th scope="col">Action</th>
                    </tr>
                 </thead>
                 <tbody>
                    @foreach($data as $userDetails)
                    <tr>
                       <th scope="row">
                          <div class="media align-items-center">
                             <div class="media-body">
                                <span class="mb-0 text-sm">{{ $userDetails->CUST_NAME }}</span>
                             </div>
                          </div>
                       </th>
                       <td>
                          {{ $userDetails->FAN_NO }}
                       </td>
                       <td>
                          {{ $userDetails->PAN_NO }}
                       </td>
                       <td>
                          {{ $userDetails->RAM_TRAN_HEADER_CRT_DT }}
                       </td>
                       <td>
                          <a href="{{ url('models/edit') }}?custId={{ $userDetails->CUST_ID }} ">
                              <i class="fa fa-pencil-square"></i>
                          </a>
                          <span class="space"></span>
                          <a href="{{ url('models/downloadpdf/?pan_no='.$userDetails->PAN_NO.'&version='.$userDetails->RAM_VERSION) }}">
                              <i class="fa fa-file-pdf"></i>
                          </a>
                          <span class="space"></span>
                          <a href="{{ url('models/downloadexcel/?pan_no='.$userDetails->PAN_NO.'&version='.$userDetails->RAM_VERSION) }}">
                              <i class="fa fa-file-excel"></i>
                          </a>
                       </td>
                    </tr>
                    @endforeach
                 </tbody>
              </table>
           </div>
           <div class="card-footer py-4">
              <!-- <nav aria-label="...">
                 <ul class="pagination justify-content-end mb-0">
                   <li class="page-item disabled">
                     <a class="page-link" href="#" tabindex="-1">
                       <i class="fas fa-angle-left"></i>
                       <span class="sr-only">Previous</span>
                     </a>
                   </li>
                   <li class="page-item active">
                     <a class="page-link" href="#">1</a>
                   </li>
                   <li class="page-item">
                     <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                   </li>
                   <li class="page-item"><a class="page-link" href="#">3</a></li>
                   <li class="page-item">
                     <a class="page-link" href="#">
                       <i class="fas fa-angle-right"></i>
                       <span class="sr-only">Next</span>
                     </a>
                   </li>
                 </ul>
                 </nav> -->
           </div>
        </div>
     </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
        $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#min').datepicker("getDate");
            var max = $('#max').datepicker("getDate");
            var startDate = new Date(data[3]);
            //console.log(startDate);
            if (min == null && max == null) { return true; }
            if (min == null && startDate <= max) { return true;}
            if(max == null && startDate >= min) {return true;}
            if (startDate <= max && startDate >= min) { return true; }
            return false;
        }
        );

       
            $("#min").datepicker({dateFormat: "yy-mm-dd" , onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#max").datepicker({dateFormat: "yy-mm-dd" , onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#myTable').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#min, #max').change(function () {
                table.draw();
            });
        });
</script>
@endsection