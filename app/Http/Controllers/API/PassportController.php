<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class PassportController extends Controller
{
    public function register(Request $request)
    {
        $newuser = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'rating' => 0
        ]);
        $success['token'] = $newuser->createToken('MyApp')->accessToken;
        $newuser->save();
        return response()->json(['success' => $success, 'user' => $newuser], 200);
        
    }

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success, 'user' => $user], 200);
        } else {
            return response()->json(['error' => 'Usuário não cadastrado!', 'status' => 401]);
        } 
    }

    public function getDetails(){
        $user = Auth::user();
        return response()->json(['success'=> $user], 200);
    }

    public function logout(){
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')->where('access_token_id', $accessToken->id)->update(['revoked'=>true]);
        $accessToken->revoke();
        return response()->json(['Usuário deslogado'], 200);
    }
}
