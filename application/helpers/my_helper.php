<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('to_rupiah'))
{
	function to_rupiah($value)
	{
		if($value < 0)
		{
			return '( Rp '.number_format(abs($value), 0, '', '.').' )';
		}
		else
		{
			return 'Rp '.number_format($value, 0, '', '.').'  ';
		}
	}
}

if ( ! function_exists('indo_date'))
{
    function indo_date($date)
    {           
        $pecah     = explode("-", $date);       
        $year      = $pecah[0];
        $monthh     = $pecah[1];
        $day       = $pecah[2];
        
        $bulan     = ''; 
        switch($monthh)
        {
            case '01':
                 $bulan = 'Januari';
                 break;
            case '02':
                 $bulan = 'Februari';
                 break;
            case '03':
                 $bulan = 'Maret';
                 break;
            case '04':
                 $bulan = 'April';
                 break;
            case '05':
                 $bulan = 'Mei';
                 break;
            case '06':
                 $bulan = 'Juni';
                 break;
            case '07':
                 $bulan = 'Juli';
                 break;
            case '08':
                 $bulan = 'Agustus';
                 break;
            case '09':
                 $bulan = 'September';
                 break;
            case '10':
                 $bulan = 'Oktober';
                 break;
            case '11':
                 $bulan = 'Nopember';
                 break;
            case '12':
                 $bulan = 'Desember';
                 break;
         }    
         
         $result = $day.' '.$bulan.' '.$year;
         return $result;
    }
}

if ( ! function_exists('agama'))
{
    function agama($id)
    {
        $agama = '';
        switch($id)
        {
            case 1 : $agama = 'Islam';
                     break; 
            case 2 : $agama = 'Kristen';
                     break;
            case 3 : $agama = 'Katolik';
                     break;
            case 4 : $agama = 'Hindu';
                     break;
            case 5 : $agama = 'Budha';
                     break;
        }
        return $agama;
    }
}

if ( ! function_exists('jalur'))
{
    function jalur($jalur_id)
    {
        $jalur = '';
        switch($jalur_id)
        {
            case 1 : $jalur = 'Umum';
                     break; 
            case 2 : $jalur = 'Prestasi';
                     break;
        }
        return $jalur;
    }
}

if ( ! function_exists('status'))
{
    function status($status)
    {
        $diterima = '';
        if ($status == 't')
        {
            $diterima = 'Tidak Diterima';
        }
        else if ($status == '0')
        {
            $diterima = 'Belum Diseleksi';
        }
        else
        {
            $CI =& get_instance();
            $CI->load->model('m_prodi');
            $query    = $CI->m_prodi->find($status);
            $diterima = $query['prodi_nama']; 
        }

        return $diterima;
    }
}

if ( ! function_exists('bulan'))
{
    function bulan($bulan)
    {
        $month = '';
        switch($bulan)
        {
            case '01' : $month = 'Januari';
                        break;
            case '02' : $month = 'Februari';
                        break;
            case '03' : $month = 'Maret';
                        break;
            case '04' : $month = 'April';
                        break;
            case '05' : $month = 'Mei';
                        break;
            case '06' : $month = 'Juni';
                        break;
            case '07' : $month = 'Juli';
                        break;
            case '08' : $month = 'Agustus';
                        break;
            case '09' : $month = 'September';
                        break;
            case '10' : $month = 'Oktober';
                        break;
            case '11' : $month = 'Nopember';
                        break;
            case '12' : $month = 'Desember';
                        break;
        }
        return $month;
    }
}

if ( ! function_exists('config'))
{
    function config($field)
    {
        $CI =& get_instance();
        $CI->db->where('id', 1);
        $query  = $CI->db->get('configuration');
        $result = $query->row_array(); 
        return $result[$field];
    }
}

if ( ! function_exists('copyright'))
{
    function copyright()
    {
        $CI =& get_instance();
        $CI->load->helper('url');

        define('CREATED', 2016);
        $copyright  = date('Y') > CREATED ? "Copyright &copy; " . CREATED . ' - ' . date('Y') : "Copyright &copy; " . CREATED;
        $copyright .= ' '.anchor(base_url(), config('nama_sekolah'));
        return $copyright;
    }
}

if ( ! function_exists('extract_date'))
{
    function extract_date($value)
    {
        $year = explode('-', $value);
        return $year[2].'-'.$year[1].'-'.$year[0];
    }
}