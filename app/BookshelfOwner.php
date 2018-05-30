<?php

namespace App;

use App\Models\Bookshelf;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BookshelfOwner extends Authenticatable
{
    use Notifiable;
    public $timestamps = true;
    protected $table = 'bookshelf_owner';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

   // protected $guarded = ['id'];

    public function bookshelf(){
        return $this->hasOne(Bookshelf::class,'id_bookshelf_owner','id');
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
