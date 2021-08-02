@extends('admin.layout.master')

@section('infoProfile_active')
    class="active"
@endsection

@section('content')

<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-6">
        <h2>Información de perfil</h2>
    </div>
    
</div>

<div class="row">
    
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="ibox float-e-margins" id="panelDataCustomer">

                            <div class="ibox-title">
                                <h4></h4>
                            </div>
                            <div class="ibox-content edit-box" style="padding-right: 20%;padding-left: 20%;">
                                
                                    @include('util.loading')
                                    
                                    {!! Form::open(['action' => ['admin\InfoProfileController@update', 0], 'id'=>'editForm', 'method' => 'PATCH', 'files'=>true]) !!}
                                    

                                        <div class="form-group">
                                            <div id="editImage">
                                                <div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;">
                                                    <p>Sin imagen</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6 col-md-offset-6">
                                                    {!! Form::file('image', array('class'=>'form-control', 'accept' => 'image/*', 'onchange' => 'InfoProfile.PreviewImage(this, "#editImage")')) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('Título ') !!}
                                            {!! Form::text('name', old('name'), array('class'=>'form-control', 'required'=>'true')) !!}
                                            {{ $errors->first('name') }}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('Slogan ') !!}
                                            {!! Form::text('slogan', old('slogan'), array('class'=>'form-control', 'required'=>'true')) !!}
                                            {{ $errors->first('slogan') }}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Paginación principal ') !!}
                                            {!! Form::number('paginationElements', old('paginationElements'), array('class'=>'form-control', 'required'=>'true')) !!}
                                            {{ $errors->first('paginationElements') }}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Ubicación') !!}
                                            <div id="map" style="height:400px;"></div>
                                            {!! Form::hidden('lat') !!}
                                            {!! Form::hidden('lng') !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Estado') !!}
                                            {!! Form::select('state', [''=>'seleccione un estado'], '', array('class'=>'form-control')) !!}
                                            {{ $errors->first('state') }}
                                            {!! Form::hidden('stateName') !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Ciudad') !!}
                                            {!! Form::select('city', [''=>'seleccione una ciudad'], '', array('class'=>'form-control')) !!}
                                            {{ $errors->first('city') }}
                                            {!! Form::hidden('cityName') !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Colonia') !!}
                                            {!! Form::text('suburb', old('suburb'), array('class'=>'form-control')) !!}
                                            {{ $errors->first('suburb') }}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('Calle') !!}
                                            {!! Form::text('street', old('street'), array('class'=>'form-control')) !!}
                                            {{ $errors->first('street') }}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Cruzamientos') !!}
                                            {!! Form::text('crossing', old('crossing'), array('class'=>'form-control')) !!}
                                            {{ $errors->first('crossing') }}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('Número') !!}
                                            {!! Form::text('number', old('number'), array('class'=>'form-control')) !!}
                                            {{ $errors->first('number') }}
                                        </div>

                                        
                                        <div class="form-group form-inline">
                                            <div class="row">
                                                <div class="col-md-7 col-md-offset-5">
                                                    <div class="col-md-6">
                                                        {{-- <button type="reset" class="btn btn-default btn-block" onclick="InfoProfile.CancelEdit()"><i class="fas fa-exclamation"></i> &nbsp; Cancelar</button> --}}
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" id="edit-btn" class="btn btn-primary btn-block"><span class="fa fa-edit"></span> &nbsp; Editar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    {!! Form::close() !!}
                                
                            </div><!--./edit-box-->
                        
                    </div>{{--./box--}}

                </div>{{---/col-lg-10--}}
            </div>{{--./row--}}
        </div>{{--./wrapper-content--}}
    
</div>{{--./row--}}

@endsection

@section('scripts')
<script src="{{ asset('js/admin/infoprofile.js') }}"></script>
<script src="{{ asset('js/modules/publications/main.js') }}"></script>
@if(Session::has('storeInfoProfile'))
    <script>
        $(document).ready(function () {
            Base.ToastInfo("Perfil", "{{ Session::get('storeInfoProfile') }}");
        });
    </script>
@endif
@if(Session::has('updateInfoProfile'))
    <script>
        $(document).ready(function () {
            Base.ToastInfo("Perfil", "{{ Session::get('updateInfoProfile') }}");
        });
    </script>
@endif
@if(Session::has('fileStatus'))
    <script>
        $(document).ready(function () {
            Base.ToastWarning("Perfil - Imagen", "{{ Session::get('fileStatus') }}");
        });
    </script>
@endif

@if(Session::has('deleteInfoProfile'))
    <script>
        $(document).ready(function() {
            Base.ToastInfo("Perfil", "{{ Session::get('deleteInfoProfile') }}");
        });
    </script>
@endif

@if(Session::has('errorClient'))
    <script>
        $(document).ready(function() {
            Base.ToastError('Cliente', "{{ Session::get('errorClient') }}");
        });
    </script>
@endif

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5JGbGNJkD5fpIO-8G6Q9aPQ7XwrfrYXM">
</script>
@endsection