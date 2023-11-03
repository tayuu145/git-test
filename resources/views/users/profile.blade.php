@extends('layouts.login')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    <!-- ↓送られたerror名 -->
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
          <img src="{{ asset(Auth::user()->images) }}" class="icon-profile maru">
          <!-- 重要な箇所ここから -->
          <form action="/profil_edit" method="POST" enctype="multipart/form-data" class="profile-form">
            @csrf

            <input type="hidden" name="id" value="{{Auth::user()->id}}" />
            <div class="profile">
              <p class="font24">user name　　</p>
              <input type="text" class="profile-box" name="name" value="{{Auth::user()->username}}" />
            </div>
            <div class="profile">
              <p class="font24">mail adress　　</p>
              <input type="text" class="profile-box" name="mail" value="{{Auth::user()->mail}}" />
            </div>
            <div class="profile">
              <p class="font24">password　　</p>
              <input type="password" class="profile-box" name="password" value="" />
            </div>
            <div class="profile">
              <p class="font24">password comfirm　　</p>
              <input type="password" class="profile-box" name="password-comfirm" value="" />
            </div>
            <div class="profile">
              <p class="font24">bio　　</p>
              <input type="text" class="profile-box" name="bio" value="{{Auth::user()->bio}}" />
            </div>
            <div class="profile">
              <p class="font24">icon image　　</p>
              <label>
                <input type="file" class="profile-box file" name="icon" value="{{Auth::user()->images}}" />ファイルを選択
              </label>
            </div>

            <br />
            <input type="submit" class="submit-profile" value="更新" />
          </form>
          <!-- 重要な箇所ここまで -->
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
