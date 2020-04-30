<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuration extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array('m_configuration'));
        
        $this->auth->restrict();
    }
	            
    public function index()
    {
        if ($this->uri->segment(3))
        {
            if ($_POST)
            {
                if ($this->_validation())
                {
                    $file = $this->upload();
                    if ($file != NULL)
                    {
                        $this->delete_photo(config('logo'));
                    }
                    $this->m_configuration->field_data($file);
                    $this->m_configuration->update();
                    $this->message->config('on', 'success', 'Pengaturan Aplikasi sudah diperbaharui!');
                    redirect('configuration/index/1');
                }
                else
                {
                    $this->message->config('on', 'error', validation_errors());
                    redirect('configuration/index/1');
                }
            }
            else
            {
                $data['message'] = $this->message->show();
                $data['tools']   = 'active';
                $data['cg']      = 'class = active';
        	    $data['action']  = site_url('configuration/index/1');
                $data['logo']    = config('logo') != '' ? base_url().'assets/images/'.config('logo') : base_url().'assets/images/logo.jpg';
                $data['query']   = $this->m_configuration->find();
        	    $data['content'] = 'dashboard/create';
        		$this->load->view('theme/index', $data);
                $this->message->close();
            }            
        }
        else
        {
            $this->message->config('on', 'info', 'Anda tidak diperkenankan memanipulasi URL');
            redirect('configuration/index/1');
        }
    }
    
    private function upload()
    {
        $config['upload_path']   = APPPATH . '../assets';
        $config['allowed_types'] = 'jpg';
        $config['max_size']      = '5000';
        $config['encrypt_name']  = TRUE;
        $this->load->library('upload', $config);
        if($this->upload->do_upload('file') == TRUE)
        {
            $data   = $this->upload->data();
            $config = array(
                      'source_image'    => $data['full_path'],
        	 	      'new_image'       => APPPATH . '../assets/images/',
        		      //'maintain_ration' => TRUE,
        		      'width'           => 99,
        		      'height'          => 99
    		          );
  		    $this->load->library('image_lib', $config);
    		$this->image_lib->resize();
            $file = APPPATH . '../assets/' . $data['file_name'];
            unlink($file);
            return $data['file_name'];
        }
        else
        {
            return NULL;
        }
    }
    
    private function delete_photo($file)
    {
        if(file_exists('./assets/images/'.$file))
        {
            unlink('./assets/images/'.$file);
        }
    }

    private function _validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama_sekolah',        'Nama Sekolah',          'trim|required|xss_clean');
        $this->form_validation->set_rules('alamat',              'Alamat',                'trim|required|xss_clean');
        $this->form_validation->set_rules('kota',                'Kota',                  'trim|required|xss_clean');
        $this->form_validation->set_rules('email',               'Email',                 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('website',             'Website',               'trim|required|xss_clean');
        $this->form_validation->set_rules('akreditasi',          'Akreditasi',            'trim|required|xss_clean');
        $this->form_validation->set_rules('meta_keywords',       'Meta Keywords',         'trim|required|xss_clean');
        $this->form_validation->set_rules('meta_description',    'Meta Description',      'trim|required|xss_clean');
        $this->form_validation->set_rules('pesan_sukses',        'Pesan Sukses',          'trim|required|xss_clean');
        $this->form_validation->set_rules('pesan_gagal',         'Pesan Gagal',           'trim|required|xss_clean');
        $this->form_validation->set_rules('pesan_status_daftar', 'Informasi Pendaftaran', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ppdb_tahun',          'Tahun PPDB',            'trim|required|xss_clean');
        
        $this->form_validation->set_error_delimiters('<div><i class="icon-circle-arrow-right"></i> ', '</div>');
        
        return $this->form_validation->run();
    }
}

/* End of file configuration.php */
/* Location: ./application/controllers/configuration.php */