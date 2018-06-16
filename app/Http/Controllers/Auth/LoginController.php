<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Bookshelf;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Helpers\HelperClass;
use App\BookshelfOwner;
use Illuminate\Support\Facades\Auth;


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

        $signUpFields = resolve('helper')->extractFromRequest($request,['name','username','password']);
        #dd($signUpFields);
        $signUpFields['password'] = bcrypt($signUpFields['password']);
        $newUser = BookshelfOwner::create($signUpFields);
        return json_encode($newUser);
    }



    public function attempt(Request $request){


        $dataResult = $this->login($request);

        return json_encode($dataResult);
    }
/*
    public function sendLoginResponse(Request $request){
        $owner = BookshelfOwner::where('username',$request->post('username'))->with('bookshelf')->first();

        $bookshelfOwned = Bookshelf::where('id_bookshelf_owner',$owner->id)->first();
        if ($bookshelfOwned){
            return ['apitoken'=>date('Y-m-d').':'.$request->post('username'),
                'user_id'=>$owner->id,'bookshelf_id'=>$bookshelfOwned->id,
                'username'=>$request->post('username')
                ];
        }


    }



    protected function sendFailedLoginResponse(Request $request)
    {
        $username = $request->post('username');
        $password = $request->post('password');
        $apitoken = 0;

       return ['username'=>$username,'password'=>$password,'apitoken'=>$apitoken];
    }
*/

    public function login()
    {

        $credentials = request(['username', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            $response = response()->json(['error' => 'Unauthorized'], 401);
            return $response;
        }
        $response =$this->respondWithToken($token,$credentials['username']);
        return $response;
    }



    protected function respondWithToken($token,$username)
    {



        $userId = Auth::user()->id;
        $bookshelfOwned = Bookshelf::where('id_bookshelf_owner',$userId)->first();
        $bookshelfId = $bookshelfOwned->id;
        return response()->json([
            'apitoken' => $token,
            'user_id' => $userId,
            'bookshelf_id'=>$bookshelfId,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

}
