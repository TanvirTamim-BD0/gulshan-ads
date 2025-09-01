
<!DOCTYPE html>
<html lang="en" class="semi-dark">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="{{ asset('admin') }}/assets/images/favicon-32x32.png" type="image/png" />
        <!--plugins-->
        <link href="{{ asset('admin') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
        <link href="{{ asset('admin') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
        <link href="{{ asset('admin') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
        <!-- Bootstrap CSS -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('admin') }}/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="{{ asset('admin') }}/assets/css/bootstrap-extended.css" rel="stylesheet" />
        <link href="{{ asset('admin') }}/assets/css/style.css" rel="stylesheet" />
        <link href="{{ asset('admin') }}/assets/css/icons.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

        <!-- loader-->
        <link href="{{ asset('admin') }}/assets/css/pace.min.css" rel="stylesheet" />

        <!--Theme Styles-->
        <link href="{{ asset('admin') }}/assets/css/dark-theme.css" rel="stylesheet" />
        <link href="{{ asset('admin') }}/assets/css/light-theme.css" rel="stylesheet" />
        <link href="{{ asset('admin') }}/assets/css/semi-dark.css" rel="stylesheet" />
        <link href="{{ asset('admin') }}/assets/css/header-colors.css" rel="stylesheet" />
        <link href="{{ asset('admin') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
        <link href="{{ asset('admin') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
        <link href="{{ asset('admin') }}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
        
        <title>Dashboard</title>
    </head>

    <body>
        <!--start wrapper-->
        <div class="wrapper">

            <!--start top header-->
            <header class="top-header">
                <nav class="navbar navbar-expand gap-3">
                    <div class="mobile-toggle-icon fs-3">
                        <i class="bi bi-list"></i>
                    </div>

                    <h5>{{Auth::user()->name}} ({{Auth::user()->userID}})</h5>

                    <div class="top-navbar-right ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item dropdown dropdown-user-setting">
                                
                                <h5>Balance ${{Auth::user()->balance}}</h5>
                            </li>
                        </ul>
                    </div>


                    
                </nav>
            </header>
            <!--end top header-->

             @php
                    $setting = App\Models\Ads::first();
                    @endphp
                    

            <!--start sidebar -->
            <aside class="sidebar-wrapper" data-simplebar="true">
                <div class="sidebar-header">
                    <div>
                        <img src="{{ asset('/uploads/site_logo/'.$setting->site_logo) }}" class="logo-icon" alt="logo icon" />
                    </div>
                    <div>
                        <h4 class="logo-text">{{$setting->site_name}}</h4>
                    </div>
                    <div class="toggle-icon ms-auto"><i class="bi bi-list"></i></div>
                </div>
                <!--navigation-->
                <ul class="metismenu" id="menu">

                    <li>
                        <a>
                            <div class="parent-icon"></div>
                            <h5 class="logo-text text-white">Balance ${{Auth::user()->balance}}</h5>
                        </a>
                    </li> 

                    @php
                    $dollarRate = App\Models\DollarRate::first();
                    $ads = App\Models\Ads::first();
                    @endphp

                    <li>
                        <a>
                            <div class="parent-icon"></div>
                            <h6 class="logo-text text-white">Today $ Rate {{Auth::user()->doller_rate ?? ''}}</h6>
                        </a>
                    </li> 

                    <li>
                        <a href="{{route('home')}}">
                            <div class="parent-icon"><i class="bi bi-house-fill"></i></div>
                            <div class="menu-title">Home</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('balance')}}">
                            <div class="parent-icon"><i class="bi bi-droplet-fill"></i></div>
                            <div class="menu-title">Recharge Balance</div>
                        </a>
                    </li>

                    <li class="{{ request()->is('ad-account-edit*') ? 'mm-active' : '' }}">
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bi bi-grid-fill"></i></div>
                            <div class="menu-title">Meta Ad Accounts</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('ad-account-overview')}}"><i class="bi bi-circle"></i>Overview</a>
                            </li>

                            <li>
                                <a href="{{route('ad-account-request-list')}}"><i class="bi bi-circle"></i>Account Request List</a>
                            </li>

                            <li>
                                <a href="{{route('created-account')}}"><i class="bi bi-circle"></i>Created Account</a>
                            </li>
                            <li>
                                <a href="{{route('ad-account-request')}}"><i class="bi bi-circle"></i>Account Request</a>
                            </li>
                            <li>
                                <a href="{{route('ad-account-top-up')}}"><i class="bi bi-circle"></i>Limit Request</a>
                            </li>

                            <li>
                                <a href="{{route('ad-account-found-transfer')}}"><i class="bi bi-circle"></i>Fund Transfer</a>
                            </li>

                            <li>
                                <a href="{{route('ad-account-transfer')}}"><i class="bi bi-circle"></i>BM share/remove</a>
                            </li>

                            <li>
                                <a href="{{route('ad-account-bm-link-request')}}"><i class="bi bi-circle"></i>BM Link Request</a>
                            </li>

                            <li>
                                <a href="{{route('ad-account-appeal')}}"><i class="bi bi-circle"></i>Account Disabled</a>
                            </li>
                            <li>
                                <a href="{{route('ad-account-replace')}}"><i class="bi bi-circle"></i>Account Replace</a>
                            </li>
                            <li>
                                <a href="{{route('ad-account-rename')}}"><i class="bi bi-circle"></i>Account Rename</a>
                            </li>

                            <li>
                                <a href="{{route('ad-account-try-hold')}}"><i class="bi bi-circle"></i>Try Hold Request </a>
                            </li>

                            <li>
                                <a href="{{route('ad-account-bill-failed')}}"><i class="bi bi-circle"></i>Bill Failed Request</a>
                            </li>

                            <li>
                                <a href="{{route('ad-account-refund-request')}}"><i class="bi bi-circle"></i>Refund Request</a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('ad-account-edit*') ? 'mm-active' : '' }}">
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bi bi-app"></i></div>
                            <div class="menu-title">Tiktok Ad Accounts</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('tiktok-ad-account-overview')}}"><i class="bi bi-circle"></i>Overview</a>
                            </li>

                            <li>
                                <a href="{{route('tiktok-ad-account-request-list')}}"><i class="bi bi-circle"></i>Account Request List</a>
                            </li>

                            <li>
                                <a href="{{route('tiktok-created-account')}}"><i class="bi bi-circle"></i>Created Account</a>
                            </li>
                            <li>
                                <a href="{{route('tiktok-ad-account-request')}}"><i class="bi bi-circle"></i>Account Request</a>
                            </li>
                            <li>
                                <a href="{{route('tiktok-ad-account-top-up')}}"><i class="bi bi-circle"></i>Limit Request</a>
                            </li>

                            <li>
                                <a href="{{route('tiktok-ad-account-found-transfer')}}"><i class="bi bi-circle"></i>Fund Transfer</a>
                            </li>

                            <li>
                                <a href="{{route('tiktok-ad-account-transfer')}}"><i class="bi bi-circle"></i>BM share/remove</a>
                            </li>

                            <li>
                                <a href="{{route('tiktok-ad-account-bm-link-request')}}"><i class="bi bi-circle"></i>BM Link Request</a>
                            </li>

                            <li>
                                <a href="{{route('tiktok-ad-account-appeal')}}"><i class="bi bi-circle"></i>Account Disabled</a>
                            </li>
                            <li>
                                <a href="{{route('tiktok-ad-account-replace')}}"><i class="bi bi-circle"></i>Account Replace</a>
                            </li>
                            <li>
                                <a href="{{route('tiktok-ad-account-rename')}}"><i class="bi bi-circle"></i>Account Rename</a>
                            </li>

                            <li>
                                <a href="{{route('tiktok-ad-account-try-hold')}}"><i class="bi bi-circle"></i>Try Hold Request </a>
                            </li>

                            <li>
                                <a href="{{route('tiktok-ad-account-bill-failed')}}"><i class="bi bi-circle"></i>Bill Failed Request</a>
                            </li>

                            <li>
                                <a href="{{route('tiktok-ad-account-refund-request')}}"><i class="bi bi-circle"></i>Refund Request</a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('ad-account-edit*') ? 'mm-active' : '' }}">
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bi bi-google"></i></div>
                            <div class="menu-title">Google Ad Accounts</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('google-ad-account-overview')}}"><i class="bi bi-circle"></i>Overview</a>
                            </li>

                            <li>
                                <a href="{{route('google-ad-account-request-list')}}"><i class="bi bi-circle"></i>Account Request List</a>
                            </li>

                            <li>
                                <a href="{{route('google-created-account')}}"><i class="bi bi-circle"></i>Created Account</a>
                            </li>
                            <li>
                                <a href="{{route('google-ad-account-request')}}"><i class="bi bi-circle"></i>Account Request</a>
                            </li>
                            <li>
                                <a href="{{route('google-ad-account-top-up')}}"><i class="bi bi-circle"></i>Limit Request</a>
                            </li>

                            <li>
                                <a href="{{route('google-ad-account-found-transfer')}}"><i class="bi bi-circle"></i>Fund Transfer</a>
                            </li>

                            <li>
                                <a href="{{route('google-ad-account-transfer')}}"><i class="bi bi-circle"></i>BM share/remove</a>
                            </li>

                            <li>
                                <a href="{{route('google-ad-account-bm-link-request')}}"><i class="bi bi-circle"></i>BM Link Request</a>
                            </li>

                            <li>
                                <a href="{{route('google-ad-account-appeal')}}"><i class="bi bi-circle"></i>Account Disabled</a>
                            </li>
                            <li>
                                <a href="{{route('google-ad-account-replace')}}"><i class="bi bi-circle"></i>Account Replace</a>
                            </li>
                            <li>
                                <a href="{{route('google-ad-account-rename')}}"><i class="bi bi-circle"></i>Account Rename</a>
                            </li>

                            <li>
                                <a href="{{route('google-ad-account-try-hold')}}"><i class="bi bi-circle"></i>Try Hold Request </a>
                            </li>

                            <li>
                                <a href="{{route('google-ad-account-bill-failed')}}"><i class="bi bi-circle"></i>Bill Failed Request</a>
                            </li>

                            <li>
                                <a href="{{route('google-ad-account-refund-request')}}"><i class="bi bi-circle"></i>Refund Request</a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ request()->is('create-campaign*') ? 'mm-active' : '' }}">
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bi bi-calendar-week"></i></div>
                            <div class="menu-title">Campaign</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('create-campaign')}}"><i class="bi bi-circle"></i>Create Campaign</a>
                            </li>
                            <li>
                                <a href="{{route('pending-campaign')}}"><i class="bi bi-circle"></i>Pending Campaign</a>
                            </li>
                            <li>
                                <a href="{{route('resume-campaign')}}"><i class="bi bi-circle"></i>Resume Campaign</a>
                            </li>
                            <li>
                                <a href="{{route('pause-campaign')}}"><i class="bi bi-circle"></i>Pause Campaign</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{route('guides')}}">
                            <div class="parent-icon"><i class="bi bi-collection-play-fill"></i></div>
                            <div class="menu-title">Guides</div>
                        </a>
                    </li>

                    <li class="{{ request()->is('services*') ? 'mm-active' : '' }} {{ request()->is('service-buy-report') ? 'mm-active' : '' }}">
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bi bi-basket2-fill"></i></div>
                            <div class="menu-title">Services</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('services')}}"><i class="bi bi-circle"></i>Services</a>
                            </li>

                            <li>
                                <a href="{{route('service-buy-report')}}"><i class="bi bi-circle"></i>Service Buy Report</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="{{ request()->is('balance-top-up-history') ? 'mm-active' : '' }} {{ request()->is('ad-account-top-up-history') ? 'mm-active' : '' }} {{ request()->is('transfer-history') ? 'mm-active' : '' }} {{ request()->is('appeal-history') ? 'mm-active' : '' }} {{ request()->is('replace-history') ? 'mm-active' : '' }} {{ request()->is('service-buy-history') ? 'mm-active' : '' }}">
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bi bi-stopwatch"></i></div>
                            <div class="menu-title">History</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('balance-top-up-history')}}"><i class="bi bi-circle"></i>Balance TopUp History</a>
                            </li>

                            <li>
                                <a href="{{route('ad-account-top-up-history')}}"><i class="bi bi-circle"></i>Ad Account TopUp History</a>
                            </li>

                            <li>
                                <a href="{{route('transfer-history')}}"><i class="bi bi-circle"></i>Trasnfer History</a>
                            </li>

                            <li>
                                <a href="{{route('appeal-history')}}"><i class="bi bi-circle"></i>Disabled History</a>
                            </li>

                            <li>
                                <a href="{{route('replace-history')}}"><i class="bi bi-circle"></i>Replace History</a>
                            </li>

                            <li>
                                <a href="{{route('rename-history')}}"><i class="bi bi-circle"></i>Rename History</a>
                            </li>

                            <li>
                                <a href="{{route('service-buy-history')}}"><i class="bi bi-circle"></i>Service Buy History</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li>
                        <a href="{{route('support')}}">
                            <div class="parent-icon"><i class="bi bi-question-lg"></i></div>
                            <div class="menu-title">Support</div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <div class="parent-icon"><i class="bi bi-lock-fill"></i></div>
                            <div class="menu-title">Logout</div>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </li>
                    <br>
                    <li>
                        @if(isset($ads->ads_1))
                        <a href="{{$ads->ads_link_1}}" target="_blank"><embed src="{{ asset('/uploads/ads_1/'.$ads->ads_1) }}" height="150"></a>
                        <h6 style="color: white; text-align: center;" >{{$ads->ads_text_1}}</h6>
                        @endif

                    </li>

                    <li>
                        @if(isset($ads->ads_link_2))
                        <a href="{{$ads->ads_link_2}}" target="_blank"><embed src="{{ asset('/uploads/ads_2/'.$ads->ads_2) }}" height="150"></a>
                        <h6 style="color: white; text-align: center;">{{$ads->ads_text_2}}</h6>
                        @endif
                    </li>
                </ul>
                <!--end navigation-->
            </aside>
            <!--end sidebar -->

            <!--start content-->
            <main class="page-content">
                
                @yield('content')

            </main>
            <!--end page main-->

            <!--start overlay-->
            <div class="overlay nav-toggle-icon"></div>
            <!--end overlay-->

            <!--Start Back To Top Button-->
            <a href="javaScript:;" class="back-to-top"><i class="bx bxs-up-arrow-alt"></i></a>
            <!--End Back To Top Button-->
        </div>
        <!--end wrapper-->

        <!-- Bootstrap bundle JS -->
        <script src="{{ asset('admin') }}/assets/js/bootstrap.bundle.min.js"></script>
        <!--plugins-->
        <script src="{{ asset('admin') }}/assets/js/jquery.min.js"></script>
        <script src="{{ asset('admin') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
        <script src="{{ asset('admin') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
        <script src="{{ asset('admin') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
        <script src="{{ asset('admin') }}/assets/js/pace.min.js"></script>
        <script src="{{ asset('admin') }}/assets/plugins/chartjs/js/Chart.min.js"></script>
        <script src="{{ asset('admin') }}/assets/plugins/chartjs/js/Chart.extension.js"></script>
        <script src="{{ asset('admin') }}/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
        <!-- Vector map JavaScript -->
        <script src="{{ asset('admin') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="{{ asset('admin') }}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="{{ asset('admin') }}/assets/plugins/select2/js/select2.min.js"></script>
        <script src="{{ asset('admin') }}/assets/js/form-select2.js"></script>
        <!--app-->
        <script src="{{ asset('admin') }}/assets/js/app.js"></script>
        <script src="{{ asset('admin') }}/assets/js/index.js"></script>
        <script>
            new PerfectScrollbar(".review-list");
            new PerfectScrollbar(".chat-talk");
        </script>

        <script src="{{ asset('admin') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('admin') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
        <script src="{{ asset('admin') }}/assets/js/table-datatable.js"></script>
    

        <!-- Toaster -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <script>
            @if(Session::has('message'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.success("{{ session('message') }}");
            @endif
                @if(Session::has('error'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.error("{{ session('error') }}");
            @endif
                @if(Session::has('info'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.info("{{ session('info') }}");
            @endif
                @if(Session::has('warning'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.warning("{{ session('warning') }}");
            @endif
        </script>



     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>

    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="a3b8675a-b0bd-4829-94d7-71354d7d8d6b";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>

    </body>
</html>
