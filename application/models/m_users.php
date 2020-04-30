<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * USER STATUS : 1 = Enable     2 = Disable     3 = Trash
 */

class M_users extends CI_Model {
    
    /**
     * @var
     * @access  private
     */
    private $pk    = 'user_id';
    private $table = 'users';
    private $data  = array();

    /**
     * field_data()
     * method untuk menyimpan data sementara ke variabel $data
     * @access  public
     * @return  void
     */
    public function field_data()
    {
        $this->data = array(
                      'user_name'    => $this->input->post('user_name'),
                      'user_email'   => $this->input->post('user_email'),
                      'user_display' => $this->input->post('user_display')
                      );

        if ($this->input->post('user_password'))
        $this->data['user_password'] = $this->auth->hash_password($this->input->post('user_password'));
    }

    /**
     * save()
     * method untuk menyimpan data
     * @access  public
     * @return  void
     */
    public function save()
    {
        $this->db->insert($this->table, $this->data);
    }
        
    /**
     * update()
     * method untuk mengubah data
     * @param   int
     * @access  public
     * @return  void
     */
    public function update($user_id)
    {
        $this->db
             ->where($this->pk, $user_id)
             ->update($this->table, $this->data);
    }
    
    /**
     * find_all()
     * method untuk mengambil data
     * @param   int
     * @access  public
     * @return  void
     */
    public function find_all($user_status = 1)
    {
         return $this->db
                     ->select('user_id, user_name, user_email, user_display')   
                     ->where('user_status', $user_status)
                     ->where('user_level !=', 1)
                     ->get($this->table);
    }
    
    public function find($user_id)
    {
        $query = $this->db->where($this->pk, $user_id)
                         ->get($this->table);
        return $query->num_rows() == 1 ? $query->row_array() : NULL;
    }

    /**
     * change_status()
     * @param   int
     * @access  public
     * @return  void
     */
    public function change_status($status, $user_id)
    {
        $this->db
             ->where_in($this->pk, $user_id)
             ->update($this->table, array('user_status' => $status));
        return $this->db->affected_rows();
    }

    /**
     * is_exist()
     * method untuk mengecek ketersediaan email
     * @param   int
     * @access  public
     * @return  bool
     */
    public function is_exist($field, $value, $user_id = '')
    {
        $this->db->where($field, $value);

        if ($user_id != '')
        {
            $this->db->where($this->pk . ' !=', $user_id);
        }

        $result = $this->db->count_all_results($this->table);

        return $result > 0 ? TRUE : FALSE;
    }
    
    /**
     * delete()
     * method untuk menghapus record data secara permanen
     * @param   int
     * @access  public
     * @return  void
     */
    public function delete($user_id)
    {
        $this->db
			 ->where_in($this->pk, $user_id)
			 ->delete($this->table);
        return $this->db->affected_rows();
    }
}

/* End of file m_users.php */
/* Location: ./application/models/m_users.php */