<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guestbook extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array('m_guestbook'));
        
        $this->load->helper(array('captcha', 'text'));
    }

	public function index()
	{
	    $this->read();
	}

    public function create()
    {
        if ($this->auth->is_logged_in())
        {
            $this->message->config('on', 'info', 'Fasilitas pengiriman buku tamu hanya untuk pengunjung!');
            redirect('guestbook/read');
        }
        else
        {
            if ($_POST)
            {
                if ($this->_validation())
                {
                    $this->m_guestbook->field_data();
                    $this->m_guestbook->save();
                    $this->message->config('on', 'success', 'Pesan anda sudah terkirim!');
                    redirect('guestbook/create');
                }
                else
                {
                    $this->message->config('on', 'error', validation_errors());
                    redirect('guestbook/create');
                }
            }
            else
            {
                $data['message'] = $this->message->show();
                $data['gb']      = 'class = active';
        	    $data['action']  = site_url('guestbook/create');
                $data['captcha'] = $this->_set_captcha();
                $data['query']   = FALSE;
        	    $data['content'] = 'guestbook/create';
        		$this->load->view('theme/index', $data);
                $this->message->close();
            }
        }
    }
    
    public function read()
    {
        $this->auth->restrict();
        $data['message'] = $this->message->show();
        $data['action']  = site_url('guestbook/delete');
	    $data['gb']      = 'class = active';
        $data['query']   = $this->m_guestbook->find_all();
        $data['content'] = 'guestbook/read';
		$this->load->view('theme/index', $data);
        $this->message->close();
    }
            
    public function reply()
    {
        $this->auth->restrict();
        
        if ($this->uri->segment(3))
        {
            if ($_POST)
            {
                $this->load->library('email');
                $this->email->from(config('email'), config('nama_sekolah'));
                $this->email->to($this->input->post('email'));
                $this->email->subject(config('meta_description'));
                $this->email->message($this->input->post('reply'));
                if ($this->email->send())
                {
                    $this->message->config('on', 'success', 'Email balasan sudah terkirim!');
                    redirect('guestbook/reply/'.$this->uri->segment(3));
                }
                else
                {
                    $this->message->config('on', 'error', 'Email balasan tidak terkirim!');
                    redirect('guestbook/reply/'.$this->uri->segment(3));
                }
            }
            else
            {
                $data['message'] = $this->message->show();
                $data['gb']      = 'class = active';
        	    $data['action']  = site_url('guestbook/reply/'.$this->uri->segment(3));
                $data['query']   = $this->m_guestbook->find($this->uri->segment(3));
        	    $data['content'] = 'guestbook/reply';
        		$this->load->view('theme/index', $data);
                $this->message->close();
            }            
        }
        else
        {
            $this->message->config('on', 'info', 'Anda tidak diperkenankan memanipulasi URL');
            redirect('guestbook');
        }
    }

    public function delete()
    {
        $this->auth->restrict();
        
        if (isset($_POST['id']))
        {
            $query = $this->m_pekerjaan->delete($_POST['pk_id']);

            if ($query > 0)
            {
                $this->message->config('on', 'success', 'Data sudah dihapus!');
                redirect('guestbook');
            }
            else
            {
                $this->message->config('on', 'info', 'Tidak ada data yang terhapus !');
                redirect('guestbook');
            }
        }
        else
        {
            $this->message->config('on', 'info', 'Anda belum memiih data untuk dihapus!');
            redirect('guestbook');
        }
    }
        
    private function _validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name',    'Nama',    'trim|required|xss_clean');
        $this->form_validation->set_rules('email',   'Email',   'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('content', 'Pesan',   'trim|required|xss_clean');
        $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|callback_valid_captcha');

        $this->form_validation->set_error_delimiters('<div><i class="icon-circle-arrow-right"></i> ', '</div>');

        return $this->form_validation->run();
    }
    
    private function _set_captcha()
	{	
		$vals = array(
			    'img_path'   => './assets/captcha/',
			    'img_url'    => base_url().'/assets/captcha/',
			    'img_width'  => 150,
			    'img_height' => 35,
			    'expiration' => 7200,
			    'word'	     => random_string('numeric', 6)
		        );		
		$cap  = create_captcha($vals);		
		$data = array(
			    'captcha_time' => $cap['time'],
			    'ip_address'   => $this->input->ip_address(),
			    'word'         => $cap['word']
		        );		
		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);
		return $cap;
	}
    
    // OK
	public function valid_captcha($str)
	{	    
		// First, delete old captchas
		$expiration = time()-7200; // Two hour limit
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
		
		// Then see if a captcha exists:
		$sql   = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($str, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row   = $query->row();

		if ($row->count == 0)
		{
			$this->form_validation->set_message('valid_captcha', 'Captcha tidak valid');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}

/* End of file guestbook.php */
/* Location: ./application/controllers/guestbook.php */