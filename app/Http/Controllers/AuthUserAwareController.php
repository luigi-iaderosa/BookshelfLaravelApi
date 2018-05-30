<?php
/**
 * Created by PhpStorm.
 * User: alceste
 * Date: 23/05/18
 * Time: 11.52
 */

namespace App\Http\Controllers;
use App\BookshelfOwner;
use App\Models\Bookshelf;

class AuthUserAwareController extends Controller
{

    protected $username;
    protected $owner;

    public function __construct()
    {

        parent::__construct();
        /*
            $this->username = explode(':',$this->headers['Apitoken'])[1];
            $this->owner = BookshelfOwner::where('username',$this->username)->first();
            $this->ownedBookshelf = Bookshelf::where('id_bookshelf_owner',$this->owner->id)->first();
        */
    }

}