@extends('core::template')

@section('title', 'Forgot Password')

@section('content')
	<section class="main">
		<div class="content">
			<div class="row">
				<div class="medium-12 small-12 columns">
					<h2>Forgot Password</h2>
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
								<td valign="top"></td>
								<td><input type="submit" value="Submit"></td>
							</tr>
						</table>
						{{ Form::hidden('url',Request::url()) }}
						{{ Form::hidden('redirect',(Input::get('redirect') ? Input::get('redirect') : "/")) }}
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</section>
@stop




