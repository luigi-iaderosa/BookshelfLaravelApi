<?php
/**
 * Created by PhpStorm.
 * User: alceste
 * Date: 23/05/18
 * Time: 15.34
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $timestamps = false;
    protected $table = 'book';
    protected $guarded = ['id'];

    public function author(){
        return $this->hasOne(
            "App\Models\Author",'id','id_author');
    }




}