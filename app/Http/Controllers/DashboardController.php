<?php

namespace App\Http\Controllers;

use App\Models\DashboardModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->DashboardModel = new DashboardModel();
    }


    public function index()
    {

        $data = DB::table('warga')->count();

        return view('v_dashboard', compact('data'));
    }
}
