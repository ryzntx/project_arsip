<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Pencarian</title>
</head>
<body>
    <p>{{$dokumen->nama_dokumen}}</p>
    <p>{{$dokumen->penerima}}</p>
    <p>{{$dokumen->pengirim}}</p>
    <p>{{$dokumen->lampiran}}</p>
    <p>{{$dokumen->tanggal_masuk}}</p>
    <p>{{$dokumen->tanggal_keluar}}</p>
    <p>{{$dokumen->keterangan}}</p>
    <p>{{$dokumen->status}}</p>
    <p>{{$dokumen->persetujuan}}</p>
    <p>{{$dokumen->bukti_diterima}}</p>

    <p>{{$dokumen->instansi->nama_instansi}}</p>
    <p>{{$dokumen->dokumen_kategori->nama_kategori}}</p>
    <p>{{$dokumen->bukti_diterima}}</p>

</body>
</html>
