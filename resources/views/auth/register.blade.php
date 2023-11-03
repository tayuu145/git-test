@extends('layouts.logout')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		<!-- ↓送られたerror名 -->
		@foreach ($errors->all() as $validator)
		<li>{{ $validator }}</li>
		@endforeach
	</ul>
</div>
@endif

{!! Form::open(['url' => '/register']) !!}

<h2 class="senter">新規ユーザー登録</h2>

{{ Form::label('user name') }}
{{ Form::text('username',null,['class' => 'input']) }}

{{ Form::label('mail adress') }}
{{ Form::text('mail',null,['class' => 'input']) }}

{{ Form::label('password') }}
{{ Form::password('password',['class' => 'input']) }}

{{ Form::label('password-confirm') }}
{{ Form::password('password_confirmation',['class' => 'input']) }}

{{ Form::submit('REGISTER',['class' => 'login-b']) }}

<p class="senter-a top-m20px"><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}




@endsection
