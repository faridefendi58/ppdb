<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_guestbook extends CI_Model {
    
    private $pk    = 'id';
    private $table = 'guestbook';
    private $data  = array();

    public function field_data()
    {
        date_default_timezone_set('Asia/Jakarta');

        $this->data = array(
                      'name'       => $this->input->post('name'),
                      'email'      => $this->input->post('email'),
                      'date'       => date('Y-m-d H:i:s'),
                      'content'    => $this->input->post('content'),
                      'ip_address' => $this->input->ip_address()
					  );
    }

    public function find_all()
    {
        return $this->db
                    ->order_by('date', 'DESC')
                    ->get($this->table);
    }
    
    public function find($id)
    {
        $query = $this->db->where($this->pk, $id)
                         ->get($this->table);
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
    
    public function delete($id)
    {
        $this->db
			 ->where_in($this->pk, $id)
			 ->delete($this->table);
        return $this->db->affected_rows();
    }
}

/* End of file name.php */
/* Location: ./application/models/name.php */