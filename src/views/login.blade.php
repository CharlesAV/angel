@extends('core::template')

@section('title', 'Login')

@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			{{ Form::open(array('role'=>'form')) }}
				<h1>Login</h1>
				<div class="form-group">
					{{ Form::label('loguser', 'Username or Email', array('class'=>'sr-only')) }}
					{{ Form::text('loguser', null, array('class'=>'form-control', 'placeholder'=>'Username or Email', 'autofocus')) }}
				</div>
				<div class="form-group">
					{{ Form::label('logpass', 'Password', array('class'=>'sr-only')) }}
					{{ Form::password('logpass', array('class'=>'form-control', 'placeholder'=>'Password')) }}
				</div>
				<div style="float:right;font-size:13px;">
					<a href="/register">Register</a>
					&bull;
					<a href="/password/remind">Forogt Password</a>
				</div>
				<div class="checkbox">
					<label>
						{{ Form::checkbox('remember') }}
						Remember Me
					</label>
				</div>
				<p class="text-right">
					<input type="submit" class="btn btn-primary button" value="Sign In" />
				</p>
			{{ Form::hidden('redirect',(Input::get('redirect') ? Input::get('redirect') : "/")); }}
			{{ Form::hidden('url',Request::url()); }}
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop