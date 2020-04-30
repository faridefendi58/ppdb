<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siswa extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array('m_siswa', 'm_pekerjaan', 'm_prodi'));
        
        $this->load->helper(array('captcha'));
    }

	public function index()
	{
	   redirect('siswa/read/a');
	}

    public function create()
    {
        if ($_POST)
        {
            if ($this->_validation())
            {
                $photo = $this->upload();
                $this->m_siswa->field_data(1, $photo);
                $this->m_siswa->save();
                $this->print_formulir($this->db->insert_id());
            }
            else
            {
                $this->message->config('on', 'error', validation_errors());
                redirect('siswa/create');
            }
        }
        else
        {
            $data['message']   = $this->message->show();
            $data['ppdb']      = 'active';
            $data['daftar']    = 'class = "active"';
    	    $data['action']    = site_url('siswa/create');
            $data['pekerjaan'] = $this->m_pekerjaan->get_dropdown();
            $data['prodi']     = $this->m_prodi->get_dropdown();
            $data['captcha']   = $this->_set_captcha();
            $data['query']     = FALSE;

            if (config('status_daftar') == 'n')
            {
                $data['info']    = config('pesan_status_daftar');
                $data['content'] = 'siswa/pendaftaran_ditutup';
            }
            else
            {
                $data['photo']   = base_url().'assets/images/photo.JPG';
                $data['content'] = 'siswa/create';
            }

    		$this->load->view('theme/index', $data);
            $this->message->close();
        }
    }
    
    public function read()
    {
        $this->auth->restrict();
        
        $title = '';

        if ($this->uri->segment(3) == FALSE)
        {
            $title = 'Data Pendaftar';
        }
        else if ($this->uri->segment(3) == 1)
        {
            $title = 'Seleksi Calon Siswa Baru';
        }
        else if ($this->uri->segment(3) == 2)
        {
            $title = 'Daftar Siswa Diterima';
        }
        else if ($this->uri->segment(3) == 3)
        {
            $title = 'Daftar Siswa Tidak Diterima';
        }
        
        $criteria        = $this->uri->segment(3) == FALSE ? '' : $this->uri->segment(3);
        $data['message'] = $this->message->show();
        $data['title']   = $title.' '.config('ppdb_tahun');
        $data['siswa']   = 'class = "active"';
        $data['action']  = site_url('siswa/multiple_action');
        $data['query']   = $this->m_siswa->find_all($criteria, config('ppdb_tahun'));
        $data['prodi']   = $this->m_prodi->find_all();
        $data['content'] = 'siswa/read';
    	$this->load->view('theme/index', $data);
        $this->message->close();
    }
            
    public function update()
    {
        $this->auth->restrict();
        
        if ($this->uri->segment(3))
        {
            if ($_POST)
            {
                if ($this->_validation())
                {
                    $photo = $this->upload();
                    if ($photo != NULL)
                    {
                        $query = $this->m_siswa->find($this->uri->segment(3));
                        $this->delete_photo($query['photo']);
                    }
                    $this->m_siswa->field_data(2, $photo);
                    $this->m_siswa->update($this->uri->segment(3));
                    $this->message->config('on', 'success', 'Data sudah diperbaharui!');
                    redirect('siswa/update/'.$this->uri->segment(3));
                }
                else
                {
                    $this->message->config('on', 'error', validation_errors());
                    redirect('siswa/update/'.$this->uri->segment(3));
                }
            }
            else
            {
                $data['message']   = $this->message->show();
                $data['siswa']     = 'class = "active"';
        	    $data['action']    = site_url('siswa/update/'.$this->uri->segment(3));
                $data['pekerjaan'] = $this->m_pekerjaan->get_dropdown();
                $data['prodi']     = $this->m_prodi->get_dropdown();
                $data['query']     = $this->m_siswa->find($this->uri->segment(3));
                if ($data['query']['photo'] != '' && file_exists('assets/photo/'.$data['query']['photo']))
                {
                    $data['photo'] = base_url().'assets/photo/'.$data['query']['photo'];
                }
                else
                {
                    $data['photo'] = base_url().'assets/images/photo.jpg';
                }
        	    $data['content']   = 'siswa/create';
        		$this->load->view('theme/index', $data);
                $this->message->close();
            }            
        }
        else
        {
            $this->message->config('on', 'info', 'Anda tidak diperkenankan memanipulasi URL');
            redirect('siswa');
        }
    }

    public function _validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama',                 'Nama',                  'trim|required|xss_clean');
        $this->form_validation->set_rules('tmp_lahir',            'Tempat Lahir',          'trim|required|xss_clean');
        $this->form_validation->set_rules('tgl_lahir',            'Tanggal Lahir',         'trim|required|xss_clean');
        $this->form_validation->set_rules('email',                'Email',                 'trim|valid_email|xss_clean|callback_email_check');
        $this->form_validation->set_rules('alamat',               'Alamat',                'trim|required|xss_clean');
        $this->form_validation->set_rules('telp',                 'Telp',                  'trim|required|xss_clean');
        $this->form_validation->set_rules('asal_sekolah',         'Asal Sekolah',          'trim|required|xss_clean');
        $this->form_validation->set_rules('penghasilan_ortu',     'Penghasilan Orang Tua', 'trim|numeric|xss_clean');

        if ($this->uri->segment(2) == 'create')
        {
            $this->form_validation->set_rules('captcha',          'Captcha',               'trim|required|callback_valid_captcha');
        }

        $this->form_validation->set_error_delimiters('<div><i class="icon-circle-arrow-right"></i> ', '</div>');
        
        return $this->form_validation->run();
    }
    
    public function email_check($email)
    {
        $id = $this->uri->segment(3);
        
        if ($id)
        {
            if ($this->m_siswa->is_exist('email', $email, $id) == TRUE)
            {
                $this->form_validation->set_message('email_check', 'Email sudah digunakan !');
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            if ($this->m_siswa->is_exist('email', $email) == TRUE)
            {
                $this->form_validation->set_message('email_check', 'Email sudah digunakan !');
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
    }

    public function print_formulir($id)
    {
        $siswa_id = $this->uri->segment(3) == FALSE ? $id : $this->uri->segment(3);
        $this->load->library(array('fpdf'));
        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
        $data['query'] = $this->m_siswa->find($siswa_id);
        $this->load->view('report/formulir', $data);
    }

    public function hasil_seleksi()
    {
        if ($_POST)
        {
            $config    = $this->m_configuration->find();
            $no_daftar = $this->input->post('no_daftar');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $query     = $this->m_siswa->cetak_formulir($no_daftar, $tgl_lahir);
            
            if ($query != NULL)
            {
                if ($query['diterima'] == '0')
                {
                    $data['message']  = '<div class="alert alert-block alert-info">';
                    $data['message'] .= '<h4 class="alert-heading">Informasi !</h4>';
                    $data['message'] .= '<p>Proses Seleksi Belum selesai!</p>';
                    $data['message'] .= '</div>';
                }
                else if ($query['diterima'] != 't' && $query['diterima'] != '0')
                {
                    $prodi_id = $query['diterima'];
                    $prodi  = $this->db->query("SELECT * FROM prodi WHERE prodi_id = $prodi_id")->row_array();
                    $result = $prodi['prodi_nama'];
                    $data['message']  = '<div class="alert alert-block alert-success">';
                    $data['message'] .= '<h4 class="alert-heading">Selamat ! Anda LULUS </h4>';
                    $data['message'] .= '<p>'.$query['nama'].' Anda diterima di SMK Negeri 2 Muara Enim di Program Keahlian : '.$result.'</p>';
                    $data['message'] .= '<br><i>Silahkan melakukan Daftar Ulang pada tanggal dan waktu yang telah ditentukan di SMK Negeri 2 Muara Enim dengan membawa persyaratan yang telah ditentukan pada website resmi PPDB Online SMKN 2 Muara Enim di <a href="http://www.psb.smkn2muaraenim.sch.id"target="_blank"><b>www.psb.smkn2muaraenim.sch.id</b></a>. Terima Kasih.</i>';
                    $data['message'] .= '</div>';
                }
                else if ($query['diterima'] == 't')
                {
                    $data['message']  = '<div class="alert alert-block alert-warning">';
                    $data['message'] .= '<h4 class="alert-heading">TIDAK LULUS</h4>';
                    $data['message'] .= '<p>Mohon maaf '.$query['nama'].' , '.$config['pesan_gagal'].'</p>';
                    $data['message'] .= '</div>';
                }
                               
                $data['title']   = 'Hasil Seleksi PPDB Tahun ' . config('ppdb_tahun');
                $data['ppdb']    = 'active';
                $data['seleksi'] = 'class = "active"';
                $data['action']  = site_url('siswa/hasil_seleksi');
        	    $data['content'] = 'siswa/cetak_formulir';
                $data['button']  = 'Lihat Hasil Seleksi';
        		$this->load->view('theme/index', $data);
            }
            else
            {
                $this->message->config('on', 'info', 'Data tidak ditemukan!');
                redirect('siswa/hasil_seleksi');
            }
        }
        else
        {
            $data['message'] = '';
            $data['title']   = 'Hasil Seleksi PPDB Tahun ' . config('ppdb_tahun');
            $data['ppdb']    = 'active';
            $data['seleksi'] = 'class = "active"';
    	    $data['action']  = site_url('siswa/hasil_seleksi');
    	    $data['content'] = 'siswa/cetak_formulir';
            $data['button']  = 'Lihat Hasil Seleksi';
    		$this->load->view('theme/index', $data);
        }
    }
    
    public function cetak_formulir()
    {
        if ($_POST)
        {
            $no_daftar = $this->input->post('no_daftar');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $query     = $this->m_siswa->return_id($no_daftar, $tgl_lahir);
            if ($query != NULL)
            {
                $this->print_formulir($query['id']);
            }
            else
            {
                $this->message->config('on', 'info', 'Data tidak ditemukan!');
                redirect('siswa/cetak_formulir');
            }
        }
        else
        {
            $data['message'] = $this->message->show();
            $data['title']   = 'Cetak Formulir PPDB Tahun ' . config('ppdb_tahun');
            $data['ppdb']    = 'active';
            $data['cetak']   = 'class = "active"';
    	    $data['action']  = site_url('siswa/cetak_formulir');
    	    $data['content'] = 'siswa/cetak_formulir';
            $data['button']  = 'Cetak Formulir Pendaftaran';
    		$this->load->view('theme/index', $data);
            $this->message->close();
        }
    }

    public function multiple_action()
    {
        $this->auth->restrict();

        $url = $this->input->post('url');
        
        if (isset($_POST['id']))
        {
            if (isset($_POST['delete']))
            {
                $affected_row = $this->m_siswa->delete($_POST['id']);
                
                if ($affected_row > 0)
                {
                    $this->message->config('on', 'success', 'Data pendaftar sudah dihapus!');
                    redirect($url);
                }
                else
                {
                    $this->message->config('on', 'error', 'Data pendaftar tidak terhapus!');
                    redirect($url);
                }
            }
            elseif(isset($_POST['clear']))
            {
                $affected_row = $this->m_siswa->clear($_POST['id']);
                
                if ($affected_row > 0)
                {
                    $this->message->config('on', 'success', 'Data siswa sudah dihapus dari daftar!');
                    redirect($url);
                }
                else
                {
                    $this->message->config('on', 'error', 'Perubahan data gagal dilakukan!');
                    redirect($url);
                }
            }
        }
        else
        {
            $this->message->config('on', 'info', 'Tidak ada data yang terpilih !');
            redirect($url);
        }
    }
    
    public function seleksi()
    {
        $id       = $this->uri->segment(3);
        $prodi_id = $this->uri->segment(4);
        $this->m_siswa->seleksi($prodi_id, $id);
        $this->message->config('on', 'success', 'Proses seleksi berhasil dilakukan!');
        redirect('siswa/read/1');
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
		if (!empty($cap['time'])) {
			$query = $this->db->insert_string('captcha', $data);
			$this->db->query($query);
		}
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
    
    private function upload()
    {
        $config['upload_path']   = APPPATH . '../assets';
        $config['allowed_types'] = 'jpg';
        $config['max_size']      = '500';
        $config['encrypt_name']  = TRUE;
        $this->load->library('upload', $config);
        if($this->upload->do_upload('file') == TRUE)
        {
            $data   = $this->upload->data();
            $config = array(
                      'source_image'    => $data['full_path'],
        	 	      'new_image'       => APPPATH . '../assets/photo/',
        		      //'maintain_ration' => TRUE,
        		      'width'           => 113,
        		      'height'          => 170
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
        if (file_exists('./assets/photo/'.$file))
        {
            unlink('./assets/photo/'.$file);
        }
    }
}
