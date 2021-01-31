<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;
class CommentController extends Controller
{
    public function create(Request $request) {
        $user = Auth::user();
        $comment = Comment::create(
            [
                "text" => $request->text,
                "book_id" => $request->book_id,
                "user_id" => $user->id
            ]
        );
        return response()->json([$comment]);
    }

    public function index() {
        $comments = Comment::all();
        return response()->json(['comments' => $comments],200);
    }

    public function show($id) {
        $comment = Comment::find($id);
        return response()->json(['comment' => $comment],200);
    }

    public function update(Request $request,$id) {
        $comment = Comment::find($id);
        if($request->text){
            $comment->text = $request->text;
        }
        $comment->save();
        return response()->json(['comment' => $comment],200);
    }

    public function destroy($id) {
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json(['Livro deletado com sucesso!' => $comment],200);
    }
}
