<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\Asset;
use App\AssetEvent;
use App\AreItem;
use App\Asset_category;
use App\Employee;
use App\Log;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AssetsController extends Controller {
  	public function index(){
    	return view('layout.index');
   	}

    public function asset_categories(Request $request){

        $data = array(
            'assetCategory'=>$request->input('assetCategory')
        );

      	$asset_categories = DB::table('Asset_categories as ac');

        if ($data['assetCategory']){ 
          $asset_categories = $asset_categories->where('asset_category', $data['assetCategory']);
        }

        $asset_categories = $asset_categories->orderBy('asset_name')->get();

        return response()-> json([
            'status'=>200,
            'data'=>$asset_categories,
            'message'=>''
        ]);
    }

    public function assets(Request $request){

        $date2 = Carbon::create(2018, 12, 31);


        $data = array(
            'assetCode'=>$request->input('assetCode'),
            'tag'=>$request->input('tag'),
            'name'=>$request->input('name'),
            'category'=>$request->input('category'),
            'areCode'=>$request->input('areCode'),
            'status'=>$request->input('status'),
            'isAll'=>$request->input('isAll'),
            'withActiveAre'=>$request->input('withActiveAre')
        );

        // return $data['status'];

      	$asset = DB::table('Assets as a')
      			// ->select('*')
            ->select(
                'e.employee_code',
                DB::raw('CONCAT(trim(CONCAT(e.lname," ",COALESCE(e.affix,""))),", ", COALESCE(e.fname,"")," ", COALESCE(e.mname,"")) as employee_name'),
                'a.asset_id',
                'a.asset_code',
                'a.tag', 
                'a.code', 
                'a.name',
                'a.category',
                'a.model',
                'a.brand',
                'a.description',
                DB::raw('DATE_FORMAT(a.date_acquired, "%m/%d/%Y") as date_acquired'),
                'a.acquisition_cost',
                'a.plate_no',
                'a.engine_no',
                'a.chassis_no',
                DB::raw('DATE_FORMAT(a.warranty_date, "%m/%d/%Y") as warranty_date'),
                'a.project_code',
                'a.status',
                'ac.asset_category_name',
                'e.organizational_unit',
                'org.org_name as organizational_unit_name',
                'org.barangay as barangay',
                'm.municipality_code as municipality_code',
                'm.municipality_text',
                'p.province_code as province_code',
                'p.province_text',
                'r.region_code as region_code',
                'r.region_text_short',
                'r.region_text_long',
                // 'are_item.are_item_code',
                // 'are_item.ended_at',
                // 'are.are_code'
                // DB::raw('count(are_item.ended_at = "9999-12-31") as with_active_are')
                DB::raw('SUM(CASE WHEN are_item.ended_at = "9999-12-31" THEN 1 ELSE 0 END) AS count_with_active_are')
              )

            // ->leftjoin('Employees as e','e.employee_code','=','a.assign_to')
            // ->leftjoin('Projects as p','p.project_code','=','a.project_code')
            
            ->leftjoin('are_items as are_item','are_item.asset_code','=','a.asset_code')
              ->where(function ($query) {
                // $query->whereDate('are_item.ended_at', '9999-12-31');
                // $query->whereRaw('SUM(CASE WHEN are_item.ended_at = "2018-12-31" THEN 1 ELSE 0 END)', 1);
                // $query->orderBy("are_item.ended_at", "asc");
              })
            ->leftjoin('ares as are','are.are_code','=','are_item.are_code')
            ->leftjoin('asset_categories as ac','ac.asset_category_code','=','a.category')
            ->leftjoin('employees as e','e.employee_code','=','are.employee_code')
            ->leftjoin('organizations as org','org.org_code','=','e.organizational_unit')
            ->leftjoin('municipalities as m','m.municipality_code','=','org.municipality_code')
            ->leftjoin('provinces as p','p.province_code','=','m.province_code')
      			->leftjoin('regions as r','r.region_code','=','p.region_code');

      	if ($data['tag']){ 
      		$asset = $asset->where('a.tag', $data['tag']);
      	}

        if ($data['name']){ 
          $asset = $asset->where('a.name', $data['name']);
        }

        if ($data['category']){ 
          $asset = $asset->where('a.category', $data['category']);
        }

        if ($data['areCode']){ 
          $asset = $asset->where('are.are_code', $data['areCode']);
        }

        // if($data['isAll']==0)
        // {
        //   $asset = $asset->whereNull('are.are_code');
        // }
        // else{
        //   $asset = $asset->whereDate('are_item.ended_at', '9999-12-31');
        // }

        if ($data['status']){ 
          $asset = $asset->whereIn('a.status', explode(',', $data['status']));
        }

        $asset = $asset->groupBy(
                'e.employee_code',
                'employee_name',
                'a.asset_id',
                'a.asset_code',
                'a.tag', 
                'a.code', 
                'a.name',
                'a.category',
                'a.model',
                'a.brand',
                'a.description',
                'a.date_acquired',
                'a.acquisition_cost',
                'a.plate_no',
                'a.engine_no',
                'a.chassis_no',
                'a.warranty_date',
                'a.project_code',
                'a.status',
                'ac.asset_category_name',
                'e.organizational_unit',
                'org.org_name',
                'org.barangay',
                'm.municipality_code',
                'm.municipality_text',
                'p.province_code',
                'p.province_text',
                'r.region_code',
                'r.region_text_short',
                'r.region_text_long'
                // 'are_item.are_item_code',
                // 'are_item.ended_at'
                // 'are.are_code'
              );


        if ($data['withActiveAre'] == 1){ 
          $asset = $asset->havingRaw('SUM(CASE WHEN are_item.ended_at = "9999-12-31" THEN 1 ELSE 0 END) = 1');
        }elseif ($data['withActiveAre'] == 0){ 
          $asset = $asset->havingRaw('SUM(CASE WHEN are_item.ended_at = "9999-12-31" THEN 1 ELSE 0 END) = 0');
        }else{

        }

 
      	$asset = $asset->get();

        return response()-> json([
            'status'=>200,
            'data'=>$asset,
            'data2'=>$data,
            'message'=> ''
        ]);
    }

    public function asset_events(Request $request){

        $data = array(
            'tag'=>$request->input('tag'),
            'name'=>$request->input('name'),
            'category'=>$request->input('category'),
            'areCode'=>$request->input('areCode'),
            'assetEventCode'=>$request->input('assetEventCode'),
        );

        $asset_events = DB::table('asset_events as ae');

        if ($data['assetEventCode']){ 
          $asset_events = $asset_events->where('asset_event_code', $data['assetEventCode']);
        }

        if ($data['tag']){ 
          $asset = $asset_events->where('ae.asset_tag', $data['tag']);
        }

        // if ($data['name']){ 
        //   $asset = $asset->where('a.name', $data['name']);
        // }

        // if ($data['category']){ 
        //   $asset = $asset->where('a.category', $data['category']);
        // }

        // if ($data['areCode']){ 
        //   $asset = $asset->where('a.are_code', $data['areCode']);
        // }

        // if (!$data['areCode']){ 
        //   $asset = $asset->whereNull('a.are_code');
        // }

        $asset_events = $asset_events->get();

        return response()-> json([
            'status'=>200,
            'data'=>$asset_events,
            'message'=>''
        ]);
    }

    public function methods(){

      	$methods = DB::table('methods')->get();

        return response()-> json([
            'status'=>200,
            'data'=>$methods
        ]);
    }

    public function asset_tag(Request $request)
    {
    	$assetTag = $request->input('categoryCode')."-".date('Ymd', strtotime($request->input('dateAcquired')))."-".$request->input('assetID');

    	return response()-> json([
            'status'=>200,
            'data'=>$assetTag
        ]);
    }

    public function save(Request $request){
        
        $data = array();

       	$data['assetName'] = $request->input('assetName');
       	$data['assetID'] = $request->input('assetID');
       	$data['modelnumber'] = $request->input('modelnumber');
       	$data['categoryCode'] = $request->input('categoryCode');
       	$data['description'] = $request->input('description');
       	$data['brand'] = $request->input('brand');
       	$data['dateAquired'] = $request->input('dateAquired');
       	$data['acquisitionCost'] = $request->input('acquisitionCost');
       	$data['dateAcquired'] = date('Y-m-d', strtotime($request->input('dateAcquired')));
       	$data['plateNumber'] = $request->input('plateNumber');
        $data['engineNumber'] = $request->input('engineNumber');
        $data['chassisNumber'] = $request->input('chassisNumber');
       	$data['warrantyDate'] = date('Y-m-d', strtotime($request->input('warrantyDate'))); 

        $transaction = DB::transaction(function($data) use($data){
        	try{

	            $asset = new Asset;
              $assetCode = (str_pad(($asset->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')->get()->count() + 1), 4, "0", STR_PAD_LEFT));
              $asset->asset_code = "ASSET-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$assetCode;
              $asset->tag = $data['categoryCode']."-".date('Ymd', strtotime($data['dateAcquired']))."-".$data['assetID'];
	            $asset->name = $data['assetName'];
	            $asset->code = $data['assetID'];
	            $asset->model = $data['modelnumber'];
	            $asset->category = $data['categoryCode'];
	            $asset->description = $data['description'];
	            $asset->brand = $data['brand'];
	            $asset->date_acquired = $data['dateAcquired'];
	            $asset->acquisition_cost = $data['acquisitionCost'];
	            $asset->plate_no         = $data['plateNumber'];
              $asset->engine_no        = $data['engineNumber'];
              $asset->chassis_no = $data['chassisNumber'];
	            $asset->warranty_date = $data['warrantyDate'];
              $asset->status = "ACTIVE";
	            $asset->changed_by = Auth::user()->email;
	            $asset->save();

	            // $assetCopy = DB::table('Assets')->where('tag', $asset->tag)->first();
	            // $assetCopy->asset_id;

	            // $log = new Log;
	            // $log->log_code = $assetCopy->asset_id;
	            // $log->log_desc = "Added new asset";
	            // $log->user_id = Auth::user()->id;
	            // $log->save();

	            return response()->json([
	                'status' => 200,
	                'data' => 'null',
	                'message' => 'Successfully saved.'
	            ]);
            } 
            catch (\Exception $e) 
            {
		    	    return response()->json([
	                'status' => 500,
	                'data' => 'null',
	                'message' => 'Error, please try again!'
	            ]);
		        }
        });

        return $transaction;
    }


    public function update(Request $request){

      $data = array();

      $data['tag'] = $request->input('tag');
      $data['areCode'] = $request->input('areCode');
      // $data['assetName'] = $request->input('assetName');
      // $data['assetID'] = $request->input('assetID');
      // $data['modelnumber'] = $request->input('modelnumber');
      // $data['categoryCode'] = $request->input('categoryCode');
      // $data['description'] = $request->input('description');
      // $data['brand'] = $request->input('brand');
      // $data['dateAquired'] = $request->input('dateAquired');
      // $data['acquisitionCost'] = $request->input('acquisitionCost');
      // $data['dateAcquired'] = date('Y-m-d', strtotime($request->input('dateAcquired')));
      // $data['plateNumber'] = $request->input('plateNumber');
      // $data['engineNumber'] = $request->input('engineNumber');
      // $data['chassisNumber'] = $request->input('chassisNumber');

      $transaction = DB::transaction(function($data) use($data){
    // try{

          
      
          DB::table('assets')
            ->where('tag', $data['tag'])
            ->update([
              'are_code' => $data['areCode'],
            ]);

          $assetEvent = new AssetEvent;
          $assetEvent->asset_event_code = 1111;
          $assetEvent->event_date = "2018-01-01";
          $assetEvent->asset_tag = $data['tag'];
          $assetEvent->status = "Assigned";
          $assetEvent->remarks = "Assigned";
          $assetEvent->save();

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

  public function updateAsset(Request $request){

      $data = array();

      $data['tag'] = $request->input('tag');
      $data['description'] = $request->input('description');
      $data['model'] = $request->input('model');
      $data['brand'] = $request->input('brand');
      $data['date_acquired'] = date('Y-m-d', strtotime($request->input('date_acquired')));
      $data['acquisition_cost'] = $request->input('acquisition_cost');
      $data['plate_no'] = $request->input('plate_no');
      $data['engine_no'] = $request->input('engine_no');
      $data['chassis_no'] = $request->input('chassis_no');
      $data['warranty_date'] = date('Y-m-d', strtotime($request->input('warranty_date')));
      // $data['warranty_date'] = $request->input('warranty_date');

      $transaction = DB::transaction(function($data) use($data){
      try{
          

          $asset = Asset::where('tag', $data['tag'])->first();
          $asset->description = $data['description'];
          $asset->model = $data['model'];
          $asset->brand = $data['brand'];
          $asset->date_acquired = $data['date_acquired'];
          $asset->acquisition_cost = $data['acquisition_cost'];
          $asset->plate_no = $data['plate_no'];
          $asset->engine_no = $data['engine_no'];
          $asset->chassis_no = $data['chassis_no'];
          $asset->warranty_date = $data['warranty_date'];
          $asset->changed_by = Auth::user()->email;
          $asset->timestamps = true;
          $asset->save();

        return response()->json([
            'status' => 200,
            'data' => 'null',
            'message' => 'Successfully saved.'
        ]);

      }
      catch (\Exception $e) 
      {
          return response()->json([
            'status' => 500,
            'data' => 'null',
            'message' => 'Error, please try again!'
        ]);
      }
    });

    return $transaction;
  }


  public function saveAssetEvent(Request $request){
        
        $data = array();

        // $end_date = date('2019-m-d', strtotime($request->input('event_date')));

        $data['status'] = $request->input('status');
        $data['event_date'] = date('Y-m-d', strtotime($request->input('event_date')));
        $data['remarks'] = $request->input('remarks');
        $data['asset_tag'] = $request->input('asset_tag');
        $data['asset_code'] = $request->input('asset_code');
       
        $transaction = DB::transaction(function($data) use($data){
          // try{

              $assetEvent = new AssetEvent;
              // $asset->asset_event_code = $data['categoryCode']."-".date('Ymd', strtotime($data['dateAcquired']))."-".$data['assetID'];
              $assetEvent->asset_event_code = "AEVNT-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
              $assetEvent->status = $data['status'];
              $assetEvent->asset_tag = $data['asset_tag'];
              $assetEvent->event_date = date('Y-m-d', strtotime($data['event_date']));
              $assetEvent->remarks = $data['remarks'];
              $assetEvent->changed_by = Auth::user()->email;
              $assetEvent->save();

              $asset = Asset::where('tag', $data['asset_tag'])->first();
              $asset->status = $data['status'];
              $asset->changed_by = Auth::user()->email;
              $asset->timestamps = true;
              $asset->save();

              // DB::table('assets')
              // ->where('tag', $data['asset_tag'])
              // ->update([
              //   'status' => $data['status']
              // ]);

              if($data['status']=="RETURN"){

                //termporary query
                $asset = DB::table('assets')->where('tag', $data['asset_tag'])->first();
                $are = DB::table('are_items')
                    ->where('asset_code', $asset->asset_code)
                    ->where('ended_at', "9999-12-31")
                    ->first();
                  
                if($are)
                {

                // DB::table('are_items')
                // ->where('asset_code', $asset->asset_code)
                // ->where('are_item_code', $are->are_item_code)
                // ->update([
                //   'ended_at' => $data['event_date']
                // ]);

                $asset = AreItem::where('asset_code', $asset->asset_code)->where('are_item_code', $are->are_item_code)->first();
                $asset->ended_at = $data['event_date'];
                $asset->changed_by = Auth::user()->email;
                $asset->timestamps = true;
                $asset->save();
                
                }

              }


              return response()->json([
                  'status' => 200,
                  'data' => 'null',
                  'message' => 'Successfully saved.'
              ]);
          //   } 
          //   catch (\Exception $e) 
          //   {
             //  return response()->json([
           //        'status' => 500,
           //        'data' => 'null',
           //        'message' => 'Error, please try again!'
           //    ]);
            // }
        });

        return $transaction;
    }
}