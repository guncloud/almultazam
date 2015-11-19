<?php

namespace App\Http\Controllers;

use App\Division;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Siswa\Entities\Classroom;
use Modules\Siswa\Entities\Config;
use App\Stakeholder;
use Modules\Hrd\Entities\Indicator;
use Modules\Hrd\Entities\Report;
use Modules\Siswa\Entities\Contract;
use Modules\Siswa\Entities\Ekskul;
use Modules\Siswa\Entities\Student;
use Modules\Siswa\Http\Controllers\SiswaController;
use Excel;

class ToolController extends Controller
{

    public function getIndex()
    {
        $data['title'] = 'Tool';
        $data['year'] = Config::where('slug', '=', 'tahun-ajar')->first()->value;

        return view('tool.index', $data);
    }

    public function getPdfProfileStakeholder($id)
    {
        $stakeholder = Stakeholder::find($id);

        $data['title'] = 'Profile Pegawai';
        $data['stakeholder'] = $stakeholder;

//        return view('pdf.report-profile-stakeholder', $data);

        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOrientation('portrait')->loadView('pdf.report-profile-stakeholder', $data);
        return $pdf->stream();
    }

    public function postSavePdfReportStakeholder(Request $request)
    {
       // dd($request->all());
        $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;
        $stakeholder = Stakeholder::find($request->get('stakeholder'));

        $report = Indicator::has('performances')->get();

        $reportScore = Report::where('stakeholder_id', '=', $request->get('stakeholder'))
            ->where('semester', '=', $request->get('semester'))
            ->where('year', '=', $year)
            ->get();

        if(count($reportScore) > 0){
            $totalScore = 0;
            foreach ($reportScore as $rpt) {
                $reportScores[$rpt->performance_id] = $rpt;
                $totalScore += $rpt->score;
            }
        }else{
            $reportScores = false;
            $totalScore = 0;
        }

        $data['kepala_divisi'] = Config::where('slug', '=', 'kepala-divisi')->first();
        $data['reportScores'] = $reportScores;
        $data['totalScore'] = $totalScore;
        $data['report'] = $report;
        $data['stakeholder'] = $stakeholder;
        $data['title'] = 'Rapor Pegawai';

//        return view('pdf.report-stakeholder', $data);

        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOrientation('portrait')->loadView('pdf.report-stakeholder', $data);
        return $pdf->stream();
    }

    public function getSavePdfDetailStudent(Request $request, $id)
    {
        $q = $request->get('q');
        $student = Student::find($id);

        $_classroom = new Classroom;
        $_siswa = new SiswaController;
        $_contract = new Contract;

        if($q == 'biodata')
        {
            $title = 'Data Biodata';

            $page = 'biodata';
        }
        elseif($q == 'akademik')
        {
            $title = 'Data Akademik';
            $data['contracts'] = $_contract->getContract();
            $data['scores'] = $_siswa->getAkademik($id);

            $page = 'akademik';
        }
        elseif($q == 'ekskul')
        {
            $title = 'Data Ekskul';

            $data['ekskuls'] = Ekskul::all();
            $data['ekskulStudent'] = $_siswa->getEkskul($id);

            $page = 'ekskul';
        }
        elseif($q == 'pelanggaran')
        {
            $title = 'Data Pelanggaran';
            $page = 'pelanggaran';
        }
        elseif($q == 'prestasi')
        {
            $title = 'Data Prestasi';
            $page = 'prestasi';
        }
        elseif($q == 'full')
        {
            $title = 'Data Detail Siswa';
            $page = 'full';

            $data['contracts'] = $_contract->getContract();
            $data['scores'] = $_siswa->getAkademik($id);
            $data['ekskuls'] = Ekskul::all();
            $data['ekskulStudent'] = $_siswa->getEkskul($id);

        }

        //dd($_classroom->getClass($id));

        $data['student'] = $student;
        $data['title'] = $title;
        $data['classroom'] = $_classroom->getClass($id);

        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOrientation('portrait')->loadView('pdf.students.'.$page, $data);
        return $pdf->stream();
    }

    public function getPrintCover(Request $request)
    {
        $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;

        $data['year'] = $year;
        $data['semester'] = $request->get('semester');

       // return view('pdf.cover', $data);

        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOrientation('portrait')->loadView('pdf.cover', $data);
        return $pdf->stream();
    }

    public function getDownloadFormatSiswa(){
        $path = base_path() . '/storage/downloads/format_data_siswa.xlsx';
        return response()->download($path);
    }

    public function getDownloadFormatPegawai(){
        $path = base_path() . '/storage/downloads/format_data_pegawai.xlsx';
        return response()->download($path);
    }

