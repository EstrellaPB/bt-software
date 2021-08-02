@extends('admin.layout.master')
{{-- 
@section('vistas_active')
    class="active"
@endsection --}}

@section('devices_active')
    class="active"
@endsection

@section('content')

<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-6">
        <h2>Dispositivos</h2>
    </div>
    <div class="col-md-6">
        <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#addModal">Nuevo dispositivo <i class="fas fa-plus-circle"></i></button>
    </div>
</div>

<div class="row">
    <div class="">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-8">
                	<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h4>Todos los dispositivos</h4>
                        </div>
                        <div class="ibox-content table-responsive">
                            @include('util.loading')
                            <table class="table custom-table-hover" id="devices_dataTable">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>MAC</th>
                                    <th>Estado</th>
                                    <th>Ver</th>
                                    <th>Eliminar</th>
                                
                                </tr>
                                </thead>
                                <tbody id="device_tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" style="padding:0;">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h4>Relaciones</h4>
                        </div>
                        <div class="ibox-content edit-box">
                            @include('util.loading')
                            <div id="relatedTable">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4" style="padding:0;">
                	<div class="ibox float-e-margins" id="panelDataDevice">
                        <div class="ibox-title">
                            <h4>Editar Dispositivo</h4>
                        </div>
                        <div class="ibox-content edit-box">
                            @include('util.loading')
                            {!! Form::open(['action' => ['admin\DeviceController@update', 0], 'id'=>'editForm', 'method' => 'PATCH' ]) !!}
                            {!! Form::hidden('id') !!}
                            <div class="form-group">
                                {!! Form::label('MAC') !!}
                                {!! Form::text('mac', old('mac'), array('class'=>'form-control', 'required'=>'true', 'pattern'=>'^([0-9A-F]{2}:){5}[0-9A-F]{2}$', 'maxlength'=>"17", 'autocomplete'=>'off', 'onkeydown'=>'Device.upperCaseF(this)')) !!}
                                {{ $errors->first('mac') }}
                            </div>

                            <div class="form-group">
                                <div class="pretty p-switch">
                                    <input type="checkbox" name="status" />
                                    <div class="state p-primary">
                                        <label>Activo</label>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group form-inline">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="reset" class="btn btn-default btn-block" onclick="Device.CancelEdit()"><i class="fas fa-exclamation"></i> &nbsp; Cancelar</button>
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
            {!! Form::open(['action' => ['admin\DeviceController@store'], 'id'=>'addForm', 'method' => 'POST', 'files' => true]) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title pull-left">Agregar dispositivo</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <br>
                    
                    <div class="form-group">
                        {!! Form::label('MAC') !!}
                        {!! Form::text('mac', old('mac'), array('class'=>'form-control', 'required'=>'true', 'autocomplete'=>'off', 'onkeydown'=>'Device.upperCaseF(this)')) !!}
                        {{ $errors->first('mac') }}
                    </div>

                    <div class="form-group">
                        <div class="pretty p-switch">
                            <input type="checkbox" name="status" />
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
                <h3 class="modal-title pull-left">Vista del dispositivo</h3>
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
<script src="{{ asset('js/admin/device.js') }}"></script>
<script src="{{ asset('js/modules/publications/main.js') }}"></script>
@if(Session::has('storeDevice'))
    <script>
        $(document).ready(function () {
            Base.ToastInfo("Dispositivo", "{{ Session::get('storeDevice') }}");
        });
    </script>
@endif
@if(Session::has('updateDevice'))
    <script>
        $(document).ready(function () {
            Base.ToastInfo("Dispositivo", "{{ Session::get('updateDevice') }}");
        });
    </script>
@endif
@if(Session::has('deleteDevice'))
    <script>
        $(document).ready(function() {
            Base.ToastInfo("Dispositivo", "{{ Session::get('deleteDevice') }}");
        });
    </script>
@endif

@if(Session::has('errorDevice'))
    <script>
        $(document).ready(function() {
            Base.ToastError('Dispositivo', "{{ Session::get('errorDevice') }}");
        });
    </script>
@endif

@endsection