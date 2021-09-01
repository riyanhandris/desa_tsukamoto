<?php

namespace App\Http\Controllers;

use App\Models\PenilaianModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenilaianController extends Controller
{
    public function index()
    {
        $data = [
            'penilaian' => $this->PenilaianModel->allData(),
        ];
        return view('v_penilaian', $data);
    }

    public function findNIK(Request $request)
    {
        try {
            $data = WargaModel::query()
                ->where('nik', $request->nik)
                ->firstOrFail();

            return view('form_nik', compact('data'));
        } catch (\Throwable $th) {
        }
    }

    public function __construct()
    {
        $this->PenilaianModel = new PenilaianModel();
    }

    public function insert()
    {
        Request()->validate(
            [
                'nik' => 'required|unique:nilai,nik|max:16',
                'nama' => 'required',
                'bantuan' => 'required',
                'penghasilan' => 'required',
                'keluarga' => 'required',
            ],
            [
                'nik.required' => 'Wajib diisi !!!',
                'nik.unique' => 'NIK sudah dinilai !!!',
                'nama.required' => 'Wajib diisi !!!',
                'bantuan.required' => 'Wajib diisi !!!',
                'penghasilan.required' => 'Wajib diisi !!!',
                'keluarga.required' => 'Wajib diisi !!!',
            ]
        );
        $data = [
            'nik' => Request()->nik,
            'nama' => Request()->nama,
            'bantuan' => Request()->bantuan,
            'penghasilan' => Request()->penghasilan,
            'keluarga' => Request()->keluarga,
        ];

        $this->PenilaianModel->addData($data);
        return redirect()->route('nilai')->with('pesan', 'Data berhasil ditambahkan');
    }
}
