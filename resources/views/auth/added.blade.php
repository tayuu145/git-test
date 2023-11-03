@extends('layouts.logout')

@section('content')

<div id="clear">
  <!-- ↓セッションから表示させる -->
  <p class="senter-a font-wei">{{ Session::get('UserName') }}さん</p>
  <p class="senter-a font-wei">ようこそ！AtlasSNSへ</p>
  <div class="add-setumei">
    <p>ユーザー登録が完了しました。<br>
      早速ログインをしてみましょう！</p>
  </div>
  <p class="add-b"><a href="/login">ログイン画面へ</a></p>
</div>
<!--  -->
@endsection
