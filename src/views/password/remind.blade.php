@extends('core::template')

@section('title', 'Forgot Password')

@section('content')
	<section class="main">
		<div class="content">
			<div class="row">
				<div class="medium-12 small-12 columns">
					<h1>Forgot Password</h1>
					Enter the e-mail you used when signing up and we'll send you instructions on how you can' reset your password!<br /><br />
					
					{{ Form::open() }}
						{{ Form::label('email','E-mail') }}</td>
						{{ Form::text('email', null, array('class'=>'form-control')) }}
						<input type="submit" value="Submit" class="btn btn-primary button" />
						{{ Form::hidden('url',Request::url()) }}
						{{ Form::hidden('redirect',(Input::get('redirect') ? Input::get('redirect') : "/")) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</section>
@stop




