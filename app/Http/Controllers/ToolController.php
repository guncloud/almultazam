<?php

namespace App\Http\Controllers;

use App\Division;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Hrd\Entities\Performance;
use Modules\Hrd\Entities\Position;
use Modules\Hrd\Entities\PositionStakeholder;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Modules\Hrd\Entities\Golongan;

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
        $position = DB::table('stakeholders')
            ->select('position')
            ->join('position_stakeholder', 'position_stakeholder.stakeholder_id', '=', 'stakeholders.id')
            ->join('positions', 'positions.id', '=', 'position_stakeholder.position_id')
            ->where('stakeholders.id', '=', $request->get('stakeholder'))
            ->get();

        $report = Indicator::has('performances')->get();

        $reportScore = Report::where('stakeholder_id', '=', $request->get('stakeholder'))
            ->join('performances', 'performances.id', '=', 'reports.performance_id')
            ->where('semester', '=', $request->get('semester'))
            ->where('year', '=', $year)
            ->get();

        if(count($reportScore) > 0){
            $totalScore = 0;
            foreach ($reportScore as $rpt) {
//                echo "<pre>";
//                print_r($rpt);
                $reportScores[$rpt->performance_id] = $rpt;
                $totalScore += $rpt->score;
//                echo $rpt->score;
//                echo "<br />";
            }
        }else{
            $reportScores = false;
            $totalScore = 0;
        }
//
//        echo "<pre>";
//        print_r($reportScore->toArray());
//        exit();

//        exit();

        $data['kepala_divisi'] = Config::where('slug', '=', 'kepala-divisi')->first();
        $data['reportScores'] = $reportScores;
        $data['totalScore'] = $totalScore;
        $data['report'] = $report;
        $data['stakeholder'] = $stakeholder;
        $data['title'] = 'Rapor Pegawai';
        $data['positions'] = (count($position) > 0) ? $position : false;
        $data['bulan'] = $this->bulan(date('m'));

//        return view('pdf.report-stakeholder', $data);

        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOrientation('portrait')->loadView('pdf.report-stakeholder', $data);
        return $pdf->stream();
    }

    function bulan($bln)
    {
        switch ($bln)
        {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
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

//        return view('pdf.cover', $data);

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

    public function getDownloadFormatReportPegawai(){
        $path = base_path() . '/storage/downloads/format_report_pegawai.xlsx';
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

                $division = Division::where('slug', '=', str_slug($res->division , '-'))->first();

                if($res->golongan == '-'){
                    $golongan_id = null;
                }else{
                    $golongan = Golongan::where('slug', '=', str_slug($res->golongan , '-'))->first();

                    if($golongan){
                        $golongan_id = $golongan->id;
                    }
                }

                if(count($division) <= 0){
                    Session::flash('info', 'Error divisi');
                    return redirect('/hrd/stakeholder');
                }

//                if($res->jabatan != '-'){
//                    $postition = Position::where('position', '=', $res->jabatan)->first();
//                }
//
//                echo $postition->id;
//
//                exit;

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
                    'golongan_id' => $golongan_id,
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

                if($res->jabatan != '-'){
                    $position = Position::where('position', '=', $res->jabatan)->first();

                    PositionStakeholder::create(array(
                        'stakeholder_id' => $new->id,
                        'position_id' => $position->id
                    ));
                }

                if(!$new){
                    Session::flash('info', 'Error importing');
                }
            }
        });

        Session::flash('info', 'Data imported');

        return redirect('/hrd/stakeholder');
    }

    public function postUploadRaportPegawai(Request $request)
    {
        $uploaded_name = $request->file('upload_pegawai')->getClientOriginalName();
        $semester = $request->get('semester');
        $request->file('upload_pegawai')->move(base_path() . '/storage/uploads/', $uploaded_name);

        Excel::load(base_path() . '/storage/uploads/'.$uploaded_name, function($reader) use ($request) {
            $results = $reader->get();

            foreach ($results as $p => $v) {

                foreach ($v as $k => $item) {
                    $stk = Stakeholder::where('nrp', $item['nrp'])->first();
                   if($stk){
                       foreach($item as $ind => $val){
                           if($ind != 'nrp'){
                               if($val > 0){
                                   $performance = explode('_', $ind);
                                   $performance = Performance::where('performance', 'LIKE', $performance[0].' '.$performance[1].'%')->first();

                                   $year = Config::where('slug', '=', 'tahun-ajar')->first()->value;

                                   $array = array(
                                       'stakeholder_id' => $stk->id,
                                       'performance_id' => $performance->id,
                                       'semester' => $request->get('semester'),
                                       'score' => $val,
                                       'year' => $year
                                   );

                                   $exist = Report::where('stakeholder_id', '=', $stk->id)
                                            ->where('performance_id', '=', $performance->id)
                                            ->where('semester', '=', $request->get('semester'))
                                            ->where('year', '=', $year)
                                            ->first();

                                   if($exist){
                                       $update = Report::where('id', $exist->id)
                                           ->update(array('score' => $val));

                                       echo "Update <br>";
                                       flush();
                                       ob_flush();
                                        usleep(1000);
                                   }else{
                                       $insert = Report::create($array);
                                       if($insert){
                                          echo "Insert <br>";
                                          flush();
                                          ob_flush();
                                           usleep(1000);
                                       }else{
                                          echo "error Insert <br>";
                                          flush();
                                          ob_flush();
                                           usleep(1000);
                                       }
                                   }
                                   flush();
                                   ob_flush();
                                   usleep(1000);
                               }
                           }
                           flush();
                           ob_flush();
                           usleep(1000);
                       }
                   }else{
                       echo "NRP ".$item['nrp']." tidak ditemukan <br>";
                       flush();
                       ob_flush();
                       usleep(1000);
                   }
                }

                Session::flash('info', 'Imported');
            }
        });

        return redirect('/hrd/report');
    }

    public function getRefresh()
    {
        Cache::flush();
        return back();
    }

    public function getExportPegawai()
    {

        $stakeholders = Stakeholder::all();
//
//        echo "<pre>";
//        print_r($stakeholders);
//        exit;

//        $users = User::select('id', 'name', 'email', 'created_at')->get();
        Excel::create('data_pegawai', function($excel) use($stakeholders) {
            $excel->sheet('Sheet 1', function($sheet) use($stakeholders) {
                $sheet->fromArray($stakeholders);
            });
        })->export('xls');
    }

    public function getExportReportPegawai()
    {
        $data = DB::table('stakeholders')
            ->select(
                'stakeholders.nama',
                'stakeholders.id',
                'performances.performance',
                'reports.score'
            )
            ->join('reports', 'reports.stakeholder_id', '=', 'stakeholders.id')
            ->join('performances', 'performances.id', '=', 'reports.performance_id')
            ->get();

        $rec = array();

        foreach ($data as $i => $v) {
            $rec[$v->id]['nama'] = $v->nama;
            $rec[$v->id][$v->performance] = $v->score;
//            $rec[$v->id]['score'][] = $v->score;

//            $rec[$i]['nama'] = $v->nama;
//            $rec[$i]['performance'] = $v->performance;
//            $rec[$i]['score'] = $v->score;
        }

//        echo "<prE>";
//        print_r($rec);
//        exit;

        Excel::create('data_report_pegawai', function($excel) use($rec) {
            $excel->sheet('Sheet 1', function($sheet) use($rec) {
                $sheet->fromArray($rec);
            });
        })->export('xlsx');


    }
}
