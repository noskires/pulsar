<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Illuminate\Notifications\Messages\NexmoMessage;
use App\Notifications\NexmoMessage;
use Notification;

use DB;
use App\Organization;
use App\Warranty;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\Notifications\SMSNotification;

use Woenel\Itexmo;



class SmsNotificationController extends Controller {
   // public function index(){
   //    return view('employee.index');
   // }

    public function not(){

    $user = new User();
    $user->phone_number= '+639988964947';   // Don't forget specify country code.
    // $user->phone_number= '+639064010017';   // Don't forget specify country code.
    $user->notify(new SMSNotification());

    }

    public function not2(){

        $itexmo = new Itexmo;

        $itexmo->to = '09173031835'; //sir Jay
        // $itexmo->to = '09050410088'; //sir Mykee
        $itexmo->message = 'Hello Mykee, this is Bizlogiks Team!';
        $itexmo->send();

        if($itexmo->result == '0') {
        // Success message or logic. Refer to the return codes below.
        }
    
    }

}

