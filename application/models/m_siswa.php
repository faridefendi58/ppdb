<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_siswa extends CI_Model {
    
    private $pk    = 'id';
    private $table = 'siswa';
    private $data  = array();
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function field_data($type = 1, $photo = NULL, $more = [])
    {
        $this->data = array(
                      'nisn'           => $this->input->post('nisn'),
                      'nik'            => $this->input->post('nik'),
                      'no_akte'        => $this->input->post('no_akte'),
                      'nama'           => $this->input->post('nama'),
                      'tmp_lahir'      => $this->input->post('tmp_lahir'),
                      'tgl_lahir'      => extract_date($this->input->post('tgl_lahir')),
                      'jalur_id'       => $this->input->post('jalur_id'),
                      'pil_1'          => $this->input->post('pil_1'),
                      'pil_2'          => $this->input->post('pil_2'),
                      'pil_3'          => $this->input->post('pil_3'),
                      'pil_4'          => $this->input->post('pil_4'),
                      'jns_kelamin'    => $this->input->post('jns_kelamin'),
                      'agama'          => $this->input->post('agama'),
                      'anak_ke'        => $this->input->post('anak_ke'),
                      'sdr_kandung'    => $this->input->post('sdr_kandung'),
                      'st_anak'        => $this->input->post('st_anak'),
                      'alamat'         => $this->input->post('alamat'),
                      'no_kk'          => $this->input->post('no_kk'),
                      'telp'           => $this->input->post('telp'),
                      'email'          => $this->input->post('email'),
                      'b_badan'        => $this->input->post('b_badan'),
                      't_badan'        => $this->input->post('t_badan'),
                      'g_darah'        => $this->input->post('g_darah'),
                      'no_kip'         => $this->input->post('no_kip'),
                      'asal_sekolah'   => $this->input->post('asal_sekolah'),
                      'nama_ortu'      => $this->input->post('nama_ortu'),
                      'nik_ayah'       => $this->input->post('nik_ayah'),
                      'nama_ibu'       => $this->input->post('nama_ibu'),
                      'nik_ibu'        => $this->input->post('nik_ibu'),
                      'alamat_ibu'     => $this->input->post('alamat_ibu'),
                      'hasil_ibu'      => $this->input->post('hasil_ibu'),
                      'hp_ibu'         => $this->input->post('hp_ibu'),
                      'alamat_ortu'    => $this->input->post('alamat_ortu'),
                      'pekerjaan_ortu' => $this->input->post('pekerjaan_ortu'),
                      'kerja_ibu'      => $this->input->post('kerja_ibu'),
                      'hasil_ortu'     => $this->input->post('hasil_ortu'),
                      'telp_ortu'      => $this->input->post('telp_ortu'),
                      'n_bindo'        => $this->input->post('n_bindo'),
                      'n_bing'         => $this->input->post('n_bing'),
                      'n_mtk'          => $this->input->post('n_mtk'),
                      'n_ipa'          => $this->input->post('n_ipa'),
                      'n_rata'         => $this->input->post('n_rata'),
                      'n_bindo2'       => $this->input->post('n_bindo2'),
                      'n_bing2'        => $this->input->post('n_bing2'),
                      'n_mtk2'         => $this->input->post('n_mtk2'),
                      'n_ipa2'         => $this->input->post('n_ipa2'),
                      'n_rata2'        => $this->input->post('n_rata2'),
                      'n_bindo3'        => $this->input->post('n_bindo3'),
                      'n_bing3'         => $this->input->post('n_bing3'),
                      'n_mtk3'          => $this->input->post('n_mtk3'),
                      'n_ipa3'          => $this->input->post('n_ipa3'),
                      'n_rata3'         => $this->input->post('n_rata3'),
                      'n_bindo4'        => $this->input->post('n_bindo4'),
                      'n_bing4'         => $this->input->post('n_bing4'),
                      'n_mtk4'          => $this->input->post('n_mtk4'),
                      'n_ipa4'          => $this->input->post('n_ipa4'),
                      'n_rata4'         => $this->input->post('n_rata4'),
                      'n_bindo5'        => $this->input->post('n_bindo5'),
                      'n_bing5'         => $this->input->post('n_bing5'),
                      'n_mtk5'          => $this->input->post('n_mtk5'),
                      'n_ipa5'          => $this->input->post('n_ipa5'),
                      'n_rata5'         => $this->input->post('n_rata5'),
                      'nun_bindo'        => $this->input->post('nun_bindo'),
                      'nun_bing'         => $this->input->post('nun_bing'),
                      'nun_mtk'          => $this->input->post('nun_mtk'),
                      'nun_ipa'          => $this->input->post('nun_ipa'),
                      'nun_rata'         => $this->input->post('nun_rata'),
                      'nus_bindo'        => $this->input->post('nus_bindo'),
                      'nus_bing'         => $this->input->post('nus_bing'),
                      'nus_mtk'          => $this->input->post('nus_mtk'),
                      'nus_ipa'          => $this->input->post('nus_ipa'),
                      'nus_rata'         => $this->input->post('nus_rata')
    				  );

        if ($type == 1)
        {
            $this->data['no_daftar']  = config('ppdb_tahun') . $this->no_daftar();
            $this->data['tgl_daftar'] = date('Y-m-d H:i:s');
        }
        
        if ($photo != NULL)
        {
            $this->data['photo'] = $photo;
        }

        if (count($more) > 0) {
            foreach ($more as $m_field => $m_val) {
                $this->data[$m_field] = $m_val;
            }
        }
    }

    public function find_all($criteria = '', $year)
    {
        if ($criteria == '')
        {
            return $this->db->query("SELECT s.id, 
                                            s.no_daftar,
                                            s.nama,
                                    	    s.asal_sekolah, 
                                            s.diterima,
                                    	    p1.prodi_nama AS pilihan_1, 
                                    	    p2.prodi_nama AS pilihan_2,
                                            p3.prodi_nama AS pilihan_3,
                                            p4.prodi_nama AS pilihan_4
                                     FROM siswa s
                                     INNER JOIN prodi p1 ON p1.prodi_id = s.pil_1
                                     INNER JOIN prodi p2 ON p2.prodi_id = s.pil_2
                                     INNER JOIN prodi p3 ON p3.prodi_id = s.pil_3
                                     INNER JOIN prodi p4 ON p4.prodi_id = s.pil_4
                                     WHERE substring(no_daftar, 1, 4) = '$year'");
        }
        else if ($criteria == 1)
        {
            return $this->db->query("SELECT s.id, 
        			                        s.no_daftar, 
                                    		p1.prodi_nama AS pilihan_1, 
                                    		p2.prodi_nama AS pilihan_2, 
                                                p3.prodi_nama AS pilihan_3,
                                                p4.prodi_nama AS pilihan_4,
                                    		s.nama, 
                                    		p5.prodi_nama AS diterima
                                     FROM siswa s
                                     INNER JOIN prodi p1 ON p1.prodi_id = s.pil_1
                                     INNER JOIN prodi p2 ON p2.prodi_id = s.pil_2
                                     INNER JOIN prodi p3 ON p3.prodi_id = s.pil_3
                                     INNER JOIN prodi p4 ON p4.prodi_id = s.pil_4
                                     LEFT  JOIN prodi p5 ON p5.prodi_id = s.diterima
                                     WHERE substring(no_daftar, 1, 4) = '$year'
                                     AND diterima = '0' ");
        }
        else if ($criteria == 2)
        {
            return $this->db->query("SELECT s.id, 
        			                        s.no_daftar,
                                            s.nama,
                                            s.asal_sekolah,
                                    		p1.prodi_nama AS pilihan_1, 
                                    		p2.prodi_nama AS pilihan_2,
                                                p3.prodi_nama AS pilihan_3,
                                                p4.prodi_nama AS pilihan_4,
                                    		p5.prodi_nama AS diterima
                                     FROM siswa s
                                     INNER JOIN prodi p1 ON p1.prodi_id = s.pil_1
                                     INNER JOIN prodi p2 ON p2.prodi_id = s.pil_2
                                     INNER JOIN prodi p3 ON p3.prodi_id = s.pil_3
                                     INNER JOIN prodi p4 ON p4.prodi_id = s.pil_4
                                     LEFT  JOIN prodi p5 ON p5.prodi_id = s.diterima
                                     WHERE substring(no_daftar, 1, 4) = '$year'
                                     AND diterima != '0' AND diterima != 't' ");
        }
        else if ($criteria == 3)
        {
            return $this->db->query("SELECT id,
                                            no_daftar,
                                            nama,
                                            asal_sekolah
                                     FROM siswa
                                     WHERE substring(no_daftar, 1, 4) = '$year'
                                     AND diterima = 't'");
        }
    }

    public function find($id)
    {
        $query = $this->db->query("SELECT s.id,
                                          s.no_daftar,
                                          s.tgl_daftar,
                                          s.nisn,
                                          s.nik,
                                          s.no_akte,
                                          s.nama,
                                          s.tmp_lahir,
                                          s.tgl_lahir,
                                          s.jalur_id,
                                          s.jns_kelamin,
                                          s.agama,
                                          s.anak_ke,
                                          s.sdr_kandung,
                                          s.st_anak,
                                          s.alamat,
                                          s.no_kk,
                                          s.telp,
                                          s.no_kip,
                                          s.email,
                                          s.b_badan,
                                          s.t_badan,
                                          s.g_darah,
                                          s.asal_sekolah,
                                          s.nama_ortu,
                                          s.nik_ayah,
                                          s.nama_ibu,
                                          s.nik_ibu,
                                          s.alamat_ibu,
                                          s.hasil_ibu,
                                          s.hp_ibu,
                                          s.alamat_ortu,
                                          pekerjaan.pk_nama,
                                          s.kerja_ibu,
                                          s.hasil_ortu,
                                          s.telp_ortu,
                                          s.n_bindo,
                                          s.n_bing,
                                          s.n_mtk,
                                          s.n_ipa,
                                          s.n_rata,
                                          s.n_bindo2,
                                          s.n_bing2,
                                          s.n_mtk2,
                                          s.n_ipa2,
                                          s.n_rata2,
                                          s.n_bindo3,
                                          s.n_bing3,
                                          s.n_mtk3,
                                          s.n_ipa3,
                                          s.n_rata3,
                                          s.n_bindo4,
                                          s.n_bing4,
                                          s.n_mtk4,
                                          s.n_ipa4,
                                          s.n_rata4,
                                          s.n_bindo5,
                                          s.n_bing5,
                                          s.n_mtk5,
                                          s.n_ipa5,
                                          s.n_rata5,
                                          s.nun_bindo,
                                          s.nun_bing,
                                          s.nun_mtk,
                                          s.nun_ipa,
                                          s.nun_rata,
                                          s.nus_bindo,
                                          s.nus_bing,
                                          s.nus_mtk,
                                          s.nus_ipa,
                                          s.nus_rata,
                                          s.photo,
                                          s.pil_1,
                                          s.pil_2,
                                          s.pil_3,
                                          s.pil_4,
                                          s.pekerjaan_ortu,
                                          s.diterima,
                                          p1.prodi_nama AS pilihan_1, 
                                          p2.prodi_nama AS pilihan_2,
                                          p3.prodi_nama AS pilihan_3,
                                          p4.prodi_nama AS pilihan_4			 
                                  FROM siswa s
                                  INNER JOIN pekerjaan ON pekerjaan.pk_id = s.pekerjaan_ortu
                                  INNER JOIN prodi p1 ON p1.prodi_id = s.pil_1
                                  INNER JOIN prodi p2 ON p2.prodi_id = s.pil_2
                                  INNER JOIN prodi p3 ON p3.prodi_id = s.pil_3
                                  INNER JOIN prodi p4 ON p4.prodi_id = s.pil_4
                                  WHERE id = '$id'");
        return $query->num_rows() == 1 ? $query->row_array() : NULL;
    }

    public function findByPk($id)
    {
        $sql = "SELECT s.id, s.no_daftar, s.tgl_daftar, s.nisn, s.nik, s.no_akte, s.nama,
            s.tmp_lahir, s.tgl_lahir, s.jalur_id, s.jns_kelamin, s.agama, s.anak_ke,
            s.sdr_kandung, s.st_anak, s.alamat, s.no_kk, s.telp, s.no_kip, s.email,
            s.b_badan, s.t_badan, s.g_darah, s.asal_sekolah, s.nama_ortu, s.nik_ayah,
            s.nama_ibu, s.nik_ibu, s.alamat_ibu, s.hasil_ibu, s.hp_ibu, s.alamat_ortu,
            pekerjaan.pk_nama, s.kerja_ibu, s.hasil_ortu, s.telp_ortu, s.n_bindo, s.n_bing,
            s.n_mtk, s.n_ipa, s.n_rata, s.n_bindo2, s.n_bing2, s.n_mtk2, s.n_ipa2, s.n_rata2,
            s.n_bindo3, s.n_bing3, s.n_mtk3, s.n_ipa3, s.n_rata3, s.n_bindo4, s.n_bing4,
            s.n_mtk4, s.n_ipa4, s.n_rata4, s.n_bindo5,
            s.n_bing5, s.n_mtk5, s.n_ipa5, s.n_rata5, s.nun_bindo, s.nun_bing,
            s.nun_mtk, s.nun_ipa, s.nun_rata, s.nus_bindo, s.nus_bing, s.nus_mtk, s.nus_ipa, s.nus_rata, s.photo, s.pil_1, s.pil_2, s.pil_3, s.pil_4,
            s.pekerjaan_ortu, s.diterima, s.n_raport_1_5, s.no_ujian_smp, 
            p1.prodi_nama AS pilihan_1,p2.prodi_nama AS pilihan_2, p3.prodi_nama AS pilihan_3, p4.prodi_nama AS pilihan_4			 
            FROM siswa s
             LEFT JOIN pekerjaan ON pekerjaan.pk_id = s.pekerjaan_ortu 
             LEFT JOIN prodi p1 ON p1.prodi_id = s.pil_1 
             LEFT JOIN prodi p2 ON p2.prodi_id = s.pil_2 
             LEFT JOIN prodi p3 ON p3.prodi_id = s.pil_3 
             LEFT JOIN prodi p4 ON p4.prodi_id = s.pil_4 
             WHERE id = ". $id;
        $query = $this->db->query($sql);
        return $query->num_rows() == 1 ? $query->row_array() : NULL;
    }

    public function save()
    {
        $this->db->insert($this->table, $this->data);
    }

    public function update($id)
    {
        $this->db
			 ->where($this->pk, $id)
             ->update($this->table, $this->data);
    }
    
    public function seleksi($prodi_id, $id)
    {
        $this->db
			       ->where($this->pk, $id)
             ->update($this->table, array('diterima' => $prodi_id));
    }

    public function clear($id)
    {
        return $this->db
                    ->where_in($this->pk, $id)
                    ->update($this->table, array('diterima' => 0));
    }
    
    public function delete($id)
    {
        $this->db
		     ->where_in($this->pk, $id)
			 ->delete($this->table);
        return $this->db->affected_rows();
    }

    public function is_exist($field, $value, $id = '')
    {
        $this->db->where($field, $value);
        
        if ($id != '')
        {
            $this->db->where($this->pk.' != ', $id);
        }
        
        $result = $this->db->count_all_results($this->table);
        
        return $result > 0 ? TRUE : FALSE;
    }

    public function return_id($no_daftar, $tgl_lahir)
    {
        $this->db->where('no_daftar', $no_daftar);
        $this->db->where('tgl_lahir', $tgl_lahir);
                        
        $result = $this->db->get('siswa');
        
        return $result->num_rows() == 1 ? $result->row_array() : NULL;
    }
    
    public function cetak_formulir($no_daftar, $tgl_lahir)
    {
        $query = $this->db
                      ->where('no_daftar', $no_daftar)
                      ->where('tgl_lahir', $tgl_lahir)
                      //->join('pekerjaan', 'pekerjaan.pk_id = siswa.pekerjaan_ortu')
                      ->get($this->table);
        return $query->num_rows() == 1 ? $query->row_array() : NULL;
    }

    public function export_excel($status = 'a', $tahun, $jalur = 'a', $order_by, $order_type)
    {
        $query = "SELECT s.no_daftar,
                         s.tgl_daftar,
                         s.jalur_id,
                         s.nisn,
                         s.nik,
                         s.no_akte,
                         s.nama,
                         s.tmp_lahir,
                         s.tgl_lahir,
                         s.jns_kelamin,
                         s.agama,
                         s.anak_ke,
                         s.sdr_kandung,
                         s.st_anak,
                         s.alamat,
                         s.no_kk,
                         s.telp,
                         s.no_kip,
                         s.email,
                         s.b_badan,
                         s.t_badan,
                         s.g_darah,
                         s.asal_sekolah,
                         s.nama_ortu,
                         s.nik_ayah,
                         s.nama_ibu,
                         s.nik_ibu,
                         s.alamat_ibu,
                         s.hasil_ibu,
                         s.hp_ibu,
                         s.alamat_ortu,
                         pekerjaan.pk_nama,
                         s.kerja_ibu,
                         s.hasil_ortu,
                         s.telp_ortu,
                         s.n_bindo,
                         s.n_bing,
                         s.n_mtk,
                         s.n_ipa,
                         s.n_rata,
                         s.n_bindo2,
                         s.n_bing2,
                         s.n_mtk2,
                         s.n_ipa2,
                         s.n_rata2,
                         s.n_bindo3,
                         s.n_bing3,
                         s.n_mtk3,
                         s.n_ipa3,
                         s.n_rata3,
                         s.n_bindo4,
                         s.n_bing4,
                         s.n_mtk4,
                         s.n_ipa4,
                         s.n_rata4,
                         s.n_bindo5,
                         s.n_bing5,
                         s.n_mtk5,
                         s.n_ipa5,
                         s.n_rata5,
                         s.nun_bindo,
                         s.nun_bing,
                         s.nun_mtk,
                         s.nun_ipa,
                         s.nun_rata,
                         s.nus_bindo,
                         s.nus_bing,
                         s.nus_mtk,
                         s.nus_ipa,
                         s.nus_rata,
                         s.diterima,
                         p1.prodi_nama AS pilihan_1, 
                         p2.prodi_nama AS pilihan_2,
                         p3.prodi_nama AS pilihan_3,
                         p4.prodi_nama AS pilihan_4 
                         FROM siswa s
                         LEFT JOIN pekerjaan ON pekerjaan.pk_id = s.pekerjaan_ortu
                         LEFT JOIN prodi p1 ON p1.prodi_id = s.pil_1
                         LEFT JOIN prodi p2 ON p2.prodi_id = s.pil_2
                         LEFT JOIN prodi p3 ON p3.prodi_id = s.pil_3
                         LEFT JOIN prodi p4 ON p4.prodi_id = s.pil_4
                         ";
        $query .= " WHERE SUBSTRING(no_daftar, 1, 4) = $tahun ";

        if ($status != 'a')
        {
            if ($status == 1) // diterima
            {
                $query .= " AND diterima != 't' AND diterima != '0' ";
            }
            else if ($status == 2) // tidak diterima
            {
                $query .= " AND diterima = 't' ";
            }
            else if ($status == 3) // belum diseleksi
            {
                $query .= " AND diterima = '0' ";
            }
        }

        if ($jalur != 'a')
        {
            $query .= " AND jalur_id = $jalur";
        }
        
        $query .= " ORDER BY $order_by $order_type";

        return $this->db->query($query);
    }

    private function no_daftar()
    {
        $year  = config('ppdb_tahun');
        $query = $this->db->query("SELECT MAX(RIGHT(no_daftar, 5)) AS no_max 
                                   FROM siswa
                                   WHERE left(no_daftar, 4) = '$year'");
        $no = "";
        if ($query->num_rows() > 0 )
        {
            foreach($query->result() as $data)
            {
                $temp = ((int)$data->no_max) + 1;
                $no   = sprintf("%05s", $temp);
            }
        }
        else
        {
            $no = "00001";
        } 
        return $no;
    }
}

/* End of file m_jalur.php */
/* Location: ./application/models/m_jalur.php */