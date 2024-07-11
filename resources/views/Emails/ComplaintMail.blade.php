<!DOCTYPE html>
<html>
<head>
    <title>Pengaduan Baru</title>
</head>
<body>
    <h1>Pengaduan Baru Dari :</h1>
    <p><strong>Nama :</strong> {{ $user_name }}</p>
    <p><strong>Asal Instansi:</strong> {{ $user_agency }}</p>
    <p><strong>No Pengaduan</strong> {{ $no_complaint }}</p>
    <p><strong>Tanggal Pengaduan:</strong> {{ $created_at }}</p>
    <p><strong>Kategori Pengaduan:</strong> {{ $category}}</p>
    <p><strong>Deskripsi Pengaduan:</strong> {{ $description_complaint }}</p>
</body>
</html>
