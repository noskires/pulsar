<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MaintenanceController extends Controller {
   public function index(){
      return view('maintenance.index');
   }
}