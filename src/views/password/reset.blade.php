@extends('core::template')

@section('title', 'Forgot Password')

@section('content')
	<section class="main">
		<div class="content">
			<div class="row">
				<div class="medium-12 small-12 columns">
					<h2>Reset Password</h2>
					{{ Form::open(array('url' => 'password/reset')) }}
						<div class="row">
							<div class="form-group col-md-4">
								{{ Form::label('email','E-mail') }}
								{{ Form::text('email', null, array('class'=>'form-control')) }}
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4">
								{{ Form::label('password','New Password') }}
								{{ Form::password('password', array('class'=>'form-control')) }}
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4">
								{{ Form::label('password_confirmation','Verify New Password') }}
								{{ Form::password('password_confirmation', array('class'=>'form-control')) }}
							</div>
						</div>
						<input type="submit" value="Submit" class="btn btn-primary button" />
						{{ Form::hidden('token',$token) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</section>
@stop




