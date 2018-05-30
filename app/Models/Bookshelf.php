<?php
/**
 * Created by PhpStorm.
 * User: alceste
 * Date: 23/05/18
 * Time: 11.14
 */

namespace App\Models;
use Illuminate\Http\Request;

class Bookshelf extends \Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
    protected $table = 'bookshelf';


    protected $guarded = ['id'];

    public function books(){
        return $this->hasMany(BookBookshelf::class,'id_shelf','id')
            ->with('book');
    }

}