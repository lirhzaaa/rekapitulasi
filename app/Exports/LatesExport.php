<?php

namespace App\Exports;

use App\Models\Lates;
use App\Models\Students;
use App\Models\rombels;
use App\Models\rayons;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LatesExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->getData());
    }
    private function getData()
    {
        // Mendapatkan semua data keterlambatan
        $lates = lates::all();

        // Inisialisasi array untuk melacak jumlah keterlambatan per student_id
        $studentCounts = [];

        // Inisialisasi array untuk menyimpan hasil pencarian
        $results = [];

        // Iterasi melalui data keterlambatan
        foreach ($lates as $late) {
            // Menambahkan atau meningkatkan jumlah keterlambatan per student_id
            $studentId = $late->student_id;
            $studentCounts[$studentId] = isset($studentCounts[$studentId]) ? $studentCounts[$studentId] + 1 : 1;
        }

        // Mengonversi array hasil ke dalam koleksi
        $studentCountsCollection = collect($studentCounts);

        // Iterasi melalui data keterlambatan
        foreach ($lates as $late) {
            // Mencari siswa dengan student_id yang sesuai dan mengambil relasi rayon dan rombel
            $student = students::with(['rayon', 'rombel'])->find($late->student_id);

            // Jika siswa ditemukan
            if ($student) {
                // Mendapatkan data yang diinginkan
                $result = [
                    'nis' => $student->nis,
                    'nama' => $student->nama,
                    'rombel' => $student->rombel->rombels,
                    'rayon' => $student->rayon->rayons,
                    'jumlahKeterlambatan' => $studentCounts[$student->id],
                ];

                $results[$student->id] = $result;
            }
        }

        // Mengonversi array hasil ke dalam koleksi
        return $results = collect(array_values($results));

        // Menampilkan hasil pencarian



    }

    public function styles(Worksheet $sheet)
    {
        // Styling untuk header
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'DDDDDD'],
            ],
        ]);

        // Styling untuk sel data
        $sheet->getStyle('A2:E' . $sheet->getHighestRow())->applyFromArray([
            'font' => [
                'bold' => false,
            ],
        ]);
    }
    public function headings(): array
    {
	return [
        'Nis',
        'Nama',
        'Rombel',
        'Rayon',
        'Total Keterlambatan',
	];
    }
}
