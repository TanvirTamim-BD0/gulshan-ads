
<!doctype html>
<html lang="en" class="semi-dark">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('admin') }}/assets/images/favicon-32x32.png" type="image/png" />
  <!-- Bootstrap CSS -->
  <link href="{{ asset('admin') }}/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{ asset('admin') }}/assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="{{ asset('admin') }}/assets/css/style.css" rel="stylesheet" />
  <link href="{{ asset('admin') }}/assets/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- loader-->
    <link href="{{ asset('admin') }}/assets/css/pace.min.css" rel="stylesheet" />

  <title>Admin Login</title>
</head>

<body class="bg-surface">

  <!--start wrapper-->
  <div class="wrapper">
       <!--start content-->
       <main class="authentication-content">
        <br><br><br>
        <div class="container">
          <div class="mt-4">
            <div class="card rounded-0 overflow-hidden shadow-none border mb-5 mb-lg-0">
              <div class="row g-0">
                <div class="col-12 order-1 col-xl-8 d-flex align-items-center justify-content-center border-end">
                  <img src="{{ asset('admin') }}/assets/images/error/auth-img-7.png" class="img-fluid" alt="">
                </div>
                <div class="col-12 col-xl-4 order-xl-2">
                  <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title">Admin Sign In</h5>
                    <p class="card-text mb-4">See your growth and get consulting support!</p>
                     <form class="card-body" method="POST" action="{{ route('admin.login') }}">
                        @csrf
                      
                        <div class="row g-3">
                          <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                              <input type="email" name="email" class="form-control radius-30 ps-5 @error('email') is-invalid @enderror " id="inputEmailAddress" placeholder="Email" value="{{ old('email') }}" required >
                            </div>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                          <div class="col-12">
                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                              <input type="password" name="password" class="form-control radius-30 ps-5 @error('password') is-invalid @enderror " id="inputChoosePassword" placeholder="Password">
                            </div>

                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                            @enderror
                          </div>

                          <div class="col-6">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                              <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                            </div>
                          </div>
               
                          <div class="col-12">
                            <div class="d-grid">
                              <button type="submit" class="btn btn-primary radius-30">Sign In</button>
                            </div>
                          </div>
                         
                         
                        </div>
                    </form>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       </main>
        
       <!--end page main-->

  </div>
  <!--end wrapper-->


  <!-- Bootstrap bundle JS -->
  <script src="{{ asset('admin') }}/assets/js/bootstrap.bundle.min.js"></script>

  <!--plugins-->
  <script src="{{ asset('admin') }}/assets/js/jquery.min.js"></script>
  <script src="{{ asset('admin') }}/assets/js/pace.min.js"></script>


</body>

</html>