<?php

namespace App\Http\Controllers\Auth;

use App\Mail\EmailVerification;
use App\User;
use App\University;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\registeredValiRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

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
    protected $redirectTo = '/';

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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => 'required|string|max:255', // 仮登録時のバリデーションは名前を含まないため
            'email' => 'bail|required|string|email|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function preCheck(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $user = User::where('email', $request->email)->first();
            if ($validator->errors()->has('email') && $user != null) {
                $created_at = Carbon::parse($user->created_at)->format('Y年m月d日');
                return redirect('register')
                            ->with('status', $created_at)
                            ->withErrors($validator)
                            ->withInput();
            } else {
                return redirect('register')
                            ->withErrors($validator)
                            ->withInput();
            }
        }

        $request->flashOnly('email');

        $bridge_request = $request->all();
        // passeord マスキング
        $bridge_request['password_mask'] = '******';

        return view('auth.register_check')->with($bridge_request);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => bcrypt($data['password']),
        // ]); 初期のユーザー作成のソースコード

        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verify_token' => base64_encode($data['email']),
        ]);

        $email = new EmailVerification($user);
        Mail::to($user->email)->send($email);

        return $user;
    }

        public function register(Request $request)
    {
        event(new Registered($user = $this->create( $request->all() )));

        return view('auth.registered');
    }

    /**
     * [showForm description 本会員登録 入力画面]
     * @param  [type] $email_token
     * @return [type] \Illuminate\Contracts\View\Factory|\Illuminate\View
     */
    public function showForm($email_token)
    {
        // 使用可能なトークンかを確認
        if (!User::where('email_verify_token', $email_token)->exists() ){
            return view('auth.register_main')->with('message', '無効なトークンです');
        } else {
            $user = User::where('email_verify_token', $email_token)->first();
            // 本登録済みユーザーかを確認
            if ($user->status == config('const.USER_STATUS.REGISTER')) {
                logger("status".$user->status);
                return view('auth.register_main')->with('message', '既に登録されています。ログインして利用してください。');
            } //REGISTER=1
            // ユーザーステータスの更新
            // $user->status = config('const.USER_STATUS.MAIL_AUTHED');
            $user->email_verified = config('const.USER_STATUS.MAIL_AUTHED');
            if ($user->save()) {
                $universities = University::all();
                return view('auth.register_main', compact('email_token', 'universities'));
            } else {
                return view('auth.register_main')->with('message', 'メール認証に失敗しました。再度、メールからリンクをクリックしてください。');
            }
        }
    }

    /**
     * [mainCheck description 本会員登録 確認画面]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function mainCheck(registeredValiRequest $request)
    {
        // データ保存用
        $email_token = $request->email_token;
        // User インスタンスを生成し view に渡す
        $user = new User();
        $user->name = $request->name;
        $user->name_phonetic = $request->name_phonetic;
        $user->birth_year = $request->birth_year;
        $user->birth_month = $request->birth_month;
        $user->birth_day = $request->birth_day;
        $user->university = University::find($request->university);
        $user->admission_year = $request->admission_year;

        return view('auth.register_main_check', compact('user', 'email_token'));
    }

    public function mainRegister(Request $request)
    {
        $user = User::where('email_verify_token', $request->email_token)->first();
        $user->status = config('const.USER_STATUS.REGISTER');
        $user->university_id = $request->university_id;
        $user->name = $request->name;
        $user->name_phonetic = $request->name_phonetic;
        $user->birth_year = $request->birth_year;
        $user->birth_month = $request->birth_month;
        $user->birth_day = $request->birth_day;
        $user->admission_year = $request->admission_year;
        $user->save();

        $this->guard()->login($user);

        return view('auth.registered_main');
    }
}
