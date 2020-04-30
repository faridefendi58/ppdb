<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_post_category extends CI_Model {
    
    private $pk    = 'cat_id';
    private $table = 'post_category';
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
    
    public function find_where()
    {
        return $this->db->query("SELECT cat_id, cat_name
                                 FROM post_category
                                 WHERE cat_id IN (SELECT post_cat_id FROM post WHERE post_default = 'N')");
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
        if (is_array($cat_id))
        {
            $this->db
				 ->where_in($this->pk, $cat_id)
                 ->where('default != ', 'y')
				 ->delete($this->table);
        }
        else
        {
            $this->db
				 ->where($this->pk, $cat_id)
                 ->where('default != ', 'y')
  				 ->delete($this->table);
        }
    }
    
    public function is_exist($cat_id)
    {
        if (is_array($cat_id))
        {
            $result = $this->db
                           ->where_in('post_cat_id', $cat_id)
                           ->count_all_results('post');
        }
        else
        {
            $result = $this->db
                           ->where('post_cat_id', $cat_id)
                           ->count_all_results('post');
        }
        
        return $result > 0 ? TRUE : FALSE;
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

/* End of file m_post_category.php */
/* Location: ./application/models/m_post_category.php */