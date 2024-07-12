<!DOCTYPE html>
<html>
<head>
    <title>Pengaduan Ditinjau</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4f5e50;
            color: white;
            padding: 10px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .header h1 {
            margin: 0;
        }
        .content {
            padding: 20px;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        .content td {
            padding: 10px 0;
        }
        .content td:first-child {
            width: 200px;
            font-weight: bold;
        }
        .footer {
            background-color: #4f5e50;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 0 0 8px 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pengaduan Ditinjau</h1>
        </div>
        <div class="content">
            <p>Pengaduan anda dengan informasi:</p>
            <table>
                <tr>
                    <td>Nomor Pengaduan</td>
                    <td>:</td>
                    <td>{{ $no_complaint }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pengaduan</td>
                    <td>:</td>
                    <td>{{ $tanggal_complaint }}</td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td>:</td>
                    <td>{{ $category }}</td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td>:</td>
                   <td>{{ strip_tags($description_complaint) }}</td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>Sudah kami tinjau. Terima kasih sudah memberikan informasi untuk perbaikan mengenai kendala dan kekurangan dalam aplikasi SRIKANDI.</p>
            <p>Kami akan segera memperbaiki kendala yang anda alami.</p>
            <p>Hormat kami,<br>Terima kasih sudah menggunakan layanan kami.</p>
        </div>
    </div>
</body>
</html>
