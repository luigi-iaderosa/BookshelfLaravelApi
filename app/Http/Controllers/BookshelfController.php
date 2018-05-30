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



        $bookshelfValues = HelperClass::extractFromRequest($request,['bookshelf_description','id_user']);

        if (!isset($request['id_user']) ) {

            $owner = BookshelfOwner::where('username', $this->username)->first();
            if ($owner == NULL)
                throw new \Exception('could not find user with name ' + $this->username);
            else {
                $bookshelfValues['id_bookshelf_owner'] = $owner->id;

            }
        }
        return json_encode(Bookshelf::create($bookshelfValues));

    }


    public function addToBookshelf(Request $request)
    {
        $addToBookshelfValues = HelperClass::extractFromRequest($request, ['id_book', 'id_user']);
        if (!isset($request['id_user'])) {
            $addToBookshelfValues['id_shelf'] = $this->ownedBookshelf->id;

        } else {
            $id_user = $request['id_user'];
            $bookshelf = Bookshelf::where('id_bookshelf_owner', $id_user)->first();
            if (!$bookshelf) {
                throw new \Exception('could not find owner with supplied id');
            } else {
                $addToBookshelfValues['id_shelf'] = $bookshelf->id;
            }
        }
        $data = BookBookshelf::create($addToBookshelfValues);
        return json_encode($data);
    }

    public function removeFromBookshelf(Request $request,$id){
        #dd($this->headers);
        if (!isset($this->headers['Id-User'])){
            throw new \Exception('unsupported branch');
        }

        $removeFromBookshelfValues['id_user'] = $this->headers['Id-User'];



        $outcome = false;
        $target = BookBookshelf::where('id',$id)->first();

        if ($target) {
            $target->delete();
            $outcome = true;
        }

        return json_decode($outcome);

    }











    public function getBookshelf(Request $request,$id){
        /*
        $bookshelf = $this->ownedBookshelf;
        $books = $bookshelf->books;
        */

        $bookshelf = Bookshelf::where('id',$id)->with(['books'])->first();



        return json_encode(['shelf'=>$bookshelf]);
    }


}