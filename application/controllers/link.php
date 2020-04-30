<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Link extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array('m_link', 'm_link_category'));
        
        $this->auth->restrict();
    }

	public function index()
	{
	    $this->read();
	}

    public function create()
    {
        if ($_POST)
        {
            if ($this->_validation())
            {
                $this->m_link->field_data();
                $this->m_link->save();
                $this->message->config('on', 'success', 'Data sudah tersimpan!');
                redirect('link');
            }
            else
            {
                $this->message->config('on', 'error', validation_errors());
                redirect('link/create');
            }
        }
        else
        {
            $data['message']  = $this->message->show();
            $data['lk']       = 'class = "active"';
    	    $data['action']   = site_url('link/create');
            $data['category'] = $this->m_link_category->get_dropdown();
            $data['query']    = FALSE;
    	    $data['content']  = 'link/create';
    		$this->load->view('theme/index', $data);
            $this->message->close();
        }
    }
    
    public function read()
    {
        $data['message'] = $this->message->show();
        $data['lk']      = 'class = "active"';
        $data['action']  = site_url('link/delete');
        $data['query']   = $this->m_link->find_all();
        $data['content'] = 'link/read';
		$this->load->view('theme/index', $data);
        $this->message->close();
    }
            
    public function update()
    {
        if ($this->uri->segment(3))
        {
            if ($_POST)
            {
                if ($this->_validation())
                {
                    $this->m_link->field_data();
                    $this->m_link->update($this->uri->segment(3));
                    $this->message->config('on', 'success', 'Data sudah diperbaharui!');
                    redirect('link');
                }
                else
                {
                    $this->message->config('on', 'error', validation_errors());
                    redirect('link/update/'.$this->uri->segment(3));
                }
            }
            else
            {
                $data['message']  = $this->message->show();
                $data['lk']       = 'class = "active"';
        	    $data['action']   = site_url('link/update/'.$this->uri->segment(3));
                $data['category'] = $this->m_link_category->get_dropdown();
                $data['query']    = $this->m_link->find($this->uri->segment(3));
        	    $data['content']  = 'link/create';
        		$this->load->view('theme/index', $data);
                $this->message->close();
            }            
        }
        else
        {
            $this->message->config('on', 'info', 'Anda tidak diperkenankan memanipulasi URL');
            redirect('link');
        }
    }

    public function delete()
    {
        if (isset($_POST['link_id']))
        {
            $query = $this->m_link->delete($_POST['link_id']);

            if ($query > 0)
            {
                $this->message->config('on', 'success', 'Data sudah dihapus!');
                redirect('link');
            }
            else
            {
                $this->message->config('on', 'info', 'Data tidak bisa dihapus karena sudah digunakan !');
                redirect('link');
            }
        }
        else
        {
            $this->message->config('on', 'info', 'Anda belum memiih data untuk dihapus!');
            redirect('link');
        }
    }
        
    private function _validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('link_name',        'Name',        'trim|required|xss_clean');
        $this->form_validation->set_rules('link_url',         'URL',         'trim|required|xss_clean');
        $this->form_validation->set_rules('link_description', 'Description', 'trim|required|xss_clean');
        
        $this->form_validation->set_error_delimiters('<div><i class="icon-circle-arrow-right"></i> ', '</div>');
        
        return $this->form_validation->run();
    }
}

/* End of file link.php */
/* Location: ./application/controllers/link.php */