
<!DOCTYPE html>
<html lang="en" class="semi-dark">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="{{ asset('admin') }}/assets/images/favicon-32x32.png" type="image/png" />
        <!--plugins-->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('admin') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
        <link href="{{ asset('admin') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
        <link href="{{ asset('admin') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
        <!-- Bootstrap CSS -->
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

        <title>Admin Dashboard</title>
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
                        <a href="{{route('admin.dashboard')}}">
                            <div class="parent-icon"><i class="bi bi-house-fill"></i></div>
                            <div class="menu-title">Home</div>
                        </a>
                    </li>

                    @if(auth('admin')->user()->can('balance-top-up'))
                    <li class="{{ request()->is('add-balance') ? 'mm-active' : '' }}">
                        <a href="{{route('balance-top-up-request')}}">
                            <div class="parent-icon"><i class="bi bi-droplet-fill"></i></div>
                            <div class="menu-title">Recharge Request</div>
                        </a>
                    </li>
                    @endif

                    @if(auth('admin')->user()->can('top-up-limit-request'))
                    <li class="{{ request()->is('add-balance') ? 'mm-active' : '' }}">
                        <a href="{{route('ad-account-top-up-request')}}">
                            <div class="parent-icon"><i class="bi bi-currency-dollar"></i></div>
                            <div class="menu-title">Limit Request</div>
                        </a>
                    </li>
                    @endif


                    @if(auth('admin')->user()->can('meta-ad-accounts'))
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bi bi-grid-fill"></i></div>
                            <div class="menu-title">Meta Ad Accounts</div>
                        </a>
                        <ul>
                            <li>
                                <a href="javascript:;" class="has-arrow">
                                    <div class="parent-icon"><i class="bi bi-person-badge"></i></div>
                                    <div class="menu-title">Ad Accounts</div>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{route('ad-account-list')}}"><i class="bi bi-circle"></i>Ad Accounts List</a>
                                    </li>

                                    <li>
                                        <a href="{{route('ad-account-business-manager')}}"><i class="bi bi-circle"></i>Business Manager Id</a>
                                    </li>

                                    <!-- <li>
                                        <a href="{{route('ad-account-card-4-digit')}}"><i class="bi bi-circle"></i>Card 4 Digit</a>
                                    </li> -->

                                   <!--  <li>
                                        <a href="{{route('ad-account-daily-spending')}}"><i class="bi bi-circle"></i>Daily Spending</a>
                                    </li> -->

                                    <li>
                                        <a href="{{route('ad-account-social')}}"><i class="bi bi-circle"></i>Social</a>
                                    </li>

                                    
                                </ul>
                            </li>

                            <li>
                                <a href="{{route('create-ad-account')}}"><i class="bi bi-circle"></i>Create Ad Account</a>
                            </li>

                            <li>
                                <a href="{{route('ad-account-create-request')}}"><i class="bi bi-circle"></i>Ad Account Request</a>
                            </li>

                            @if(auth('admin')->user()->can('top-up-limit-request'))
                            <li>
                                <a href="{{route('ad-account-top-up-request')}}"><i class="bi bi-circle"></i>Limit Request</a>
                            </li>
                            @endif

                            <li>
                                <a href="{{route('ad-account-found-transfer-request')}}"><i class="bi bi-circle"></i>Fund Transfer Request</a>
                            </li>
                            
                            <li>
                                <a href="{{route('ad-account-transfer-request')}}"><i class="bi bi-circle"></i>BM share/remove Request</a>
                            </li>

                            <li>
                                <a href="{{route('ad-account-bm-link-request-view')}}"><i class="bi bi-circle"></i>BM Link Request</a>
                            </li>

                            <li>
                                <a href="{{route('ad-account-appeal-request')}}"><i class="bi bi-circle"></i>Disabled Request</a>
                            </li>
                            <li>
                                <a href="{{route('ad-account-replace-request')}}"><i class="bi bi-circle"></i>Replace Request</a>
                            </li>
                            <li>
                                <a href="{{route('ad-account-rename-request')}}"><i class="bi bi-circle"></i>Rename Request</a>
                            </li>

                            <li>
                                <a href="{{route('ad-account-try-hold-request')}}"><i class="bi bi-circle"></i>Try Hold Request</a>
                            </li>

                            <li>
                                <a href="{{route('ad-account-bill-failed-request')}}"><i class="bi bi-circle"></i>Bill Failed Request</a>
                            </li>

                            <li>
                                <a href="{{route('ad-account-refund-request-view')}}"><i class="bi bi-circle"></i>Refund Request</a>
                            </li>

                        </ul>
                    </li>
                    @endif

                    @if(auth('admin')->user()->can('meta-ad-accounts'))
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bi bi-grid-fill"></i></div>
                            <div class="menu-title">Tiktok Ad Accounts</div>
                        </a>
                        <ul>
                            <li>
                                <a href="javascript:;" class="has-arrow">
                                    <div class="parent-icon"><i class="bi bi-person-badge"></i></div>
                                    <div class="menu-title">Ad Accounts</div>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{route('tiktok-ad-account-list')}}"><i class="bi bi-circle"></i>Ad Accounts List</a>
                                    </li>

                                    <li>
                                        <a href="{{route('tiktok-ad-account-business-manager')}}"><i class="bi bi-circle"></i>Business Manager Id</a>
                                    </li>

                                    <!-- <li>
                                        <a href="{{route('ad-account-card-4-digit')}}"><i class="bi bi-circle"></i>Card 4 Digit</a>
                                    </li> -->

                                   <!--  <li>
                                        <a href="{{route('ad-account-daily-spending')}}"><i class="bi bi-circle"></i>Daily Spending</a>
                                    </li> -->

                                    <li>
                                        <a href="{{route('tiktok-ad-account-social')}}"><i class="bi bi-circle"></i>Social</a>
                                    </li>

                                    
                                </ul>
                            </li>

                            <li>
                                <a href="{{route('tiktok-create-ad-account')}}"><i class="bi bi-circle"></i>Create Ad Account</a>
                            </li>

                            <li>
                                <a href="{{route('tiktok-ad-account-create-request')}}"><i class="bi bi-circle"></i>Ad Account Request</a>
                            </li>

                            @if(auth('admin')->user()->can('top-up-limit-request'))
                            <li>
                                <a href="{{route('tiktok-ad-account-top-up-request')}}"><i class="bi bi-circle"></i>Limit Request</a>
                            </li>
                            @endif

                            <li>
                                <a href="{{route('tiktok-ad-account-found-transfer-request')}}"><i class="bi bi-circle"></i>Fund Transfer Request</a>
                            </li>
                            
                            <li>
                                <a href="{{route('tiktok-ad-account-transfer-request')}}"><i class="bi bi-circle"></i>BM share/remove Request</a>
                            </li>

                            <li>
                                <a href="{{route('tiktok-ad-account-bm-link-request-view')}}"><i class="bi bi-circle"></i>BM Link Request</a>
                            </li>

                            <li>
                                <a href="{{route('tiktok-ad-account-appeal-request')}}"><i class="bi bi-circle"></i>Disabled Request</a>
                            </li>
                            <li>
                                <a href="{{route('tiktok-ad-account-replace-request')}}"><i class="bi bi-circle"></i>Replace Request</a>
                            </li>
                            <li>
                                <a href="{{route('tiktok-ad-account-rename-request')}}"><i class="bi bi-circle"></i>Rename Request</a>
                            </li>

                            <li>
                                <a href="{{route('tiktok-ad-account-try-hold-request')}}"><i class="bi bi-circle"></i>Try Hold Request</a>
                            </li>

                            <li>
                                <a href="{{route('tiktok-ad-account-bill-failed-request')}}"><i class="bi bi-circle"></i>Bill Failed Request</a>
                            </li>

                            <li>
                                <a href="{{route('tiktok-ad-account-refund-request-view')}}"><i class="bi bi-circle"></i>Refund Request</a>
                            </li>

                        </ul>
                    </li>
                    @endif
                    


                    @if(auth('admin')->user()->can('campaign'))
                    <li class="{{ request()->is('campaign-request*') ? 'mm-active' : '' }}">
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bi bi-calendar-week"></i></div>
                            <div class="menu-title">Campaign</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('campaign-request')}}"><i class="bi bi-circle"></i>Pending Campaign</a>
                            </li>
                            <li>
                                <a href="{{route('resume-campaign-request')}}"><i class="bi bi-circle"></i>Resume Campaign</a>
                            </li>
                            <li>
                                <a href="{{route('pause-campaign-request')}}"><i class="bi bi-circle"></i>Pause Campaign</a>
                            </li>
                            <li>
                                <a href="{{route('audience.index')}}"><i class="bi bi-circle"></i>Location</a>
                            </li>

                            <li>
                                <a href="{{route('detailed-targeting.index')}}"><i class="bi bi-circle"></i>Detailed Targeting</a>
                            </li>

                            <li>
                                <a href="{{route('detailed-targeting-chiled.index')}}"><i class="bi bi-circle"></i>Detailed Targeting Child</a>
                            </li>

                            <li>
                                <a href="{{route('editor-access.index')}}"><i class="bi bi-circle"></i>Editor Access</a>
                            </li>

                        </ul>
                    </li>
                    @endif


                    @if(auth('admin')->user()->can('services'))
                    <li class="{{ request()->is('service*') ? 'mm-active' : '' }} { request()->is('service-category*') ? 'mm-active' : '' }}" >
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bi bi-basket2-fill"></i></div>
                            <div class="menu-title">Services</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('service-category.index')}}"><i class="bi bi-circle"></i>Service Category</a>
                            </li>

                            <li>
                                <a href="{{route('service.index')}}"><i class="bi bi-circle"></i>Services</a>
                            </li>
                            <li>
                                <a href="{{route('service-buy-request')}}"><i class="bi bi-circle"></i>Service Buy Request</a>
                            </li>
                            
                        </ul>
                    </li>
                    @endif


                    @if(auth('admin')->user()->can('users'))
                     <li class="{{ request()->is('users*') ? 'mm-active' : '' }}">
                        <a href="{{route('users.index')}}">
                            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
                            <div class="menu-title">Users</div>
                        </a>
                    </li>
                    @endif

                    @if(auth('admin')->user()->can('payment-method'))
                    <li class="{{ request()->is('payment-method*') ? 'mm-active' : '' }}" >
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bi bi-credit-card-fill"></i></div>
                            <div class="menu-title">Payment Method</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('payment-method-category.index')}}"><i class="bi bi-circle"></i>Payment Method Category</a>
                            </li>
                            <li>
                                <a href="{{route('payment-method.index')}}"><i class="bi bi-circle"></i>Payment Method</a>
                            </li>
                            
                        </ul>
                    </li>
                    @endif


                    @if(auth('admin')->user()->can('reports'))
                    <li class="{{ request()->is('balanace-top-up-report*') ? 'mm-active' : '' }} {{ request()->is('ad-account-balanace-top-up-report*') ? 'mm-active' : '' }} " >
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bi bi-bar-chart-steps"></i></div>
                            <div class="menu-title">Report</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('balanace-top-up-report-filter')}}"><i class="bi bi-circle"></i>Balance TopUp Report</a>
                            </li>
                            <li>
                                <a href="{{route('ad-account-balanace-top-up-report-filter')}}"><i class="bi bi-circle"></i>Ad Account Balance TopUp Report</a>
                            </li>
                            
                        </ul>
                    </li>
                    @endif

                    @if(auth('admin')->user()->can('ads'))
                    <li class="{{ request()->is('ads*') ? 'mm-active' : '' }}">
                        <a href="{{route('ads.index')}}">
                            <div class="parent-icon"><i class="bi bi-file-spreadsheet-fill"></i></div>
                            <div class="menu-title">Ads</div>
                        </a>
                    </li>
                    @endif

                    @if(auth('admin')->user()->can('ads'))
                    <li class="{{ request()->is('settings*') ? 'mm-active' : '' }} {{ request()->is('ad-account-balanace-top-up-report*') ? 'mm-active' : '' }} " >
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bi bi-gear-fill"></i></div>
                            <div class="menu-title">Settings</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{route('settings.index')}}"><i class="bi bi-circle"></i>Settings</a>
                            </li>
                            <li>
                                <a href="{{route('timeZone.index')}}"><i class="bi bi-circle"></i>TimeZone</a>
                            </li>

                            <li>
                                <a href="{{route('businessType.index')}}"><i class="bi bi-circle"></i>Business Type</a>
                            </li>
                            
                        </ul>
                    </li>

                    @endif


                    @if(auth('admin')->user()->can('guides'))
                    <li class="{{ request()->is('guide*') ? 'mm-active' : '' }}">
                        <a href="{{route('guide.index')}}">
                            <div class="parent-icon"><i class="bi bi-collection-play-fill"></i></div>
                            <div class="menu-title">Guides</div>
                        </a>
                    </li>
                    @endif


                    @if(auth('admin')->user()->can('admin'))
                    <li class="{{ request()->is('admins*') ? 'mm-active' : '' }}">
                        <a href="{{route('admins.index')}}">
                            <div class="parent-icon"><i class="bi bi-people"></i></div>
                            <div class="menu-title">Admin</div>
                        </a>
                    </li>
                    @endif


                    @if(auth('admin')->user()->can('role'))
                    <li class="{{ request()->is('role*') ? 'mm-active' : '' }}">
                        <a href="{{route('role.index')}}">
                            <div class="parent-icon"><i class="bi bi-border-style"></i></div>
                            <div class="menu-title">Role</div>
                        </a>
                    </li>
                    @endif


                    @if(auth('admin')->user()->can('support'))
                    <li class="{{ request()->is('supports*') ? 'mm-active' : '' }}">
                        <a href="{{route('supports.index')}}">
                            <div class="parent-icon"><i class="bi bi-question-lg"></i></div>
                            <div class="menu-title">Support</div>
                        </a>
                    </li>
                    @endif
               

                    <li>
                        <a href="{{route('admin.logout')}}">
                            <div class="parent-icon"><i class="bi bi-lock-fill"></i></div>
                            <div class="menu-title">Logout</div>
                        </a>
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
        <script src="{{ asset('admin') }}/assets/plugins/select2/js/select2.min.js"></script>
        <script src="{{ asset('admin') }}/assets/js/form-select2.js"></script>

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

        

     <!-- sweetalert -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
     <script type="text/javascript">
 
     $('#show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this data?`,
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


    </body>
</html>