    public function postUploadSiswa(Request $request){

        $uploaded_name = $request->file('upload_siswa')->getClientOriginalName();

        $request->file('upload_siswa')->move(base_path() . '/storage/uploads/', $uploaded_name);

        Excel::load(base_path() . '/storage/uploads/'.$uploaded_name, function($reader) {
            $results = $reader->get();

            $tahun_ajar = Config::where('slug', '=', 'tahun-ajar')->first()->value;
            foreach($results as $res){

                $kelas = Classroom::where('classroom', '=', $res->kelas)->first();
                if(@$kelas){
                    $kelas_id = $kelas->id;
                }else{
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
                if(@$new){
                    $new->classrooms()->attach($kelas_id, ['year' => $tahun_ajar]);
                }
            }
        });

        return redirect('/siswa');
    }

    public function postUploadStakeholder(Request $request){

        $uploaded_name = $request->file('upload_pegawai')->getClientOriginalName();

        $request->file('upload_pegawai')->move(base_path() . '/storage/uploads/', $uploaded_name);

        Excel::load(base_path() . '/storage/uploads/'.$uploaded_name, function($reader) {
            $results = $reader->get();

//            dd($results);

            $divisi = '';
            $tahun_ajar = Config::where('slug', '=', 'tahun-ajar')->first()->value;
            foreach($results as $res){

                $division = Division::where('slug', '=', $res->division)->first();
                if(count($division) <= 0){
                    Session::flash('info', 'Error divisi');
                    return redirect('/hrd/stakeholder');
                }

                $dump = [
                    'nama' => $res->nama,
                    'ktp' => $res->ktp,
                    'tempat_lahir' => $res->tempat_lahir,
                    'tanggal_lahir' => $res->tanggal_lahir,
                    'jenis_kelamin' => $res->jenis_kelamin,
                    'status' => $res->status,
                    'division_id' => $division->id,
//                    'photo' => $res->photo,
                    'nrp' => $res->nrp,
                    'status_kepegawaian' => $res->status_kepegawaian,
                    'jabatan' => $res->jabatan,
                    'mulai_kerja' => $res->mulai_kerja,
                    'golongan' => $res->golongan,
                    'status_marital' => $res->status_marital,
                    'nama_istri_suami' => $res->nama_istri_suami,
                    'alamat_rumah' => $res->alamat_rumah,
                    'alamat_sekarang' => $res->alamat_sekarang,
                    'kontak' => $res->kontak,
                    'tk' => $res->tk,
                    'sd' => $res->sd,
                    'smp' => $res->smp,
                    'sma' => $res->sma,
                    'diploma' => $res->diploma,
                    'universitas_s1' => $res->universitas_s1,
                    'fakultas_s1' => $res->fakultas_s1,
                    'jurusan_s1' => $res->jurusan_s1,
                    'program_pendidikan_s1' => $res->program_pendidikan_s1,
                    'universitas_s2' => $res->universitas_s2,
                    'fakultas_s2' => $res->fakultas_s2,
                    'jurusan_s2' => $res->jurusan_s2,
                    'program_pendidikan_s2' => $res->program_pendidikan_s2,
                    'nama_lembaga_1' => $res->nama_lembaga_1,
                    'jenis_pendidikan_1' => $res->jenis_pendidikan_1,
                    'nama_lembaga_2' => $res->nama_lembaga_2,
                    'jenis_pendidikan_2' => $res->jenis_pendidikan_2,
                    'nama_lembaga_3' => $res->nama_lembaga_3,
                    'jenis_pendidikan_3' => $res->jenis_pendidikan_3,
                    'lembaga_pengalaman_kerja_1' => $res->lembaga_pengalaman_kerja_1,
                    'alamat_pengalaman_kerja_1' => $res->alamat_pengalaman_kerja_1,
                    'jabatan_pengalaman_kerja_1' => $res->jabatan_pengalaman_kerja_1,
                    'awal_kerja_1' => $res->awal_kerja_1,
                    'akhir_kerja_1' => $res->akhir_kerja_1,
                    'lembaga_pengalaman_kerja_2' => $res->lembaga_pengalaman_kerja_2,
                    'alamat_pengalaman_kerja_2' => $res->alamat_pengalaman_kerja_2,
                    'jabatan_pengalaman_kerja_2' => $res->jabatan_pengalaman_kerja_2,
                    'awal_kerja_2' => $res->awal_kerja_2,
                    'akhir_kerja_2' => $res->akhir_kerja_2,
                    'lembaga_organisasi_1' => $res->lembaga_organisasi_1,
                    'jabatan_organisasi_1' => $res->jabatan_organisasi_1,
                    'lembaga_organisasi_2' => $res->lembaga_organisasi_2,
                    'jabatan_organisasi_2' => $res->jabatan_organisasi_2,
                    'lembaga_organisasi_3' => $res->lembaga_organisasi_3,
                    'jabatan_organisasi_3' => $res->jabatan_organisasi_3,
                    'lembaga_organisasi_4' => $res->lembaga_organisasi_4,
                    'jabatan_organisasi_4' => $res->jabatan_organisasi_4,
                    'keahlian_1' => $res->keahlian_1,
                    'keahlian_2' => $res->keahlian_2,
                    'keahlian_3' => $res->keahlian_3,
                    'pekerjaan_keluarga' => $res->pekerjaan_keluarga,
                    'child_1' => $res->child_1,
                    'child_2' => $res->child_2,
                    'child_3' => $res->child_3,
                    'child_4' => $res->child_4,
                    'child_5' => $res->child_5,
                    'child_6' => $res->child_6,
                    'child_7' => $res->child_7,
                    'child_8' => $res->child_8,
                    'universitas_diploma' => $res->universitas_diploma,
                    'fakultas_diploma' => $res->fakultas_diploma,
                    'jurusan_diploma' => $res->jurusan_diploma,
                    'program_pendidikan_diploma' => $res->program_pendidikan_diploma,
                ];

                $new = Stakeholder::create($dump);
                if(!$new){
                    Session::flash('info', 'Error importing');
                }
            }
        });

        Session::flash('info', 'Data imported');

        return redirect('/hrd/stakeholder');
    }

}
