<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use App\Post;
use Auth;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    //
    public function profile()
    {

        return view('users.profile');
    }
    // protected function validator(array $data)
    // {
    //     // ↓(検証する配列値(名前),検証ルール)
    //     return Validator::make($data, [
    //         'username' => 'required|string|max:255',
    //         'mail' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|between:1,10|alpha_num',
    //         'password-confirm' => 'required|'
    //     ]);
    //     return $validator;
    // }
    public function profiledit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,12',
            'mail' => 'string|email|between:5,40|unique:users',
            'password' => 'string|between:8,20|alpha_num',

            'bio' => 'max:150',
            'icon' => 'image'
        ]);

        if ($validator->fails()) {
            return redirect('/profile')
                ->withInput()
                ->withErrors($validator);
        }
        $id = $request->input('id');
        $username = $request->input('name');
        $mail = $request->input('mail');
        $password = $request->input('password');
        $bio = $request->input('bio');
        // $icon = $request->file('icon');

        // パブリックフォルダに画像を保存とDBにファイルパスを保存
        // file('icon')はformのfileタイプの名前を参照
        $dir = 'images';
        $file_name = $request->file('icon')->getClientOriginalName();
        // 非公開のパブリック側に画像保存するよシンボリックリンクしている非公開ところに
        $request->file('icon')->storeAs('public/' . $dir, $file_name);
        // DBには表向きのアクセスできるパスを保存
        $icon = 'storage/' . $dir . '/' . $file_name;


        // 2つ目の処理　　引数左カラムに右変数に更新(↓uodateによって)
        User::where('id', $id)->update([
            'username' => $username,
            'mail' => $mail,
            //            暗号化したままDBに保存
            'password' => bcrypt($password),
            'bio' => $bio,
            'images' => $icon,
        ]);

        return redirect('/top');
    }

    public function search()
    {

        $users = User::get();
        return view('users.search', compact('users'));
    }

    public function searching(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $_search = str_replace('　', ' ', $search);
            $_search = preg_replace('/\s(?=\s)/', '', $search);
            $_search = trim($search);

            $query = User::query();

            $query->where('username', 'LIKE', '%' . $search . '%');
            $query->orderBy('created_at', 'desc')->get();
            $users = $query;
            $users = $query->get();
        } else {
            $users = User::get();
        }


        return view('users.search', compact('users', 'search'));
    }

    public function userprofile($id)
    {
        $users = User::where('id', $id)->first();
        $posts = Post::with("user")->where('user_id', $id)->get();
        return view('users.userprofile', compact('users', 'posts'));
    }
}
