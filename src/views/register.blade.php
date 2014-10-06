@extends('core::template')

@section('title', 'Login')

@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			{{ Form::open(array('role'=>'form')) }}
				<h1>Register</h1>
				<div class="form-group">
					{{ Form::label('username', 'Username') }}
					{{ Form::text('username', null, array('class'=>'form-control', 'autofocus')) }}
				</div>
				<div class="form-group">
					{{ Form::label('email', 'Email') }}
					{{ Form::email('email', null, array('class'=>'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('password', 'Password') }}
					{{ Form::password('password', array('class'=>'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::label('password_confirmation', 'Confirm Password') }}
					{{ Form::password('password_confirmation', array('class'=>'form-control')) }}
				</div>
				<p class="text-right">
					<input type="submit" class="btn btn-primary button" value="Register" />
				</p>
				{{ Form::hidden('redirect',(Input::get('redirect') ? Input::get('redirect') : "/")); }}
				{{ Form::hidden('url',Request::url()); }}
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop