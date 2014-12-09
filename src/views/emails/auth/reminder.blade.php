@extends('core::emails.template')
@section('content')
Someone has requested to reset your password. To do so, please visit the link below:<br /><br />

<a href="{{ url("password/reset/".$token) }}">{{ url("password/reset/".$token) }}</a><br /><br />

If you feel you received this e-mail in error, please ignore it.
@stop