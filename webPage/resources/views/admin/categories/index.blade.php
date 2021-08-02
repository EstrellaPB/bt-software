@extends('admin.layout.master')

@section('vistas_active')
    class="active"
@endsection

@section('category_active')
    class="active"
@endsection

@section('content')

<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-6">
        <h2>Categorías</h2>
    </div>
    <div class="col-md-6">
        <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#addModal">Nueva categoría <i class="fas fa-plus-circle"></i></button>
    </div>
</div>

<div class="row">
    <div class="">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-8">
                	<div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h4>Todas las categorías</h4>
                        </div>
                        <div class="ibox-content table-responsive">
                            @include('util.loading')
                            <table class="table custom-table-hover" id="categories_dataTable">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Descripción corta</th>
                                    <th>Descripción larga</th>
                                    <th>Ver</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody id="category_tbody">
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
                	<div class="ibox float-e-margins" id="panelDataCategory">
                        <div class="ibox-title">
                            <h4>Editar categoría</h4>
                        </div>
                        <div class="ibox-content edit-box">
                            @include('util.loading')
                            {!! Form::open(['action' => ['admin\CategoryController@update', 0], 'id'=>'editForm', 'method' => 'PATCH', 'files'=>true]) !!}

                            <div class="form-group">
                                <div id="editImage">
                                    <div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;">
                                        <p>Sin imagen</p>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Form::file('image', array('class'=>'form-control', 'accept' => 'image/*', 'onchange' => 'Category.PreviewImage(this, "#editImage")')) !!}
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-6">
                                            <button class="btn btn-default" onclick="Category.DeleteImage(event, this)"><i class="fas fa-times-circle"></i> &nbsp; Eliminar imagen</button>
                                            {!! Form::hidden('deleteImage', 0) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('Descripción corta') !!}
                                {!! Form::text('shortDescription', old('shortDescription'), array('class'=>'form-control', 'required'=>'true')) !!}
                                {{ $errors->first('shortDescription') }}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Descripción Larga') !!}
                                {!! Form::textarea('longDescription', old('longDescription'), array('class'=>'form-control', 'required'=>'true')) !!}
                                {{ $errors->first('longDescription') }}
                            </div>

                            
                            <div class="form-group form-inline">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="reset" class="btn btn-default btn-block" onclick="Category.CancelEdit()"><i class="fas fa-exclamation"></i> &nbsp; Cancelar</button>
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
            {!! Form::open(['action' => ['admin\CategoryController@store'], 'id'=>'addForm', 'method' => 'POST', 'files'=>true]) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar categoría</h4>
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
                        {!! Form::file('image', array('class'=>'form-control', 'accept' => 'image/*', 'onchange' => 'Category.PreviewImage(this, "#addImage")')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('Descripción corta') !!}
                        {!! Form::text('shortDescription', old('shortDescription'), array('class'=>'form-control', 'required'=>'true')) !!}
                        {{ $errors->first('shortDescription') }}
                    </div>

                    <div class="form-group">
                        {!! Form::label('Descripción larga') !!}
                        {!! Form::textarea('longDescription', old('longDescription'), array('class'=>'form-control', 'required'=>'true')) !!}
                        {{ $errors->first('longDescription') }}
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
                <h3 class="modal-title pull-left">Vista de la categoría</h3>
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
<script src="{{ asset('js/admin/category.js') }}"></script>
<script src="{{ asset('js/modules/publications/main.js') }}"></script>
@if(Session::has('storeCategory'))
    <script>
        $(document).ready(function () {
            Base.ToastInfo("Categoría", "{{ Session::get('storeCategory') }}");
        });
    </script>
@endif
@if(Session::has('updateCategory'))
    <script>
        $(document).ready(function () {
            Base.ToastInfo("Categoría", "{{ Session::get('updateCategory') }}");
        });
    </script>
@endif
@if(Session::has('fileStatus'))
    <script>
        $(document).ready(function () {
            Base.ToastWarning("Categoría - Imagen", "{{ Session::get('fileStatus') }}");
        });
    </script>
@endif

@if(Session::has('deleteCategory'))
    <script>
        $(document).ready(function() {
            Base.ToastInfo("Categoría", "{{ Session::get('deleteCategory') }}");
        });
    </script>
@endif

@if(Session::has('errorCategory'))
    <script>
        $(document).ready(function() {
            Base.ToastError('Categoría', "{{ Session::get('errorCategory') }}");
        });
    </script>
@endif
@endsection