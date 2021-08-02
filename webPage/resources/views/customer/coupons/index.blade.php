@extends('layouts.master')

@section('styles')
	<style>
		body {
			font-family: Arial;
		}
		.coupon {
			border: 5px dotted #bbb; /* Dotted border */
			width: 80%;
			border-radius: 15px; /* Rounded border */
			margin: 0 auto; /* Center the coupon */
			max-width: 600px;
		}

		.container-coupon {
			padding: 2px 16px;
			background-color: #f1f1f1;
		}

		.promo {
			padding: 3px;
		}

		.expire {
			color: red;
		}
		.col-sm-12{
			margin-bottom: 15px;
		}

		.main h2 i{
			padding-right: 10px;
			color: #A8D13B;
			font-size: 0.8em;
		}
		.main h2:after
		{
			position: absolute;
			content: "";
			height: 1px;
			border-radius: 2px;
			left: 0;
			bottom: 0;
			box-shadow:
					0 -1px 0 rgba(0,0,0,0.1),
					0 1px 0 rgba(255,255,255,0.6);
		}

		.main h2:after { width: 100%; }

		.main h2 {
			margin: 1em 0 0.75em;
			padding: 0 0 5px 0;
			font-weight: normal;
			font-family: 'Scada', sans-serif;
			position: relative;
			text-shadow: 0 2px 0 rgba(255,255,255,0.5);
			font-size: 30px;
			line-height: 40px;
		}
	</style>
@endsection

@section('content')
<br>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="main">
				<h2>Cupones activos</h2>
			</div>
			@foreach ($coupons as $key=>$coupon)
				@if(\Carbon\Carbon::parse($coupon->publication->expiration_date) > \Carbon\Carbon::now())
					@if (fmod($key, 2)==0)
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="coupon">
									<div class="container-coupon">
										<h3>{{ $coupon->publication->company->name }}</h3>
									</div>
									@if (file_exists($_SERVER['DOCUMENT_ROOT'].$coupon->publication->urlImage))
										<img style="width:100%;" src="{{ asset($coupon->publication->urlImage) }}" alt="Card image cap">
									@else
										<div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;">
											<p>Sin imagen</p>
										</div>
									@endif
									<div class="container" style="background-color:white">
										<h2><b>{{ $coupon->publication->title }}</b></h2>
										<p>{{ $coupon->publication->description }}</p>
									</div>
									<div class="container-coupon">
										<p>Generar código de promoción: <button type="button" class="btn btn-primary promo">Generar</button></p>
										<p class="expire">Expira: {{ \Carbon\Carbon::parse($coupon->publication->expiration_date)->toDateString() }}</p>
									</div>
								</div>
							</div>
							@else
								<div class="col-md-6 col-sm-12">
									<div class="coupon">
										<div class="container-coupon">
											<h3>{{ $coupon->publication->company->name }}</h3>
										</div>
										@if (file_exists($_SERVER['DOCUMENT_ROOT'].$coupon->publication->urlImage))
											<img style="width:100%;" src="{{ asset($coupon->publication->urlImage) }}" alt="Card image cap">
										@else
											<div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;">
												<p>Sin imagen</p>
											</div>
										@endif
										<div class="container" style="background-color:white">
											<h2><b>{{ $coupon->publication->title }}</b></h2>
											<p>{{ $coupon->publication->description }}</p>
										</div>
										<div class="container-coupon">
											<p>Generar código de promoción: <button type="button" class="btn btn-primary promo">Generar</button></p>
											<p class="expire">Expira: {{ \Carbon\Carbon::parse($coupon->publication->expiration_date)->toDateString() }}</p>
										</div>
									</div>
								</div>
								<br><br><br><br>
								@if(fmod($key, 2)==1)
						</div>
					@endif
				@endif
				@endif
			@endforeach
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="main">
				<h2>Cupones inactivos</h2>
			</div>
			@foreach ($coupons as $key=>$coupon)
				@if(\Carbon\Carbon::parse($coupon->publication->expiration_date) < \Carbon\Carbon::now())
					@if (fmod($key, 2)==0)
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="coupon">
									<div class="container-coupon">
										<h3>{{ $coupon->publication->company->name }}</h3>
									</div>
									@if (file_exists($_SERVER['DOCUMENT_ROOT'].$coupon->publication->urlImage))
										<img style="width:100%;" src="{{ asset($coupon->publication->urlImage) }}" alt="Card image cap">
									@else
										<div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;">
											<p>Sin imagen</p>
										</div>
									@endif
									<div class="container" style="background-color:white">
										<h2><b>{{ $coupon->publication->title }}</b></h2>
										<p>{{ $coupon->publication->description }}</p>
									</div>
									<div class="container-coupon" style="text-align: center">
										<button type="button" class="btn btn-primary">Quitar de la cuponera</button>
									</div>
								</div>
							</div>
							@else
								<div class="col-md-6 col-sm-12">
									<div class="coupon">
										<div class="container-coupon">
											<h3>{{ $coupon->publication->company->name }}</h3>
										</div>
										@if (file_exists($_SERVER['DOCUMENT_ROOT'].$coupon->publication->urlImage))
											<img style="width:100%;" src="{{ asset($coupon->publication->urlImage) }}" alt="Card image cap">
										@else
											<div style="width: 100%; height: auto; background-color: grey;color:white;padding:50px;text-align: center;">
												<p>Sin imagen</p>
											</div>
										@endif
										<div class="container" style="background-color:white">
											<h2><b>{{ $coupon->publication->title }}</b></h2>
											<p>{{ $coupon->publication->description }}</p>
										</div>
										<div class="container-coupon" style="text-align: center">
											<button type="button" class="btn btn-primary">Quitar de la cuponera</button>
										</div>
									</div>
								</div>
								<br><br><br><br>
								@if(fmod($key, 2)==1)
						</div>
					@endif
				@endif
				@endif
			@endforeach
		</div>
	</div>
</div>
<br>
@endsection

@section('scripts')
	<script>
		$('table.table').dataTable({
			language: {
				url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
			}
		});
	</script>
@endsection