@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<p class="senter">AtlasSNSへようこそ</p>
{{ Form::label('mail adress') }}<br>
{{ Form::text('mail',null,['class' => 'input']) }}<br>
{{ Form::label('password') }}<br>
{{ Form::password('password',['class' => 'input']) }}<br>
{{ Form::submit('LOGIN',['class' => 'login-b']) }}

<p class="senter"><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

@endsection
