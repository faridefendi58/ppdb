<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('m_post', 'm_post_category', 'm_link_category', 'm_link'));
        $this->load->helper(array('text'));
    }

	public function index()
	{
        $data['home']          = 'class = "active"';
        $data['archives']      = $this->m_post->archive_month();
        $data['category']      = $this->m_post_category->find_where();
        $data['link_category'] = $this->m_link_category->find_all();
        $data['query']         = $this->m_post->post_default();
        $data['content']       = 'post/single';
		$this->load->view('theme/index', $data);
	}

    public function category()
	{
	    $this->load->library(array('pagination'));

	    $cat_id = $this->uri->segment(3);
	    $config = array(
                  'base_url'    => site_url().'/post/category/'.$cat_id.'/',
                  'total_rows'  => $this->db
                                        ->where('post_status', 'y')
                                        ->where('post_default', 'N')
                                        ->where('post_cat_id', $cat_id)
                                        ->count_all_results('post'),
                  'per_page'    => 5,
                  'uri_segment' => 4,
                  'prev_link'   => 'prev',
                  'next_link'   => 'next',
                  'first_link'  => 'first',
                  'last_link'   => 'last'
                  );
        $this->pagination->initialize($config); 
        $data['pagination']    = $this->pagination->create_links();
        $data['num_rows']      = $config['total_rows'];
        $data['home']          = 'class = "active"';

        $title                 = $this->m_post_category->find($cat_id);
        $data['title']         = 'Kategori '.$title['cat_name'];
        $data['archives']      = $this->m_post->archive_month();
        $data['category']      = $this->m_post_category->find_where();
        $data['link_category'] = $this->m_link_category->find_all();
        $data['query']         = $this->m_post->category($config['per_page'], $this->uri->segment(4), $cat_id);
        $data['content']       = 'post/loop';
		$this->load->view('theme/index', $data);
	}
    
    public function archives()
	{
	    $this->load->library(array('pagination'));
       
	    $month  = $this->uri->segment(3);
	    $config = array(
                  'base_url'    => site_url().'/post/archives/'.$month.'/',
                  'total_rows'  => $this->m_post->count_archive($month),
                  'per_page'    => 5,
                  'uri_segment' => 4,
                  'prev_link'   => 'prev',
                  'next_link'   => 'next',
                  'first_link'  => 'first',
                  'last_link'   => 'last'
                  );
        $this->pagination->initialize($config); 
        $data['pagination']    = $this->pagination->create_links();
        $data['num_rows']      = $config['total_rows'];
        $data['home']          = 'class = "active"';
        $data['title']         = 'Arsip Bulan '.bulan($month).' '.date('Y');
        $data['archives']      = $this->m_post->archive_month();
        $data['category']      = $this->m_post_category->find_where();
        $data['link_category'] = $this->m_link_category->find_all();
        $data['query']         = $this->m_post->archives($config['per_page'], $this->uri->segment(4), $month);
        $data['content']       = 'post/loop';
		$this->load->view('theme/index', $data);
	}

    public function create()
    {
        $this->auth->restrict();
        
        if ($_POST)
        {
            if ($this->_validation())
            {
                $this->m_post->field_data();
                $this->m_post->save();
                $this->message->config('on', 'success', 'Data sudah tersimpan!');
                redirect('post/read');
            }
            else
            {
                $this->message->config('on', 'error', validation_errors());
                redirect('post/create');
            }
        }
        else
        {
            $data['message']  = $this->message->show();
            $data['posts']    = 'class = "active"';
    	    $data['action']   = site_url('post/create');
            $data['category'] = $this->m_post_category->get_dropdown();
            $data['query']    = FALSE;
    	    $data['content']  = 'post/create';
    		$this->load->view('theme/index', $data);
            $this->message->close();
        }
    }
    
    public function read()
    {
        $this->auth->restrict();
        
        $data['message'] = $this->message->show();
        $data['posts']   = 'class = "active"';
        $data['action']  = site_url('post/multiple_checked');
        $data['query']   = $this->m_post->find_all();
        $data['content'] = 'post/read';
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
                    $this->m_post->field_data(2);
                    $this->m_post->update($this->uri->segment(3));

                    if ($this->input->post('post_default') == 'Y')
                    {
                        $this->m_post->set_post_default($this->uri->segment(3));
                    }

                    $this->message->config('on', 'success', 'Data sudah diperbaharui!');
                    redirect('post/update/'.$this->uri->segment(3));
                }
                else
                {
                    $this->message->config('on', 'error', validation_errors());
                    redirect('post/update/'.$this->uri->segment(3));
                }
            }
            else
            {
                $data['message']  = $this->message->show();
                $data['posts']    = 'class = "active"';
        	    $data['action']   = site_url('post/update/'.$this->uri->segment(3));
                $data['category'] = $this->m_post_category->get_dropdown();
                $data['query']    = $this->m_post->find($this->uri->segment(3));
        	    $data['content']  = 'post/create';
        		$this->load->view('theme/index', $data);
                $this->message->close();
            }            
        }
        else
        {
            $this->message->config('on', 'info', 'Anda tidak diperkenankan memanipulasi URL');
            redirect('post/read');
        }
    }
    
    public function delete()
    {
        $this->auth->restrict();
        
        if ($this->uri->segment(3))
        {
             $this->m_post->delete($this->uri->segment(3));
             $this->message->config('on', 'success', 'Data sudah dihapus!');
             redirect('post/read');
        }
        else
        {
            $this->message->config('on', 'info', 'Anda tidak diperkenankan memanipulasi URL');
            redirect('post/read');
        }
    }
    
    public function multiple_checked()
    {
        $this->auth->restrict();
        
        if (isset($_POST['post_id']))
        {
            $query = $this->m_post->delete($_POST['post_id']);

            if ($query > 0)
            {
                $this->message->config('on', 'success', 'Data sudah dihapus!');
            }
            else
            {
                $this->message->config('on', 'info', 'Tidak ada data yang terhapus !');
                
            }
            redirect('post/read');
        }
        else
        {
            $this->message->config('on', 'info', 'Anda belum memiih data untuk dihapus!');
            redirect('post/read');
        }
    }
        
    private function _validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('post_title',   'Title',   'trim|required|xss_clean');
        $this->form_validation->set_rules('post_content', 'Content', 'trim|required');
        
        $this->form_validation->set_error_delimiters('<div><i class="icon-circle-arrow-right"></i> ', '</div>');
        
        return $this->form_validation->run();
    }    
}

/* End of file post.php */
/* Location: ./application/controllers/post.php */