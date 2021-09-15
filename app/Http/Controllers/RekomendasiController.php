<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenilaianModel;
use App\Models\RekomendasiModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RekomendasiController extends Controller
{
    public function __construct()
    {
        $this->RekomendasiModel = new RekomendasiModel();
    }

    public function index()
    {

        // return $this->RekomendasiModel->allData();

        $data = DB::table('nilai')
            ->join('warga', 'nilai.nik', '=', 'warga.nik')
            ->orderBy('nilai.hasil_z', 'desc')
            ->where('nilai.id', '=',  Auth::user()->id)
            ->get();
        // $data = [
        //     'rekomendasi' => $this->RekomendasiModel->allData(),
        // ];
        return view('v_rekomendasi', compact('data'));
    }
}
