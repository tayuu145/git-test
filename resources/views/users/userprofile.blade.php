@extends('layouts.login')

@section('content')
<div class="ontainer-a">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
          <!-- 重要な箇所ここから -->

          @csrf
          <div class="userprofile">
            <p><img src="{{ asset($users->images) }}" class="icon magintop20 maru"></p>
            <div class="userprofile-name">
              <p class="p-magi30">name 　　　　　{{$users->username}}</p>
              <p class="p-magi30">bio　　　　　　{{$users->bio}}</p>
            </div>
            @if (auth()->user()->isFollowed($users->id))
            @endif
            <div class="userprofile-b">
              @if (Auth::user()->isFollowing($users->id))
              <form action="{{ route('unfollow', ['id' => $users->id]) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}

                <button type="submit" class="btn-f btn-follow">フォロー解除</button>
              </form>
              @else
              <form action="{{ route('follow', ['id' => $users->id]) }}" method="POST">
                {{ csrf_field() }}

                <button type="submit" class="btn-f btn-followed">フォローする</button>
              </form>
              @endif
            </div>
          </div>


          <table class="table-eria">
            <!-- テーブルヘッダ -->
            <thead>
              <th></th>
              <th> </th>
            </thead>
            <!-- テーブル本体 -->
            <tbody>
              <div class="post-box">
                @foreach ($posts as $post)
                <tr>

                  <!-- 投稿ID -->
                  <td class="table-icon">
                    <div><a href=""><img src="{{ asset($post->user->images) }}" class="maru" width="45" height="45"></a> </div>
                  </td>

                  <!-- 投稿詳細 -->
                  <td class="table-text">
                    <div>
                      <p>{{$post->user->username}}</p>
                    </div>
                    <div class="magintop10">{{ $post->post }}</div>
                  </td>
                  <td class="content">
                    <div>
                      <p> {{$post->created_at}}</p>
                    </div>
                  </td>

                </tr>
                @endforeach

              </div>

            </tbody>
          </table>
          <br />
          <!-- 重要な箇所ここまで -->
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
