<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RekomendasiModel extends Model
{
    public function allData()
    {
        // return DB::table('nilai')
        //     ->join('warga', 'nilai.nik', '=', 'warga.nik')
        //     ->orderBy('nilai.hasil_z', 'desc')
        //     ->get();
    }
}
