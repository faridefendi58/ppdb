<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
     
class Laporan extends CI_Controller {        

   /**
    * ----------------------------------------------------------------------
    * Method   __construct()
    * @return  void
    * @access  public
    * ---------------------------------------------------------------------- 
    */
    public function __construct()
    {
        parent::__construct();

        $this->auth->restrict();

        error_reporting(E_ALL);

        $this->load->model(array('m_siswa', 'm_prodi'));

        require_once APPPATH.'third_party/PHPExcel'.EXT;
    }

    public function index()
    {
        if ($_POST)
        {
            $status     = $this->input->post('status');
            $tahun      = $this->input->post('tahun');
            $jalur      = $this->input->post('jalur');
            $order_by   = $this->input->post('order_by');
            $order_type = $this->input->post('order_type');
            $query      = $this->m_siswa->export_excel($status, $tahun, $jalur, $order_by, $order_type);
            $file_name  = 'Laporan PPDB Online';
            
            if ($status == 'a')
            {
                $file_name .= ' seluruh siswa';
            }
            else if ($status == 1)
            {
                $file_name .= ' siswa diterima';
            }
            else if ($status == 2)
            {
                $file_name .= ' siswa tidak diterima';
            }
            
            if ($tahun == 'a')
            {
                $file_name .= ' dari semua tahun';
            }
            else
            {
                $file_name .= ' tahun '.$tahun;
            }
            
            if ($jalur == 'a')
            {
                $file_name .= ' dan semua jalur pendaftaran';
            }
            else if ($jalur == 1)
            {
                $file_name .= ' dan jalur umum';
            }
            else if ($jalur == 2)
            {
                $file_name .= ' dan jalur prestasi';
            }
            
            $this->export_excel($query, $file_name);
        }
        else
        {
            $data['query']   = $this->db->query("SELECT LEFT(no_daftar,4) AS tahun FROM siswa GROUP BY tahun");
            $data['action']  = site_url('laporan/index');
            $data['laporan'] = 'class = "active"';
    	    $data['content'] = 'report/form';
    	    $this->load->view('theme/index', $data);
        }
    }

    private function export_excel($query, $file_name)
    {                       
        $objXLS = new PHPExcel();
        $objSheet = $objXLS->setActiveSheetIndex(0);
        
        $cell = 2;        
        $no   = 1;
        $objSheet->setCellValue('A1', 'NO.');
        $objSheet->setCellValue('B1', 'NO. PENDAFTARAN');
        $objSheet->setCellValue('C1', 'TANGGAL PENDAFTARAN');
        $objSheet->setCellValue('D1', 'JALUR PENDAFTARAN');
        $objSheet->setCellValue('E1', 'PILIHAN 1');
        $objSheet->setCellValue('F1', 'PILIHAN 2');
        $objSheet->setCellValue('G1', 'PILIHAN 3');
        $objSheet->setCellValue('H1', 'PILIHAN 4');
        $objSheet->setCellValue('I1', 'NAMA');
        $objSheet->setCellValue('J1', 'TEMPAT LAHIR');
        $objSheet->setCellValue('K1', 'TANGGAL LAHIR');
        $objSheet->setCellValue('L1', 'JENIS KELAMIN');
        $objSheet->setCellValue('M1', 'AGAMA');
        $objSheet->setCellValue('N1', 'ALAMAT');
        $objSheet->setCellValue('O1', 'ASAL SEKOLAH');
        $objSheet->setCellValue('P1', 'NAMA ORANG TUA');
        $objSheet->setCellValue('Q1', 'PEKERJAAN ORANG TUA');
        $objSheet->setCellValue('R1', 'HASIL SELEKSI');
        $objSheet->setCellValue('S1', 'NILAI RATA-RATA SEMESTER 1');
        $objSheet->setCellValue('T1', 'NILAI RATA-RATA SEMESTER 2');
        $objSheet->setCellValue('U1', 'NILAI RATA-RATA SEMESTER 3');
        $objSheet->setCellValue('V1', 'NILAI RATA-RATA SEMESTER 4');
        $objSheet->setCellValue('W1', 'NILAI RATA-RATA SEMESTER 5');
        $objSheet->setCellValue('X1', 'NILAI RATA-RATA UN');
        $objSheet->setCellValue('Y1', 'NILAI RATA-RATA US');

        foreach($query->result_array() as $data)
        {
            $objSheet->setCellValue('A'.$cell, $no);
            $objSheet->setCellValue('B'.$cell, $data['no_daftar']);
            $objSheet->setCellValue('C'.$cell, indo_date($data['tgl_daftar']));
            $objSheet->setCellValue('D'.$cell, $data['jalur_id'] == 1 ? 'UMUM' : 'PRESTASI');
            $objSheet->setCellValue('E'.$cell, $data['pilihan_1']);
            $objSheet->setCellValue('F'.$cell, $data['pilihan_2']);
            $objSheet->setCellValue('G'.$cell, $data['pilihan_3']);
            $objSheet->setCellValue('H'.$cell, $data['pilihan_4']);
            $objSheet->setCellValue('I'.$cell, $data['nama']);
            $objSheet->setCellValue('J'.$cell, $data['tmp_lahir']);
            $objSheet->setCellValue('K'.$cell, indo_date($data['tgl_lahir']));
            $objSheet->setCellValue('L'.$cell, $data['jns_kelamin'] == 'L' ? 'LAKI-LAKI':'PEREMPUAN');
            $objSheet->setCellValue('M'.$cell, strtoupper(agama($data['agama'])));
            $objSheet->setCellValue('N'.$cell, $data['alamat']);
            $objSheet->setCellValue('O'.$cell, $data['asal_sekolah']);
            $objSheet->setCellValue('P'.$cell, $data['nama_ortu']);
            $objSheet->setCellValue('Q'.$cell, $data['pk_nama']);
            $objSheet->setCellValue('R'.$cell, status($data['diterima']));
            $objSheet->setCellValue('S'.$cell, $data['n_rata']);
            $objSheet->setCellValue('T'.$cell, $data['n_rata2']);
            $objSheet->setCellValue('U'.$cell, $data['n_rata3']);
            $objSheet->setCellValue('V'.$cell, $data['n_rata4']);
            $objSheet->setCellValue('W'.$cell, $data['n_rata5']);
            $objSheet->setCellValue('X'.$cell, $data['nun_rata']);
            $objSheet->setCellValue('Y'.$cell, $data['nus_rata']);
            $cell++;
            $no++;    
        }
                    
        $objXLS->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("I")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("J")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("K")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("L")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("M")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("N")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("O")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("P")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("Q")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("R")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("S")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("T")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("U")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("V")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("W")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("X")->setAutoSize(true);
        $objXLS->getActiveSheet()->getColumnDimension("Y")->setAutoSize(true);
        $objXLS->setActiveSheetIndex(0);
        
        $styleArray = array(
                      'borders' => array(
                                   'allborders' => array(
                                                   'style' => PHPExcel_Style_Border::BORDER_THIN,
                                                   'color' => array(
                                                              'rgb'  => '000000'
                                                              ),
                                                   ),
                                   ),
                      );
        $objSheet->getStyle('A1:S'.$no)->applyFromArray($styleArray);

        $objXLS->getProperties()
               ->setCreator($this->config->item('sekolah')) 
               ->setLastModifiedBy($this->config->item('author')) 
               ->setTitle($file_name)
               ->setSubject($this->config->item('sekolah')) 
               ->setDescription($file_name)
               ->setKeywords($this->config->item('sekolah')) 
               ->setCategory('Data Laporan');

        $objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel5');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$file_name.'.xls"'); 
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        exit();      
    }
}