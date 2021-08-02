<div class="container-fluid">
    <div class="row row-flex row-flex-center">
        <div class="col-sm-4">
            <div class="view-product">
                <h2><b>{{ $device->mac }}</b></h2>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="product-information text-center" ><!--/product-information-->
                @if($device->status)
                <h2><b>Activo</b></h2>
                    <p><i class="fas fa-check-circle fa-3x"></i>  </p>
                @else 
                <h2><b>Inactivo</b></h2>
                    <p><i class="far fa-circle fa-3x"></i> </p>
                @endif
                
                <br>
            </div><!--/product-information-->
        </div>
        <div class="col-sm-4">
            <a href="{{ route('admin.deviceMessages', $device->id) }}" class="btn btn-primary center-block">Administrar mensajes</a>
        </div>
    </div>
</div>