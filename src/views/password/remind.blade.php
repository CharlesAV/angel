@extends('core::template')

@section('title', 'Forgot Password')

@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<h1>Forgot Password</h1>
			Enter the e-mail you used when signing up and we'll send you instructions on how you can' reset your password!<br /><br />
			
			{{ Form::open(array('class' => 'form-horizontal password-remind')) }}
				<div class="row">
					<div class="form-group">
						{{ Form::label('email','E-mail',array('class' => 'col-md-1 control-label')) }}
						<div class="col-md-3">
							{{ Form::text('email', null, array('class'=>'form-control')) }}
						</div>
						<div class="col-md-3">
							<input type="submit" value="Submit" class="btn btn-primary button" />
						</div>
					</div>
				</div>
				{{ Form::hidden('url',Request::url()) }}
				{{ Form::hidden('redirect',(Input::get('redirect') ? Input::get('redirect') : "/")) }}
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop




