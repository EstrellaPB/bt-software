@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="/css/login.css">
@endsection

@php
    $profile = json_decode(Storage::get('resources.json'));
@endphp

@section('content')
    <!--<div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="text-align: center">
                <img src="/img/under-construction.png" class="img-responsive" style="width: 50%;">
            </div>
        </div>
    </div>-->
    <form action="{{route('log')}}" method="POST" role="form" class="login">
    	{{ csrf_field() }}
        <div class="group" style="text-align: center">
            <img src="{{ $profile->company_info->logo_url }}" class="img-responsive" width="80%" height="auto">
        </div>
    	<div class="group form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input id="email" type="email" class="login" name="email" value="{{ old('email') }}"><span class="highlight"></span><span class="bar"></span>
            <label class="login">Email</label>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="group form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" class="login" name="password"><span class="highlight"></span><span class="bar"></span>
            <label class="login">Contraseña</label>
            @if ($errors->has('password'))
                <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
            @endif
        </div>

    	<div class="form-group">
    		<div class="checkbox">
    			<label>
    				<input type="checkbox" name="remember" value="{{ old('remember') ? 'checked' : '' }}">
    				Recordarme
    			</label>
    		</div>
    	</div>
    
    	<button type="submit" class="button buttonBlue">Iniciar sesión
            <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
        </button>
    </form>
@endsection

@section('scripts')
    <script>
        $(window, document, undefined).ready(function() {
            $('input').blur(function() {
                var $this = $(this);
                if ($this.val())
                    $this.addClass('used');
                else
                    $this.removeClass('used');
            });

            var $ripples = $('.ripples');

            $ripples.on('click.Ripples', function(e) {

                var $this = $(this);
                var $offset = $this.parent().offset();
                var $circle = $this.find('.ripplesCircle');

                var x = e.pageX - $offset.left;
                var y = e.pageY - $offset.top;

                $circle.css({
                    top: y + 'px',
                    left: x + 'px'
                });

                $this.addClass('is-active');

            });

            $ripples.on('animationend webkitAnimationEnd mozAnimationEnd oanimationend MSAnimationEnd', function(e) {
                $(this).removeClass('is-active');
            });

        });
    </script>
@endsection