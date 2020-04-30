<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Auth Library
 *  
 * @author		Anton Sofyan 
 * @copyright	(c) 2013 
 * @version		1.0
 */

class Auth {
   
   /**
    * get_instance()
    *
    * @var object
    **/ 
   private $CI;
   
   /**
	* __construct() 
	*
	* @access	public 
	* @return	void
	*/
   public function __construct()
   {
       $this->CI =& get_instance();
   }

   /**
	* login()
    * Fungsi untuk mengecek ketersediaan account users dalam proses login
	* @access	public
    * @param    string
	* @return	bool
	*/	
	public function login($user_name, $user_password)
	{
        /* Pengecekan account users di database */
        $result = $this->CI->db
                           ->from('users')
   		                   ->where('user_name', $user_name)
                           ->where('user_status', 1)
   		                   ->get();

        /* Jika hasil yang didapatkan sama dengan 0 */
 		if ($result->num_rows() == 0)
   		{
   			return FALSE;
   		}
   		/* Jika hasil yang didapatkan tidak sama dengan 0 */
        else
   		{
   		    /* Simpan data yang didapatkan kedalam variabel $data berupa single result object */
   			$data = $result->row();
            $log  = array(
                    'user_id'       => $data->user_id, 
                    'last_login'    => date('Y-m-d H:i:s'),
                    'last_login_ip' => $_SERVER['SERVER_ADDR']
                    );
            $this->CI->db->insert('log', $log);
            
            if ($this->check_password($user_password, $data->user_password))
            {
                 $session_data = array(
                                'user_id'      => $data->user_id,
                                'user_display' => $data->user_display,
                                'user_level'   => $data->user_level
  			                    );
   			     $this->CI->session->set_userdata($session_data);
   			     return TRUE;
             }
             else
             {//var_dump($this->hash_password($user_password));exit;
                 return FALSE;
             }
   		}
	}
    
   /**
	* hash_password()
    * Fungsi untuk mengenkripsi password
	* @access	public
    * @param    string
	* @return	string
	*/
    public function hash_password($password)
    {
        require_once APPPATH.'libraries/password_hash'.EXT;
        $hash = new password_hash(8, FALSE);
        return $hash->hash_password($password);
    }

   /**
	* check_password()
    * Fungsi untuk memvalidasi password
	* @access	public
    * @param    string  Password yang dikirim users
    * @param    string  Password yang tersimpan dalam database
	* @return	bool
	*/    
    public function check_password($user_password, $db_password)
    {
        require_once APPPATH.'libraries/password_hash'.EXT;
        $hash = new password_hash(8, FALSE);
        return $hash->check_password($user_password, $db_password);
    }
   
   /**
	* is_logged_in()
    * Fungsi untuk mengecek apakah data session user id kosong / tidak
	* @access	public    
	* @return	bool
	*/
	public function is_logged_in()
	{
	    return $this->CI->session->userdata('user_id') != '' ? TRUE : FALSE;
	}
    
   /**
	* restrict()
    * Fungsi untuk memvalidasi status login
	* @access	public
	* @return	bool
	*/
	public function restrict()
	{
	    if ( ! $this->is_logged_in() == TRUE)
        {
            redirect('login');
        }
	}

   /**
	* logout()
    * Fungsi untuk menghapus data session user 
	* @return	void
	*/
    public function logout()
	{
	    $this->CI->session->unset_userdata('user_id');       
        $this->CI->session->unset_userdata('user_display');
        $this->CI->session->unset_userdata('user_level');
	}
}
