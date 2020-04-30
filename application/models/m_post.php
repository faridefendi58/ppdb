<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_post extends CI_Model {
    
    private $pk    = 'post_id';
    private $table = 'post';
    private $data  = array();

    public function field_data($action = 1)
    {
        $this->data = array(
                      'post_cat_id'  => $this->input->post('post_cat_id'),
                      'post_title'   => $this->input->post('post_title'),
                      'post_content' => $this->input->post('post_content'),
                      'post_status'  => $this->input->post('post_status')
					  );

        if ($action == 1)
        {
            $this->data['post_date']   = date('Y-m-d');
            $this->data['post_author'] = $this->session->userdata('user_id');
        }
    }
    
    private function wpost_default($post_id)
    {
        
    }
    
    public function category($limit, $uri, $category = '')
    {
        $this->db->select('post.post_id,
                           post.post_title,
                           post.post_content,
                           post.post_date,
                           post_category.cat_name,
                           users.user_display');
        if ($category != '')
        {
            $this->db->where('post_cat_id', $category);
        }

        $this->db->where('post_status', 'Y');
        $this->db->where('post_default', 'N');
        $this->db->join('post_category', 'post_category.cat_id = post.post_cat_id');
        $this->db->join('users', 'users.user_id = post.post_author');
        $this->db->order_by('post.post_date', 'DESC');
        return $this->db->get($this->table, $limit, $uri);
    }
    
    public function post_default()
    {
        $query = $this->db
                      ->select('post.post_id,
                                post.post_title,
                                post.post_content,
                                post.post_date,
                                post_category.cat_name,
                                users.user_display')
                      ->where('post_status', 'Y')
                      ->where('post_default', 'Y')
                      ->join('post_category', 'post_category.cat_id = post.post_cat_id')
                      ->join('users', 'users.user_id = post.post_author')
                      ->get($this->table);
        return $query->num_rows() == 1 ? $query->row_array() : NULL;
    }
    
    public function archives($limit, $uri, $month)
    {
        $year = date('Y');
        $this->db->select('post.post_id,
                           post.post_title, 
                           post.post_content, 
                           post.post_date, 
                           post_category.cat_name, 
                           users.user_display');        
        $this->db->join('users', 'post.post_author = users.user_id');
        $this->db->join('post_category', 'post.post_cat_id = post_category.cat_id');
        $where = "substring(post.post_date, 1, 4) = '$year' AND substring(post.post_date, 6, 2) = '$month' AND post.post_status = 'Y' AND post.post_default = 'N' ";
        $this->db->where($where);
        $this->db->order_by('post.post_date', 'DESC');
        return $this->db->get('post', $limit, $uri);
    }
    
    public function archive_month()
    {
        $year = date('Y');
        return $this->db->query("SELECT MID(post_date, 6, 2) AS bulan 
                                 FROM post 
                                 WHERE LEFT(post_date, 4) = '$year'
                                 AND post_default = 'N'
                                 GROUP BY bulan
                                 ORDER BY bulan ASC");
    }
    
    public function count_archive($month)
    {
        $year  = date('Y');
        $query = $this->db->query("SELECT COUNT(*) AS numrows
                                   FROM post
                                   WHERE post_status = 'Y'
                                   AND post_default = 'N'
                                   AND SUBSTRING(post_date, 6, 2) = '$month' 
                                   AND SUBSTRING(post_date, 1, 4) = '$year'");
        $result = $query->row_array();
        return $result['numrows'];
    }
    
    public function find_all()
    {
        return $this->db
                    ->select('post.post_id,
                              post.post_title,
                              post.post_content,
                              post.post_date,
                              post.post_default,
                              post_category.cat_name,
                              users.user_display')
                    ->join('post_category', 'post_category.cat_id = post.post_cat_id')
                    ->join('users', 'users.user_id = post.post_author')
                    ->order_by('post_date', 'DESC')
                    ->get($this->table);
    }
    
    public function find($post_id)
    {
        $query = $this->db
                      ->where($this->pk, $post_id)
                      ->get($this->table);
        return $query->num_rows() == 1 ? $query->row_array() : NULL;
    }
    
    public function save()
    {
        $this->db->insert($this->table, $this->data);
    }

    public function update($post_id)
    {
        $this->db
			 ->where($this->pk, $post_id)
             ->update($this->table, $this->data);
    }
    
    public function set_post_default($post_id)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE post SET post_default = 'Y' WHERE post_id  = '$post_id'");
        $this->db->query("UPDATE post SET post_default = 'N' WHERE post_id != '$post_id'");
        $this->db->trans_complete();
    }
    
    public function delete($post_id)
    {
        if (is_array($post_id))
        {
            $this->db
                 ->where('post_default', 'N')
				 ->where_in($this->pk, $post_id)
				 ->delete($this->table);
            return $this->db->affected_rows();
        }
        else
        {
            $this->db
                 ->where('post_default', 'N')
				 ->where($this->pk, $post_id)
  				 ->delete($this->table);
            return $this->db->affected_rows();
        }
    }
}

/* End of file m_post.php */
/* Location: ./application/models/m_post.php */