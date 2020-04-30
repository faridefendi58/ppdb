<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Link_category extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array('m_link_category'));
        
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
                $this->m_link_category->field_data();
                $this->m_link_category->save();
                $this->message->config('on', 'success', 'Data sudah tersimpan!');
                redirect('link_category');
            }
            else
            {
                $this->message->config('on', 'error', validation_errors());
                redirect('link_category/create');
            }
        }
        else
        {
            $data['message'] = $this->message->show();
            $data['master']  = 'active';
            $data['lc']      = 'class = "active"';
    	    $data['action']  = site_url('link_category/create');
            $data['query']   = FALSE;
    	    $data['content'] = 'link_category/create';
    		$this->load->view('theme/index', $data);
            $this->message->close();
        }
    }
    
    public function read()
    {
        $data['message'] = $this->message->show();
        $data['master']  = 'active';
        $data['lc']      = 'class = "active"';
        $data['action']  = site_url('link_category/delete');
        $data['query']   = $this->m_link_category->find_all();
        $data['content'] = 'link_category/read';
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
                    $this->m_link_category->field_data();
                    $this->m_link_category->update($this->uri->segment(3));
                    $this->message->config('on', 'success', 'Data sudah diperbaharui!');
                    redirect('link_category');
                }
                else
                {
                    $this->message->config('on', 'error', validation_errors());
                    redirect('link_category/update/'.$this->uri->segment(3));
                }
            }
            else
            {
                $data['message'] = $this->message->show();
                $data['master']  = 'active';
                $data['lc']      = 'class = "active"';
        	    $data['action']  = site_url('link_category/update/'.$this->uri->segment(3));
                $data['query']   = $this->m_link_category->find($this->uri->segment(3));
        	    $data['content'] = 'link_category/create';
        		$this->load->view('theme/index', $data);
                $this->message->close();
            }            
        }
        else
        {
            $this->message->config('on', 'info', 'Anda tidak diperkenankan memanipulasi URL');
            redirect('link_category');
        }
    }

    public function delete()
    {
        if (isset($_POST['cat_id']))
        {
            $query = $this->m_link_category->delete($_POST['cat_id']);

            if ($query > 0)
            {
                $this->message->config('on', 'success', 'Data sudah dihapus!');
                redirect('link_category');
            }
            else
            {
                $this->message->config('on', 'info', 'Data tidak bisa dihapus karena sudah digunakan !');
                redirect('link_category');
            }
        }
        else
        {
            $this->message->config('on', 'info', 'Anda belum memiih data untuk dihapus!');
            redirect('link_category');
        }
    }
        
    private function _validation()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('cat_name', 'Category Name', 'trim|required|xss_clean');
        
        $this->form_validation->set_error_delimiters('<div><i class="icon-circle-arrow-right"></i> ', '</div>');
        
        return $this->form_validation->run();
    }
}

/* End of file link_category.php */
/* Location: ./application/controllers/link_category.php */