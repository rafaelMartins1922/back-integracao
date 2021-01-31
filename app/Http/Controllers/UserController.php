<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create(Request $request) {
        $user = User::create(
            ["name" => $request->name,
            "email" => $request->email,
            "passord" => $request->password,
            "rating" => 0]
        );
        return response()->json([$user]);
    }

    public function index() {
        $users = User::all();
        return response()->json(['users' => $users],200);
    }

    public function show($id) {
        $user = User::find($id);
        return response()->json(['user' => $user],200);
    }

    public function update(Request $request,$id) {
        $user = User::find($id);
        if($request->name){
            $user->name = $request->name;
        }
        if($request->email){
            $user->email = $request->email;
        }
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        if($request->rating){
            $user->rating = $request->rating;
        }
        if($request->role){
            $user->role = $request->role;
        }
        $user->save();
        return response()->json(['user' => $user],200);
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return response()->json(['Livro deletado com sucesso!' => $user],200);
    }
}
