<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 11px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #004d4d;
            padding: 4px;
        }

        th {
            background: #e6f2f2;
        }

        .footer {
            margin-top: 10px;
            font-size: 10px;
        }
    </style>
</head>

<body>

    <center>
        <img src="{{ public_path('img/pku/logo_clear_100kb.png') }}" width="90">
        <h2 style="margin-bottom: 2px">JADWAL POLIKLINIK SPESIALIS<br>RUMAH SAKIT PKU MUHAMMADIYAH SUKOHARJO</h2>
        <h3 style="color:rgb(214, 66, 66)"><i>Dicetak pada {{ now()->locale('id')->format('d-m-Y H:i:s') }} WIB</i></h3>
    </center>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Dokter</th>
                <th>Poli Spesialis</th>
                <th>Hari</th>
                <th>Jam</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($jadwal as $row)
                <tr>
                    <td style="text-align: center;">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ data_get($row, 'namadokter', '-') }}
                    </td>

                    <td style="text-align: center;">
                        {{ data_get($row, 'namasubspesialis', '-') }}
                    </td>

                    <td style="text-align: center;">
                        {{ data_get($row, 'namahari', '-') }}
                    </td>

                    <td style="text-align: center;">
                        {{ data_get($row, 'jadwal', '-') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">
                        Tidak ada jadwal dokter pada minggu ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <h3>* Dengan perjanjian</h3>
        <p>Pendaftaran ditutup 30 menit sebelum poli dimulai.</p>
        <p>Informasi lebih lanjut, silakan hubungi bagian Informasi RS (<b style="color:red">Jam Kerja Kantor</b>) melalui</p>
        <ul>
            <li>Telp: 0271 593 979</li>
            <li>Whatsapp: 0851-5076-3480</li>
        </ul>
    </div>

</body>

</html>
