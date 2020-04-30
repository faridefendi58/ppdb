<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_link extends CI_Model {
    
    private $pk    = 'link_id';
    private $table = 'link';
    private $data  = array();

    public function field_data()
    {
        $this->data = array(
                      'link_name'        => $this->input->post('link_name'),
                      'link_url'         => prep_url($this->input->post('link_url')),
                      'link_description' => $this->input->post('link_description'),
                      'link_cat_id'      => $this->input->post('link_cat_id')
					  );
    }

    public function find_all()
    {
        return $this->db
                    ->join('link_category', 'link_category.cat_id = link.link_cat_id')
                    ->get($this->table);
    }
    
    public function find_by_category($cat_id)
    {
        return $this->db
                    ->where('link_cat_id', $cat_id)
                    ->get($this->table);
    }
    
    public function find($link_id)
    {
        $query = $this->db
                      ->where($this->pk, $link_id)
                      ->get($this->table);
        return $query->num_rows() == 1 ? $query->row_array() : NULL;
    }
    
    public function save()
    {
        $this->db->insert($this->table, $this->data);
    }

    public function update($link_id)
    {
        $this->db
			 ->where($this->pk, $link_id)
             ->update($this->table, $this->data);
    }
    
    public function delete($link_id)
    {
        $this->db
				 ->where_in($this->pk, $link_id)
				 ->delete($this->table);
        return $this->db->affected_rows();
    }
}

/* End of file m_link.php */
/* Location: ./application/models/m_link.php */