<?php

namespace App\Http\Controllers;

use App\Link;
use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function uploadCSV(Request $request) {

        $requestData = $request->all();

        $validator = Validator::make($requestData,[
            'csvfile'=>'required'
        ]);

        if($validator->passes()) {

            $file = $request->file('csvfile');

            try {
                self::linkCSVToDB($request->file('csvfile'));

            } catch(\Exception $e) {
                return response()->json(['error'=>substr($e->getMessage(),0,100)]);
            }


            $result=['success'=>'done'];
            return response()->json($result);
        }


        return response()->json(['error'=>$validator->errors()->all()]);


    }


    public static function linkCSVToDB($file) {
        $results = CommonFunctions::csvToArray($file);
        $now = Carbon::now('Canada/Pacific')->toDateTimeString();
        $rows = $results['rows'];
        $insertLinks=[];


        foreach($rows as $row) {

            $insertLink['issue_article']=$row["issue_article"];
            $insertLink['url']=$row["url"];
            $insertLink['interest']=$row["interest"];
            $insertLinks[]=$insertLink;
        }

        DB::beginTransaction();
        try{
            Link::insert($insertLinks);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}
