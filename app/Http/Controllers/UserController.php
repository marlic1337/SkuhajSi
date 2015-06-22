<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use Auth;
use DB;
use Request;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function get_profile()
	{
        $data = DB::table('users')->where('id', Auth::id())->get()[0];
        //dd($data);
        return view('user/profile', ['data' => $data]);
	}

    public function edit_profile(){
        DB::table('users')->where('id', Auth::id())->update(['name' => Request::input('name'),'email' => Request::input('email')]);
        $data = DB::table('users')->where('id', Auth::id())->get()[0];
        //Request::input('email');
        return view('/user/profile', ['data'=>$data]);
    }
}
