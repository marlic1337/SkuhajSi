<?php namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TestController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public $id;
    public function __construct()
    {
        $this->middleware('auth');
        $id = Auth::id();
    }

	public function index()
	{
        //$id = Auth::id();
        return AuthController::basic('name');
	}
}
