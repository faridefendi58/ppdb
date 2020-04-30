<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

$this->fpdf->FPDF("P", "cm", 'A4');
$this->fpdf->SetMargins(1, 0.5, 1);
$this->fpdf->SetAutoPageBreak(true, 1);

$this->fpdf->Open();
$this->fpdf->AliasNbPages();

$this->fpdf->AddPage();
$logo = config('logo') == '' ? 'assets/images/logo.jpg' : 'assets/images/'.config('logo');
$this->fpdf->Image($logo, 1.2 ,0.5 ,2 ,2);

$this->fpdf->SetX(4);
$this->fpdf->SetFont('Helvetica','B',11);
$this->fpdf->Cell(15,0.5, strtoupper(config('nama_sekolah')), 0, 0, 'C');

$this->fpdf->Ln();
$this->fpdf->SetX(4);
$this->fpdf->Cell(15,0.5, config('akreditasi'), 0, 0, 'C');

$this->fpdf->Ln();
$this->fpdf->SetX(4);
$this->fpdf->SetFont('helvetica','',9);
$this->fpdf->Cell(15,0.5, config('alamat'), 0, 0, 'C');

$this->fpdf->Ln();
$this->fpdf->SetX(4);
$this->fpdf->Cell(15,0.5, 'Website : ' . config('website') . '  |  Email : '. config('email'), 0, 0, 'C');

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
    $this->fpdf->SetFont('Helvetica','',10);
    
}
   
$this->fpdf->SetXY(1, 3.3);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15,0.7,'FORMULIR PENERIMAAN PESERTA DIDIK BARU (PPDB) ONLINE', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, 'DATA PENDAFTARAN', 0, 0, 'L');

