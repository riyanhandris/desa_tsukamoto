<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PenilaianModel extends Model
{
    protected $table = 'nilai';

    public function allData()
    {
        return DB::table('nilai')->get();
    }

    public function addData($data)
    {
        DB::table('nilai')->insert($data);
    }
}
