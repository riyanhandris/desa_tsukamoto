<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WargaModel extends Model
{
    protected $table = 'warga';

    public function allData()
    {
        return DB::table('warga')->get();
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

    public function deleteData($id_warga)
    {
        DB::table('warga')
            ->where('id_warga', $id_warga)
            ->delete();
    }
}
