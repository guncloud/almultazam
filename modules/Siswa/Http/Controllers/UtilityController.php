<?php namespace Modules\Siswa\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Pingpong\Modules\Routing\Controller;
use Modules\Siswa\Entities\Student;
use Modules\Siswa\Entities\Config;
use Illuminate\Http\Request;
use Modules\Siswa\Entities\Classroom;
use Excel;

class UtilityController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function getDownloadFormatSiswa()
    {
        $path = base_path() . '/storage/downloads/format_data_siswa.xlsx';
        return response()->download($path);
    }

    public function postUploadSiswa(Request $request)
    {

        $uploaded_name = $request->file('upload_siswa')->getClientOriginalName();

        $request->file('upload_siswa')->move(base_path() . '/storage/uploads/', $uploaded_name);

        Excel::load(base_path() . '/storage/uploads/' . $uploaded_name, function ($reader) {
            $results = $reader->get();

            //dd($results);

            $tahun_ajar = Config::where('slug', '=', 'tahun-ajar')->first()->value;
            foreach ($results as $res) {

                $kelas = Classroom::where('classroom', '=', $res->kelas)->first();
                if (@$kelas) {
                    $kelas_id = $kelas->id;
                } else {
                    return "Kelas Tidak tersedia";
                }

                $dump = [
                    'nis' => $res->nis,
                    'nama' => $res->nama,
                    'nisn' => $res->nisn,
                    'jenis_kelamin' => strtolower($res->jenis_kelamin),
                    'tempat_lahir' => $res->tempat_lahir,
                    'tanggal_lahir' => $res->tanggal_lahir,
                    'nik' => $res->nik,
                    'alamat' => $res->alamat,
                    'jenis_tinggal' => $res->jenis_tinggal,
                    'telepon' => $res->telepon,
                    'handphone' => $res->hp,
                    'email' => $res->e_mail,
                    'ibu' => $res->ibu,
                    'tahun_lahir_ibu' => $res->tahun_lahir_ibu,
                    'jenjang_pendidikan_ibu' => $res->jenjang_pendidikan_ibu,
                    'pekerjaan_ibu' => $res->pekerjaan_ibu,
                    'skhun_ibu' => $res->skhun_ibu,
                    'kps_ibu' => 'tidak',
                    'ayah' => $res->ayah,
                    'tahun_lahir_ayah' => $res->tahun_lahir_ayah,
                    'jenjang_pendidikan_ayah' => $res->jenjang_pendidikan_ayah,
                    'pekerjaan_ayah' => $res->pekerjaan_ayah,
                    'penghasilan_ayah' => $res->penghasilan_ayah,
                    'wali' => $res->wali,
                    'tahun_lahir_wali' => $res->tahun_lahir_ayah,
                    'jenjang_pendidikan_wali' => $res->jenjang_pendidikan_ayah,
                    'pekerjaan_wali' => $res->pekerjaan_wali,
                    'penghasilan_wali' => $res->penghasilan_wali
                ];

                $new = Student::create($dump);
                if (@$new) {
                    $new->classrooms()->attach($kelas_id, ['year' => $tahun_ajar]);
                    Cache::forget('student_' . $kelas_id);
                }
            }
        });

        return redirect('/siswa');
    }
	
}