<?php

namespace App\Http\Controllers;

use App\Models\lates;
use App\Models\rombels;
use App\Models\rayons;
use App\Models\students;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use PDF;
use App\Exports\LatesExport;
use Excel;

class LatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latests = lates::all();
        $students = lates::with('student')->simplePaginate(10);
        return view('latests.index', compact('latests', 'students'));
    }

    public function rekap()
    {
            $dataCollection = lates::all();
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
            $students = lates::with('student')->simplePaginate(10);
            return view('latests.rekap', compact('dataCollection', 'students', 'result'));
    }


    public function createExcel()

{

	$file_name = 'data_keterlambatan'.'.xlsx';

	return Excel::download(new LatesExport, $file_name);

}





        public function search(Request $request)
    {
        $searchQuery = $request->input('query');
        $latests = lates::all();
        $students = lates::with('student')->simplePaginate(10);
        // $request->session()->put('search_query', $query);
        $latestSearch = lates::whereHas('student', function ($studentQuery) use ($searchQuery) {
        $studentQuery->where('nama', 'like', '%' . $searchQuery . '%')
                    ->orWhere('nis', 'like', '%' . $searchQuery . '%');
    })
    ->orWhere('date_time_late', 'like', '%' . $searchQuery . '%')
    ->orWhere('information', 'like', '%' . $searchQuery . '%')
    ->get();

        return view('latests.index', compact('latestSearch', 'latests', 'students', 'searchQuery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = students::all();
        $latests = lates::all();
        return view('latests.create', compact('students', 'latests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'student_id' => 'required',
        ]);
        $imageName = time().'.'.$request->bukti->extension();

        $request->bukti->move(public_path('images'), $imageName);

        lates::create([
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
            'bukti' => $imageName,
            'student_id' => $request->student_id,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data keterlambatan!');    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $students = students::find($id);
        $latests = lates::all();
        $rombels = rombels::all();
        $rayons = rayons::all();

        return view('Ps.detail', compact('latests', 'students', 'rombels', 'rayons'));
     }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $students = students::all();
        $latests = lates::find($id);
        return view('latests.edit', compact('students', 'latests'));
    }

    public function downloadPDF($id){


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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
           $request->validate([
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'student_id' => 'required',
        ]);

        $imageName = time().'.'.$request->bukti->extension();

        $request->bukti->move(public_path('images'), $imageName);

        lates::where('id', $id)->update([
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
            'bukti' => $imageName,
            'student_id' => $request->student_id
        ]);

        return redirect()->route('latests.home')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        lates::where('id', $id)->delete();
        return redirect()->back()->with('Deleted', 'Berhasil menghapus data');
    }
}
