<?php
/**
 * Created by PhpStorm.
 * User: alceste
 * Date: 23/05/18
 * Time: 12.38
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BookBookshelf extends Model
{
    public $timestamps = false;
    protected $table = "book_bookshelf";
    protected $fillable = ['id_book','id_shelf'];

    public function book(){
        return $this->hasOne('App\Models\Book',
            'id','id_book')->with('author');
    }
}