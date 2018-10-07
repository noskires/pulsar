<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Exports\EmployeesExport;
use App\Http\Exports\AssetsExport;
use DB;
use Auth;
use App\User;
use Carbon\Carbon;
use Excel;

class ExportController extends Controller {

	public function index(){
		return view('layout.index');
	}

    public function exportEmployees(){
        return Excel::download(new EmployeesExport, 'All_Users.xlsx');
    }

    public function exportAssets(){
        return (new AssetsExport)->name('Dump Track')->download('Assets.xlsx');
    }

}