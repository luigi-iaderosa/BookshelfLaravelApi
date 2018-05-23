<?php
/**
 * Created by PhpStorm.
 * User: alceste
 * Date: 23/05/18
 * Time: 10.52
 */

namespace App\Http\Controllers;
use App\Helpers\HelperClass;
use Illuminate\Http\Request;
use App\BookshelfOwner;
use App\Models\Bookshelf;
use App\Models\BookBookshelf;
class BookshelfController extends AuthUserAwareController
{

    public $ownBookshelf;
    public function __construct()
    {
        parent::__construct();


    }

    public function addBookshelf(Request $request){



        $bookshelfValues = HelperClass::extractFromRequest($request,['bookshelf_description']);


        $owner = BookshelfOwner::where('username',$this->username)->first();
        if ($owner == NULL)
            throw new \Exception('could not find user with name '+$this->username);
        else {

            $bookshelfValues['id_bookshelf_owner'] = $owner->id;
            return json_encode(Bookshelf::create($bookshelfValues));

        }

    }


    public function addToBookshelf(Request $request){
        $addToBookshelfValues = HelperClass::extractFromRequest($request,['id_book']);
        $addToBookshelfValues['id_shelf'] = $this->ownedBookshelf->id;

        $data = BookBookshelf::create($addToBookshelfValues);
        return json_encode($data);
    }

    public function getBookshelf(Request $request){
        $bookshelf = $this->ownedBookshelf;
        $bookshelf->books;
        return json_encode(['data'=>$bookshelf]);
    }


}