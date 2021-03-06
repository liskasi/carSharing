<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->id == 1)
        {
            $carsDB = DB::table('cars')->get();
        }
        else
        {
            $carsDB = DB::table('cars')->where('status','=','Approved')->get();
        }
        $a = DB::table('cars')->where('status','=','Approved')->count();
        return view ('home', ['carsDB' => $carsDB, 'a'=>$a]);

    }
        
    public function languageDemo(){
        return view('languageDemo');
    }
}
