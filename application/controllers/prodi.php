<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prodi extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array('m_prodi'));
        
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
                $this->m_prodi->field_data();
                $this->m_prodi->save();
                $this->message->config('on', 'success', 'Data sudah tersimpan!');
                redirect('prodi');
            }
            else
            {
                $this->message->config('on', 'error', validation_errors());
                redirect('prodi/create');
            }
        }
        else
        {
            $data['message'] = $this->message->show();
            $data['master']  = 'active';
            $data['pd']      = 'class = "active"';
    	    $data['action']  = site_url('prodi/create');
            $data['query']   = FALSE;
    	    $data['content'] = 'prodi/create';
    		$this->load->view('theme/index', $data);
            $this->message->close();
        }
    }
    
    public function read()
    {
        $data['message'] = $this->message->show();
        $data['master']  = 'active';
        $data['pd']      = 'class = "active"';
        $data['action']  = site_url('prodi/delete');
        $data['query']   = $this->m_prodi->find_all();
        $data['content'] = 'prodi/read';
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
                    $this->m_prodi->field_data();
                    $this->m_prodi->update($this->uri->segment(3));
                    $this->message->config('on', 'success', 'Data sudah diperbaharui!');
                    redirect('prodi');
                }
                else
                {
                    $this->message->config('on', 'error', validation_errors());
                    redirect('prodi/update/'.$this->uri->segment(3));
                }
            }
            else
            {
                $data['message'] = $this->message->show();
                $data['master']  = 'active';
                $data['pd']      = 'class = "active"';
        	    $data['action']  = site_url('prodi/update/'.$this->uri->segment(3));
                $data['query']   = $this->m_prodi->find($this->uri->segment(3));
        	    $data['content'] = 'prodi/create';
        		$this->load->view('theme/index', $data);
                $this->message->close();
            }            
        }
        else
        {
            $this->message->config('on', 'info', 'Anda tidak diperkenankan memanipulasi URL');
            redirect('prodi');
        }
    }

    public function delete()
    {
        if (isset($_POST['prodi_id']))
        {
            $query = $this->m_prodi->delete($_POST['prodi_id']);

            if ($query > 0)
            {
                $this->message->config('on', 'success', 'Data sudah dihapus!');
                redirect('prodi');
            }
            else
            {
                $this->message->config('on', 'info', 'Data tidak bisa dihapus karena sudah digunakan !');
                redirect('prodi');
            }
        }
        else
        {
            $this->message->config('on', 'info', 'Anda belum memiih data untuk dihapus!');
            redirect('prodi');
        }
    }

    private function _validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('prodi_nama', 'prodi', 'trim|required|xss_clean');
        
        $this->form_validation->set_error_delimiters('<div><i class="icon-circle-arrow-right"></i> ', '</div>');
        
        return $this->form_validation->run();
    }
}

/* End of file prodi.php */
/* Location: ./application/controllers/prodi.php */