<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Bookshelf;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Helpers\HelperClass;
use App\BookshelfOwner;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function signUp(Request $request){
        header('Access-Control-Allow-Origin: *');
        $signUpFields = HelperClass::extractFromRequest($request,['name','username','password']);
        #dd($signUpFields);
        $signUpFields['password'] = bcrypt($signUpFields['password']);
        $newUser = BookshelfOwner::create($signUpFields);
        return json_encode($newUser);
    }

    public function attempt(Request $request){


        $dataResult = $this->login($request);

        return json_encode($dataResult);
    }

    public function sendLoginResponse(Request $request){
        $owner = BookshelfOwner::where('username',$request->post('username'))->with('bookshelf')->first();

        $bookshelfOwned = Bookshelf::where('id_bookshelf_owner',$owner->id)->first();
        if ($bookshelfOwned){
            return ['apitoken'=>date('Y-m-d').':'.$request->post('username'),
                'user_id'=>$owner->id,'bookshelf_id'=>$bookshelfOwned->id];
        }
        /*
        else return ['apitoken'=>date('Y-m-d').':'.$request->post('username'),
            'user_id'=>$owner->id,'bookshelf_id'=>1];
        */

    }



    protected function sendFailedLoginResponse(Request $request)
    {
        throw new \Exception('401: Unauthorized');
    }


}
