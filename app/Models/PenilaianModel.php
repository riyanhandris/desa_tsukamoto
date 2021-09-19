<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenilaianModel extends Model
{
    protected $table = 'nilai';

    public function allData()
    {
        if (Auth::user()->id == 2) {
            return DB::table('nilai')
                ->orderBy('id_nilai', 'desc')
                ->get();
        } else {
            return DB::table('nilai')
                ->where('id', '=',  Auth::user()->id)
                ->orderBy('id_nilai', 'desc')
                ->get();
        }
    }

    public function addData($data)
    {
        DB::table('nilai')->insert($data);
    }

    public function editData($id_nilai, $data)
    {
        DB::table('nilai')
            ->where('id_nilai', $id_nilai)
            ->update($data);
    }

    public function deleteData($id_nilai)
    {
        DB::table('nilai')
            ->where('id_nilai', $id_nilai)
            ->delete();
    }
}
