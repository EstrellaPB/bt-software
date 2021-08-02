<div class="container-fluid">
    <div class="row">
        <div class="col-sm-7">
            <div class="view-product">
                @if (file_exists($_SERVER['DOCUMENT_ROOT'].$publication->urlImage))
                    <img id="principalImage" class="img-fluid" src="{{ asset($publication->urlImage) }}" alt="Card image cap" style="max-width: 100%; height: auto;">
                @else
                    <div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;">
                        <p>Sin imagen</p>
                    </div>
                @endif
                <h2><b>{{ $publication->title }}</b></h2>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="product-information"><!--/product-information-->
                @if($publication->is_coupon)
                    <p><i class="fas fa-check-circle"></i> Cupón</p>
                @endif
                <p><b>Categoria:</b> {{ $publication->category->shortDescription }}</p>
                <p><b>Descripcion:</b> {{ $publication->description }}</p>
                <p><b>Tienda:</b> {{ $publication->company->name }}</p>
                <br>
            </div><!--/product-information-->
        </div>
    </div>
</div>