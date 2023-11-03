@extends('layouts.login')

@section('content')
<h2>編集画面</h2>
<div class="container small">
  <h1>内容を編集</h1>
  <form action="{{ route('post.update', ['id'=>$post->post]) }}" method="POST">
  @csrf
    <fieldset>
      <div class="form-group">
        <label for="post_name">{{ __('内容') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <input type="text" class="form-control" name="post_name" id="post_name">
      </div>
      <div class="d-flex justify-content-between pt-3">
        <a href="{{ route('posts.create') }}" class="btn btn-outline-secondary" role="button">
            <i class="fa fa-reply mr-1" aria-hidden="true"></i>{{ __('一覧画面へ') }}
        </a>
        <button type="submit" class="btn btn-success">
            {{ __('更新') }}
        </button>
      </div>
    </fieldset>
  </form>
</div>



@endsection
