<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

$this->fpdf->FPDF("P", "cm", 'A4');
$this->fpdf->SetMargins(1, 0.5, 1);
$this->fpdf->SetAutoPageBreak(true, 0);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();

$this->fpdf->AddPage();
$logo = config('logo') == '' ? 'assets/images/logo.jpg' : 'assets/images/'.config('logo');
$this->fpdf->Image($logo, 1.2 ,0.5 ,2 ,2);

$this->fpdf->SetX(3);
$this->fpdf->SetFont('Helvetica','B',9);
$this->fpdf->Cell(15,0.5, strtoupper(config('nama_sekolah')), 0, 0, 'C');

$this->fpdf->Ln();
$this->fpdf->SetX(3);
$this->fpdf->Cell(15,0.5, config('akreditasi'), 0, 0, 'C');

$this->fpdf->Ln();
$this->fpdf->SetX(3);
$this->fpdf->SetFont('helvetica','',9);
$this->fpdf->Cell(15,0.5, config('alamat'), 0, 0, 'C');

$this->fpdf->Ln();
$this->fpdf->SetX(3);
$this->fpdf->Cell(15,0.5, 'Website : ' . config('website') . '  |  Email : '. config('email'), 0, 0, 'C');

$logo = config('logo2') == '' ? 'assets/images/logo.jpg' : 'assets/images/'.config('logo2');
$this->fpdf->Image($logo, 17.8 ,0.5 ,2 ,2);

$this->fpdf->Line(1,2.7,20,2.7);
$this->fpdf->Line(1,2.75,20,2.75);

if ($query['photo'] != '' && file_exists('assets/photo/'.$query['photo']))
{
    $this->fpdf->Image('assets/photo/'.$query['photo'], 17, 3.5, 3, 4);
}
else
{
    $this->fpdf->Ln();
    $this->fpdf->SetY(3.5);
    $this->fpdf->SetX(17);
    $this->fpdf->SetFont('Helvetica','',8);

}

