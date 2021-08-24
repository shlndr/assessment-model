<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Models</title>
      <!-- Favicon -->
      <!-- <link href="https://demos.creative-tim.com/assets/img/brand/favicon.png" rel="icon" type="image/png"> -->
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
      <!-- Icons -->
      <!-- <link href="https://demos.creative-tim.com/argon-dashboard/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet" /> -->
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://demos.creative-tim.com/argon-dashboard/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
      <!-- CSS Files -->
      <link href="{{ asset('css/argon.css') }}" rel="stylesheet" />
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
      <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />
      <style>
         label{color:red !important;}
         .dataTables_filter{display: none;}
         .dataTables_length{display: none;}
         .dataTables_paginate{display: none;}
         .dataTables_info{display: none;}
         .search_icon{
         background: #6C757D;
         color: white;
         border: none;
         }
         #myTable td i:hover {color: #000000;}
         #myTable td i {color: #717273;font-size: 20px;}
         #myTable td .space {margin-right:12px;}
         #myTable{border-bottom: none;}
         #fromboxbtn{
         border:1px solid;
         border-right: 0px;
         color: black;
         }
         #score{display: inline;}
         .card-category{    padding: 16px 0;
    border-top: 1px solid rgba(199, 199, 199, 0.6);
    border-bottom: 1px solid rgba(199, 199, 199, 0.6);
    margin-bottom: 30px;}
    .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle {
        color: #fff;
        border-color: #595959;
        background-color: #595959;
    }
    /*.navbar-search .input-group{border: 1px solid #adb5bd;}*/
    .card {
        margin-bottom: 30px;
/*        border: none;
        border-left: 1px solid #9f9f9f;
        border-right: 1px solid #9f9f9f;
        border-bottom: 1px solid #9f9f9f;
        border-top: 1px solid #9f9f9f;*/
        border: 1px solid #d9d8d8;
        box-shadow: none;
    }
    .fa-pencil-square{color: #1968b3c9!important;}
    .fa-pencil-square:hover{color: #1968b3!important;}
    .fa-file-excel{color: #008000c9!important;}
    .fa-file-excel:hover{color: green!important;}
    .fa-file-pdf{color: #ff0000c9!important;}
    .fa-file-pdf:hover{color: red!important;}
    .fa-question-circle{color: #04c;}
    canvas {
      -moz-user-select: none;
      -webkit-user-select: none;
      -ms-user-select: none;
    }
    /* Tooltip container */
    .tooldesc {
      position: relative;
      display: inline-block;
    }

    /* Tooltip text */
    .tooldesc .tooltiptext {
      visibility: hidden;
      width: 200px;
      font-size: 11px;
      background-color: black;
      color: #fff;
      text-align: center;
      padding: 5px 0;
      border-radius: 6px;
     
      /* Position the tooltip text - see examples below! */
      position: absolute;
      z-index: 1;
        bottom: 100%;
        left: 50%;
        margin-left: -100px; /* Use half of the width (120/2 = 60), to center the tooltip */
    }

    /* Show the tooltip text when you mouse over the tooltip container */
    .tooldesc:hover .tooltiptext {
      visibility: visible;
    }
    .tooldesc .tooltiptext::after {
      content: " ";
      position: absolute;
      top: 100%; /* At the bottom of the tooltip */
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: black transparent transparent transparent;
    }
      </style>
      @yield('styles')
      <!--   Core   -->
      <!-- <script src="https://demos.creative-tim.com/argon-dashboard/assets/vendor/jquery/dist/jquery.min.js"></script> -->
      <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
      <!-- <script src="https://demos.creative-tim.com/argon-dashboard/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
      <!--   Optional JS   -->
      <!--   Argon JS   -->
      <!-- <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script> -->
      <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
      <script src=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
      <!-- <script src="{{ asset('js/js.cookie.js') }}"></script> -->
      <!-- <script src="{{ asset('js/argon.js') }}"></script> -->
      <!-- Optional JS -->
      <!-- <script src="{{ asset('js/Chart.min.js') }}"></script> -->
      <!-- <script src="{{ asset('js/Chart.extension.js') }}"></script> -->
      <script src="{{ asset('js/select2.full.min.js') }}"></script>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script src="{{ asset('js/utils.js') }}"></script>
      <script src="{{ asset('js/barchart.js') }}"></script>
      @yield('scriptsrc')
   </head>
   <body class="">
      <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
           <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                 <a class="brand" href="">
                      <img src="{{ asset('img/brand/white.png') }}" class="navbar-brand-img" alt="...">
                 </a>
                 <!-- Navbar links -->
                 <ul class="navbar-nav align-items-center  ml-md-auto ">
                    <li class="nav-item d-xl-none">
                       <!-- Sidenav toggler -->
<!--                        <div class="pr-3 sidenav-toggler sidenav-toggler-dark active" data-action="sidenav-pin" data-target="#sidenav-main">
                          <div class="sidenav-toggler-inner">
                             <i class="sidenav-toggler-line"></i>
                             <i class="sidenav-toggler-line"></i>
                             <i class="sidenav-toggler-line"></i>
                          </div>
                       </div> -->
                    </li>
                    <li class="nav-item d-sm-none">
                       <!-- <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                       <i class="ni ni-zoom-split-in"></i>
                       </a> -->
                    </li>
                 </ul>
                 <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                    <li class="nav-item">
                          <div class="media align-items-center">
                             <div class="media-body  ml-2  d-none d-lg-block">
                                <h1 class="display-4 font-weight-bold text-white">Risk Assessment Model</h1>
                             </div>
                          </div>
                    </li>
                 </ul>
              </div>
           </div>
        </nav>
        <!-- Header -->
        @yield('content')
      <!-- Footer -->
      <div class="container-fluid mt-4">
        <footer class="footer pt-0">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6">
<!--               <div class="copyright text-center  text-lg-left  text-muted">
                ©
              </div> -->
            </div>
          </div>
        </footer>
      </div>
      </div>
      @yield('scripts')
      <script>
           var APP_URL = {!! json_encode(url('/')) !!}
           $(document).ready( function ()
           {
               $('#from_date').datepicker();
               $('#to_date').datepicker();
               
               var dataTable = $('#myTable').DataTable();
               
               $("#searchbox").on("keyup search input paste cut", function() {
                   dataTable.search(this.value).draw();
                });
                
                $('[data-toggle="tooltip"]').tooltip()
         
         
           });
           
           // SearchControl = function () {
           //    var a = $("#searchbox");
           //    a.length && a.on("focus blur", function (a) {
           //      $(this).parents(".form-group").toggleClass("focused", "focus" === a.type)
           //    }).trigger("blur")
           //  }();

          // Popover = function () {
          //   var b = $('[data-toggle="popover"]'),
          //     e = "";
          //   b.length && b.each(function () {  
          //     ! function (a) {
          //       b.data("color") && (e = "popover-" + b.data("color"));
          //       var n = {
          //         trigger: "focus",
          //         template: '<div class="popover ' + e + '" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
          //       };
          //       b.popover(n)
          //     }($(this))
          //   })
          // }();

           $("#searchbox").keyup(function() {
              dataTable.fnFilter(this.value);
           });



      </script>
   </body>
</html>