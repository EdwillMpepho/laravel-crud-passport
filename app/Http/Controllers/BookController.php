<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $book = Book::orderBy('created_at','desc')->paginate(1);
	    $book = Book::all();
        return $book;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $this->validate($request,[
          'title'  => 'required',
          'body'   => 'required'
        ]);


         $book = new Book();
         $book->title = $request->input('title');
         $book->body = $request->input('body');
         $book->user_id = auth()->user()->id;

         $book->save();
         return $book;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return $book;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'  => 'required',
            'body'   => 'required'
          ]);

        $book = Book::find($id);
        $book->title = $request->input('title');
        $book->body = $request->input('body');

        if($book->user_id !== auth()->user()->id){
           return response()->json(['message' => 'Unauthorized'], 401);
        }
        $book->save();
        return $book;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if($book->user_id !== auth()->user()->id){
            return response()->json(['message' => 'Unauthorized'], 401);
         }
        $book->delete();
        return response()->json(['message'=>'Book successfully deleted'],200);
    }
}
