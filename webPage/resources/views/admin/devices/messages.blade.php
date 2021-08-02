@extends('admin.layout.master')
{{-- 
@section('vistas_active')
    class="active"
@endsection --}}

@section('devices_active')
    class="active"
@endsection
@section('styles')
<style>
	.connectedSortable{
	min-height: 50px
}
</style>
<link rel="stylesheet" href="{{ asset('css/admin/messages.css') }}">
@endsection
@section('content')

<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-md-6">
        <h2>Administración de mensajes</h2>
        <h4>Dispositivo {{ $device->id }}</h4>
    </div>
</div>

<div class="row">
    <div class="">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-6">
                	<div class="ibox float-e-margins">
						<div class="ibox-title">
							<div class="row">
								<div class="col-sm-6">
									<h4>Mensajes</h4>
								</div>
		                    	 <div class="col-sm-6">
		                    	 	<div class="form-group">
		                    	 		<div class="col-xs-3">
		                    	 			<label for="search">Buscar: </label>
		                    	 		</div>
		                    	 		<div class="col-xs-9">
		                    	 			<input name="search" type="search" id="searchMessages" onkeyup="Message.search()" class="form-control input-sm">
		                    	 		</div>
		                    	 	</div>		                     
		                        </div>
		                    </div>
	                	</div>
						<div class="ibox-content">
							@include('util.loading')
							<div id="mensajes_items">
								<ul id="sortableMessages" class="connectedSortable">
									@foreach ($messages as $message)
										<li data-idMessage="{{$message->id}}" class="ui-state-default {{\Carbon\Carbon::parse($message->expiration_date)->lt($now) ? 'expired' : ''}}">
											<div class="col-xs-4 img-message">
												@if (file_exists($_SERVER['DOCUMENT_ROOT'].$message->urlImage))
													<img class="img-responsive" src="{{$message->urlImage}}" alt="">
												@else
													<div style="width: 100%; height: auto; background-color: grey;color:white;padding:20px;text-align: center;">
				                                        <p>Sin imagen</p>
				                                    </div>
												@endif
												
											</div>
											<div class="col-xs-8 body-message">
												<h3 title="{{$message->message}}">{{str_limit($message->message, 27)}}</h3>
												<a href="{{$message->url}}">{{$message->url}}</a>
												{{-- {{$now}}
												{{\Carbon\Carbon::parse($message->expiration_date)}} --}}
												<div class="col-xs-8">
													<span class="pubTitle">{{$message->publicationTitle}}</span>
												</div>
												<div class="col-xs-4">
													{!! Form::hidden('companyName', $message->companyName, array('class'=>'companyName')) !!}
													<img src="{{$message->companyImage}}" class="img-responsive" alt="">
													
												</div>
												
											</div>
											
										</li>
									@endforeach
								</ul>
							</div>
						</div>

                    </div>
                </div>
               	<div class="col-lg-6">
                	<div class="ibox float-e-margins">

                        <div class="ibox-title">
                            <h4>Asignados</h4>
                        </div>
                        <div class="ibox-content">
							@include('util.loading')
							{!! csrf_field() !!}
							{!! Form::hidden('id_device', $device->id); !!}
							<div id="mensajes_items">
								<ul id="sortableMessagesDevice" class="connectedSortable">
									@foreach ($deviceMessages as $deviceMessage)
										<li data-idMessage="{{$deviceMessage->id}}" class="ui-state-default {{\Carbon\Carbon::parse($deviceMessage->expiration_date)->lt($now) ? 'expired' : ''}}">
											<div class="col-xs-4 img-message">
												@if (file_exists($_SERVER['DOCUMENT_ROOT'].$deviceMessage->publication->urlImage))
													<img class="img-responsive" src="{{$deviceMessage->publication->urlImage}}" alt="">
												@else
													<div style="width: 100%; height: auto; background-color: grey;color:white;padding:20px;text-align: center;">
				                                        <p>Sin imagen</p>
				                                    </div>
												@endif
												
											</div>
											<div class="col-xs-8 body-message">
												<h3 title="{{$deviceMessage->message}}">{{str_limit($deviceMessage->message, 27)}}</h3>
												<a href="{{$deviceMessage->url}}">{{$deviceMessage->url}}</a>

												<div class="col-xs-8">
													<span class="pubTitle">{{$deviceMessage->publication->title}}</span>
												</div>
												<div class="col-xs-4">
													{!! Form::hidden('companyName', $deviceMessage->publication->company->name, array('class'=>'companyName')) !!}
													<img src="{{$deviceMessage->publication->company->companyDetail->urlImage}}" class="img-responsive" alt="">
												</div>
											</div>
										</li>
									@endforeach
								</ul>
							</div>
						</div>

                    </div>
                </div>
             </div>
         </div>
     </div>

 </div>

 @endsection

@section('scripts')
<script src="{{ asset('js/admin/message.js') }}"></script>
@endsection
