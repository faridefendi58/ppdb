<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict();
        
        $this->load->model(array('m_log'));
    }
    
    public function index()
    {
        $data['db'] = 'class = "active"';
        $where      = "substring(no_daftar, 1, 4) = " . config('ppdb_tahun') ."";

        // jumlah pendaftar
        $data['a']       = $this->db
                                ->where($where)
                                ->count_all_results('siswa');
        // Jumlah Siswa Diterima
        $data['b']       = $this->db
                                ->where($where)
                                ->where('diterima', 'y')
                                ->count_all_results('siswa');
        
        // Jumlah Siswa Tidak Diterima
        $data['c']       = $this->db
                                ->where($where)
                                ->where('diterima', 'n')
                                ->count_all_results('siswa');
        
        // Jumlah Siswa Belum Diseleksi
        $data['d']       = $this->db
                                ->where($where)
                                ->where('diterima', 't')
                                ->count_all_results('siswa');
        
        // Pendaftar Jalur SKHUN
        $data['e']       = $this->db
                                ->where($where)
                                ->where('jalur_id', 1)
                                ->count_all_results('siswa');
        
        // Pendaftar Jalur Tes Tulis
        $data['f']       = $this->db
                                ->where($where)
                                ->where('jalur_id', 2)
                                ->count_all_results('siswa');
        
        // Pendaftar Jalur Prestasi
        $data['g']       = $this->db
                                ->where($where)
                                ->where('jalur_id', 3)
                                ->count_all_results('siswa');
        
        $data['logs']    = $this->m_log->find_all();
        $data['message'] = $this->message->show();
        $data['title']   = 'Statistik Pendaftaran Tahun ' . config('ppdb_tahun');
        $data['content'] = 'dashboard/cpanel';
        $this->load->view('theme/index', $data);
        $this->message->close();        
    }
    
    public function clear_recent_history()
    {
        $this->m_log->truncate();
        $this->message->config('on', 'success', 'Data sudah dihapus!');
        redirect('dashboard');
    }
    
    public function user_guide()
    {
        $this->load->helper('download');
        $data = file_get_contents(FCPATH . "/assets/PANDUAN PENGGUNAAN APLIKASI PENERIMAAN SISWA BARU.docx");
        $name = 'PANDUAN PENGGUNAAN APLIKASI PPDB ONLINE.docx';
        force_download($name, $data); 
    }
    
    public function backup()
    {
        $this->load->dbutil();
        $backup =& $this->dbutil->backup();
        $this->load->helper('download');
        force_download(date('d F Y').'.gz', $backup);
    }
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */