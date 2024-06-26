<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .header {
            margin-bottom: 20px;
        }

        .content {
            text-align: left;
            margin-bottom: 30px;
        }

        .signature {
            text-align: left;
            margin-top: 50px;
        }

        .signature div {
            width: 50%;
            display: inline-block;
        }

        .right {
            text-align: right;
        }

        .jumlah_keterlambatan{
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        td {
            text-align: center;
            border: none;
            height: 22px;
        }

        .empty-row {
            height: 54px;
        }

        .signature-tb {
            height: 50px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>SURAT PERNYATAAN</h2>
        <h3>TIDAK AKAN DATANG TERLAMBAT KESEKOLAH</h3>
    </div>

    <div class="content">
        <p>NIS : {{ $result['nis'] }}</p>
        <p>Nama : {{ $result['nama'] }}</p>
{{--
        @foreach ($rombels as $item)
        @if ($item['id'] == $students['rombel_id']) --}}
        <p>Rombel : {{ $result['rombel'] }} </p>
        {{-- @endif
        @endforeach --}}
        <p>Rayon : {{ $result['rayon'] }} </p>

        <p>Dengan ini menyatakan bahwa saya telah melakukan pelanggaran tata tertib sekolah, yaitu terlambat datang ke sekolah sebanyak <span class="jumlah_keterlambatan"> {{ $result['keterlambatan'] }} Kali</span> yang mana hal tersebut termasuk kedalam pelanggaran kedisiplinan. Saya berjanji tidak akan terlambat datang ke sekolah lagi. Apabila saya terlambat datang ke sekolah lagi saya siap diberikan sanksi yang sesuai dengan peraturan sekolah.</p>

        <p>Demikian surat pernyataan terlambat ini saya buat dengan penuh penyesalan.</p>
    </div>

    <table>
        <tbody>
        <tr>
            <td>Peserta Didik,</td>
            <td>Bogor, 24 November 2023</td>
        </tr>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <tr class="signature-tb">
            <td>(UI)</td>
            <td>Orang Tua/Wali Peserta</td>
        </tr>
        <br>
        <br>
        <tr>
            <td>Pembimbing Siswa,</td>
            <td>Kesiswaan,</td>
        </tr>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <tr class="signature-tb">
            <td>(PS Wikrama 1)</td>
            <td>(.....................................)</td>
        </tr>
        </tbody>
    </table>

</body>
</html>
