<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\students;
use App\Models\rayons;
use App\Models\rombels;
use App\Models\lates;
use Illuminate\Support\Facades\Auth;
use PDF;


class PsController extends Controller
{
    public function index()
    {
        $students = students::all();
        $rombels = rombels::all();
        $rayons = rayons::all();
        return view('ps.student', compact('rombels', 'students', 'rayons'));
    }

    public function lates()
    {
        $students = students::all();
        $rombels = rombels::all();
        $rayons = rayons::all();
        $latests = lates::all();
        return view('ps.lates', compact('latests', 'rombels', 'students', 'rayons'));
    }

    public function rekap()
    {
        $rayons = rayons::all();
        $students = students::all();
        $dataCollection = lates::all();
        foreach ($rayons as $key)
            if ($key['user_id'] == Auth::id()) {
                foreach ($students as $std) {
                    if ($std['rayon_id'] == $key['id']) {
                        foreach ($dataCollection as $lates) {
                            if ($lates['student_id'] == $std['id']) {
                                $id = $std['id'];
                            }
                        }
                    }
                }
            }
        $kategori = $dataCollection->where('student_id');
        $counts = [];
        foreach ($kategori as $key) {

            $student_id = $key['student_id'];
            if (isset($counts[$student_id])) {
                $counts[$student_id]++;
            } else {
                $counts[$student_id] = 1;
            }
        }

        $result = $counts;
        // $students = lates::with('student')->simplePaginate(10);
        return view('Ps.rekap', compact('rayons','dataCollection', 'students', 'result'));
    }

    public function show($id){
        $students = students::find($id);
        $latests = lates::all();
        $rombels = rombels::all();
        $rayons = rayons::all();

        return view('Ps.detail', compact('latests','students', 'rombels', 'rayons'));
    }

    public function downloadPDF($id)
    {


        $students = students::find($id)->toArray();
        $rombels = rombels::all()->toArray();
        $rayons = rayons::all()->toArray();
        $dataCollection = lates::all();
        $kategori = $dataCollection->where('student_id', $id)->count();


        $nama = $students['nama'];
        $nis = $students['nis'];
        foreach ($rombels as $key) {
            if ($key['id'] == $students['rombel_id']) {
                $rombel = $key['rombels'];
            }
        }
        foreach ($rayons as $key) {
            if ($key['id'] == $students['rayon_id']) {
                $rayon = $key['rayons'];
            }
        }

        $result =
            [
                'nama' => $nama,
                'nis' => $nis,
                'rombel' => $rombel,
                'rayon' => $rayon,
                'keterlambatan' => $kategori
            ];


        // $result = data($resultStudents, $resultRombels, $resultRayons);


        view()->share('result', $result);

        $pdf = PDF::loadView('latests.download-pdf',  $result);

        return $pdf->download('SURAT_PERNYATAAN.pdf');
    }


}
