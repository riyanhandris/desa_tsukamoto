<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WargaModel;

class WargaController extends Controller
{
    public function __construct()
    {
        $this->WargaModel = new WargaModel();
    }
    public function index()
    {
        $data = [
            'warga' => $this->WargaModel->allData(),
        ];
        return view('v_warga', $data);
    }
    public function detail($id_warga)
    {
        if (!$this->WargaModel->detailData($id_warga)) {
            abort(404);
        }
        $data = [
            'warga' => $this->WargaModel->detailData($id_warga),
        ];
        return view('v_detail_warga', $data);
    }
    public function insert()
    {
        Request()->validate(
            [
                'nik' => 'required|unique:warga,nik|max:16',
                'nama' => 'required',
                'jk' => 'required',
                'dusun' => 'required',
                'rt' => 'required',
                'rw' => 'required',
            ],
            [
                'nik.required' => 'Wajib diisi !!!',
                'nik.unique' => 'NIK sudah ada !!!',
                'nama.required' => 'Wajib diisi !!!',
                'jk.required' => 'Harap pilih jenis kelamin !!!',
                'dusun.required' => 'Wajib diisi !!!',
                'rt.required' => 'Wajib diisi !!!',
                'rw.required' => 'Wajib diisi !',
            ]
        );

        $data = [
            'nik' => Request()->nik,
            'nama' => Request()->nama,
            'jk' => Request()->jk,
            'dusun' => Request()->dusun,
            'rt' => Request()->rt,
            'rw' => Request()->rw,
            'id' => Request()->id,
        ];

        $this->WargaModel->addData($data);
        return redirect()->route('warga')->with('pesan', 'Data berhasil ditambahkan');
    }

    public function update($id_warga)
    {
        Request()->validate(
            [
                'nama' => 'required',
                'jk' => 'required',
                'dusun' => 'required',
                'rt' => 'required',
                'rw' => 'required',
            ],
            [
                'nama.required' => 'Wajib diisi !!!',
                'jk.required' => 'Harap pilih jenis kelamin !!!',
                'dusun.required' => 'Wajib diisi !!!',
                'rt.required' => 'Wajib diisi !!!',
                'rw.required' => 'Wajib diisi !',
            ]
        );

        $data = [
            'nik' => Request()->nik,
            'nama' => Request()->nama,
            'jk' => Request()->jk,
            'dusun' => Request()->dusun,
            'rt' => Request()->rt,
            'rw' => Request()->rw,
        ];

        $this->WargaModel->editData($id_warga, $data);
        return redirect()->route('warga');
    }

    public function delete($id_warga)
    {
        $this->WargaModel->deleteData($id_warga);
        return redirect()->route('warga');
    }
}
