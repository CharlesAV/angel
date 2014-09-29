@extends('core::template')

@section('title', 'Forgot Password')

@section('content')
	<section class="main">
		<div class="content">
			<div class="row">
				<div class="medium-12 small-12 columns">
					<h2>Reset Password</h2>
					{{ Form::open() }}
						<table>
							<tr>
								<td valign="top">{{ Form::label('email','E-mail') }}</td>
								<td>
									<div class="field-wrap">
										{{ Form::text('email') }}
									</div>
								</td>
							</tr>
							<tr>
								<td valign="top">{{ Form::label('password','New Password') }}</td>
								<td>
									<div class="field-wrap">
										{{ Form::password('password') }}
									</div>
								</td>
							</tr>
							<tr>
								<td valign="top">{{ Form::label('password_confirmation','Verify New Password') }}</td>
								<td>
									<div class="field-wrap">
										{{ Form::password('password_confirmation') }}
									</div>
								</td>
							</tr>
							<tr>
								<td valign="top"></td>
								<td><input type="submit" value="Submit"></td>
							</tr>
						</table>
						{{ Form::hidden('token',$token) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</section>
@stop




