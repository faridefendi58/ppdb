<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_configuration extends CI_Model {
    
    private $pk    = 'id';
    private $table = 'configuration';
    private $data  = array();

    public function field_data($file = NULL, $file2 = NULL)
    {
        $this->data = array(
                      'nama_sekolah'        => $this->input->post('nama_sekolah'),
                      'alamat'              => $this->input->post('alamat'),
                      'kota'                => $this->input->post('kota'),
                      'email'               => $this->input->post('email'),
                      'website'             => $this->input->post('website'),
                      'akreditasi'          => $this->input->post('akreditasi'),
                      'status_daftar'       => $this->input->post('status_daftar'),
                      'meta_keywords'       => $this->input->post('meta_keywords'),
                      'meta_description'    => $this->input->post('meta_description'),
                      'pesan_sukses'        => $this->input->post('pesan_sukses'),
                      'pesan_gagal'         => $this->input->post('pesan_gagal'),
                      'pesan_status_daftar' => $this->input->post('pesan_status_daftar'),
                      'ppdb_tahun'          => $this->input->post('ppdb_tahun'),
                      'status_pengumuman'   => $this->input->post('status_pengumuman'),
                      'pesan_status_pengumuman'   => $this->input->post('pesan_status_pengumuman')
					  );
        
        if ($file != NULL)
        {
            $this->data['logo'] = $file;
        }

        if ($file2 != NULL)
        {
            $this->data['logo2'] = $file2;
        }
    }

    public function find()
    {
        $query = $this->db->where($this->pk, 1)
                         ->get($this->table);
        return $query->num_rows() == 1 ? $query->row_array() : NULL;
    }
    
    public function update()
    {
        $this->db
			 ->where($this->pk, 1)
             ->update($this->table, $this->data);
    }
}

/* End of file name.php */
/* Location: ./application/models/name.php */