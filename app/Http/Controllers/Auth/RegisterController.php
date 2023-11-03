<?php


namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    // バリテーション
    protected function validator(array $data)
    {
        // ↓(検証する配列値(名前),検証ルール)
        return Validator::make($data, [
            'username' => 'required|string|between:2,12',
            'mail' => 'required|string|email|between:5,40|unique:users',
            'password' => 'required|string|between:8,20|alpha_num|confirmed',
            'password_confirmation' => 'required|',
        ]);
        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            // ddd($request->username);

            $data = $request->input();
            $validator = $this->Validator($data);

            // バリデーションよびだし
            if ($validator->fails()) {
                return redirect('/register')
                    ->withInput()
                    // ()内でerror送るよ
                    ->withErrors($validator);
            }

            // createメソッドが実行
            $this->create($data);
            // セッションでサーバに保存
            session(['UserName' => $data['username']]);

            return redirect('added');
            // ↑でaddedにとんでるため以降は無視される①まで

            // ①まで
        }
        return view('auth.register');
    }

    public function added()
    {
        return view('auth.added');
    }
}
