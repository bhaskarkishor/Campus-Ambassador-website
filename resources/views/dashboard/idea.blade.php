@extends('voyager::master')

@section('page_header')
<div class="page-title">
    Share Your Thoughts
</div>
@stop

@section('content')
You received a message from : {{ $name }}
<p>
Name: {{ $name }}
</p>
<p>
Email: {{ $email }}
</p>
<p>
Message: {{ $user_message }}
</p>
@stop