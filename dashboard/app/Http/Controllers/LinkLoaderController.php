<?php

namespace App\Http\Controllers;


use App\Link;
use Illuminate\Http\Request;
use App\Http\Requests;
use Yajra\Datatables\Datatables;

class LinkLoaderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index() {
        return view('LinkLoader');
    }
    function anyData() {
        return Datatables::of(Link::query())->make(true);
    }

}
