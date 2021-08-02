@extends('admin.layout.master')

@section('customers_active')
    class="active"
@endsection

@section('content')

<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-6">
        <h2>Usuarios</h2>
    </div>
    <div class="col-md-6">
        <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#addModal">Nuevo usuario <i class="fas fa-plus-circle"></i></button>
    </div>
</div>

<div class="row">
    <div class="">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-8">
                	<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h4>Todos los usuarios</h4>
                        </div>
                        <div class="ibox-content table-responsive">
                            @include('util.loading')
                            <table class="table custom-table-hover" id="customers_dataTable">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>e-mail</th>
                                    {{-- <th>Nombre de usuario</th> --}}
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Teléfono</th>
                                    <th>Ver</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody id="customer_tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" style="padding:0;">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h4>Relacionados</h4>
                        </div>
                        <div class="ibox-content edit-box">
                            @include('util.loading')
                            <div id="relatedTable">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4" style="padding:0;">
                	<div class="ibox float-e-margins" id="panelDataCustomer">
                        <div class="ibox-title">
                            <h4>Editar usuario</h4>
                        </div>
                        <div class="ibox-content edit-box">
                            @include('util.loading')
                            {!! Form::open(['action' => ['admin\CustomerController@update', 0], 'id'=>'editForm', 'method' => 'PATCH', 'files'=>true]) !!}

                     
                            <div class="form-group">
                                {!! Form::label('e-mail *') !!}
                                {!! Form::text('email', old('email'), array('class'=>'form-control', 'required'=>'true')) !!}
                                {{ $errors->first('email') }}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Nombre de usuario *') !!}
                                {!! Form::text('name', old('name'), array('class'=>'form-control', 'required'=>'true')) !!}
                                {{ $errors->first('name') }}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Nombre *') !!}
                                {!! Form::text('first_name', old('first_name'), array('class'=>'form-control', 'required'=>'true')) !!}
                                {{ $errors->first('first_name') }}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Apellido *') !!}
                                {!! Form::text('last_name', old('last_name'), array('class'=>'form-control', 'required'=>'true')) !!}
                                {{ $errors->first('last_name') }}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Dirección') !!}
                                {!! Form::text('address', old('address'), array('class'=>'form-control')) !!}
                                {{ $errors->first('address') }}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Teléfono') !!}
                                {!! Form::text('tel', old('tel'), array('class'=>'form-control')) !!}
                                {{ $errors->first('tel') }}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Ciudad') !!}
                                {!! Form::text('city', old('city'), array('class'=>'form-control')) !!}
                                {{ $errors->first('city') }}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Estado') !!}
                                {!! Form::text('state', old('state'), array('class'=>'form-control')) !!}
                                {{ $errors->first('state') }}
                            </div>

                            
                            <div class="form-group form-inline">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="reset" class="btn btn-default btn-block" onclick="Customer.CancelEdit()"><i class="fas fa-exclamation"></i> &nbsp; Cancelar</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" id="edit-btn" class="btn btn-primary btn-block"><span class="fa fa-edit"></span> &nbsp; Editar</button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            {!! Form::open(['action' => ['admin\CustomerController@store'], 'id'=>'addForm', 'method' => 'POST']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar usuario</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <fieldset>
                        <legend>Datos generales</legend>
                         <div class="form-group">
                            {!! Form::label('e-mail *') !!}
                            {!! Form::text('email', old('email'), array('class'=>'form-control', 'required'=>'true')) !!}
                            {{ $errors->first('email') }}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Contraseña *') !!}
                            {!! Form::password('password', array('class'=>'form-control', 'required'=>'true')) !!}
                            {{ $errors->first('password') }}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Nombre de usuario *') !!}
                            {!! Form::text('name', old('name'), array('class'=>'form-control', 'required'=>'true')) !!}
                            {{ $errors->first('name') }}
                        </div>
                    </fieldset>
                    
                    <fieldset>
                        <legend>Perfil</legend>
                        <div class="form-group">
                            {!! Form::label('Nombre *') !!}
                            {!! Form::text('first_name', old('first_name'), array('class'=>'form-control', 'required'=>'true')) !!}
                            {{ $errors->first('first_name') }}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Apellido *') !!}
                            {!! Form::text('last_name', old('last_name'), array('class'=>'form-control', 'required'=>'true')) !!}
                            {{ $errors->first('last_name') }}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Dirección') !!}
                            {!! Form::text('address', old('address'), array('class'=>'form-control')) !!}
                            {{ $errors->first('address') }}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Teléfono') !!}
                            {!! Form::text('tel', old('tel'), array('class'=>'form-control')) !!}
                            {{ $errors->first('tel') }}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Ciudad') !!}
                            {!! Form::text('city', old('city'), array('class'=>'form-control')) !!}
                            {{ $errors->first('city') }}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Estado') !!}
                            {!! Form::text('state', old('state'), array('class'=>'form-control')) !!}
                            {{ $errors->first('state') }}
                        </div>
                    </fieldset>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                {!! Form::submit('Guardar', array('class'=>'btn btn-primary pull-right')) !!}
            </div>
            {!! Form::close() !!}
        </div>

    </div>
</div>

<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title pull-left">Vista del usuario</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body with-loader">
                @include('util.loading')
                <div id="viewBody" class="viewBody">
                    <p>...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/admin/customer.js') }}"></script>
{{-- <script src="{{ asset('js/modules/publications/main.js') }}"></script> --}}
@if(Session::has('storeCustomer'))
    <script>
        $(document).ready(function () {
            Base.ToastInfo("Usuario", "{{ Session::get('storeCustomer') }}");
        });
    </script>
@endif
@if(Session::has('updateCustomer'))
    <script>
        $(document).ready(function () {
            Base.ToastInfo("Usuario", "{{ Session::get('updateCustomer') }}");
        });
    </script>
@endif
{{-- @if(Session::has('fileStatus'))
    <script>
        $(document).ready(function () {
            Base.ToastWarning("Categoría - Imagen", "{{ Session::get('fileStatus') }}");
        });
    </script>
@endif --}}

@if(Session::has('deleteCustomer'))
    <script>
        $(document).ready(function() {
            Base.ToastInfo("Usuario", "{{ Session::get('deleteCustomer') }}");
        });
    </script>
@endif

@if(Session::has('errorCustomer'))
    <script>
        $(document).ready(function() {
            Base.ToastError('Usuario', "{{ Session::get('errorCustomer') }}");
        });
    </script>
@endif

@endsection