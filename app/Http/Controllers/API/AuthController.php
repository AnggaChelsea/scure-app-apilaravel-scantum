<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;


class AuthController extends BaseController
{
    
    public function signin(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();
            $success['token'] = $authUser->createToken('MyAuthApp')->plainTextToken;
            $success['name'] =  $authUser->name;
            $success['level'] =  $authUser->level;
            $success['password'] =  $authUser->password;
            return $this->sendResponse($success, 'User success Masuk ');
        } else {
            return $this->sendError('unauthorize,. tidak ke detect', ['error' => 'belum terigter']);
        }
    }
    public function signup(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:2',
                'email' => 'required|email|',
                'level' => 'required',
                'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'confirm_password' => 'required|same:password'
            ]
        );

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }
        $input = $request->all();
        $input['level'] = $input['level'];
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] = $user->name;
        $success['level'] = $user->level;

        return $this->sendResponse($success, 'User terdaftar');
    }


}
