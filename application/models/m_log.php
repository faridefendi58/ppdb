<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_log extends CI_Model {
	
	public function find_all()
    {
        $level   = $this->session->userdata('user_level');
        $user_id = $this->session->userdata('user_id');

        if ($level == 1)
        {
            return $this->db->query("SELECT users.user_display, log.last_login, log.last_login_ip
                                     FROM log
                                     JOIN users ON users.user_id = log.user_id
                                     ORDER BY log.last_login DESC
                                     LIMIT 7");
        }
        else
        {
            return $this->db->query("SELECT users.user_display, log.last_login, log.last_login_ip
                                     FROM log
                                     JOIN users ON users.user_id = log.user_id
                                     WHERE log.user_id = $user_id
                                     ORDER BY log.last_login DESC
                                     LIMIT 7");
        }
    }
    
    public function truncate()
    {
        $this->db->query("TRUNCATE log");
    }
}