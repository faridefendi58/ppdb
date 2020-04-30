<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_link_category extends CI_Model {
    
    private $pk    = 'cat_id';
    private $table = 'link_category';
    private $data  = array();

    public function field_data()
    {
        $this->data = array(
                      'cat_name' => $this->input->post('cat_name')
					  );
    }

    public function find_all()
    {
        return $this->db->get($this->table);
    }
    
    public function find($cat_id)
    {
        $query = $this->db->where($this->pk, $cat_id)
                         ->get($this->table);
        return $query->num_rows() == 1 ? $query->row_array() : NULL;
    }
    
    public function save()
    {
        $this->db->insert($this->table, $this->data);
    }

    public function update($cat_id)
    {
        $this->db
			 ->where($this->pk, $cat_id)
             ->update($this->table, $this->data);
    }
    
    public function delete($cat_id)
    {
        $result = $this->db
                       ->where_in('link_cat_id', $cat_id)
                       ->count_all_results('link');
        
        if ($result == 0)
        {
            $this->db
				 ->where_in($this->pk, $cat_id)
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
				$category[$row->cat_id] = $row->cat_name;
			}
			return $category;
		}
        else
        {
            return array(null => null);            
        }
	}
}

/* End of file m_link_category.php */
/* Location: ./application/models/m_link_category.php */