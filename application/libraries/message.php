<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Message class
 * 
 * @author       : Anton Sofyan
 * @copyright    : (c) 2013
 * @version      : 1.0
 */
 
class Message {
   
   /**
	* Method config() 
	*
	* @access	public
    * @param    String
    * @param    String
    * @param    String
	* @return	void
	*/
    public function config($page, $type, $message)
    {        
        /* Create Instance Object */
	    $CI =& get_instance();
        
        $data = array(
                'page'    => $page,
                'type'    => $type,
                'message' => $message
                );
        $CI->session->set_userdata($data);
    }
    
   /**
	* Method show()
	*
	* @access	public
	* @return	string
	*/	
    public function show()
    {
        /* Create Instance Object */
	    $CI =& get_instance();
        
        if ($CI->session->userdata('page') == 'on')
        {
            $type    = $CI->session->userdata('type');
            $message = $CI->session->userdata('message');
            return $this->alert($type, $message);
        }
        return NULL;
    }
          
   /**
	* Method close() 
	*
	* @access	public
    * @param    String
	* @return	void
	*/
    public function close()
    {           
        /* Create Instance Object */
	    $CI =& get_instance();
        
        $CI->session->unset_userdata('page');
        $CI->session->unset_userdata('type');
        $CI->session->unset_userdata('message');
    }
   
   /**
	* Method alert() 
	*
	* @access	private
    * @param    string 
    * @param    string
	* @return	string
	*/ 
    private function alert($type, $message)
	{
	   switch($type)
       {
            case 'success' :
                 $str  = '<div class="alert alert-success">';
		         $str .= '<button class="close" data-dismiss="alert">x</button>';
                 $str .= '<strong>Sukses !</strong> ';
                 $str .= $message;
                 $str .= '</div>';
                 break;
           case  'error' :
                 $str  = '<div class="alert alert-error">';
		         $str .= '<button class="close" data-dismiss="alert">x</button>';
                 $str .= '<strong>Terjadi Kesalahan !</strong> ';
                 $str .= $message;
                 $str .= '</div>';
                 break;
           case  'info' :
                 $str  = '<div class="alert alert-info">';
		         $str .= '<button class="close" data-dismiss="alert">x</button>';
                 $str .= '<strong>Informasi !</strong> ';
                 $str .= $message;
                 $str .= '</div>';
                 break;
       }
	   return $str;
	}
}