@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="/css/login.css">
@endsection

@php
    $profile = json_decode(Storage::get('resources.json'));
@endphp

@section('content')
    <form class="login" role="form" method="POST" action="{{ route('customerRegister') }}">
        {{ csrf_field() }}
        <div class="group" style="text-align: center">
            <img src="{{ $profile->company_info->logo_url }}" class="img-responsive" width="80%" height="auto">
        </div>
        <div class="group form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <input id="name" type="text" class="login" name="name" value="{{ old('name') }}" autofocus><span class="highlight"></span><span class="bar"></span>
            <label class="login">Nombre</label>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="group form-group{{ $errors->has('name') ? ' has-error' : '' }}">
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
        <div class="group form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <input id="password-confirm" type="password" class="login" name="password_confirmation"><span class="highlight"></span><span class="bar"></span>
            <label class="login">Confirmar contraseña</label>
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
            @endif
        </div>
        <button type="submit" class="button buttonBlue">Registrarse
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
