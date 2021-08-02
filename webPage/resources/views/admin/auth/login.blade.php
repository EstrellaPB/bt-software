<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inicio de Sesión publicidad Bluetooth</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Theme styles -->
    <link href="/theme-admin/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/theme-admin/css/animate.css" rel="stylesheet">
    <link href="/theme-admin/css/style.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
@php
    $profile = json_decode(Illuminate\Support\Facades\Storage::get('resources.json'))->company_info;
@endphp
<body class="gray-bg">

<div class="loginColumns animated fadeInDown">
    <div class="row">

        <div class="col-md-6">
            <img src="{{ $profile->logo_url }}" class="img-responsive" alt="Logo" style="width: 90%">

        </div>
        <div class="col-md-6">
            <div class="ibox-content">
                <h2 style="text-align: center">Inicio de sesión</h2>
                <h4 style="text-align: center">{{ $profile->name }}</h4>
                <p><br></p>
                <form action="{{route('adminLogin')}}" method="POST" role="form" class="m-t">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" type="email" name="email" class="form-control" placeholder="Correo electronico" required="" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input id="password" type="password" name="password" class="form-control" placeholder="Contraseña" required="">
                        @if ($errors->has('password'))
                         <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                         </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                    <a href="#">
                        <small>Forgot password?</small>
                    </a>
                </form>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            Copyright {{ $profile->name }} &copy; 2018
        </div>
        <div class="col-md-6 text-right">
            <small>© 2018</small>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="/js/app.js"></script>
</body>
</html>

