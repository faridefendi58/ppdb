<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminpsb extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }
    
    public function index($alert = 'off')
	{
	    if($this->auth->is_logged_in()) redirect('guestbook/read');
        
	    if($alert == 'off')
        {
            $data['alert'] = '';
            $data['query'] = $this->m_configuration->find();
		    $this->load->view('users/form_login', $data);
        }
        else
        {
            $data['alert'] = $this->alert();
            $data['query'] = $this->m_configuration->find();
		    $this->load->view('users/form_login', $data);
        }
	}
    
    public function process()
    {
        $user_name = $this->input->post('user_name');
        $user_password = $this->input->post('user_password');
        if($this->auth->login($user_name, $user_password))
        {
            $user_display = $this->session->userdata('user_display');
            $this->message->config('on', 'success', 'Selamat Datang '.$user_display.' !');
            redirect('dashboard');
        }
        else
        {
            $this->index('on');
        }
    }
    
    public function logout()
    {
        if($this->auth->is_logged_in() == TRUE)
		{			
			$this->auth->logout();
		}		
		redirect('adminpsb/');
    }
    
    private function alert()
    {
        return '<div class="alert alert-error" style="text-align: center;">
	               <button class="close" data-dismiss="alert">x</button>
	               <strong>Terjadi Kesalahan !</strong> Nama pengguna dan/atau kata sandi yang anda masukan tidak benar!
                </div>';
    }
}

/* End of file name.php */
/* Location: ./application/controllers/name.php */
