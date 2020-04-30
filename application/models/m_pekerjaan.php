<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pekerjaan extends CI_Model {
    
    private $pk    = 'pk_id';
    private $table = 'pekerjaan';
    private $data  = array();

    public function field_data()
    {
        $this->data = array(
                      'pk_nama' => $this->input->post('pk_nama')
					  );
    }

    public function find_all()
    {
        return $this->db->get($this->table);
    }
    
    public function find($pk_id)
    {
        $query = $this->db->where($this->pk, $pk_id)
                         ->get($this->table);
        return $query->num_rows() == 1 ? $query->row_array() : NULL;
    }
    
    public function save()
    {
        $this->db->insert($this->table, $this->data);
    }

    public function update($pk_id)
    {
        $this->db
			 ->where($this->pk, $pk_id)
             ->update($this->table, $this->data);
    }
    
    public function delete($pk_id)
    {
        $result = $this->db
                       ->where_in('pekerjaan_ortu', $pk_id)
                       ->count_all_results('siswa');
        if ($result == 0)
        {
            $this->db
				 ->where_in($this->pk, $pk_id)
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
				$pekerjaan[$row->pk_id] = $row->pk_nama;
			}
			return $pekerjaan;
		}
        else
        {
            return array(null => null);            
        }
	}
}

/* End of file m_jalur.php */
/* Location: ./application/models/m_jalur.php */