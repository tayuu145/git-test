<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    //
    public function index()
    {
        $posts = Post::with("user")->whereIn('user_id', Auth::user()->follows()->pluck('followed_id'))->orWhere('user_id', Auth::user()->id)->latest()->get();
        $users = User::get();
        $user_id = Auth::id();

        return view('posts.index', compact('posts', 'users', 'user_id'));
    }

    public function followlist()
    {
        $following_id = Auth::user()->follows()->pluck('followed_id');

        // フォローしているユーザーのidを元に投稿内容を取得

        $posts = Post::with("user")->whereIn('user_id', Auth::user()->follows()->pluck('followed_id'))->latest()->get();

        $users = User::query()->whereIn('id', Auth::user()->follows()->pluck('followed_id'))->latest()->get();

        return view('follows.followList', compact('posts', 'users'));
    }

    public function followerlist()
    {
        $followed_id = Auth::user()->followers()->pluck('following_id');

        // フォローしているユーザーのidを元に投稿内容を取得
        $posts = Post::with("user")->whereIn('user_id', Auth::user()->followers()->pluck('following_id'))->latest()->get();

        $users = User::query()->whereIn('id', Auth::user()->followers()->pluck('following_id'))->latest()->get();

        return view('follows.followerList', compact('posts', 'users'));
    }

    public function create()
    {
        return view('posts/create');
    }

    // 投稿内容登録処理 <wakaranai> </wakaranai>
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'post' => 'required|string|between:1,200',
        ]);

        if ($validator->fails()) {
            return redirect('/top')
                ->withInput()
                ->withErrors($validator);
        }
        // postsテーブルの情報を変数に格納
        $posts = new Post;
        // $posts->id = $request->id;
        // $posts→カラム名＝リクエストしたpostをいれる
        $posts->user_id = $request->user_id;
        $posts->post = $request->post;
        // 覚える全体
        $posts->save();
        return redirect('/top');
    }

    // // DBからpostのデータを取得し、withの中に渡したい名前を以下の形式のように同じ名前でならべる。
    //     public function list()
    // {
    //     $posts = Post::get();

    //     return view('posts.create')->with([
    //         'posts'=> $posts
    //     ]);
    // }

    /**
     * 編集画面の表示
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $posts = Post::get();

        return view('posts.index', compact('post', 'posts'));
    }
    // 編集更新処理
    public function update(Request $request)
    {
        // 1つ目の処理        ↓nameが入る
        $id = $request->input('update-id');
        $up_post = $request->input('update-text');
        // 2つ目の処理　　引数左カラムに右変数に更新(↓uodateによって)
        Post::where('id', $id)->update(['post' => $up_post]);
        // 3つ目の処理
        return redirect('/top');
    }
    // 投稿削除処理
    public function delete($id)
    {
        //   このIDがあるかpostテーブルから取得し。変数に格納
        $item = Post::findOrFail($id);
        $item->delete();
        return redirect('/top');
    }
}
