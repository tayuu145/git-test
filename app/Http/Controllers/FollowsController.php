<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Http\Request;
use App\User;
use APP\Post;

class FollowsController extends Controller
{
    //
    public function followList()
    {
        // $posts = Post::query()->whereIn('user_id', Auth::user()->follows()->pluck('followed_id'))->orWhere('user_id', Auth::user()->id)->latest()->get();;
        $users = User::get();

        return view('follows.followList', compact('users'));
    }
    public function followerList()
    {
        return view('follows.followerList');
    }

    public function follow($id)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($id);

        // $followCount = count(Follow::where('following_id')->get());
        if (!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($id);
            return back();
            // ->with('followCount', $followCount);
        }
    }

    // フォロー解除
    public function unfollow($id)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($id);
        if ($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($id);
            return back();
        }
    }
}
