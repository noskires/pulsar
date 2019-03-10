<?php
namespace App\Http\Controllers\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use Auth;
use App\Audit;

class VouchersController extends Controller {
	public function index(){
		return view('layout.index');
	}

	public function audits(Request $request){

	}
}