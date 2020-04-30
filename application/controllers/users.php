<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Users extends CI_Controller {
    
    /**
     * __construct()
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array('m_users'));
        
        $this->auth->restrict();
    }
    
    /**
     * index()
     * @access  public 
     * redirect to users/read/1
     */
	public function index()
	{
	    redirect('users/read/1');
	}
    
    /**
     * create()
     * method untuk menambah record data
     * @access  public
     * @return  void
     */
    public function create()
	{
	   if ($this->session->userdata('user_level') != 1) redirect('dashboard');
       
	   if ($_POST)
       {
           if ($this->_set_validation())
           {
               $this->m_users->field_data();
               $this->m_users->save();
               $this->message->config('on', 'success', 'Data berhasil disimpan!');
               redirect('users/read/1');
           }
           else
           {
               $this->message->config('on', 'error', validation_errors());
               redirect('users/create');
           }
       }
       else
       {
           $data['message'] = $this->message->show();
           $data['tools']   = 'active';
           $data['us']      = 'class = active';
           $data['action']  = site_url('users/create');
           $data['query']   = FALSE;
    	   $data['content'] = 'users/create';
    	   $this->load->view('theme/index', $data);
           $this->message->close();    
       }
	}
    
    /**
     * read()
     * method untuk menampilkan record data
     * @access  public
     * @return  void
     */
    public function read()
	{
	   if ($this->session->userdata('user_level') != 1) redirect('dashboard');
       
	   if ($this->uri->segment(3))
       {
    	    $data['message'] = $this->message->show();
            $data['tools']   = 'active';
            $data['us']      = 'class = active';
            $data['action']  = site_url('users/change_status');
            $data['query']   = $this->m_users->find_all($this->uri->segment(3));
    	    $data['content'] = 'users/read';
    		$this->load->view('theme/index', $data);
            $this->message->close();
        }
        else
        {
            $this->message->config('on', 'error', 'Anda tidak diperkenankan memanipulasi URL!');
            redirect('users/read/1');
        }
	}
    
    /**
     * update()
     * method untuk mengubah record data
     * @access  public
     * @return  void
     */
    public function update()
	{
       $user_id = $this->uri->segment(3) == FALSE ? $this->session->userdata('user_id') : $this->uri->segment(3); 
       
       if ($_POST)
       {
           $url = $this->input->post('url');
           
           if ($this->_set_validation())
           {
               $this->m_users->field_data();
               $this->m_users->update($user_id);
               $this->message->config('on', 'success', 'Data sudah diperbaharui!');
               redirect($url);
            }
           else
           {
               $this->message->config('on', 'error', validation_errors());
               redirect($url);
           }
       }
       else
       {
           $data['message'] = $this->message->show();
           $data['tools']   = 'active';
           $data['us']      = 'class = active';
           $data['action']  = site_url('users/update/'.$user_id);
           $data['query']   = $this->m_users->find($user_id);
     	   $data['content'] = 'users/create';
       	   $this->load->view('theme/index', $data);
           $this->message->close();
       }
	}

    /**
     * change_status()
     * method untuk mengubah status users
     * @access  public
     * @return  void
     */
    public function change_status()
    {
        if ($this->session->userdata('user_level') != 1) redirect('dashboard');

        $url = $this->input->post('url');

        if (isset($_POST['user_id']))
        {
            if (isset($_POST['active']))
            {
                $query = $this->m_users->change_status(1, $_POST['user_id']);
                
                if ($query > 0)
                {
                    $this->message->config('on', 'success', 'User sudah diaktifkan!');
                    redirect($url);
                }
                else
                {
                    $this->message->config('on', 'info', 'Tidak ada data user yang diaktifkan!');
                    redirect($url);
                }
            }
            else if (isset($_POST['disable']))
            {
                $query = $this->m_users->change_status(2, $_POST['user_id']);
                
                if ($query > 0)
                {
                    $this->message->config('on', 'success', 'User sudah di non aktifkan!');
                    redirect($url);
                }
                else
                {
                    $this->message->config('on', 'info', 'Tidak ada data user yang di non aktifkan!');
                    redirect($url);
                }
            }
            else if (isset($_POST['trash']))
            {
                $query = $this->m_users->change_status(3, $_POST['user_id']);
                
                if ($query > 0)
                {
                    $this->message->config('on', 'success', 'User sudah dihapus!');
                    redirect($url);
                }
                else
                {
                    $this->message->config('on', 'info', 'Tidak ada data user yang dihapus!');
                    redirect($url);
                }
            }
            else if (isset($_POST['delete_pemanently']))
            {
                $this->m_users->delete($_POST['user_id']);
                $this->message->config('on', 'success', 'User sudah dihapus permanen!');
                redirect($url);
            }
        }
        else
        {
            $this->message->config('on', 'info', 'Tidak ada data yang terpilih !');
            redirect($url);
        }
    }

    /**
     * method _set_validation()
     * method untuk validasi data
     * @access  private
     * @return  bool
     */
    private function _set_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'Nama Pengguna', 'trim|required|min_length[6]|xss_clean|callback_user_name_check');
        
        if ($this->uri->segment(2) == 'create')
        {
            $this->form_validation->set_rules('user_password', 'Kata Sandi', 'trim|required|min_length[6]xss_clean');
            $this->form_validation->set_rules('conf_password', 'Ulangi Kata Sandi', 'trim|required|matches[user_password]|xss_clean');
        }
        else
        {
            $this->form_validation->set_rules('user_password', 'Kata Sandi', 'trim|min_length[6]xss_clean');
            $this->form_validation->set_rules('conf_password', 'Ulangi Kata Sandi', 'trim|matches[user_password]|xss_clean');
        }        
        
        $this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|xss_clean|callback_user_email_check');
        $this->form_validation->set_rules('user_display', 'Nama Lengkap', 'trim|required|xss_clean');

        $this->form_validation->set_error_delimiters('<div><i class="icon-circle-arrow-right"></i> ', '</div>');
        
        return $this->form_validation->run();
    }
    
    public function user_email_check($email)
    {
        $user_id = $this->uri->segment(3);
        
        if ($user_id)
        {
            if ($this->m_users->is_exist('user_email', $email, $user_id) == TRUE)
            {
                $this->form_validation->set_message('user_email_check', 'Email sudah digunakan !');
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            if ($this->m_users->is_exist('user_email', $email) == TRUE)
            {
                $this->form_validation->set_message('user_email_check', 'Email sudah digunakan !');
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }
    
    public function user_name_check($user_name)
    {
        $user_id = $this->uri->segment(3);
        
        if ($user_id)
        {
            if ($this->m_users->is_exist('user_name', $user_name, $user_id) == TRUE)
            {
                $this->form_validation->set_message('user_name_check', 'Nama pengguna sudah digunakan !');
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            if ($this->m_users->is_exist('user_name', $user_name) == TRUE)
            {
                $this->form_validation->set_message('user_name_check', 'Nama pengguna sudah digunakan !');
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }
}