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
      'tag'=>$request->input('tag'),
      'name'=>$request->input('name'),
      'status'=>$request->input('status'),
    );

  	$assetPhotos = DB::table('asset_photos');

    if ($data['tag']){
      $assetPhotos = $assetPhotos->where('asset_tag', $data['tag']);
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