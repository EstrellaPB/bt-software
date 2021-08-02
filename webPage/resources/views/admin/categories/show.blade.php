<div class="container-fluid">
    <div class="row">
        <div class="col-sm-7">
            <div class="view-product">
                @if (file_exists($_SERVER['DOCUMENT_ROOT'].$category->urlImage))
                    <img id="principalImage" class="img-fluid" src="{{ asset($category->urlImage) }}" alt="Card image cap" style="max-width: 100%; height: auto;">
                @else
                    <div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;">
                        <p>Sin imagen</p>
                    </div>
                @endif
                <h2><b>{{ $category->shortDescription }}</b></h2>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="product-information"><!--/product-information-->
                <p><b>Descripcion:</b> {{ $category->longDescription }}</p>
                
                <br>
            </div><!--/product-information-->
        </div>
    </div>
</div>