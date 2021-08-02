@extends('layouts.master')
@section('active_categories')
	active
@endsection
@section('content')
<section id="content">
	<div class="container container-categories">
		<div class="row">
			<div class="col-md-12">
				<h4>A-D</h4>
			</div>
			@if($categoriesAD->count()>0)
			@foreach ($categoriesAD as $categoriaAD)
			<div class="col-sm-4 col-md-3">
				<a href="/categories/{{ $categoriaAD->id }}">
					<div class="row">
						<div class="col-4 text-center">
							@if ($categoriaAD->urlImage!=null && file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $categoriaAD->urlImage))
								<img src="{{ asset( $categoriaAD->urlImage) }}" class="img-fluid" alt="Image">
							@else
								<i class="fa fa-tags fa-lg" style="font-size: 2.33333em;"></i>
							@endif
							
						</div>
						<div class="col-8">
							<div class="row">
								{{$categoriaAD->shortDescription}}
							</div>
							<div class="row">
								{{$categoriaAD->publications->count()}} publicaciones
							</div>
						</div>
					</div>
				</a>
			</div>
			@endforeach
			@else
				<div class="container">
					<p>Sin resultados</p>	
				</div>
			@endif

			<div class="col-md-12">
				<h4>E-G</h4>
			</div>
			@if($categoriesEG->count()>0)
			@foreach ($categoriesEG as $categoriaEG)
			<div class="col-sm-4 col-md-3">
				<a href="/categories/{{ $categoriaEG->id }}">
					<div class="row">
						<div class="col-4 text-center" >
							@if ($categoriaEG->urlImage!=null && file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $categoriaEG->urlImage))
								<img src="{{ asset($categoriaEG->urlImage) }}" class="img-fluid" alt="Image">
							@else
								<i class="fa fa-tags fa-lg" style="font-size: 2.33333em;"></i>
							@endif
							
						</div>
						<div class="col-8">
							<div class="row">
								{{$categoriaEG->shortDescription}}
							</div>
							<div class="row">
								{{$categoriaEG->publications->count()}} publicaciones

							</div>

							
						</div>
					</div>
				</a>
			</div>
			@endforeach
			@else
				<div class="container">
					<p>Sin resultados</p>	
				</div>
			@endif

			<div class="col-md-12">
				<h4>H-K</h4>
			</div>
			@if($categoriesHK->count()>0)
			@foreach ($categoriesHK as $categoriaHK)
			<div class="col-sm-4 col-md-3">
				<a href="/categories/{{ $categoriaHK->id }}">
					<div class="row">
						<div class="col-4 text-center">
							@if ($categoriaHK->urlImage!=null && file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $categoriaHK->urlImage))
								<img src="{{ asset($categoriaHK->urlImage) }}" class="img-fluid" alt="Image">
							@else
								<i class="fa fa-tags fa-lg" style="font-size: 2.33333em;"></i>
							@endif
							
						</div>
						<div class="col-8">
							<div class="row">
								{{$categoriaHK->shortDescription}}
							</div>
							<div class="row">
								{{$categoriaHK->publications->count()}} publicaciones
							</div>
						</div>
					</div>
				</a>
			</div>
			@endforeach
			@else
				<div class="container">
					<p>Sin resultados</p>	
				</div>
			@endif

			<div class="col-md-12">
				<h4>L-O</h4>
			</div>

			@if($categoriesLO->count()>0)
			@foreach ($categoriesLO as $categoriaLO)
			<div class="col-sm-4 col-md-3">
				<a href="/categories/{{ $categoriaLO->id }}">
					<div class="row">
						<div class="col-4 text-center">
							@if ($categoriaLO->urlImage!=null && file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $categoriaLO->urlImage))
								<img src="{{ asset($categoriaLO->urlImage) }}" class="img-fluid" alt="Image">
							@else
								<i class="fa fa-tags fa-lg" style="font-size: 2.33333em;"></i>
							@endif
						</div>
						<div class="col-8">
							<div class="row">
								{{$categoriaLO->shortDescription}}
							</div>
							<div class="row">
								{{$categoriaLO->publications->count()}} publicaciones
							</div>
						</div>
					</div>
				</a>
			</div>
			@endforeach
			@else
				<div class="container">
					<p>Sin resultados</p>	
				</div>
				
			@endif

			<div class="col-md-12">
				<h4>P-S</h4>
			</div>

			@if($categoriesPS->count()>0)
			@foreach ($categoriesPS as $categoriaPS)
			<div class="col-sm-4 col-md-3">
				<a href="/categories/{{ $categoriaPS->id }}">
					<div class="row">
						<div class="col-4 text-center">
							@if ($categoriaPS->urlImage!=null && file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $categoriaPS->urlImage))
								<img src="{{ asset($categoriaPS->urlImage) }}" class="img-fluid" alt="Image">
							@else
								<i class="fa fa-tags fa-lg" style="font-size: 2.33333em;"></i>
							@endif
						</div>
						<div class="col-8">
							<div class="row">
								{{$categoriaPS->shortDescription}}
							</div>
							<div class="row">
								{{$categoriaPS->publications->count()}} publicaciones
							</div>
						</div>
					</div>
				</a>
			</div>
			@endforeach
			@else
				<div class="container">
					<p>Sin resultados</p>	
				</div>

			@endif

			<div class="col-md-12">
				<h4>T-Z</h4>
			</div>
			@if($categoriesTZ->count()>0)
			@foreach ($categoriesTZ as $categoriaTZ)
			<div class="col-sm-4 col-md-3">
				<a href="/categories/{{ $categoriaTZ->id }}">
					<div class="row">
						<div class="col-4 text-center">
							@if ($categoriaTZ->urlImage!=null && file_exists($_SERVER['DOCUMENT_ROOT'] . "/" . $categoriaTZ->urlImage))
								<img src="{{ asset($categoriaTZ->urlImage) }}" class="img-fluid" alt="Image">
							@else
								<i class="fa fa-tags fa-lg" style="font-size: 2.33333em;"></i>
							@endif
						</div>
						<div class="col-8">
							<div class="row">
								{{$categoriaTZ->shortDescription}}
							</div>
							<div class="row">
								{{$categoriaTZ->publications->count()}} publicaciones
							</div>
						</div>
					</div>
				</a>
			</div>
			@endforeach
			@else
				<div class="container">
					<p>Sin resultados</p>	
				</div>
			@endif
		</div>
		
	</div>
</section>
@endsection