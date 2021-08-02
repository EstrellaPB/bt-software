@extends('admin.layout.master')

@section('clients_active')
    class="active"
@endsection

@section('content')

<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-6">
        <h2>Clientes</h2>
    </div>
    <div class="col-md-6">
        <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#addModal">Nuevo Cliente <i class="fas fa-plus-circle"></i></button>
    </div>
</div>

<div class="row">
    <div class="">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-8">
                	<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h4>Todos los clientes</h4>
                        </div>
                        <div class="ibox-content table-responsive">
                            @include('util.loading')
                            <table class="table custom-table-hover" id="clients_dataTable">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nombre</th>
                                    <th>Ciudad</th>
                                    <th>Estado</th>
                                    <th>Premium</th>
                                    <th>Activo</th>
                                    <th>Ver</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody id="client_tbody">
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
                	<div class="ibox float-e-margins" id="panelDataClient">
                        <div class="ibox-title">
                            <h4>Editar cliente</h4>
                        </div>
                        <div class="ibox-content edit-box">
                            @include('util.loading')
                            {!! Form::open(['action' => ['admin\ClientController@update', 0], 'id'=>'editForm', 'method' => 'PATCH', 'files'=>true]) !!}

                            <div class="form-group">
                                <div id="editImage">
                                    <div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;">
                                        <p>Sin imagen</p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Form::file('image', array('class'=>'form-control', 'accept' => 'image/*', 'onchange' => 'Client.PreviewImage(this, "#editImage")')) !!}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-6">
                                            <button class="btn btn-default" onclick="Client.DeleteImage(event, this)"><i class="fas fa-times-circle"></i> &nbsp; Eliminar imagen</button>
                                            {!! Form::hidden('deleteImage', 0) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('Nombre') !!}
                                {!! Form::text('name', old('name'), array('class'=>'form-control', 'required'=>'true')) !!}
                                {{ $errors->first('name') }}
                            </div>
                            <div class="form-group">
                                {!! Form::label('RFC') !!}
                                {!! Form::text('rfc', old('rfc'), array('class'=>'form-control', 'required'=>'true')) !!}
                                {{ $errors->first('rfc') }}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Ciudad') !!}
                                {!! Form::text('city', old('city'), array('class'=>'form-control', 'required'=>'true')) !!}
                                {{ $errors->first('city') }}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Estado') !!}
                                {!! Form::text('state', old('state'), array('class'=>'form-control', 'required'=>'true')) !!}
                                {{ $errors->first('state') }}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Latitud') !!}
                                {!! Form::number('latitude', old('latitude'), array('class'=>'form-control', 'required'=>'true', 'step'=>'any')) !!}
                                {{ $errors->first('latitude') }}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Longitud') !!}
                                {!! Form::number('longitude', old('longitude'), array('class'=>'form-control', 'required'=>'true', 'step'=>'any')) !!}
                                {{ $errors->first('longitude') }}
                            </div>
                            <div class="form-group">
                                <div class="pretty p-switch">
                                    <input type="checkbox" name="is_premium" />
                                    <div class="state p-primary">
                                        <label>Premium</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="pretty p-switch">
                                    <input type="checkbox" name="is_active" />
                                    <div class="state p-primary">
                                        <label>Activo</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group form-inline">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="reset" class="btn btn-default btn-block" onclick="Client.CancelEdit()"><i class="fas fa-exclamation"></i> &nbsp; Cancelar</button>
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
            {!! Form::open(['action' => ['admin\ClientController@store'], 'id'=>'addForm', 'method' => 'POST', 'files'=>true]) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar cliente</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <br>
                    <div class="form-group">
                        <div id="addImage">
                            <div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;">
                                <p>Sin imagen</p>
                            </div>
                        </div>
                        <br>
                        {!! Form::file('image', array('class'=>'form-control', 'accept' => 'image/*', 'onchange' => 'Client.PreviewImage(this, "#addImage")')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('Nombre') !!}
                        {!! Form::text('name', old('name'), array('class'=>'form-control', 'required'=>'true')) !!}
                        {{ $errors->first('name') }}
                    </div>
                    <div class="form-group">
                        {!! Form::label('RFC') !!}
                        {!! Form::text('rfc', old('rfc'), array('class'=>'form-control', 'required'=>'true')) !!}
                        {{ $errors->first('rfc') }}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Ciudad') !!}
                        {!! Form::text('city', old('city'), array('class'=>'form-control', 'required'=>'true')) !!}
                        {{ $errors->first('city') }}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Estado') !!}
                        {!! Form::text('state', old('state'), array('class'=>'form-control', 'required'=>'true')) !!}
                        {{ $errors->first('state') }}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Latitud') !!}
                        {!! Form::number('latitude', old('latitude'), array('class'=>'form-control', 'required'=>'true', 'step'=>'any')) !!}
                        {{ $errors->first('latitude') }}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Longitud') !!}
                        {!! Form::number('longitude', old('longitude'), array('class'=>'form-control', 'required'=>'true', 'step'=>'any')) !!}
                        {{ $errors->first('longitude') }}
                    </div>
                    <div class="form-group">
                        <div class="pretty p-switch">
                            <input type="checkbox" name="is_premium" />
                            <div class="state p-primary">
                                <label>Premium</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pretty p-switch">
                            <input type="checkbox" name="is_active" />
                            <div class="state p-primary">
                                <label>Activo</label>
                            </div>
                        </div>
                    </div>
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
                <h3 class="modal-title pull-left">Vista del cliente</h3>
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
<script src="{{ asset('js/admin/client.js') }}"></script>
<script src="{{ asset('js/modules/publications/main.js') }}"></script>
@if(Session::has('storeClient'))
    <script>
        $(document).ready(function () {
            Base.ToastInfo("Cliente", "{{ Session::get('storeClient') }}");
        });
    </script>
@endif
@if(Session::has('updateClient'))
    <script>
        $(document).ready(function () {
            Base.ToastInfo("Cliente", "{{ Session::get('updateClient') }}");
        });
    </script>
@endif
@if(Session::has('fileStatus'))
    <script>
        $(document).ready(function () {
            Base.ToastWarning("Cliente - Imagen", "{{ Session::get('fileStatus') }}");
        });
    </script>
@endif

@if(Session::has('deleteClient'))
    <script>
        $(document).ready(function() {
            Base.ToastInfo("Cliente", "{{ Session::get('deleteClient') }}");
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
@endsection