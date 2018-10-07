<?php

namespace App\Http\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView; 
use App\Employee;
use App\User;
use App\Asset;
use DB;


use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class AssetsExport implements FromQuery
{
    use Exportable;

    public function forYear(int $year)
    {
        $this->year = $year;
        
        return $this;
    }

    public function name($name)
    {
        $this->name = $name;
        
        return $this;
    }

    public function query()
    {
        return Asset::query();
        	// ->select('assets.asset_id', 'assets.code', 'assets.name', 'ac.asset_name')
        	// ->whereYear('created_at', $this->year)
        	// ->leftJoin('asset_categories as ac' , 'ac.asset_code' , '=' , 'assets.category');

        if($this->name){
        	$assets = $assets->where('assets.name', 'like', '%Dump%');

        }
    }
}

// class AssetsExport implements FromView
// {
//     public function view(Request $request): View
//     {

//     	$data = array(
//             'tag'=>$request->input('tag'),
//             'name'=>$request->input('name'),
//             'category'=>$request->input('category'),
//             'areCode'=>$request->input('areCode'),
//             'status'=>$request->input('status'),
//             'isAll'=>$request->input('isAll'),
//         );

//     	$assets = DB::table('Assets as a')
//             ->select(
//                 DB::raw('CONCAT(trim(CONCAT(e.lname," ",COALESCE(e.affix,""))),", ", COALESCE(e.fname,"")," ", COALESCE(e.mname,"")) as employee_name'),
//                 'a.asset_id',
//                 'a.tag', 
//                 'a.code', 
//                 'a.are_code', 
//                 'a.name',
//                 'a.category',
//                 'a.model',
//                 'a.brand',
//                 DB::raw('DATE_FORMAT(a.date_acquired, "%M %d, %Y") as date_acquired'),
//                 'a.acquisition_cost',
//                 'a.plate_no',
//                 'a.engine_no',
//                 'a.chassis_no',
//                 DB::raw('DATE_FORMAT(a.warranty_date, "%M %d, %Y") as warranty_date'),
//                 'a.project_code',
//                 'a.status',
//                 'sc.asset_category',
//                 'sc.asset_name',
//                 'm.municipality_text'
//               )
//             // ->leftjoin('Employees as e','e.employee_code','=','a.assign_to')
//             ->leftjoin('Projects as p','p.project_code','=','a.project_code')
//             ->leftjoin('municipalities as m','m.municipality_code','=','p.municipality_code')
//             ->leftjoin('asset_categories as sc','sc.asset_code','=','a.category')
//             ->leftjoin('ares as are','are.are_code','=','a.are_code')
//       			->leftjoin('Employees as e','e.employee_code','=','are.employee_code');

//       	if ($data['tag']){ 
//       		$assets = $assets->where('a.tag', $data['tag']);
//       	}

//         if ($data['name']){ 
//           $assets = $assets->where('a.name', $data['name']);
//         }

//         if ($data['category']){ 
//           $assets = $assets->where('a.category', $data['category']);
//         }

//         if($data['isAll']==0)
//         {
//           if ($data['areCode']){ 
//             $assets = $assets->where('a.are_code', $data['areCode']);
//           }

//           if (!$data['areCode']){ 
//             $assets = $assets->whereNull('a.are_code');
//           }
//         }

//         if ($data['status']){ 
//           $assets = $assets->whereIn('a.status', explode(',', $data['status']));
//         }

//       	$assets = $assets->get();

//         return view('export.exportAssets', [
//             'data' => $assets
//         ]);
//     }
// }