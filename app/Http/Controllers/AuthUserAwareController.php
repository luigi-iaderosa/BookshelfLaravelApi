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

            $userId = auth()->payload()->get('sub');
            $this->owner = BookshelfOwner::where('id',$userId)->first();
            $this->username = $this->owner->username;
            $this->ownedBookshelf = Bookshelf::where('id_bookshelf_owner',$userId)->first();

    }

}