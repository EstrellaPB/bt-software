@extends('layouts.master')

@section('styles')
    <style>
        .pagination-div{
            text-align: center;
            width: 100%;
        }
        .pagination{
            display: block;
            padding-left: 5px;
            font-weight: bold;
        }
        .pagination>.disabled{
            color: #D3D3D3;
            background-color:#0079bc;
        }
        .pagination a:visited{
            color: #FFFFFF;
        }
        .pagination li{
            font-size: 14px;
            display: inline-block;
            height: 36px;
            min-width: 88px;
            padding: 6px 16px;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border:0;
            border-radius: 2px;
            background: #20a8ef;
            color: #ffffff;
            outline:0;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14),
            0 1px 5px 0 rgba(0, 0, 0, 0.12),
            0 3px 1px -2px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1);

        &:active {
             box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14),
             0 3px 14px 2px rgba(0, 0, 0, 0.12),
             0 5px 5px -3px rgba(0, 0, 0, 0.4);
         }
            &:focus {
                 background: darken($md-btn-color, 12%)
             }
        }
    </style>
@endsection

@if(Route::currentRouteName() == 'Inicio')
    @section('active_index') active @endsection
@elseif(Route::currentRouteName() == 'CategoriasShow')
    @section('active_categories') active @endsection
@elseif(Route::currentRouteName() == 'Promociones')
    @section('active_proms') active @endsection
@endif

@section('content')
    <section id="content">
        {{csrf_field()}}
        <div class="container">
            {{-- @for($i = 0; $i < 4; $i++)
            <div class="row">
                @for($j = 0; $j < 3; $j++)
                    <div class="col-md-4">
                        <!--Card-->
                        <div class="card">

                            <!--Card image-->
                            <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20%282%29.jpg" alt="Card image cap">

                            <!--Card content-->
                            <div class="card-body">
                                <!--Title-->
                                <h4 class="card-title">Card title</h4>
                                <!--Text-->
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Button</a>
                            </div>

                        </div>
                        <!--/.Card-->
                    </div>
                @endfor
            </div>
            @endfor --}}
            @foreach ($publications as $key=>$publication)
                @if (fmod($key, 3)==0)
                <div class="row">
                    <div class="col-md-4">
                    <!--Card-->
                        <div class="card box">
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
                                </div>
                            </div>

                        </div>
                        <!--/.Card-->
                    </div>
                @else
                    <div class="col-md-4">
                        <!--Card-->
                        <div class="card box">

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
                                </div>
                                 {{-- <span class="badge">{{$publication->clicked}} veces visto</span> --}}
                            </div>

                        </div>
                        <!--/.Card-->
                    </div>
                    @if(fmod($key, 3)==2)
                    </div>
                    @endif
                @endif
            @endforeach
        </div>
        </div>
        <div class="pagination-div">
        @php
        try{
            echo($publications->render());
        }
        catch (Exception $e){
        }
        @endphp
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(".clickMessage").click(function(e){
            e.preventDefault();
            var token = $('meta[name="csrf-token"]').attr('content');
            var messageId = $(this).attr('data-id');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/clickPublication',
                type: 'POST',
                dataType: 'json',
                data: {messageid: messageId},
                success: function(r){
                    console.log(r);
                    if(r.response == 'success'){
                        //location.reload();
                    }
                },
                complete: function () {
                    window.location = "/publications/" + messageId;
                }
            });
            
        });
    </script>
@endsection