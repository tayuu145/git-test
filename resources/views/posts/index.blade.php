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

<div>
  <form action="/newpost" method="POST" class="toukou">
    @csrf
    <div class="post-in">
      <div>
        <!-- かくして、ログインユーザー名おくるよ -->
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}" />
        <img src="{{ asset(Auth::user()->images) }}" class="post-image maru" width="45" height="45">
      </div>
      <div>
        <textarea class="text-eria" name="post" placeholder="投稿内容を入力してください。"></textarea>
      </div>
      <button class="button-post"><img src="images\post.png" class="post-btn"></button>
    </div>
  </form>
</div>
<!-- 全ての投稿リスト -->
@if (count($posts) > 0)
<div class="card-body">
  <div class="card-body">
    <table class="table-eria">
      <!-- テーブルヘッダ -->

      <!-- テーブル本体 -->
      <tbody>
        @foreach ($posts as $post)
        <tr>
          <div class="post-box">
            <!-- 投稿ID -->
            <td class="table-icon">
              <div><a href="{{ route('userprofile', ['id' => $post->user_id ]) }}"><img src="{{ asset($post->user->images) }}" class="maru" width="45" height="45"></a> </div>

            </td>
            <!-- 投稿詳細 -->
            <td class="table-text">
              <div>
                <p>{{$post->user->username}}</p>
              </div>
              <div class="magintop10">{{ $post->post }}</div>
            </td>
            <td class="content">
              <p class="magin-b20">{{$post->created_at}}</p>
              @if ($user_id == $post->user_id)
              <div class="disp-flex">
                <div>
                  <!-- 投稿の編集ボタン -->
                  <!-- 　　　　　　　　　　{/* ↓押したときにリンクに飛ばしたくない編集できてないから */} -->
                  <a class="js-modal-open" href="" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="images/edit.png" width="40" height="40"></a>
                </div>

                <!-- < !--モーダルの中身 -->
                <div class="modal js-modal">
                  <div class="modal__bg js-modal-close"></div>
                  <div class="modal__content">
                    <!-- {/* 　　↓ここで飛ばしたいリンクに　　nameや書いてないところをかく */} -->
                    <form action="{{ route('update', ['id' => $post->id]) }}" method="POST">
                      <textarea name="update-text" class="modal_post"></textarea><br>
                      <input type="hidden" name="update-id" class="modal_id" value="">
                      <input type="image" src="images/edit.png" width="40" height="40" value="更新">
                      {{ csrf_field() }}
                    </form>
                    <a class="js-modal-close" href="">閉じる</a>
                  </div>
                </div>
                <!-- 投稿削除 -->
                <a class="btn btn-danger" href="/posts/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"><img src="images/trash.png" width="40" height="40"></a>

                </form>
              </div>
              @endif
            </td>
            <!-- <td class="content">

            </td> -->
          </div>
        </tr>
        @endforeach</td>

  </div>
  </td>

  </tbody>
  </table>
</div>
</div>
@endif


@endsection
