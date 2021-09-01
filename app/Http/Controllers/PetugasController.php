<?php

namespace App\Http\Controllers;

use App\Models\PetugasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $data = [
            'petugas' => $this->PetugasModel->allData(),
        ];
        return view('v_petugas', $data);
    }

    public function __construct()
    {
        $this->PetugasModel = new PetugasModel();
    }

    public function insert()
    {
        Request()->validate(
            [
                'nik' => 'required|unique:users,nik|max:16',
                'nama' => 'required',
                'jk' => 'required',
            ],
            [
                'nik.required' => 'Wajib diisi !!!',
                'nik.unique' => 'NIK sudah ada !!!',
                'nama.required' => 'Wajib diisi !!!',
                'jk.required' => 'Harap pilih jenis kelamin !!!',
            ]
        );
        $data = [
            'nik' => Request()->nik,
            'name' => Request()->nama,
            'jk' => Request()->jk,
            'password' => Hash::make('password'),
        ];

        $this->PetugasModel->addData($data);
        return redirect()->route('petugas');
    }

    public function update($id)
    {
        Request()->validate(
            [
                'nama' => 'required',
                'jk' => 'required',
            ],
            [
                'nama.required' => 'Wajib diisi !!!',
                'jk.required' => 'Harap pilih jenis kelamin !!!',
            ]
        );

        $data = [
            'nik' => Request()->nik,
            'name' => Request()->nama,
            'jk' => Request()->jk,
        ];

        $this->PetugasModel->editData($id, $data);
        return redirect()->route('petugas');
    }

    public function delete($id)
    {
        $this->PetugasModel->deleteData($id);
        return redirect()->route('petugas');
    }
}
