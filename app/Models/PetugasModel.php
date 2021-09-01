<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PetugasModel extends Model
{
    protected $table = 'users';

    public function allData()
    {
        return DB::table('users')->get();
    }

    public function addData($data)
    {
        DB::table('users')->insert($data);
    }

    public function editData($id, $data)
    {
        DB::table('users')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        DB::table('users')
            ->where('id', $id)
            ->delete();
    }
}
