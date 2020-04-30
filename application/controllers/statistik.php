<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistik extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $data['ppdb']      = 'active';
        $data['statistik'] = 'class = "active"';
        $where             = "substring(no_daftar, 1, 4) = " . config('ppdb_tahun') ."";
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
        
        // Pendaftar Jalur Umum
        $data['e']       = $this->db
                                ->where($where)
                                ->where('jalur_id', 1)
                                ->count_all_results('siswa');
        
        // Pendaftar Jalur Prestasi
        $data['f']       = $this->db
                                ->where($where)
                                ->where('jalur_id', 2)
                                ->count_all_results('siswa');
        $data['content'] = 'dashboard/statistik';
        $this->load->view('theme/index', $data);        
    }
}