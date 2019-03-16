<?php 

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\AssetPhoto;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class UploadController extends Controller {

	public function upload(Request $request){

		// $this->validate($request, [
	 //        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
	 //    ]);

		if(Input::hasFile('file')){
			
			// echo 'Uploaded';
			$file = Input::file('file');
			$request['assetCode'] = Input::input('assetCode');
			$request['description'] = Input::input('description');
			$request['name'] = $request['assetCode'];
			$request['status'] = $request['status'];
			$request['extension'] = $file->getClientOriginalExtension();
			// $request['name'] = $file->getClientOriginalName();
			// $this->save($request);

			if($request['status'] == 1){

	        	DB::table('asset_photos')
	            ->where('asset_code', $request['assetCode'])
	            ->update([
	              'asset_photo_status' => 0,
	            ]);

	        }
	        else{
	        	$request['status'] = 0;
	        }

			$assetPhoto = new AssetPhoto;
	        $assetPhotoCode 						= (str_pad(($assetPhoto->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')->get()->count() + 1), 4, "0", STR_PAD_LEFT));
	        $assetPhoto->asset_photo_code 			= "APC-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$assetPhotoCode;
	        $assetPhoto->asset_code 				= $request['assetCode'];
	        $assetPhoto->asset_photo_name 			= $request['name']."-APC-".date('YmdHis', strtotime(Carbon::now('Asia/Manila'))).".".$request['extension'];
	        $assetPhoto->asset_photo_description 	= $request['description'];
	        $assetPhoto->asset_photo_status 		= $request['status'];
	        $assetPhoto->changed_by     			= Auth::user()->email;
	        $assetPhoto->save();
	        
	        $file->move('uploads',  $assetPhoto->asset_photo_name);

	        // return response()->json([
	        //     'status' => 200,
	        //     'data' => 'null',
	        //     'message' => 'Successfully saved.'
	        // ]);

			return redirect('asset/more-details/'.$request['assetCode']);
		}

		else

		{
			// 
		}

	}

	public function save(Request $request){
    // return $request->all();
    $data = array();

    $transaction = DB::transaction(function($request) use($request){
    // try{

        $assetPhoto = new AssetPhoto;

        $assetPhotoCode = (str_pad(($assetPhoto->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        $assetPhoto->asset_photo_code = "APC-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$assetPhotoCode;
        $assetPhoto->asset_code = $request['assetCode'];
        $assetPhoto->asset_photo_name = $request['name']."-APC-".date('YmdHis', strtotime(Carbon::now('Asia/Manila'))).".".$request['extension'];
        $assetPhoto->asset_photo_description = $request['description'];
        $assetPhoto->asset_photo_status = 0;
        $assetPhoto->save();

        $file->move('uploads',  $request['name']."-APC-".date('YmdHis', strtotime(Carbon::now('Asia/Manila'))).".".$request['extension']);

        return response()->json([
            'status' => 200,
            'data' => 'null',
            'message' => 'Successfully saved.'
        ]);

      // }
      // catch (\Exception $e) 
      // {
      //     return response()->json([
      //       'status' => 500,
      //       'data' => 'null',
      //       'message' => 'Error, please try again!'
      //   ]);
      // }
    });

    return $transaction;
  }
}
