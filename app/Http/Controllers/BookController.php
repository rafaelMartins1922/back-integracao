<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Auth;

class BookController extends Controller
{
    public function create(Request $request) {
        $user = Auth::user();

        $book = Book::create(
            ["name" => $request->name,
            "author" => $request->author,
            "genre" => $request->genre,
            "price" => $request->price,
            "summary" => $request->summary,
            "condition" => $request->condition,
            "user_id" => $user->id
            ]
        );
        return response()->json([$book]);
    }

    public function index() {
        $books = Book::all();
        return response()->json(['books' => $books],200);
    }

    public function show($id) {
        $book = Book::find($id);
        return response()->json(['book' => $book],200);
    }

    public function update(Request $request,$id) {
        $book = Book::find($id);
        if($request->name){
            $book->name = $request->name;
        }
        if($request->author){
            $book->author = $request->author;
        }
        if($request->genre){
            $book->genre = $request->genre;
        }
        if($request->price){
            $book->price = $request->price;
        }
        if($request->summary){
            $book->summary = $request->summary;
        }
        if($request->condition){
            $book->condition = $request->condition;
        }
        $book->save();
        return response()->json(['book' => $book],200);
    }

    public function destroy($id) {
        $book = Book::find($id);
        $book->delete();
        return response()->json(['Livro deletado com sucesso!' => $book],200);
    }

    public function rate(Request $request, $id){
        $book = Book::find($id);
        $book->rating_sum+=$request->rating;
        $book->amount_rates++;
        $book->avg_rating = $book->rating_sum/$book->amount_rates;
        $book->save();
        return response()->json(['book' =>$book, "avg_raating" => $book->avg_rating],200);
    }

    public function sell($id) {
        $book = Book::find($id);
        $book->amount_sold++;
        $book->save();
        return response()->json(["book" => $book, "amount sold" => $book->amount_sold],200);
    }

    public function mostSold() {
        $books =  Book::orderBy('amount_sold','desc')->get();
        return response()->json(["most sold books" => $books]);
    }

    public function mostWellRated() {
        $books =  Book::orderBy('avg_rating','desc')->get();
        return response()->json(["most well rated books" => $books]);
    }
}
