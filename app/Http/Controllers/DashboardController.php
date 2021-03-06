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
        if (Auth()->user()->id == 2) {
            $data = DB::table('warga')->count();
            $sudah_nilai = DB::table('nilai')
                ->join('warga', 'nilai.nik', '=', 'warga.nik')
                ->count();

            return view('v_dashboard', compact('data', 'sudah_nilai'));
        } else {
            $data = DB::table('warga')
                ->where('id', Auth()->user()->id)
                ->count();

            $sudah_nilai = DB::table('nilai')
                ->join('warga', 'nilai.nik', '=', 'warga.nik')
                ->where('nilai.id', Auth()->user()->id)
                ->count();

            return view('v_dashboard', compact('data', 'sudah_nilai'));
        }
    }
}
