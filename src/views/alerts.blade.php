@if (isset($error) && count($error))
	<div class="row">
		<div class="col-xs-12">
			<div class="alert-box alert radius">
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
			<div class="alert-box success radius">
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
			<div class="alert-box success radius">
				{{ $message }}
			</div>
		</div>
	</div>
@endif
@if ($message = Session::get('error'))
	<div class="row">
		<div class="col-xs-12">
			<div class="alert-box alert radius">
				{{ $message }}
			</div>
		</div>
	</div>
@endif