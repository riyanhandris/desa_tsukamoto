<?php

namespace App\Http\Controllers;

use App\Models\PenilaianModel;
use App\Models\WargaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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

    public function insert(Request $request)
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

        $result = $this->store($request);

        $data = [
            'nik' => Request()->nik,
            'nama' => Request()->nama,
            'bantuan' => Request()->bantuan,
            'penghasilan' => Request()->penghasilan,
            'keluarga' => Request()->keluarga,
            'hasil_z' => $result['hasilZ'],
            'tidak_layak' => $result['nilaiTidakLayak'],
            'layak' => $result['nilaiLayak'],
            'blt' => $result['blt'],
        ];


        $this->PenilaianModel->addData($data);
        return redirect()->route('nilai')->with('pesan', 'Data berhasil ditambahkan');
    }

    public function update($id_nilai, Request $request)
    {
        Request()->validate(
            [

                'nama' => 'required',
                'bantuan' => 'required',
                'penghasilan' => 'required',
                'keluarga' => 'required',
            ],
            [
                'nama.required' => 'Wajib diisi !!!',
                'bantuan.required' => 'Wajib diisi !!!',
                'penghasilan.required' => 'Wajib diisi !!!',
                'keluarga.required' => 'Wajib diisi !!!',
            ]
        );

        $result = $this->store($request);
        $data = [
            'nik' => Request()->nik,
            'nama' => Request()->nama,
            'bantuan' => Request()->bantuan,
            'penghasilan' => Request()->penghasilan,
            'keluarga' => Request()->keluarga,
            'hasil_z' => $result['hasilZ'],
            'tidak_layak' => $result['nilaiTidakLayak'],
            'layak' => $result['nilaiLayak'],
            'blt' => $result['blt'],
        ];
        $this->PenilaianModel->editData($id_nilai, $data);
        return redirect()->route('nilai');
    }

    public function delete($id_nilai)
    {
        $this->PenilaianModel->deleteData($id_nilai);
        return redirect()->route('nilai');
    }

    public function store($request)
    {
        $bantuan[0] = $this->bantuanPernahDapat($request->bantuan);
        $bantuan[1] = $this->bantuanKadangDapat($request->bantuan);
        $bantuan[2] = $this->bantuanSeringDapat($request->bantuan);

        $penghasilan[0] = $this->penghasilanSedikit($request->penghasilan);
        $penghasilan[1] = $this->penghasilanSedang($request->penghasilan);
        $penghasilan[2] = $this->penghasilanBanyak($request->penghasilan);

        $keluarga[0] = $this->keluargaSedikit($request->keluarga);
        $keluarga[1] = $this->keluargaSedang($request->keluarga);
        $keluarga[2] = $this->keluargaBanyak($request->keluarga);

        $index = 0;
        for ($b = 0; $b < count($bantuan); $b++) {
            for ($p = 0; $p < count($penghasilan); $p++) {
                for ($k = 0; $k < count($keluarga); $k++) {
                    $alpha[$index] = min([$bantuan[$b], $penghasilan[$p], $keluarga[$k]]);
                    $index++;
                }
            }
        }

        $blt = array_sum($this->alphaZ($alpha, $this->findZ($alpha))) / array_sum($alpha);

        $result[0][0] = 'Layak';
        $result[0][1] = $this->layak($blt);
        $result[1][0] = 'Tidak Layak';
        $result[1][1] = $this->tidakLayak($blt);

        if ($result[0][1] > $result[1][1]) {
            $finalText = $result[0][0];
            $nilaiLayak = $result[0][1];
            $nilaiTidakLayak = $result[1][1];
            $hasilZ = $blt;
        } else {
            $finalText = $result[1][0];
            $nilaiLayak = $result[0][1];
            $nilaiTidakLayak = $result[1][1];
            $hasilZ = $blt;
        }

        return [
            'hasilZ' => $hasilZ,
            'nilaiTidakLayak' => $nilaiTidakLayak,
            'nilaiLayak' => $nilaiLayak,
            'blt' => $finalText
        ];
    }

    // bantuan
    private function bantuanPernahDapat($int)
    {
        if ($int <= 2) {
            return 1;
        } elseif (2 <= $int && $int <= 3) {
            return (3 - $int);
        } else {
            return 0;
        }
    }

    private function bantuanKadangDapat($int)
    {
        if ($int <= 2 || $int >= 4) {
            return 0;
        } elseif (2 <= $int && $int <= 3) {
            return ($int - 2);
        } else {
            return (4 - $int);
        }
    }

    private function bantuanSeringDapat($int)
    {
        if ($int <= 3) {
            return 0;
        } elseif (3 <= $int && $int <= 4) {
            return ($int - 3);
        } else {
            return 1;
        }
    }
    // end bantuan

    // penghasilan
    private function penghasilanSedikit($int)
    {
        if ($int <= 1200) {
            return 1;
        } elseif (1200 <= $int && $int <= 2400) {
            return (2400 - $int) / 1200;
        } else {
            return 0;
        }
    }

    private function penghasilanSedang($int)
    {
        if ($int <= 1200 || $int >= 3600) {
            return 0;
        } elseif (1200 <= $int && $int <= 2400) {
            return ($int - 1200) / 1200;
        } else {
            return (3600 - $int) / 1200;
        }
    }

    private function penghasilanBanyak($int)
    {
        if ($int <= 2400) {
            return 0;
        } elseif (2400 <= $int && $int <= 3600) {
            return ($int - 2400) / 1200;
        } else {
            return 1;
        }
    }
    // end penghasilan

    // keluarga
    private function keluargaSedikit($int)
    {
        if ($int <= 3) {
            return 1;
        } elseif (3 <= $int && $int <= 4) {
            return (4 - $int);
        } else {
            return 0;
        }
    }

    private function keluargaSedang($int)
    {
        if ($int <= 3 || $int >= 5) {
            return 0;
        } elseif (3 <= $int && $int <= 4) {
            return ($int - 3);
        } else {
            return (5 - $int);
        }
    }

    private function keluargaBanyak($int)
    {
        if ($int <= 4) {
            return 0;
        } elseif (4 <= $int && $int <= 5) {
            return ($int - 4);
        } else {
            return 1;
        }
    }
    // end keluarga

    private function findZ($array)
    {
        for ($i = 0; $i < count($array); $i++) {
            if ($i == 4 || $i == 6 || $i == 7 || $i == 8 || $i == 12 || $i == 13 || $i == 15 || $i == 16 || $i == 17 || $i == 18 || $i == 19 || $i == 21 || $i == 22 || $i == 23 || $i == 24 || $i == 25 || $i == 26) {
                $arrayZ[$i] = 1 - ($array[$i] / 2);
            } else {
                $arrayZ[$i] = ($array[$i] + 1) / 2;
            }
        }

        return $arrayZ;
    }

    private function alphaZ($alpha, $findZ)
    {
        for ($i = 0; $i < count($alpha); $i++) {
            $alphaZ[$i] = $alpha[$i] * $findZ[$i];
        }

        return $alphaZ;
    }

    private function tidakLayak($blt)
    {
        if ($blt <= 0.5) {
            return 1;
        } elseif (0.5 <= $blt && $blt <= 1) {
            return (1 - $blt) / 0.5;
        } else {
            return 0;
        }
    }

    private function layak($blt)
    {
        if ($blt <= 0.5) {
            return 0;
        } elseif (0.5 <= $blt && $blt <= 1) {
            return ($blt - 0.5) / 0.5;
        } else {
            return 1;
        }
    }
}
