<?php

namespace Database\Seeders;

use App\Models\DokumenKategori;
use App\Models\Instansi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'admin@earsip.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin'
            ],
            [
                'name' => 'Pimpinan',
                'email' => 'pimpinan@earsip.com',
                'password' => Hash::make('12345678'),
                'role' => 'pimpinan'
            ]
        ];
        $dokumen_kategoris = [
            [
                'nama_kategori' => 'Dokumen Umum',
            ],
            [
                'nama_kategori' => 'Dokumen Undangan',
            ],
            [
                'nama_kategori' => 'Dokumen Pemberitahuan',
            ],
            [
                'nama_kategori' => 'Dokumen Kontrak Kegiatan',
            ],
            [
                'nama_kategori' => 'Dokumen Pengadaan Barang dan Jasa',
            ],
        ];
        $instansis = [
            [
                'nama_instansi' => 'Inspektorat',
                'singkatan_instansi' => 'INSPEKTORAT',
                'alamat' => 'Jl. Veteran No.147, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115',
            ],
            [
                'nama_instansi' => 'Sekertariat Daerah',
                'singkatan_instansi' => 'SETDA',
                'alamat' => 'Jl. Gandanegara No.25, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111',
            ],
            [
                'nama_instansi' => 'Dinas Pendidikan',
                'singkatan_instansi' => 'DISDIK',
                'alamat' => 'Jl. Veteran No 1 Gang beringin Kel. Nagri Kaler, Kecamatan Purwakarta  Kabupaten Purwakarta Jawa Barat 41114',
            ],
            [
                'nama_instansi' => 'Dinas Kesehatan',
                'singkatan_instansi' => 'DINKES',
                'alamat' => 'Jl. Veteran No.60, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115, Indonesia',
            ],
            [
                'nama_instansi' => 'Dinas Sosial Pemberdayaan Perempuan dan Perlindungan Anak',
                'singkatan_instansi' => 'DINSOS',
                'alamat' => 'Jl. Taman Pahlawan No. 9, Purwamekar, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41119',
            ],
            [
                'nama_instansi' => 'Satuan Polisi Pamong Praja',
                'singkatan_instansi' => 'SATPOL PP',
                'alamat' => 'Gg. Wortel No.29, Nagri Tengah, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111',
            ],
            [
                'nama_instansi' => 'Dinas Ketenagakerjaan dan Transmigrasi',
                'singkatan_instansi' => 'DISNAKER',
                'alamat' => 'Jl. Veteran No. 03, Ciseureuh, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115, Indonesia',
            ],
            [
                'nama_instansi' => 'Dinas Lingkungan Hidup',
                'singkatan_instansi' => 'DLH',
                'alamat' => 'Jl. Taman Pahlawan, Purwamekar, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41119',
            ],
            [
                'nama_instansi' => 'Dinas Kependudukan dan Pencatatan Sipil',
                'singkatan_instansi' => 'DISDUKCAPIL',
                'alamat' => 'Jl. Mr. Dr. Kusuma Atmaja No. 8, Nagri Tengah, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114, Indonesia',
            ],
            [
                'nama_instansi' => 'Dinas Pengendalian Penduduk dan Keluarga Berencana',
                'singkatan_instansi' => 'DPPKB',
                'alamat' => 'Jl. Taman Pahlawan, Purwamekar, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41119A',
            ],
            [
                'nama_instansi' => 'Dinas Perhubungan',
                'singkatan_instansi' => 'DISHUB',
                'alamat' => 'Jl. Veteran No.1, Ciseureuh, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41118, Indonesia',
            ],
            [
                'nama_instansi' => 'Dinas Komunikasi dan Informatika',
                'singkatan_instansi' => 'DISKOMINFO',
                'alamat' => 'Jl. Ganda Negara No.25, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111',
            ],
            [
                'nama_instansi' => 'Dinas Koperasi Usaha Kecil dan Menengah Perdagangan dan Perindustrian',
                'singkatan_instansi' => 'DISKOPRINDAG',
                'alamat' => 'Jl. Jend. Ahmad Yani No.170, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41113',
            ],
            [
                'nama_instansi' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu',
                'singkatan_instansi' => 'DPMPTSP',
                'alamat' => 'Jl. Jendral Sudirman, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115',
            ],
            [
                'nama_instansi' => 'Dinas Kepemudaan, Olahraga, Pariwisata, dan Kebudayaan',
                'singkatan_instansi' => 'DISPORAPARBUD',
                'alamat' => 'Jl. Purnawarman Timur No.2, Sindangkasih, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41112, Indonesia',
            ],
            [
                'nama_instansi' => 'Dinas Kearsipan dan Perpustakaan',
                'singkatan_instansi' => 'ARSIP',
                'alamat' => 'JL Veteran, No. 01, Komplek Perum Griya Asri, Ciseureuh, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41118, Indonesia',
            ],
            [
                'nama_instansi' => 'Dinas Pangan dan Pertanian',
                'singkatan_instansi' => 'DISPANGTAN',
                'alamat' => 'Jl. Surawinata No.30, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114, Indonesia',
            ],
            [
                'nama_instansi' => 'Dinas Perikanan dan Perternakan',
                'singkatan_instansi' => 'DISKANAK',
                'alamat' => 'Jl. Suradireja No.28, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114',
            ],
            [
                'nama_instansi' => 'Badan Perencanaan Pembangunan Penelitian dan Pengembangan Daerah',
                'singkatan_instansi' => 'BAPELITBANGDA',
                'alamat' => 'Jl. Gandanegara No. 25, Kelurahan Nageri Kidul, Kecamatan Purwakarta, Kabupaten Purwakarta, Provinsi Jawa Barat. Kode Pos 41111',
            ],
            [
                'nama_instansi' => 'Badan Keuangan dan Aset Daerah',
                'singkatan_instansi' => 'BKAD',
                'alamat' => 'Jl. Gandanegara No.25, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111',
            ],
            [
                'nama_instansi' => 'Badan Pendapatan Daerah',
                'singkatan_instansi' => 'BAPENDA',
                'alamat' => 'Jl. Surawinata No.30A, Nagri Tengah, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114, Indonesia',
            ],
            [
                'nama_instansi' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia',
                'singkatan_instansi' => 'BKPSDM',
                'alamat' => 'Jl. Veteran, Komplek Perum Hegarmanah Kel. Ciseureuh, Kec. Purwakarta, Kab. Purwakarta, Jawa Barat 41118',
            ],
            [
                'nama_instansi' => 'Badan Penanggulangan Bencana Daerah',
                'singkatan_instansi' => 'BPDB',
                'alamat' => 'Jl. Purnawarman Selatan, Sindangkasih, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41112',
            ],
            [
                'nama_instansi' => 'Dinas Pekerjaan Umum dan Tata Ruang',
                'singkatan_instansi' => 'DPUTR',
                'alamat' => 'Jalan K.K Singawinata No. 116, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111, Indonesia',
            ],
            [
                'nama_instansi' => 'Dinas Pemadam Kebakaran dan Penyelematan',
                'singkatan_instansi' => 'DAMKAR',
                'alamat' => 'Jl. Jend. Ahmed Yani No.113, Cipaisan, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41113, Indonesia',
            ],
            [
                'nama_instansi' => 'Dinas Perumahan dan Kawasa Permukiman',
                'singkatan_instansi' => 'DISTARKIM',
                'alamat' => 'Jl. Veteran No. 139, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115',
            ],
            [
                'nama_instansi' => 'Badan Kesatuan Bangsa dan Politik',
                'singkatan_instansi' => 'KESBANGPOL',
                'alamat' => 'Jl. Veteran No. 153 Purwakarta Kode Pos 41115',
            ],
            [
                'nama_instansi' => 'Dinas Pemberdayaan Masyarakat dan Desa',
                'singkatan_instansi' => 'DPMD',
                'alamat' => 'Jl. Purnawarman Timur No.8, Sindangkasih, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41112',
            ],
            [
                'nama_instansi' => 'Sekertariat Dewan',
                'singkatan_instansi' => 'SETWAN',
                'alamat' => 'Jl. Gandanegara No.25, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41111, Indonesia',
            ],
            [
                'nama_instansi' => 'RSUD Bayu Asih',
                'singkatan_instansi' => 'BAYU ASIH',
                'alamat' => 'Jl. Veteran No.39, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115',
            ],
            [
                'nama_instansi' => 'Badan Pusat Statistik',
                'singkatan_instansi' => 'BPS',
                'alamat' => 'Jl. Baru, RT.031/RW.009, Maracang, Kec. Babakancikao, Kabupaten Purwakarta, Jawa Barat 41151, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Darangdan',
                'singkatan_instansi' => 'Kecamatan Darangdan',
                'alamat' => 'JL. Raya Darangdan, KM 22, Tegalmunjul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41116, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Cibatu',
                'singkatan_instansi' => 'Kecamatan Cibatu',
                'alamat' => 'Kec. Cibatu, Kabupaten Purwakarta, Jawa Barat',
            ],
            [
                'nama_instansi' => 'Kecamatan Campaka',
                'singkatan_instansi' => 'Kecamatan Campaka',
                'alamat' => 'Jl. Raya No.17, Campaka, Kabupaten Purwakarta, Jawa Barat 41181, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Bungursari',
                'singkatan_instansi' => 'Kecamatan Bungursari',
                'alamat' => 'Kec. Bungursari, Kabupaten Purwakarta, Jawa Barat',
            ],
            [
                'nama_instansi' => 'Kecamatan Babakancikao',
                'singkatan_instansi' => 'Kecamatan Babakancikao',
                'alamat' => 'Kecamatan Babakan Cikao, Purwakarta, Jawa Barat',
            ],
            [
                'nama_instansi' => 'Kecamatan Sukasari',
                'singkatan_instansi' => 'Kecamatan Sukasari',
                'alamat' => 'Jl. Sukasari, Sukasari, Purwasari, Kabupaten Karawang, Jawa Barat 41373, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Jatiluhur',
                'singkatan_instansi' => 'Kecamatan Jatiluhur',
                'alamat' => 'Jl. Ir. H. Juanda, Jatiluhur, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41152, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Maniis',
                'singkatan_instansi' => 'Kecamatan Maniis',
                'alamat' => 'Kec. Maniis, Kabupaten Purwakarta, Jawa Barat',
            ],
            [
                'nama_instansi' => 'Kecamatan Tegalwaru',
                'singkatan_instansi' => 'Kecamatan Tegalwaru',
                'alamat' => 'Jl. Cijati Warungjeruk, Sukahaji, Tegal Waru, Kabupaten Purwakarta, Jawa Barat 41165, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Plered',
                'singkatan_instansi' => 'Kecamatan Plered',
                'alamat' => 'Jl. Raya Plered, Purwakarta, Sindangsari, Plered, Kabupaten Purwakarta, Jawa Barat 41162, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Sukatani',
                'singkatan_instansi' => 'Kecamatan Sukatani',
                'alamat' => 'Jl. Raya Sukatani KM.11, Sukatani, Purwakarta, Kabupaten Purwakarta, Jawa Barat 41167, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Bojong',
                'singkatan_instansi' => 'Kecamatan Bojong',
                'alamat' => 'Jl. Veteran No.146, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Kiarapedes',
                'singkatan_instansi' => 'Kecamatan Kiarapedes',
                'alamat' => 'Jl. Raya Kiarapedes Km. 28, Kabupaten Purwakarta, Jawa Barat',
            ],
            [
                'nama_instansi' => 'Kecamatan Wanayasa',
                'singkatan_instansi' => 'Kecamatan Wanayasa',
                'alamat' => 'Jl. Veteran No.146, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41115, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Pondoksalam',
                'singkatan_instansi' => 'Kecamatan Pondoksalam',
                'alamat' => 'Kec. Pondoksalam, Kabupaten Purwakarta, Jawa Barat',
            ],
            [
                'nama_instansi' => 'Kecamatan Pasawahan',
                'singkatan_instansi' => 'Kecamatan Pasawahan',
                'alamat' => 'Pasawahan, Kec. Pasawahan, Kabupaten Purwakarta, Jawa Barat 41172, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Purwakarta',
                'singkatan_instansi' => 'Kecamatan Purwakarta',
                'alamat' => 'Jalan Veteran, Purwakarta, Jawa Barat, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Nagri Kidul',
                'singkatan_instansi' => 'Kecamatan Nagri Kidul',
                'alamat' => 'Jl. Gandanegara No. 25, Kelurahan Nageri Kidul, Kecamatan Purwakarta, Kabupaten Purwakarta, Provinsi Jawa Barat 41111.',
            ],
            [
                'nama_instansi' => 'Kecamatan Nagri Kaler',
                'singkatan_instansi' => 'Kecamatan Nagri Kaler',
                'alamat' => 'Jalan Veteran No.7, Purwakarta, Jawa Barat 41115, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Nagri Tengah',
                'singkatan_instansi' => 'Kecamatan Nagri Tengah',
                'alamat' => 'Jalan Hidayat Martalogawa No 16 (Tegal Tulang), Purwakarta, Jawa Barat, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Sindangkasih',
                'singkatan_instansi' => 'Kecamatan Sindangkasih',
                'alamat' => 'Jalan Basuki Rahmat No. 34-36, Sindangkasih, Kecamatan Purwakarta, Kabupaten Purwakarta, Jawa Barat 41112, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Cipaisan',
                'singkatan_instansi' => 'Kecamatan Cipaisan',
                'alamat' => 'Jl. Ahmad yani (CIPAISAN), Purwakarta, Jawa Barat, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Purwamekar',
                'singkatan_instansi' => 'Kecamatan Purwamekar',
                'alamat' => 'alan Mekarsari I No.33, Purwamekar, Kecamatan Purwakarta, Purwamekar, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41114, Indonesia',
            ],
            [
                'nama_instansi' => 'Kecamatan Cisereuh',
                'singkatan_instansi' => 'Kecamatan Cisereuh',
                'alamat' => 'Ciseureuh, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat',
            ],
            [
                'nama_instansi' => 'Kecamatan Tegalmunjul',
                'singkatan_instansi' => 'Kecamatan Tegalmunjul',
                'alamat' => 'Tegalmunjul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat',
            ],
            [
                'nama_instansi' => 'Kecamatan Munjuljaya',
                'singkatan_instansi' => 'Kecamatan Munjuljaya',
                'alamat' => 'Munjuljaya, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat',
            ],
            [
                'nama_instansi' => 'Puskesmas Purwakarta',
                'singkatan_instansi' => 'Puskesmas Purwakarta',
                'alamat' => 'Jl. Siliwangi No.3, Nagri Kidul, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41117',
            ],
            [
                'nama_instansi' => 'Puskesmas Munjuljaya',
                'singkatan_instansi' => 'Puskesmas Munjuljaya',
                'alamat' => 'Ipik gandamanah, Purwakarta, Jawa Barat, Indonesia',
            ],
            [
                'nama_instansi' => 'Puskesmas Koncara',
                'singkatan_instansi' => 'Puskesmas Koncara',
                'alamat' => 'Jalan Ibrahim Singadilaga No. 60, Purwamekar, Kecamatan Purwakarta, Nagri Kaler, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41119, Indonesia',
            ],
            [
                'nama_instansi' => 'Puskesmas Campaka',
                'singkatan_instansi' => 'Puskesmas Campaka',
                'alamat' => 'Jl. Raya Campaka, Campaka, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41181, Indonesia',
            ],
            [
                'nama_instansi' => 'Puskesmas Jatiluhur',
                'singkatan_instansi' => 'Puskesmas Jatiluhur',
                'alamat' => 'JL. Ir. H. Juanda No. 73, Kec. Jatiluhur, Kab. Purwakarta Purwakarta, Jawa Barat, Indonesia',
            ],
            [
                'nama_instansi' => 'Puskesmas Plered',
                'singkatan_instansi' => 'Puskesmas Plered',
                'alamat' => 'Jl. Raya Plered, Sindangsari, Kec. Plered, Kabupaten Purwakarta, Jawa Barat 41162',
            ],
            [
                'nama_instansi' => 'Puskesmas Sukatani',
                'singkatan_instansi' => 'Puskesmas Sukatani',
                'alamat' => 'Jalan Raya Sukatani KM.12 (Samping Polsek Sukatani), Purwakarta, Jawa Barat, Indonesia',
            ],
            [
                'nama_instansi' => 'Puskesmas Darangdan',
                'singkatan_instansi' => 'Puskesmas Darangdan',
                'alamat' => 'Jl.Darangdan No.80, Purwakarta, Jawa Barat, Indonesia',
            ],
            [
                'nama_instansi' => 'Puskesmas Maniis',
                'singkatan_instansi' => 'Puskesmas Maniis',
                'alamat' => 'Maniis (Jl Raya Palumbon), Purwakarta, Jawa Barat, Indonesia',
            ],
            [
                'nama_instansi' => 'Puskesmas Tegalwaru',
                'singkatan_instansi' => 'Puskesmas Tegalwaru',
                'alamat' => 'Batutumpang, Purwakarta, Jawa Barat, Indonesia',
            ],
            [
                'nama_instansi' => 'Puskesmas Wanayasa',
                'singkatan_instansi' => 'Puskesmas Wanayasa',
                'alamat' => 'Jl. Raya Wanayasa No. 28, Kec. Wanayasa, Purwakarta Purwakarta, Jawa Barat, Indonesia 41174',
            ],
            [
                'nama_instansi' => 'Puskesmas Pasawahan',
                'singkatan_instansi' => 'Puskesmas Pasawahan',
                'alamat' => 'Jalan Terusan Kapten Halim No.105, Sawah Kulon, Pasawahan, Sawah Kulon, Kec. Purwakarta, Kabupaten Purwakarta, Jawa Barat 41172, Indonesia',
            ],
            [
                'nama_instansi' => 'Puskesmas Bojong',
                'singkatan_instansi' => 'Puskesmas Bojong',
                'alamat' => 'Jalan Raya Bojong Kab. Purwakarta, Jawa Barat',
            ],
            [
                'nama_instansi' => 'Puskesmas Maracang',
                'singkatan_instansi' => 'Puskesmas Maracang',
                'alamat' => 'Jl. Kopi, Maracang, Kec. Babakancikao, Kabupaten Purwakarta, Jawa Barat 41151, Indonesia',
            ],
            [
                'nama_instansi' => 'Puskesmas Mulyamekar',
                'singkatan_instansi' => 'Puskesmas Mulyamekar',
                'alamat' => 'Jl. Veteran No. 246, Kec. Purwakarta, Kab. Purwakarta Purwakarta, Jawa Barat, Indonesia 41118',
            ],
            [
                'nama_instansi' => 'Puskesmas Bungursari',
                'singkatan_instansi' => 'Puskesmas Bungursari',
                'alamat' => 'Jl. Raya Bungursari No. 124, Kec. Bungursari, Purwakarta Purwakarta, Jawa Barat, Indonesia',
            ],
            [
                'nama_instansi' => 'Puskesmas Cibatu',
                'singkatan_instansi' => 'Puskesmas Cibatu',
                'alamat' => 'Jl. Raya Cibatu Km. 15, Kec. Cibatu, Kab. Purwakarta Purwakarta, Jawa Barat, Indonesia 41181',
            ],
            [
                'nama_instansi' => 'Puskesmas Sukasari',
                'singkatan_instansi' => 'Puskesmas Sukasari',
                'alamat' => 'Kec.Sukasari ,Purwakarta Kab Purwakarta, Jawa Barat',
            ],
            [
                'nama_instansi' => 'Puskesmas Pondoksalam',
                'singkatan_instansi' => 'Puskesmas Pondoksalam',
                'alamat' => 'Jl. Raya Terusan Kapten Halim, Kec. Pondok Salam, Purwakarta Purwakarta, Jawa Barat, Indonesia 41115',
            ],
            [
                'nama_instansi' => 'Puskesmas Kiarapedes',
                'singkatan_instansi' => 'Puskesmas Kiarapedes',
                'alamat' => 'Jl. Raya Kiarapedes Km. 24, Kec. Kiarapedes, Purwakarta Purwakarta, Jawa Barat, Indonesia 41175',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        foreach ($dokumen_kategoris as $dokumen_kategori) {
            DokumenKategori::create($dokumen_kategori);
        }

        foreach ($instansis as $instansi) {
            Instansi::create($instansi);
        }

    }
}
