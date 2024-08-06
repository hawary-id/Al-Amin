<!DOCTYPE html>
<html>
<head>
    <title>Cetak Data Peserta</title>
    <style>
        /* CSS umum untuk halaman */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 20px;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        .content table, .content th, .content td {
            border: 1px solid #000;
        }
        .content th, .content td {
            padding: 8px;
            text-align: left;
        }
        .footer {
            text-align: center;
        }

        /* CSS khusus untuk pencetakan */
        @media print {
            .no-print {
                display: none;
            }
            .content {
                margin: 0;
            }
            .container {
                width: 100%;
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Data Peserta</h1>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>ID</th>
                    <td>{{ $peserta->id }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $peserta->nama }}</td>
                </tr>
                <tr>
                    <th>Tempat Lahir</th>
                    <td>{{ $peserta->tempat_lahir }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $peserta->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $peserta->alamat }}</td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
