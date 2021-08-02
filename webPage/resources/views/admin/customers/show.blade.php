<div class="container-fluid">
    <div class="row">
        <div class="col-sm-7">
            <div class="view-product">
                @if ($customer->customerProfile)
                    <h2><b>{{ $customer->customerProfile->first_name . " " . $customer->customerProfile->last_name }}</b></h2>
                    <h2><span class="fa fa-user-circle fa-1x"></span>&nbsp;<b>{{ $customer->name }}</b></h2>
                @else
                    <h2><span class="fa fa-user-circle fa-1x"></span>&nbsp;<b>{{ $customer->name }}</b></h2>
                @endif
                
                <p> {{ $customer->email }}</p>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="product-information"><!--/product-information-->

                @if($customer->customerProfile)
                    @if ( $customer->customerProfile->tel)
                        <p><b>Teléfono:</b> {{ $customer->customerProfile->tel }}</p>
                    @endif
                    @if ($customer->customerProfile->address)
                        <p><b>Dirección:</b> {{ $customer->customerProfile->address }}</p>
                    @endif
                    @if ($customer->customerProfile->city)
                         <p><b>Ciudad:</b> {{ $customer->customerProfile->city }}</p>
                    @endif
                    @if ($customer->customerProfile->state)
                        <p><b>Estado:</b> {{ $customer->customerProfile->state }}</p>
                    @endif

                    <br>
                @else
                    <div class="no-profile"></div>
                @endif
               
            </div><!--/product-information-->
        </div>
    </div>
    <div class="row">
        <div class="ibox-title">
            <h4>Cupones</h4>
        </div>
        <div class="ibox-content table-responsive" id="customerCouponsLoad">
            @include('util.loading')
            <table class="table custom-table-hover" id="customerCoupons_dataTable">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Usado</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody id="customerCoupons_tbody">
                </tbody>
            </table>
        </div>
    </div>
</div>