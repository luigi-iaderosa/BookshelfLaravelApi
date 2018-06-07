<?php
/**
 * Created by PhpStorm.
 * User: alceste
 * Date: 23/05/18
 * Time: 15.37
 */

namespace App\Http\Controllers;


use App\Helpers\HelperClass;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;
class BookController extends Controller
{
    public function addBook(Request $request){
        $addBookValues = resolve('helper')->extractFromRequest($request,['title','isbn','id_author']);
        $book = Book::create($addBookValues);
        return json_encode($book);
    }

    public function getBook(Request $request,$id){
        $book = Book::find($id)->first();
        $book->author;
        $data['book'] = $book;
        return json_encode($data);

    }

    public function allBooks(Request $request){
        $books['books'] = Book::with(['author'])->get();
        return json_encode($books);
    }


}