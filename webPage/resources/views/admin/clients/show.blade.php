<div class="container-fluid">
    <div class="row">
        <div class="col-sm-7">
            <div class="view-product">
                @if (file_exists($_SERVER['DOCUMENT_ROOT'].$client->companyDetail->urlImage))
                    <img id="principalImage" class="img-fluid" src="{{ asset($client->$companyDetail->urlImage) }}" alt="Card image cap" style="max-width: 100%; height: auto;">
                @else
                    <div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;">
                        <p>Sin imagen</p>
                    </div>
                @endif
                <h2><b>{{ $client->name }} </b></h2>
            </div>
        </div>
        <div class="col-sm-5">
             <div class="col-sm-6">
               <div class="product-information"><!--/product-information-->
                    <p><b>RFC:</b> {{ $client->rfc }}</p>
                    <p><b>Ciudad:</b> {{ $client->city }}</p>
                    <p><b>Estado:</b> {{ $client->state }}</p>
                    <p><b>Latitud:</b> {{ $client->companyDetail->latitude }}</p>
                    <p><b>Longitud:</b> {{ $client->companyDetail->longitude }}</p> 
                </div>
            </div>
              
             <div class="col-ms-6 text-center">
                <div class="product-information">
                    <p><b>Premium</b> </p>

                    @if ($client->companyDetail->is_premium)
                        <i class="fas fa-check-circle fa-2x"></i>
                    @else <i class="fas fa-times-circle fa-2x"></i>
                    @endif  
                    <br>
                    <br>
                    <p><b>Activo</b> </p>

                    @if ($client->companyDetail->is_active)
                        <i class="fas fa-check-circle fa-2x"></i>
                    @else <i class="fas fa-times-circle fa-2x"></i>
                    @endif  
                    <br>
                </div><!--/product-information--> 
             </div>  
                
        </div>
    </div>

    <div class="row">
        <div class="ibox-title">
            <h4>Publicaciones</h4>
        </div>
        <div class="ibox-content table-responsive" id="clientPublicationsLoad">
            @include('util.loading')
            <table class="table custom-table-hover" id="clientPublications_dataTable">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Categoría</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Cupón</th>
                    
                </tr>
                </thead>
                <tbody id="clientPublications_tbody">
                </tbody>
            </table>
        </div>
    </div>
</div>