<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('nama_program'))
{
	function nama_program()
	{
		$app_name = "Purchase Application";
		return $app_name;
	}
}


if ( ! function_exists('cek_users'))
{
	function cek_users($id)
	{

		$ci=& get_instance();
    $ci->load->database();
		$ci->db->select('username,password,nama_profile,nama_user,nama_group,t_group.id_group,t_users.id_user');
		$ci->db->join('t_group','t_group.id_group = t_users.id_group','left');
		$ci->db->where('id_user', $id);
  	$row = $ci->db->get('t_users')->row();
		return $row;
	}
}


if ( ! function_exists('aktivitas_users'))
{
	function aktivitas_users($id,$info,$ket)
	{

		$ci=& get_instance();
    $ci->load->database();
		if ($info == "insert") {

					$object = array(
						'id_activity'=>NULL,
						'id_user'=>$id,
						'activity_time'=>date('Y-m-d H:i:s'),
						'info'=>$ket,
					);
					return $row = $ci->db->insert('t_users_activity', $object);

		}else if($info == "last_data") {

					$ci->db->select('activity_time');
					$ci->db->from('t_users_activity');
					$ci->db->where('id_user',$id);
					$ci->db->where('info',$ket);
					$ci->db->order_by('id_activity','DESC');
			  	$row = $ci->db->get()->first_row();
					if($row == TRUE){
						return $row;
					}else{
						$row = (object) array('activity_time'=>date('Y-m-d H:i:s'));
						return $row;
					}

		}


	}
}


if (!function_exists('hak_akses'))
{
    function hak_akses()
    {
        $CI =& get_instance();
        $CI->load->library('session');
				$id = $CI->session->userdata('id');
				$log = cek_users($id);

        return $log->id_group;
    }
}

if (! function_exists('group_akses'))
{
	function group_akses()
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('*');
		$CI->db->from('t_group');
		$row = $CI->db->get();
		return $row->result();
	}
}

if (!function_exists('base_akses'))
{
    function base_akses()
    {
        $CI =& get_instance();
        $CI->load->library('session');
				$id = $CI->session->userdata('id');
				$log = cek_users($id);
				if ($log->id_group == 1) {
					return "admin/";
				}else{
					return "/";
				}

    }
}




if (! function_exists('record_barang'))
{
	function record_barang()
	{
		$CI =& get_instance();
		$CI->load->database();
		$row = $CI->db->get('t_items')->result();
		return count($row);
	}
}


if (! function_exists('record_supplier'))
{
	function record_supplier()
	{
		$CI =& get_instance();
		$CI->load->database();
		$row = $CI->db->get('t_supplier')->result();
		return count($row);
	}
}


if (! function_exists('record_pb'))
{
	function record_pb()
	{
		$CI =& get_instance();
		$CI->load->database();
		$row = $CI->db->get('t_pb')->result();
		return count($row);
	}
}


if (! function_exists('record_po'))
{
	function record_po()
	{
		$CI =& get_instance();
		$CI->load->database();
		$row = $CI->db->get('t_po')->result();
		return count($row);
	}
}

if (! function_exists('record_rg'))
{
	function record_rg()
	{
		$CI =& get_instance();
		$CI->load->database();
		$row = $CI->db->get('t_rg')->result();
		return count($row);
	}
}


if (! function_exists('activity_time'))
{
	function activity_time($id)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->where('id_user',$id);
		$CI->db->order_by('id_activity','DESC');
		$row = $CI->db->get('t_users_activity')->result();
		return $row;
	}
}
