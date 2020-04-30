<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_category extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array('m_post_category'));
        
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
                $this->m_post_category->field_data();
                $this->m_post_category->save();
                $this->message->config('on', 'success', 'Data sudah tersimpan!');
                redirect('post_category');
            }
            else
            {
                $this->message->config('on', 'error', validation_errors());
                redirect('post_category/create');
            }
        }
        else
        {
            $data['message'] = $this->message->show();
            $data['master']  = 'active';
            $data['pc']      = 'class = "active"';
    	    $data['action']  = site_url('post_category/create');
            $data['query']   = FALSE;
    	    $data['content'] = 'post_category/create';
    		$this->load->view('theme/index', $data);
            $this->message->close();
        }
    }
    
    public function read()
    {
        $data['message'] = $this->message->show();
        $data['master']  = 'active';
        $data['pc']      = 'class = "active"';
        $data['action']  = site_url('post_category/delete');
        $data['query']   = $this->m_post_category->find_all();
        $data['content'] = 'post_category/read';
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
                    $this->m_post_category->field_data();
                    $this->m_post_category->update($this->uri->segment(3));
                    $this->message->config('on', 'success', 'Data sudah diperbaharui!');
                    redirect('post_category');
                }
                else
                {
                    $this->message->config('on', 'error', validation_errors());
                    redirect('post_category/update/'.$this->uri->segment(3));
                }
            }
            else
            {
                $data['message'] = $this->message->show();
                $data['master']  = 'active';
                $data['pc']      = 'class = "active"';
        	    $data['action']  = site_url('post_category/update/'.$this->uri->segment(3));
                $data['query']   = $this->m_post_category->find($this->uri->segment(3));
        	    $data['content'] = 'post_category/create';
        		$this->load->view('theme/index', $data);
                $this->message->close();
            }            
        }
        else
        {
            $this->message->config('on', 'info', 'Anda tidak diperkenankan memanipulasi URL');
            redirect('post_category');
        }
    }

    public function delete()
    {
        if (isset($_POST['cat_id']))
        {
            $query = $this->m_post_category->delete($_POST['cat_id']);

            if ($query > 0)
            {
                $this->message->config('on', 'success', 'Data sudah dihapus!');
                redirect('post_category');
            }
            else
            {
                $this->message->config('on', 'info', 'Data tidak bisa dihapus karena sudah digunakan !');
                redirect('post_category');
            }
        }
        else
        {
            $this->message->config('on', 'info', 'Anda belum memiih data untuk dihapus!');
            redirect('post_category');
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

/* End of file post_category.php */
/* Location: ./application/controllers/post_category.php */