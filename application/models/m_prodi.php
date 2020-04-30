<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_prodi extends CI_Model {
    
    private $pk    = 'prodi_id';
    private $table = 'prodi';
    private $data  = array();

    public function field_data()
    {
        $this->data = array(
                      'prodi_nama' => $this->input->post('prodi_nama')
					  );
    }

    public function find_all()
    {
        return $this->db->get($this->table);
    }
    
    public function find($prodi_id)
    {
        $query = $this->db->where($this->pk, $prodi_id)
                         ->get($this->table);
        return $query->num_rows() == 1 ? $query->row_array() : NULL;
    }
    
    public function save()
    {
        $this->db->insert($this->table, $this->data);
    }

    public function update($prodi_id)
    {
        $this->db
			 ->where($this->pk, $prodi_id)
             ->update($this->table, $this->data);
    }

    public function delete($prodi_id)
    {
        $pil_1 = $this->db
                      ->where_in('pil_1', $prodi_id)
                      ->count_all_results('siswa');
        $pil_2 = $this->db
                      ->where_in('pil_2', $prodi_id)
                      ->count_all_results('siswa');
        $pil_3 = $this->db
                      ->where_in('pil_3', $prodi_id)
                      ->count_all_results('siswa');
        $pil_4 = $this->db
                      ->where_in('pil_4', $prodi_id)
                      ->count_all_results('siswa');
        $diterima = $this->db
                         ->where_in('diterima', $prodi_id)
                         ->count_all_results('siswa');

        if ($pil_1 == 0 AND $pil_2 == 0 AND $pil_3 == 0 AND $pil_4 == 0 AND $diterima == 0)
        {
            $this->db
				 ->where_in($this->pk, $prodi_id)
				 ->delete($this->table);
            return $this->db->affected_rows();
        }
    }

    public function get_dropdown()
	{
        $query = $this->find_all();
		if ($query->num_rows() > 0)
        {
			foreach ($query->result() as $row) 
            {
				$prodi[$row->prodi_id] = $row->prodi_nama;
			}
			return $prodi;
		}
        else
        {
            return array(null => null);
        }
	}
}

/* End of file m_prodi.php */
/* Location: ./application/models/m_prodi.php */