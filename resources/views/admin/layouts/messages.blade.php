@if( count( $errors->all() ) > 0 )

	<div class="alert alert-danger">
		<ul>
		@foreach($errors->all() as $error)
			
			<li>{{ $error }}</li>

		@endforeach
		</ul>
	</div>

@endif

@if( session()->has('Success') )

	<div class="alert alert-success">
		<h3>{{ session('Success') }}</h3>
	</div>

@endif

@if( session()->has('Error'))

	<div class="alert alert-danger">
		<h3>{{ session('Error') }}</h3>
	</div>

@endif

@if( session()->has('error'))

	<div class="alert alert-danger">
		<h5>{{ session('error') }}</h5>
	</div>

@endif