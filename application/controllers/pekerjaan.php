<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pekerjaan extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array('m_pekerjaan'));
        
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
                $this->m_pekerjaan->field_data();
                $this->m_pekerjaan->save();
                $this->message->config('on', 'success', 'Data sudah tersimpan!');
                redirect('pekerjaan');
            }
            else
            {
                $this->message->config('on', 'error', validation_errors());
                redirect('pekerjaan/create');
            }
        }
        else
        {
            $data['message'] = $this->message->show();
            $data['master']  = 'active';
            $data['pk']      = 'class = "active"';
    	    $data['action']  = site_url('pekerjaan/create');
            $data['query']   = FALSE;
    	    $data['content'] = 'pekerjaan/create';
    		$this->load->view('theme/index', $data);
            $this->message->close();
        }
    }
    
    public function read()
    {
        $data['message'] = $this->message->show();
        $data['master']  = 'active';
        $data['pk']      = 'class = "active"';
        $data['action']  = site_url('pekerjaan/delete');
        $data['query']   = $this->m_pekerjaan->find_all();
        $data['content'] = 'pekerjaan/read';
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
                    $this->m_pekerjaan->field_data();
                    $this->m_pekerjaan->update($this->uri->segment(3));
                    $this->message->config('on', 'success', 'Data sudah diperbaharui!');
                    redirect('pekerjaan');
                }
                else
                {
                    $this->message->config('on', 'error', validation_errors());
                    redirect('pekerjaan/update/'.$this->uri->segment(3));
                }
            }
            else
            {
                $data['message'] = $this->message->show();
                $data['master']  = 'active';
                $data['pk']      = 'class = "active"';
        	    $data['action']  = site_url('pekerjaan/update/'.$this->uri->segment(3));
                $data['query']   = $this->m_pekerjaan->find($this->uri->segment(3));
        	    $data['content'] = 'pekerjaan/create';
        		$this->load->view('theme/index', $data);
                $this->message->close();
            }            
        }
        else
        {
            $this->message->config('on', 'info', 'Anda tidak diperkenankan memanipulasi URL');
            redirect('pekerjaan');
        }
    }

    public function delete()
    {
        if (isset($_POST['pk_id']))
        {
            $query = $this->m_pekerjaan->delete($_POST['pk_id']);

            if ($query > 0)
            {
                $this->message->config('on', 'success', 'Data sudah dihapus!');
                redirect('pekerjaan');
            }
            else
            {
                $this->message->config('on', 'info', 'Data tidak bisa dihapus karena sudah digunakan !');
                redirect('pekerjaan');
            }
        }
        else
        {
            $this->message->config('on', 'info', 'Anda belum memiih data untuk dihapus!');
            redirect('pekerjaan');
        }
    }
        
    private function _validation()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('pk_nama', 'Pekerjaan', 'trim|required|xss_clean');
        
        $this->form_validation->set_error_delimiters('<div><i class="icon-circle-arrow-right"></i> ', '</div>');
        
        return $this->form_validation->run();
    }
}

/* End of file pekerjaan.php */
/* Location: ./application/controllers/pekerjaan.php */