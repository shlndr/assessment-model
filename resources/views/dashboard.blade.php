@extends('layouts.layout')

  @section('content')
  
  <div class="main-content">
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
                <div class="row">
                    <h3 class="col-md-1 mb-0">Models</h3>
                    <div class="input-group col-md-4">
                        <input class="form-control py-2 border-right-0 border" type="search" placeholder="Type something..." id="searchbox">
                        <span class="input-group-append">
                            <button class="btn btn-outline-primary search_icon" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </span>
                    </div>
                    
                    <div class="input-group col-md-3">
                        <input class="form-control py-2 border-right-0 border" name="from_date" id="from_date" placeholder="From">
                    </div>
                    
                    <div class="input-group col-md-3">
                        <input class="form-control py-2 border-right-0 border" name="to_date" id="to_date" placeholder="To">
                    </div>
                    <span class="col-md-1">
                        <button type="button" class="btn btn-primary float-right">ADD</button>
                    </span>
                    
                </div>
              
            </div>
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
                    <tr>
                        <th scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                  <span class="mb-0 text-sm">Jon Doe</span>
                                </div>
                            </div>
                        </th>
                        <td>
                            KUOLG443HJ
                        </td>
                        <td>
                            ABCDE123
                        </td>
                        <td>
                            2018-08-28
                        </td>
                        <td>
                            <a href="#">
                                <i class="fa fa-pencil-square fa-2x"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-file-pdf fa-2x"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-file-excel fa-2x"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                  <span class="mb-0 text-sm">Jon Doe</span>
                                </div>
                            </div>
                        </th>
                        <td>
                            KUOLG443HJ
                        </td>
                        <td>
                            ABCDE123
                        </td>
                        <td>
                            2018-08-28
                        </td>
                        <td>
                            <a href="#">
                                <i class="fa fa-pencil-square fa-2x"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-file-pdf fa-2x"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-file-excel fa-2x"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                  <span class="mb-0 text-sm">Jon Doe</span>
                                </div>
                            </div>
                        </th>
                        <td>
                            KUOLG443HJ
                        </td>
                        <td>
                            ABCDE123
                        </td>
                        <td>
                            2018-08-28
                        </td>
                        <td>
                            <a href="#">
                                <i class="fa fa-pencil-square fa-2x"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-file-pdf fa-2x"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-file-excel fa-2x"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                  <span class="mb-0 text-sm">Jon Doe</span>
                                </div>
                            </div>
                        </th>
                        <td>
                            KUOLG443HJ
                        </td>
                        <td>
                            ABCDE123
                        </td>
                        <td>
                            2018-08-28
                        </td>
                        <td>
                            <a href="#">
                                <i class="fa fa-pencil-square fa-2x"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-file-pdf fa-2x"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-file-excel fa-2x"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                  <span class="mb-0 text-sm">Jon Doe</span>
                                </div>
                            </div>
                        </th>
                        <td>
                            KUOLG443HJ
                        </td>
                        <td>
                            ABCDE123
                        </td>
                        <td>
                            2018-08-28
                        </td>
                        <td>
                            <a href="#">
                                <i class="fa fa-pencil-square fa-2x"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-file-pdf fa-2x"></i>
                            </a>
                            <a href="#">
                                <i class="fa fa-file-excel fa-2x"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <nav aria-label="...">
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
              </nav>
            </div>
          </div>
        </div>
      </div>
@endsection