$this->fpdf->SetXY(1, 3.3);
$this->fpdf->SetFont('Helvetica','B',9);
$this->fpdf->Cell(15,0.7,'FORMULIR PENERIMAAN PESERTA DIDIK BARU (PPDB) ONLINE', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',9);
$this->fpdf->Cell(15, 0.7, 'DATA PENDAFTARAN', 0, 0, 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'NOMOR PENDAFTARAN',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(10.7 ,0.5, strtoupper($query['no_daftar']), 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, strtoupper('Jalur Pendaftaran'),0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(10.7 ,0.5, strtoupper(jalur($query['jalur_id'])), 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, strtoupper('Pilihan 1'),0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(10.7 ,0.5, strtoupper($query['pilihan_1']), 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, strtoupper('Pilihan 2'),0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(10.7 ,0.5, strtoupper($query['pilihan_2']), 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, strtoupper('Pilihan 3'),0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(10.7 ,0.5, strtoupper($query['pilihan_3']), 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, strtoupper('Pilihan 4'),0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(10.7 ,0.5, strtoupper($query['pilihan_4']), 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, strtoupper('Tanggal Pendaftaran'),0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(10.7 ,0.5, indo_date($query['tgl_daftar']), 0, 'LR', 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',9);
$this->fpdf->Cell(15, 0.7, 'DATA CALON SISWA', 0, 0, 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'NAMA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, strtoupper($query['nama']), 0, 'LR', 'L');
// kolom 2
$this->fpdf->Cell(4 ,0.5, 'NO. KARTU KELUARGA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, $query['no_kk'], 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'NISN',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, $query['nisn'], 0, 'LR', 'L');
// kolom 2
$this->fpdf->Cell(4 ,0.5, 'JML SAUDARA KANDUNG',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, ($query['sdr_kandung']), 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'NIK',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, $query['nik'], 0, 'LR', 'L');
// kolom 2
$this->fpdf->Cell(4 ,0.5, 'ANAK KE',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, ($query['anak_ke']), 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'NO. AKTE KELAHIRAN',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, $query['no_akte'], 0, 'LR', 'L');
// kolom 2
$this->fpdf->Cell(4 ,0.5, 'STATUS ANAK',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, (strtoupper($query['st_anak'])), 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'JENIS KELAMIN',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$jns_kelamin = $query['jns_kelamin'] == 'P' ? 'Perempuan' : 'Laki-laki';
$this->fpdf->Cell(5.7 ,0.5, strtoupper($jns_kelamin), 0, 'LR', 'L');
// kolom 2
$this->fpdf->Cell(4 ,0.5, 'BERAT BADAN',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, (int)$query['b_badan'].' CM', 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'TEMPAT LAHIR',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, strtoupper($query['tmp_lahir']), 0, 'LR', 'L');
// kolom 2
$this->fpdf->Cell(4 ,0.5, 'TINGGI BADAN',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, (int) $query['t_badan'] .' KG', 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'TANGGAL LAHIR',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, strtoupper(indo_date($query['tgl_lahir'])), 0, 'LR', 'L');
// kolom 2
$this->fpdf->Cell(4 ,0.5, 'GOLONGAN DARAH',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, strtoupper($query['g_darah']), 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'AGAMA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, strtoupper(agama($query['agama'])), 0, 'LR', 'L');
// kolom 2
$this->fpdf->Cell(4 ,0.5, 'NO. HP',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, $query['telp'], 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$cur_x = $this->fpdf->GetX();
$cur_y = $this->fpdf->GetY();
$this->fpdf->Cell(4 ,0.5, 'ALAMAT LENGKAP',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->MultiCell(5.7 ,0.5, strtoupper($query['alamat']), 0, 'L');
$this->fpdf->SetXY($cur_x + 10, $cur_y);
// kolom 2
$cur_x = $this->fpdf->GetX();
$this->fpdf->Cell(4 ,0.5, 'NO. KARTU IND. PINTAR',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, $query['no_kip'], 0, 'LR', 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',9);
$this->fpdf->Cell(15, 0.7, 'DATA SEKOLAH', 0, 0, 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'ASAL SEKOLAH',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(10.7 ,0.5, strtoupper($query['asal_sekolah']), 0, 'LR', 'L');

/*$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',9);
$this->fpdf->Cell(15, 0.7, 'DATA ORANG TUA / WALI', 0, 0, 'L');*/

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',9);
$this->fpdf->Cell(10, 0.7, 'DATA AYAH', 0, 0, 'L');
$this->fpdf->Cell(10, 0.7, 'DATA IBU', 0, 0, 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'NAMA AYAH',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, strtoupper($query['nama_ortu']), 0, 'LR', 'L');
// kolom 2
$this->fpdf->Cell(4 ,0.5, 'NAMA IBU',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, strtoupper($query['nama_ibu']), 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'NIK AYAH',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, $query['nik_ayah'], 0, 'LR', 'L');
// kolom 2
$this->fpdf->Cell(4 ,0.5, 'NIK IBU',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, strtoupper($query['nik_ibu']), 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$cur_x = $this->fpdf->GetX();
$cur_y = $this->fpdf->GetY();
$this->fpdf->Cell(4 ,0.5, 'ALAMAT AYAH',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->MultiCell(5.7 ,0.5, strtoupper($query['alamat_ortu']), 0, 'L', false);
$this->fpdf->SetXY($cur_x + 10, $cur_y);
// kolom 2
$cur_x = $this->fpdf->GetX();
$this->fpdf->Cell(4 ,0.5, 'ALAMAT IBU',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->MultiCell(5.7 ,0.5, strtoupper($query['alamat_ibu']), 0, 'L', false);

$this->fpdf->Ln(0);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'PEKERJAAN AYAH',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, strtoupper($query['pk_nama']), 0, 'LR', 'L');
// kolom 2
$this->fpdf->Cell(4 ,0.5, 'PEKERJAAN IBU',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, strtoupper($query['pk_ibu_nama']), 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'PENGHASILAN AYAH',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, to_rupiah($query['hasil_ortu'], 0, ',', '.'), 0, 'LR', 'L');
// kolom 2
$this->fpdf->Cell(4 ,0.5, 'PENGHASILAN IBU',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, to_rupiah($query['hasil_ibu'], 0, ',', '.'), 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'NOMOR HP AYAH',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, $query['telp_ortu'], 0, 'LR', 'L');
// kolom 2
$this->fpdf->Cell(4 ,0.5, 'NO. HP IBU',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, $query['hp_ibu'], 0, 'LR', 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',9);
$this->fpdf->Cell(7, 0.7, 'NILAI RAPORT SEMESTER 1', 0, 'LR', 'L');
$this->fpdf->Cell(7, 0.7, 'NILAI RAPORT SEMESTER 2', 0, 'LR', 'L');
$this->fpdf->Cell(7, 0.7, 'NILAI RAPORT SEMESTER 3', 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'BAHASA INDONESIA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_bindo'], 0, 'LR', 'L');
//semester 2
$this->fpdf->Cell(4 ,0.5, 'BAHASA INDONESIA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_bindo2'], 0, 'LR', 'L');
//semester 3
$this->fpdf->Cell(4 ,0.5, 'BAHASA INDONESIA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_bindo3'], 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'BAHASA INGGRIS',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_bing'], 0, 'LR', 'L');
// semester 2
$this->fpdf->Cell(4 ,0.5, 'BAHASA INGGRIS',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_bing2'], 0, 'LR', 'L');
// semester 3
$this->fpdf->Cell(4 ,0.5, 'BAHASA INGGRIS',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_bing3'], 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'MATEMATIKA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_mtk'], 0, 'LR', 'L');
// semester 2
$this->fpdf->Cell(4 ,0.5, 'MATEMATIKA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_mtk2'], 0, 'LR', 'L');
// semester 3
$this->fpdf->Cell(4 ,0.5, 'MATEMATIKA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_mtk3'], 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'IPA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_ipa'], 0, 'LR', 'L');
// semester 2
$this->fpdf->Cell(4 ,0.5, 'IPA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_ipa2'], 0, 'LR', 'L');
// semester 3
$this->fpdf->Cell(4 ,0.5, 'IPA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_ipa3'], 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'RATA-RATA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_rata'], 0, 'LR', 'L');
// semester 2
$this->fpdf->Cell(4 ,0.5, 'RATA-RATA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_rata2'], 0, 'LR', 'L');
// semester 3
$this->fpdf->Cell(4 ,0.5, 'RATA-RATA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_rata3'], 0, 'LR', 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',9);
$this->fpdf->Cell(7, 0.7, 'NILAI RAPORT SEMESTER 4', 0, 'LR', 'L');
$this->fpdf->Cell(7, 0.7, 'NILAI RAPORT SEMESTER 5', 0, 'LR', 'L');
$this->fpdf->Cell(7, 0.7, 'NILAI UJIAN NASIONAL', 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'BAHASA INDONESIA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_bindo4'], 0, 'LR', 'L');
// semester 5
$this->fpdf->Cell(4 ,0.5, 'BAHASA INDONESIA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_bindo5'], 0, 'LR', 'L');
// un
$this->fpdf->Cell(4 ,0.5, 'BAHASA INDONESIA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['nun_bindo'], 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'BAHASA INGGRIS',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_bing4'], 0, 'LR', 'L');
// semester 5
$this->fpdf->Cell(4 ,0.5, 'BAHASA INGGRIS',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_bing5'], 0, 'LR', 'L');
// un
$this->fpdf->Cell(4 ,0.5, 'BAHASA INGGRIS',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['nun_bing'], 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'MATEMATIKA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_mtk4'], 0, 'LR', 'L');
// semester 5
$this->fpdf->Cell(4 ,0.5, 'MATEMATIKA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_mtk5'], 0, 'LR', 'L');
// un
$this->fpdf->Cell(4 ,0.5, 'MATEMATIKA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['nun_mtk'], 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'IPA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_ipa4'], 0, 'LR', 'L');
// semester 5
$this->fpdf->Cell(4 ,0.5, 'IPA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_ipa5'], 0, 'LR', 'L');
// un
$this->fpdf->Cell(4 ,0.5, 'IPA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['nun_ipa'], 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(4 ,0.5, 'RATA-RATA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_rata3'], 0, 'LR', 'L');
// semester 5
$this->fpdf->Cell(4 ,0.5, 'RATA-RATA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['n_rata4'], 0, 'LR', 'L');
// un
$this->fpdf->Cell(4 ,0.5, 'RATA-RATA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(2.7 ,0.5, $query['nun_rata'], 0, 'LR', 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',9);
$this->fpdf->Cell(10, 0.7, 'NILAI UJIAN SEKOLAH', 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
// uas
$this->fpdf->Cell(4 ,0.5, 'BAHASA INDONESIA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, $query['nus_bindo'], 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
// uas
$this->fpdf->Cell(4 ,0.5, 'BAHASA INGGRIS',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, $query['nus_bing'], 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
// uas
$this->fpdf->Cell(4 ,0.5, 'MATEMATIKA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, $query['nus_mtk'], 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
// uas
$this->fpdf->Cell(4 ,0.5, 'IPA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, $query['nus_ipa'], 0, 'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
// uas
$this->fpdf->Cell(4 ,0.5, 'RATA-RATA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(5.7 ,0.5, $query['nus_rata'], 0, 'LR', 'L');

$this->fpdf->Ln(0);
$this->fpdf->SetX(13);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(14 ,0.5, strtoupper(config('kota')) . ', '. strtoupper(indo_date(date('Y-m-d'))),0,'LR', 'L');

$this->fpdf->Ln(0.4);
$this->fpdf->SetX(13);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(14 ,0.5, 'CALON SISWA',0,'LR', 'L');

$this->fpdf->Ln(1.2);
$this->fpdf->SetX(13);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(14 ,0.5, strtoupper($query['nama']),0,'LR', 'L');

$this->fpdf->Ln();
$this->fpdf->SetY(-1);
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(9.5,  0.5 ,'Copyright [c] '.date('Y').' PPDB Online SMKN 2 Muara Enim | www.psb.smkn2muaraenim.sch.id',0,'LR','L');
$this->fpdf->Cell(9.5,  0.5 ,'Printed on : '.date('d/m/Y H:i').'',0,'LR','R');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',9);
$this->fpdf->Cell(15, 0.7, '', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(15, 0.7, '==========================================gunting disini=======================================', 0, 0, 'L');


if ($query['photo'] != '' && file_exists('assets/photo/'.$query['photo']))
{
    $this->fpdf->Image('assets/photo/'.$query['photo'], 11.3, 2.7, 3, 4);
}
else
{
    $this->fpdf->Ln();
    $this->fpdf->SetY(3.5);
    $this->fpdf->SetX(17);
    $this->fpdf->SetFont('Helvetica','',8);

}

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B' ,9);
$this->fpdf->Cell(15, 0.7, 'KARTU PESERTA DIDIK BARU SMKN 2 MUARA ENIM', 0, 0, 'L');

$this->fpdf->Ln(0.9);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(5 ,0.5, 'NOMOR PENDAFTARAN',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, strtoupper($query['no_daftar']), 0, 'LR', 'L');

$this->fpdf->Ln(0.5);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(5 ,0.5, 'NAMA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->MultiCell(5 ,0.5, strtoupper($query['nama']));

$this->fpdf->Ln(0.3);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(5 ,0.5, 'NISN',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nisn'], 0, 'LR', 'L');

$this->fpdf->Ln(0.5);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(5 ,0.5, 'ASAL SEKOLAH',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, strtoupper($query['asal_sekolah']), 0, 'LR', 'L');

$this->fpdf->Ln(0.5);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(5 ,0.5, 'TANGGAL PENDAFTARAN',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, strtoupper(indo_date($query['tgl_daftar'])), 0, 'LR', 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(15, 2.0, '==========================================gunting disini=======================================', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',8);
$this->fpdf->Cell(15, 0.7, '', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',9);
$this->fpdf->Cell(15, 0.7, '* Berkas Yang Harus Dibawa Pada Saat Pengambilan Nomor Tes :', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '1. Cetak Bukti Pendaftaran Online Di SMKN 2 Muara Enim.', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '2. Foto Copy surat tanda Peserta Ujian / Surat Keterangan Ujian dari Sekolah Asal (SMP/MTS).', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '3, Foto Copy Sertifikat/Piagam Prestasi Akademik, Olahraga dan Seni Minimal Tingkat Kecamatan (jika ada).', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '4. Foto Copy Raport Semester 1 s/d 5 Yang Telah Dilegalisir.', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '" Seluruh Berkas Dimasukkan Ke Dalam Satu Map Kertas Dengan Warna Map Yang Telah Ditentukan ".', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '" Jadwal pengambilan nomor peserta tes, silahkan dilihat di website : www.psb.smkn2muaraenim.sch.id ".', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '" Pada saat pengambilan nomor tes, verifikasi berkas dan tes minat bakat, peserta TIDAK BOLEH di dampingi Orang Tua/Wali ".', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',9);
$this->fpdf->Cell(15, 0.5, 'Warna Map Disesuaikan Dengan PILIHAN PERTAMA Program Keahlian Pada Saat Pengisian Formulir Online.', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',9);
$this->fpdf->Cell(15, 0.5, 'Dengan Ketentuan Sebagai Berikut :', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.5, '* Warna Merah : Teknik Mesin', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.5, '* Warna Kuning : Teknik Otomotif', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '* Warna Biru : Teknik Konstruksi & Properti', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '* Warna Hijau : Tata Busana & Kuliner', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '* Warna Cokelat : Teknik Ketenagalistrikan , Teknik Geomatika dan Geospasial', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',9);
$this->fpdf->Cell(15, 0.5, '** ------------------------------------------------------------------------------------', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',9);
$this->fpdf->Cell(15, 0.2, 'Pengumuman KELULUSAN Dapat Dilihat Di Situs Resmi PPDB Online SMKN2 Muara Enim Di : www.psb.smkn2muaraenim.sch.id .', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',9);
$this->fpdf->Cell(15, 0.2, 'Info Seputar SMKN 2 Muara Enim Dapat Dilihat Di : https://www.smkn2muaraenim.sch.id .', 0, 0, 'L');

$this->fpdf->Ln();
$this->fpdf->SetY(-1);
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(9.5,  0.5 ,'Copyright [c] '.date('Y').' PPDB Online SMKN 2 Muara Enim | www.psb.smkn2muaraenim.sch.id',0,'LR','L');
$this->fpdf->Cell(9.5,  0.5 ,'Printed on : '.date('d/m/Y H:i').'',0,'LR','R');

$this->fpdf->Output($query['no_daftar'].'.pdf','I');
?>