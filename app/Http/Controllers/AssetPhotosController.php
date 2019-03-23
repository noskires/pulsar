<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use App\Organization;
use App\Warranty;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AssetPhotosController extends Controller {

  public function assetPhotos(Request $request){

    $data = array(
      'assetCode'=>$request->input('assetCode'),
      'name'=>$request->input('name'),
      'status'=>$request->input('status'),
    );

  	$assetPhotos = DB::table('asset_photos');

    if ($data['assetCode']){
      $assetPhotos = $assetPhotos->where('asset_code', $data['assetCode']);
    }

    if ($data['name']){
      $assetPhotos = $assetPhotos->where('asset_photo_name', $data['name']);
    }

    if ($data['status']){
      $assetPhotos = $assetPhotos->where('asset_photo_status', $data['status']);
    }

    $assetPhotos = $assetPhotos->get();

    return response()-> json([
        'status'=>200,
        'data'=>$assetPhotos,
        'message'=>''
    ]);
  }

}