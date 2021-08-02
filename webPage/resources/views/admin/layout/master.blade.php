<!DOCTYPE html>
<html>
@php $titleArray = explode(".", Route::currentRouteName()); @endphp
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin Rulinb | {{ end($titleArray) }}</title>

    <link href="/theme-admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="/theme-admin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <!-- Toastr style -->
    <link href="/theme-admin/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="/theme-admin/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="/theme-admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <!-- DataTable -->
    <link href="/theme-admin/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="/theme-admin/css/animate.css" rel="stylesheet">
    <link href="/theme-admin/css/style.css" rel="stylesheet">
    <link href="/css/admin/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">

    @yield('styles')

</head>

<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" width="150px" class="img-circle" src="{{ $profile->logo_url }}" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name  }}</strong>
                             </span> <span class="text-muted text-xs block">Configuración <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="{{ route('admin.infoProfile') }}">Perfil</a></li>
                            <li><a href="mailbox.html">Correo</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/admin/logout') }}">Cerrar sesión</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        R
                    </div>
                </li>
                <li @yield('vistas_active')>
                    <a href="index.html"><i class="fa fa-desktop"></i> <span class="nav-label">Vistas</span> <span class="fas fa-angle-down"></span></a>
                    <ul class="nav nav-second-level">
                        <li @yield('publication_active')><a href="{{ route('admin.Publicaciones') }}">Publicaciones</a></li>
                        <li @yield('category_active')><a href="{{ route('admin.Categorias') }}">Categorías</a></li>
                    </ul>
                </li>
                <li @yield('clients_active')>
                    <a href="{{ route('admin.Clientes') }}"><i class="fa fa-briefcase"></i> <span class="nav-label">Clientes</span></a>
                </li>
                <li @yield('devices_active')>
                    <a href="{{ route('admin.Dispositivos') }}"><i class="fa fa-microchip"></i> <span class="nav-label">Dispositivos</span>  </a>
                </li>
                <li>
                    <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">Correo </span><span class="label label-warning pull-right">16/24</span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="mailbox.html">Inbox</a></li>
                        <li><a href="mail_detail.html">Email view</a></li>
                        <li><a href="mail_compose.html">Compose email</a></li>
                        <li><a href="email_template.html">Email templates</a></li>
                    </ul>
                </li>
                <li @yield('customers_active')>
                    <a href="{{ route('admin.Usuarios') }}"><i class="fa fa-user"></i> <span class="nav-label">Usuarios</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="mailbox.html">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="profile.html">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="grid_options.html">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <div class="text-center link-block">
                                    <a href="notifications.html">
                                        <strong>See All Alerts</strong>
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>


                    <li>
                        <a href="{{ url('/admin/logout') }}">
                            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                        </a>
                    </li>
                </ul>

            </nav>
        </div>

        @yield('content')

        <div class="footer">
            <div>
                <strong>Copyright</strong> {{ $profile->name }} &copy; 2018
            </div>
        </div>

    </div>
</div>

<!-- Mainly scripts -->
<script src="/js/app.js"></script>

<script src="/theme-admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/theme-admin/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="/theme-admin/js/inspinia.js"></script>
<script src="/theme-admin/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="/theme-admin/js/plugins/jquery-ui/jquery-ui.min.js"></script>


<!-- Toastr -->
<script src="/theme-admin/js/plugins/toastr/toastr.min.js"></script>

<script src="/theme-admin/js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="/theme-admin/js/plugins/swal/swal.style.js"></script>

<!-- DataTable -->
<script src="/theme-admin/js/plugins/dataTables/datatables.min.js"></script>

<script src="{{ asset('theme-admin/js/plugins/validate/jquery.validate.min.js') }}"></script>
<script src="/js/Base.js"></script>

@yield('scripts')
</body>
</html>






