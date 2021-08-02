<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Publicidad Bluetooth - {{ Route::currentRouteName() }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.3/css/mdb.min.css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/DataTables-1.10.16/css/dataTables.bootstrap4.css') }}">
    <link href="/theme-admin/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <style>
        .inner-addon {
            position: relative;
        }
        .inner-addon .glyphicon {
            position: absolute;
            padding: 10px;
            pointer-events: none;
        }
    </style>
@yield('styles')

</head>

<body>
<header>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light custom-blue">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="#"><img src="{{ $profile->logo_url }}" height="60px" class="img-responsive"></a>
        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item @yield('active_index')">
                    <a class="nav-link" href="{{ route('Inicio') }}">Inicio</a>
                </li>
                <li class="nav-item {{-- {{ (request()->is('categories') ? 'active' : '' ) }} --}} @yield('active_categories')">
                    <a class="nav-link" href="{{ route('Categorias') }}">Categorías</a>
                </li>
                <li class="nav-item @yield('active_proms')">
                    <a class="nav-link" href="{{ route('Promociones') }}">Promociones</a>
                </li>
            </ul>
            <!-- Links -->

            <!-- Search form -->
            <form class="form-inline" action="/search" method="get">
                <div class="inner-addon left-addon" data-toggle="tooltip" title="Presione enter para iniciar búsqueda">
                    <i class="fas fa-search"></i>
                    <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Search" name="searchText">
                </div>
            </form>
            @if(Auth::guard('customer')->guest())
            <button onclick="window.location.href='{{ url('/customer/login') }}'" type="button" class="btn btn-primary custom-blue-dark">Iniciar Sesion</button>
            <button onclick="window.location.href='{{ url('/customer/register') }}'" type="button" class="btn btn-primary custom-blue-dark">Registrarse</button>
            @else
            <button onclick="window.location.href='{{ url('/customer/logout') }}'" type="button" class="btn btn-primary custom-blue-dark">Cerrar Sesion</button>
            <button onclick="window.location.href='{{ url('/coupons') }}'" type="button" class="btn btn-primary custom-blue-dark">Mis cupones</button>
            @endif
        </div>
        <!-- Collapsible content -->

    </nav>
    <!--/.Navbar-->
</header>

@yield('content')

<!--Footer-->
<footer class="page-footer custom-blue center-on-small-only" style="color:black !important;">
    <!--Footer Links-->
    <div class="container-fluid">
        <div class="row">
            <!--First column-->
            <div class="col-md-6">
                <h5 class="title"><strong>{{ $profile->name  }}</strong></h5>
                <p>{{ $profile->slogan  }}</p>
            </div>
            <!--/.First column-->
            <!--Second column-->
            <div class="col-md-6">
                <h5 class="title"><strong>Mapa de sitio</strong></h5>
                <ul>
                    <li><a href="{{ route('Inicio') }}" style="color:black !important;">Inicio</a></li>
                    <li><a href="{{ route('Categorias') }}" style="color:black !important;">Categoria</a></li>
                    <li><a href="{{ route('Inicio') }}" style="color:black !important;">Promociones</a></li>
                </ul>
            </div>
            <!--/.Second column-->
        </div>
    </div>
    <!--/.Footer Links-->
    <!--Copyright-->
    <div class="footer-copyright custom-blue-dark">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"> © 2015 Copyright: Empresa Publicidad </div>
                <div class="col-md-9 right"><a href="https://studioav.com.mx" style="color:rgba(255,255,255,.6);"> Content by <i>Studio AV</i> </a></div>
            </div>
        </div>
    </div>
    <!--/.Copyright-->
</footer>
<!--/.Footer-->

<!-- Scripts -->
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
{{-- <script type="text/javascript" src="{{asset('js/dataTables.min.js')}}"></script>  --}}
<script type="text/javascript" src="/js/popper.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script type="text/javascript" src="/js/mdb.min.js"></script>
<script type="text/javascript" src="/js/Base.js"></script>
<script src="{{ asset('plugins/DataTables/DataTables-1.10.16/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/DataTables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="/theme-admin/js/plugins/toastr/toastr.min.js"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@yield('scripts')
</body>
</html>