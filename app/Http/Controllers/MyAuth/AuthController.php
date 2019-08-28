<?php

namespace App\Http\Controllers\MyAuth;

use App\User;
use App\ForgetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MyAuth\MailController as MailCont;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
//add valid
        $input = $request->except('conf_password');
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'unique:users', 'max:20', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        if($validator ->fails()){
            $failed = $validator->messages();
            return response([$failed, 'status' => 'fail',],200);
        }
        else
        {
            //if OK
            $token=random_int( 100, 99999999999 ) ;
            $new_mail = new MailCont;
          //  $new_mail-> send($token);

            $user = new User;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->verified_token = $token;
            $user->save();

            return response([
                'status' => 'success',
                'data' => $user
            ], 200);
        }

    }


    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        //if invalid log or pass
        if ( ! $token = JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }
        else
        {
            $user = User::where('email','=',$request->email) ->first();
            if(( $user ) && ($user->verified == '1')) {
                return response([
                    'status' => 'success'
                ])->header('Authorization', $token);
            }
            else
            {
                return response([
                    'status' => 'error',
                    'error' => 'invalid.credentials',
                    'msg' => 'Invalid Credentials.'
                ], 400);
            }
        }

        //end if

    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }
    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }

    public function logout()
    {
        JWTAuth::invalidate();
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function confirmToken(Request $request)
    {
        //protect from 0
        if($request->tok =='0')
        {
            return response([

                'status' => 'Ошибка подтверждения токена',
            ]);
        }

        //verification usera
        $user = User::where('verified_token','=',$request->tok) ->first();
        if($user === null)
        {
            return response([
                'status' => 'Ошибка подтверждения токена',
            ]);
        }
        else
        {
            $user->verified_token = '0';
            $user->verified = '1';
            $user->save();
            return response([
                'status' => 'Токен подтверждён успешно',
            ]);
        }

    }

    public function forgetPassword(Request $request)
    {
        $user = User::where('email','=',$request->email) ->first();

        if(( $user ) && ($user->verified == '1')) {
            $new_mail = new MailCont;
            $id = $user->id;
            $email = $user->email;
            $token=random_int( 100, 99999999999 ) ;
            //NEED TO ADD EMAIL!!!
           // $new_mail-> sendForget($token, $id );

                //model ForgetPassword
               $us_tok = $user->forget_pas;
               $us_tok::create([
                'token' => $token,
                'user_id' => $id,
            ]);

            return response([
                'status' => 'success',
                'data' => 'token created'
            ], 200);

        }

        else
        {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }

    }

    public function if_exist(Request $request)
    {
        $user = ForgetPassword::where([['user_id','=',$request->id],
            ['token', '=', $request->token]]) ->first();
        if( $user ) {
            $input = $request->except('token', 'user_id');
            $validator = Validator::make($input, [
                'password' => ['required', 'string', 'min:6'],
            ]);
            if($validator ->fails()){
                return response([
                    'status' => 'error',
                    'error' => 'invalid.credentials',
                    'msg' => 'Invalid Credentials.'
                ], 400);
            }

            else {
                $user = User::where('id', '=', $request->id)->first();
                $user->password = Hash::make($request->password);
                $user->save();


                return response([
                    'status' => 'success',
                ], 200);
            }

        }
        else
        {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }


    }


}
