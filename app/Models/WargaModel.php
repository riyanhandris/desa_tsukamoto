<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WargaModel extends Model
{
    protected $table = 'warga';

    public function allData()
    {
        if (Auth::user()->id == 2) {
            return DB::table('warga')
                ->orderBy('id_warga', 'desc')
                ->get();
        } else {
            return DB::table('warga')
                ->where('id', '=',  Auth::user()->id)
                ->orderBy('id_warga', 'desc')
                ->get();
        }
    }

    public function detailData($id_warga)
    {
        return DB::table('warga')->where('id_warga', $id_warga)->first();
    }
    public function addData($data)
    {
        DB::table('warga')->insert($data);
    }

    public function editData($id_warga, $data)
    {
        DB::table('warga')
            ->where('id_warga', $id_warga)
            ->update($data);
    }

    public function deleteData($nik)
    {
        DB::table('warga')
            ->where('nik', $nik)
            ->delete();

        DB::table('nilai')
            ->where('nik', $nik)
            ->delete();
    }
}
