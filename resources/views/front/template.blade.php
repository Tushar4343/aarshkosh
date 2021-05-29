<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vaidik Yoddha | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link href="{{ asset('front') }}/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <link href="{{ asset('front') }}/css/mdb.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
    <link rel="stylesheet" href="{{ asset('front') }}/plugins/fontawesome-free/css/all.min.css">
    <script src="{{ asset('front') }}/plugins/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/css/adminlte.css">
  
    <link rel="stylesheet" href="{{ asset('front') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/plugins/select2-bootstrap4/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/plugins/summernote/summernote-bs4.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('styles')

    <style>
           /* width */
::-webkit-scrollbar {
    width: 0.5rem;
    height: 0.5rem;
}

/* Track */
::-webkit-scrollbar-track {
    background-color: transparent;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background-color: #a9a9a9;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background-color: transparent;
}         
          

    </style>
</head>

<body class="">
            <nav class="navbar  navbar-expand-lg navbar-dark bg-orange sticky-top shadow-5-strong 
                                  ">
                <div class="container-fluid">
                    <a class="navbar-brand " href="{{ url('/') }}"><h5 class="text-light fw-bold "> वैदिक योद्धा</h5></a>
                    <button class="navbar-toggler btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">  
                      
                            <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link text-dark  fw-bold"> Home</a>
                           </li>
                           
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-sm btn-dark" type="submit">Search</button>
                    </form>
                        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto ">
                            @if (!Auth::guest())
                            <li class="nav-item dropdown">
                                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" class="nav-link text-dark fw-bold dropdown-toggle">Logged In</a>
                                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                    @can('aboutu_access')
                                    <li><a href="{{ route("admin.home") }}" class="dropdown-item">Dashboard</a></li>
                                    @endcan
                                    <li><a href="{{ url('/profile') }}" class="dropdown-item">Profile</a></li> 
                                    <li><a href="{{ url('/logout') }}" onclick="event.preventDefault(); 
                                    document.getElementById('logoutform').submit();" class="dropdown-item">Logout</a></li>
                                </ul>
                            </li>
                            @else
                            <li class="nav-item dropdown">
                                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" class="nav-link dropdown-toggle text-dark fw-bold">Account</a>
                                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                    <li><a href="{{ url('/login') }}" class="dropdown-item">Login</a></li>
                                    <li><a href="{{ url('/register') }}" class="dropdown-item">Register</a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                </nav>
            <!-- Navbar -->
  


    <div class="container-fluid mx-0 px-0 my-0 py-0 mr-0">

     



        <div class="content">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <!--Footer-->
        <footer class="container-fluid bg-light text-lg-start ">
            <div class="py-4 text-center">
                
            </div>

            <hr class="m-0" />

            <div class="text-center py-4 align-items-center">
                <p>Follow Vaidic Yoddha on social media</p>
                <a href="3" class="btn btn-primary m-1"
                    role="button" rel="nofollow" target="_blank">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="https://www.facebook.com/vaidicyoddha" class="btn btn-primary m-1" role="button" rel="nofollow"
                    target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/vaidicyoddha" class="btn btn-primary m-1" role="button" rel="nofollow"
                    target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://instagram.com/vaidicyoddha" class="btn btn-primary m-1" role="button"
                    rel="nofollow" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2021 Copyright:
                <a class="text-dark" href="https://vaidicyoddha.in/">vaidicyoddha.in</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!--Footer-->
         <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="{{ asset('front') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('front') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('front') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('front') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('front') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('front') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="{{ asset('front') }}/js/adminlte.min.js"></script>
    <script src="{{ asset('front') }}/js/admin_custom.js"></script>
    @yield('scripts')
   
</body>

</html>
