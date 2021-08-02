@extends('layouts.master')

@section('styles')
    <style>
        .loader{
            display: none;
            vertical-align: middle;
        }
        .sk-circle {
            width: 30px;
            height: 30px;
            position: relative;
            display: inline-flex;
        }
        .sk-circle .sk-child {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
        }
        .sk-circle .sk-child:before {
            content: '';
            display: block;
            margin: 0 auto;
            width: 15%;
            height: 15%;
            background-color: #2BBBAD;
            border-radius: 100%;
            -webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
            animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
        }
        .sk-circle .sk-circle2 {
            -webkit-transform: rotate(30deg);
            -ms-transform: rotate(30deg);
            transform: rotate(30deg); }
        .sk-circle .sk-circle3 {
            -webkit-transform: rotate(60deg);
            -ms-transform: rotate(60deg);
            transform: rotate(60deg); }
        .sk-circle .sk-circle4 {
            -webkit-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            transform: rotate(90deg); }
        .sk-circle .sk-circle5 {
            -webkit-transform: rotate(120deg);
            -ms-transform: rotate(120deg);
            transform: rotate(120deg); }
        .sk-circle .sk-circle6 {
            -webkit-transform: rotate(150deg);
            -ms-transform: rotate(150deg);
            transform: rotate(150deg); }
        .sk-circle .sk-circle7 {
            -webkit-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            transform: rotate(180deg); }
        .sk-circle .sk-circle8 {
            -webkit-transform: rotate(210deg);
            -ms-transform: rotate(210deg);
            transform: rotate(210deg); }
        .sk-circle .sk-circle9 {
            -webkit-transform: rotate(240deg);
            -ms-transform: rotate(240deg);
            transform: rotate(240deg); }
        .sk-circle .sk-circle10 {
            -webkit-transform: rotate(270deg);
            -ms-transform: rotate(270deg);
            transform: rotate(270deg); }
        .sk-circle .sk-circle11 {
            -webkit-transform: rotate(300deg);
            -ms-transform: rotate(300deg);
            transform: rotate(300deg); }
        .sk-circle .sk-circle12 {
            -webkit-transform: rotate(330deg);
            -ms-transform: rotate(330deg);
            transform: rotate(330deg); }
        .sk-circle .sk-circle2:before {
            -webkit-animation-delay: -1.1s;
            animation-delay: -1.1s; }
        .sk-circle .sk-circle3:before {
            -webkit-animation-delay: -1s;
            animation-delay: -1s; }
        .sk-circle .sk-circle4:before {
            -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s; }
        .sk-circle .sk-circle5:before {
            -webkit-animation-delay: -0.8s;
            animation-delay: -0.8s; }
        .sk-circle .sk-circle6:before {
            -webkit-animation-delay: -0.7s;
            animation-delay: -0.7s; }
        .sk-circle .sk-circle7:before {
            -webkit-animation-delay: -0.6s;
            animation-delay: -0.6s; }
        .sk-circle .sk-circle8:before {
            -webkit-animation-delay: -0.5s;
            animation-delay: -0.5s; }
        .sk-circle .sk-circle9:before {
            -webkit-animation-delay: -0.4s;
            animation-delay: -0.4s; }
        .sk-circle .sk-circle10:before {
            -webkit-animation-delay: -0.3s;
            animation-delay: -0.3s; }
        .sk-circle .sk-circle11:before {
            -webkit-animation-delay: -0.2s;
            animation-delay: -0.2s; }
        .sk-circle .sk-circle12:before {
            -webkit-animation-delay: -0.1s;
            animation-delay: -0.1s; }

        @-webkit-keyframes sk-circleBounceDelay {
            0%, 80%, 100% {
                -webkit-transform: scale(0);
                transform: scale(0);
            } 40% {
                  -webkit-transform: scale(1);
                  transform: scale(1);
              }
        }

        @keyframes sk-circleBounceDelay {
            0%, 80%, 100% {
                -webkit-transform: scale(0);
                transform: scale(0);
            } 40% {
                  -webkit-transform: scale(1);
                  transform: scale(1);
              }
        }
        .text-center {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <div class="view-product sticker">
                        @if (file_exists($_SERVER['DOCUMENT_ROOT'].$publication->urlImage))
                            @if($publication->is_coupon)
                                <a href="#">
                                    <span class="notify-badge">Cupon <i class="fas fa-tag"></i></span>
                                </a>
                            @endif
                            <img id="principalImage" class="img-fluid" src="{{ asset($publication->urlImage) }}" alt="Card image cap">
                        @else
                            <div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;">
                                @if($publication->is_coupon)
                                    <a href="#">
                                        <span class="notify-badge">Cupon <i class="fas fa-tag"></i></span>
                                    </a>
                                @endif
                                <p>Sin imagen</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="product-information"><!--/product-information-->
                        <h2>{{ $publication->title }}</h2>
                        @if($publication->is_coupon)
                            <p><i class="fas fa-check-circle"></i> Aprovecha el cupón</p>
                        @endif
                        <span>
                            @if($publication->is_coupon)
                                <a href="#" class="btn btn-default add-to-cart" onclick="addCoupon({{ $publication->id }})"><i class="fas fa-tag"></i> Agregar a cuponera</a>
                                <div class="loader">
                                    <div class="sk-circle">
                                    <div class="sk-circle1 sk-child"></div>
                                    <div class="sk-circle2 sk-child"></div>
                                    <div class="sk-circle3 sk-child"></div>
                                    <div class="sk-circle4 sk-child"></div>
                                    <div class="sk-circle5 sk-child"></div>
                                    <div class="sk-circle6 sk-child"></div>
                                    <div class="sk-circle7 sk-child"></div>
                                    <div class="sk-circle8 sk-child"></div>
                                    <div class="sk-circle9 sk-child"></div>
                                    <div class="sk-circle10 sk-child"></div>
                                    <div class="sk-circle11 sk-child"></div>
                                    <div class="sk-circle12 sk-child"></div>
                                </div>
                                </div>
                            @endif
                        </span>

                        <p><b>Categoria:</b> {{ $publication->category->shortDescription }}</p>
                        <p><b>Descripcion:</b> {{ $publication->description }}</p>
                        <p><b>Tienda:</b> {{ $publication->company->name }}</p>
                        <br>

                        <div class="fb-share-button"
                             data-href="{{ Request::url() }}"
                             data-layout="button_count"
                             data-size="small"
                             data-mobile-iframe="true">
                            <a class="fb-xfbml-parse-ignore"
                               target="_blank"
                               href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">
                                Compartir
                            </a>
                        </div>
                    </div><!--/product-information-->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h2 class="title text-center">De la misma categoria</h2>
                </div>
                @foreach($pCategories as $publication)
                <div class="col-md-4">
                    <!--Card-->
                    <div class="card box same-category">
                        <!--Card image-->
                        @if($publication->is_coupon)
                            <div class="ribbon"><span>Cupon</span></div>
                        @endif
                        @if (file_exists($_SERVER['DOCUMENT_ROOT'].$publication->urlImage))
                            <img class="img-fluid" src="{{ asset($publication->urlImage) }}" alt="Card image cap">
                        @else
                            <div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;">
                                <p>Sin imagen</p>
                            </div>
                        @endif

                        <!--Card content-->
                        <div class="card-body">
                            <!--Title-->
                            <h4 class="card-title">{{/*$key." - ".*/$publication->title}}</h4>
                            <!--Text-->
                            <p class="card-text">{{$publication->description}}</p>
                            <div class="col-xs-10 col-xs-offset-1 text-center">
                                <a href="#" data-id="{{$publication->id}}" class="btn btn-rulinb clickMessage center-block">Detalles</a>
                            </div> {{-- <span class="badge">{{$publication->clicked}} veces visto</span> --}}
                        </div>
                    </div>
                    <!--/.Card-->
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    
    <script>
        function addCoupon(pubId) {
            var _data = { couponId: pubId };
            $.ajax({
                url: "/publications/addCoupon",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                data: _data,
                beforeSend: function(xhr, settings){
                    $(".loader").css('display', 'inline-block');
                },
                complete: function(xhr, textStatus) {
                    $(".loader").hide();
                },
                success: function(data, textStatus, xhr) {
                    console.log(data);
                    if(data.statusRequest === 3){
                        window.location.replace("/customer/login");
                    }
                    else if(data.statusRequest === 2){
                        Base.ToastError("Cupon", "La publicacion seleccionada no es un cupón");
                    }
                    else if(data.statusRequest === 0){
                        Base.ToastError("Cupon", "Ya ha agregado este cupón anteriormente");
                    }
                    else{
                        Base.ToastInfo("Cupon", "Cupón agregado correctamente");
                    }

                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error("ERROR AJAX", errorThrown);
                }
            });
        }
    </script>
@endsection