@if (isset($error) && count($error))
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-warning">
				@foreach ($error as $message)
					<p>{{ $message }}</p>
				@endforeach
			</div>
		</div>
	</div>
@endif
@if (isset($success) && count($success))
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-success">
				@foreach ($success as $message)
					<p>{{ $message }}</p>
				@endforeach
			</div>
		</div>
	</div>
@endif
@if ($message = Session::get('status'))
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-success">
				{{ $message }}
			</div>
		</div>
	</div>
@endif
@if ($message = Session::get('error'))
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-warning">
				{{ $message }}
			</div>
		</div>
	</div>
@endif