$this->fpdf->Ln(0.7);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Nomor Pendaftaran',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['no_daftar'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Jalur Pendaftaran',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, jalur($query['jalur_id']), 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Pilihan 1',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['pilihan_1'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Pilihan 2',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['pilihan_2'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Pilihan 3',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['pilihan_3'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Pilihan 4',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['pilihan_4'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Tanggal Pendaftaran',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, indo_date($query['tgl_daftar']), 0, 'LR', 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, 'DATA CALON SISWA', 0, 0, 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Nama',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nama'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'NISN',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nisn'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'NIK',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nik'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'No. Akte Kelahiran',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['no_akte'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Jenis Kelamin',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$jns_kelamin = $query['jns_kelamin'] == 'P' ? 'Perempuan' : 'Laki-laki';
$this->fpdf->Cell(9.7 ,0.5, $jns_kelamin, 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Tempat Lahir',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['tmp_lahir'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Tanggal Lahir',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, indo_date($query['tgl_lahir']), 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Agama',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, agama($query['agama']), 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Alamat Lengkap',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->MultiCell(10 ,0.5, $query['alamat']);

$this->fpdf->Ln(0.1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'No. Kartu Keluarga',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->MultiCell(10 ,0.5, $query['no_kk']);

$this->fpdf->Ln(0.1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Jumlah Saudara Kandung',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, ($query['sdr_kandung']), 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Anak Ke',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, ($query['anak_ke']), 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Status Anak',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, ($query['st_anak']), 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Berat Badan',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['b_badan'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Tinggi Badan',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['t_badan'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Golongan Darah',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['g_darah'], 0, 'LR', 'L');
   
$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'No. HP',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['telp'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'No. Kartu Indonesia Pintar',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['no_kip'], 0, 'LR', 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, 'DATA SEKOLAH', 0, 0, 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Asal Sekolah',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['asal_sekolah'], 0, 'LR', 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, 'DATA ORANG TUA / WALI', 0, 0, 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, 'DATA AYAH', 0, 0, 'L');

$this->fpdf->Ln(0.8);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Nama Ayah',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nama_ortu'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'NIK Ayah',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nik_ayah'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Alamat Ayah',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->MultiCell(10 ,0.5, $query['alamat_ortu']);

$this->fpdf->Ln(0.1);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Pekerjaan Ayah',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['pk_nama'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Penghasilan Ayah',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['hasil_ortu'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Nomor Hp Ayah',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['telp_ortu'], 0, 'LR', 'L');

$this->fpdf->Ln(2.5);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, 'DATA IBU', 0, 0, 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Nama Ibu',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nama_ibu'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'NIK Ibu',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nik_ibu'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Alamat Ibu',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['alamat_ibu'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Pekerjaan Ibu',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['kerja_ibu'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Penghasilan Ibu',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['hasil_ibu'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'No. Hp Ibu',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['hp_ibu'], 0, 'LR', 'L');

$this->fpdf->Ln();
$this->fpdf->SetY(-1.5); 
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(9.5,  0.5 ,'Copyright [c] '.date('Y').' PPDB Online SMKN 2 Muara Enim | www.psb.smkn2muaraenim.sch.id',0,'LR','L');  
$this->fpdf->Cell(9.5,  0.5 ,'Printed on : '.date('d/m/Y H:i').'',0,'LR','R');   

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, '', 0, 0, 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, 'NILAI RAPORT SEMESTER 1', 0, 0, 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Bahasa Indonesia',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_bindo'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Bahasa Inggris',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_bing'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Matematika',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_mtk'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'IPA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_ipa'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'RATA-RATA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_rata'], 0, 'LR', 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, 'NILAI RAPORT SEMESTER 2', 0, 0, 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Bahasa Indonesia',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_bindo2'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Bahasa Inggris',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_bing2'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Matematika',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_mtk2'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'IPA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_ipa2'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'RATA-RATA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_rata2'], 0, 'LR', 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, 'NILAI RAPORT SEMESTER 3', 0, 0, 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Bahasa Indonesia',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_bindo3'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Bahasa Inggris',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_bing3'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Matematika',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_mtk3'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'IPA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_ipa3'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'RATA-RATA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_rata3'], 0, 'LR', 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, 'NILAI RAPORT SEMESTER 4', 0, 0, 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Bahasa Indonesia',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_bindo4'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Bahasa Inggris',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_bing4'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Matematika',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_mtk4'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'IPA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_ipa4'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'RATA-RATA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_rata4'], 0, 'LR', 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, 'NILAI RAPORT SEMESTER 5', 0, 0, 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Bahasa Indonesia',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_bindo5'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Bahasa Inggris',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_bing5'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Matematika',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_mtk5'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'IPA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_ipa5'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'RATA-RATA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['n_rata5'], 0, 'LR', 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, 'NILAI UJIAN NASIONAL', 0, 0, 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Bahasa Indonesia',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nun_bindo'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Bahasa Inggris',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nun_bing'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Matematika',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nun_mtk'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'IPA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nun_ipa'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'RATA-RATA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nun_rata'], 0, 'LR', 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, 'NILAI UJIAN SEKOLAH', 0, 0, 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Bahasa Indonesia',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nus_bindo'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Bahasa Inggris',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nus_bing'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Matematika',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nus_mtk'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'IPA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nus_ipa'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'RATA-RATA',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nus_rata'], 0, 'LR', 'L');

$this->fpdf->Ln(2);   
$this->fpdf->SetX(13);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(14 ,0.5, config('kota') . ', '.indo_date(date('Y-m-d')),0,'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(13);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(14 ,0.5, 'Calon Siswa',0,'LR', 'L');

$this->fpdf->Ln(2);   
$this->fpdf->SetX(13);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(14 ,0.5, $query['nama'],0,'LR', 'L');

$this->fpdf->Ln();
$this->fpdf->SetY(-1.5); 
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(9.5,  0.5 ,'Copyright [c] '.date('Y').' PPDB Online SMKN 2 Muara Enim | www.psb.smkn2muaraenim.sch.id',0,'LR','L');  
$this->fpdf->Cell(9.5,  0.5 ,'Printed on : '.date('d/m/Y H:i').'',0,'LR','R');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, '', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
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
    $this->fpdf->SetFont('Helvetica','',10);
    
}

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',10);
$this->fpdf->Cell(15, 0.7, 'Kartu Peserta Didik Baru SMKN 2 Muara Enim', 0, 0, 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Nomor Pendaftaran',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['no_daftar'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Nama',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->MultiCell(5 ,0.5, $query['nama']);

$this->fpdf->Ln(0.2);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'NISN',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['nisn'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Asal Sekolah',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, $query['asal_sekolah'], 0, 'LR', 'L');

$this->fpdf->Ln(0.6);
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(5 ,0.5, 'Tanggal Pendaftaran',0,'LR', 'L');
$this->fpdf->Cell(0.3 ,0.5, ':' ,0,'LR', 'L');
$this->fpdf->Cell(9.7 ,0.5, indo_date($query['tgl_daftar']), 0, 'LR', 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(15, 2.0, '==========================================gunting disini=======================================', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',10);
$this->fpdf->Cell(15, 0.7, '', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',9);
$this->fpdf->Cell(15, 0.7, '* Berkas Yang Harus Dibawa Pada Saat Pengambilan Nomor Tes :', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '1. Cetak Bukti Pendaftaran Online Di SMKN 2 Muara Enim.', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '2. Foto Copy surat tanda Peserta Ujian / Surat Keterangan Ujian dari Sekolah Asal (SMP/MTS).', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '3, Foto Copy Sertifikat/Piagam Prestasi Akademik, Olahraga dan Seni Minimal Tingkat Kecamatan (jika ada).', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '4. Foto Copy Raport Semester 1 s/d 5 Yang Telah Dilegalisir.', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '" Seluruh Berkas Dimasukkan Ke Dalam Satu Map Kertas Dengan Warna Map Yang Telah Ditentukan ".', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '" Jadwal pengambilan nomor peserta tes, silahkan dilihat di website : www.psb.smkn2muaraenim.sch.id ".', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '" Pada saat pengambilan nomor tes, verifikasi berkas dan tes minat bakat, peserta TIDAK BOLEH di dampingi Orang Tua/Wali ".', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','B',9);
$this->fpdf->Cell(15, 0.5, 'Warna Map Disesuaikan Dengan PILIHAN PERTAMA Program Keahlian Pada Saat Pengisian Formulir Online.', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',9);
$this->fpdf->Cell(15, 0.5, 'Dengan Ketentuan Sebagai Berikut :', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.5, '* Warna Merah : Teknik Mesin', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.5, '* Warna Kuning : Teknik Otomotif', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '* Warna Biru : Teknik Konstruksi & Properti', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '* Warna Hijau : Tata Busana & Kuliner', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','i',9);
$this->fpdf->Cell(15, 0.2, '* Warna Cokelat : Teknik Ketenagalistrikan , Teknik Geomatika dan Geospasial', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',9);
$this->fpdf->Cell(15, 0.5, '** ------------------------------------------------------------------------------------', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',9);
$this->fpdf->Cell(15, 0.2, 'Pengumuman KELULUSAN Dapat Dilihat Di Situs Resmi PPDB Online SMKN2 Muara Enim Di : www.psb.smkn2muaraenim.sch.id .', 0, 0, 'L');

$this->fpdf->Ln(1);   
$this->fpdf->SetX(1);
$this->fpdf->SetFont('Helvetica','',9);
$this->fpdf->Cell(15, 0.2, 'Info Seputar SMKN 2 Muara Enim Dapat Dilihat Di : https://www.smkn2muaraenim.sch.id .', 0, 0, 'L');

$this->fpdf->Ln();
$this->fpdf->SetY(-1.5); 
$this->fpdf->SetFont('Arial','',7);
$this->fpdf->Cell(9.5,  0.5 ,'Copyright [c] '.date('Y').' PPDB Online SMKN 2 Muara Enim | www.psb.smkn2muaraenim.sch.id',0,'LR','L');  
$this->fpdf->Cell(9.5,  0.5 ,'Printed on : '.date('d/m/Y H:i').'',0,'LR','R');
   
$this->fpdf->Output($query['no_daftar'].'pdf','I');
?>