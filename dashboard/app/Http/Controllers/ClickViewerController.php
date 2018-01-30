<?php

namespace App\Http\Controllers;

use App\Click;


use Barryvdh\Debugbar\Facade as Debugbar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Maatwebsite\Excel\Excel;
use Yajra\Datatables\Datatables;

class ClickViewerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index() {
        return view('click_viewer');
    }
    function anyData() {
        return Datatables::of(Click::with('link'))->make(true);
    }

    public function exportToExcel() {

        return \Maatwebsite\Excel\Facades\Excel::create('Clicks', function($excel){
            $excel->sheet('Sheet1', function($sheet) {
                $clicks = Click::with('link')->get();
                $reuslts = [];
                for ($i = 0, $c = count($clicks); $i < $c; ++$i) {

                    $result["Individuals.ACCOUNTNUMBER"] = $clicks[$i]->{"andar_account_number"};
                    $result["Individuals.InterestRating.INTEREST"]=$clicks[$i]->{"link"}->{"interest"};
                    $result["Individuals.InterestRating.RATING"]=1;
                    $result["Individuals.InterestRating.SOURCE"]= $clicks[$i]->{"link"}->{"issue_article"}."eNews Issue 201802 Article 2";
                    $result["Individuals.InterestRating.YEAR"]=Carbon::now()->year;

                    $results[] = $result;
                }

                $sheet->fromArray($results, null, 'A1', true);
            });
        })->export('xls');

    }
}

