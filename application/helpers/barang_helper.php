<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('unique_kode')) {
	function unique_kode()
	{
		$CI =& get_instance();
		$CI->load->database();

					$q = $CI->db->query("select MAX(RIGHT(unique_kode,6)) as kd_max from t_items");
			 $kd = "";
			 if($q->num_rows()>0)
			 {
					 foreach($q->result() as $k)
					 {
							 $tmp = ((int)$k->kd_max)+1;
							 $kd = sprintf("%06s", $tmp);
					 }
			 }
			 else
			 {
					 $kd = "001";
			 }
			 return "B".$kd;

	}
}


if (!function_exists('items')) {
			function items()
			{
				$CI =& get_instance();
				$CI->load->database();
				$CI->db->select('id_item,t_items.id_item_status,nama_category,nama_atribut,unique_kode,item_nama,item_desc');
				$CI->db->from('t_items');
				$CI->db->join('t_items_category','t_items_category.id_item_category = t_items.id_item_category','left');
				$CI->db->join('t_items_atribut','t_items_atribut.id_item_atribut = t_items.id_item_atribut','left');
				$CI->db->join('t_items_status','t_items_status.id_item_status = t_items.id_item_status','left');
				$CI->db->where('t_items.id_item_status','1');
				$CI->db->order_by('t_items.id_item','DESC');
				$row = $CI->db->get()->result();
				return $row;

			}
}



if (!function_exists('get_items')) {
			function get_items($id)
			{
				$CI =& get_instance();
				$CI->load->database();
				$CI->db->select('id_item,t_items.id_item_status,nama_category,nama_atribut,unique_kode,item_nama,item_desc');
				$CI->db->from('t_items');
				$CI->db->join('t_items_category','t_items_category.id_item_category = t_items.id_item_category','left');
				$CI->db->join('t_items_atribut','t_items_atribut.id_item_atribut = t_items.id_item_atribut','left');
				$CI->db->join('t_items_status','t_items_status.id_item_status = t_items.id_item_status','left');
				$CI->db->where('t_items.id_item_status','1');
				$CI->db->where('t_items.id_item',$id);
				$row = $CI->db->get()->row();
				return $row;
			}
}


if (!function_exists('items_category')) {
	function items_category()
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('id_item_category,nama_category');
		$CI->db->from('t_items_category');
		$query = $CI->db->get();
		$row = $query->result();
		return $row;
	}
}


if (!function_exists('get_items_category')) {
	function get_items_category($id)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('id_item_category,nama_category');
		$CI->db->from('t_items_category');
		$CI->db->where('id_item_category',$id);
		$query = $CI->db->get();
		$row = $query->row();
		if($row == TRUE){
			return $row;
		}else{
			$row = (object) array();
			return $row;
		}
	}
}

if (!function_exists('items_atribut')) {
	function items_atribut()
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('id_item_atribut,nama_atribut');
		$CI->db->from('t_items_atribut');
		$query = $CI->db->get();
		$row = $query->result();
		return $row;
	}
}



if (!function_exists('get_items_atribut')) {
	function get_items_atribut($id)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('id_item_atribut,nama_atribut');
		$CI->db->from('t_items_atribut');
		$CI->db->where('id_item_atribut',$id);
		$query = $CI->db->get();
		$row = $query->row();
		if($row == TRUE){
			return $row;
		}else{
			$row = (object) array();
			return $row;
		}
	}
}


if (!function_exists('flash_barang')) {
	function flash_barang($a)
	{
		$data = "";
		switch ($a) {
			case 'success':
					$data = '<div class="alert alert-info"> Berhasil menyimpan data barang</div>';
					break;
			case 'error':
					$data = '<div class="alert alert-danger"> Gagal menyimpan data barang</div>';
					break;

			default:
					$data = '<div class="alert alert-info"> Berhasil menyimpan data barang</div>';
				  break;
		}
	}
}


if (!function_exists('jumlah_item')) {
	function jumlah_item()
	{
		$jml = count(items());
		return $jml;
	}
}

if (!function_exists('jumlah_kategori')) {
	function jumlah_kategori()
	{
		$jml = count(items_category());
		return $jml;
	}
}


if (!function_exists('jumlah_atribut')) {
	function jumlah_atribut()
	{
		$jml = count(items_atribut());
		return $jml;
	}
}




if (!function_exists('delete_helper')) {
	function delete_helper($database,$where)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->where($where);
		$delete = $CI->db->delete($database);
		return $delete;
	}
}



if (!function_exists('get_items_graf')) {
			function get_items_graf()
			{
				$CI =& get_instance();
				$CI->load->database();
				$CI->db->select('COUNT(t_items.id_item) AS jml_item, t_items_category.nama_category');
				$CI->db->from('t_items');
				$CI->db->join('t_items_category','t_items_category.id_item_category = t_items.id_item_category','left');
				$CI->db->join('t_items_status','t_items_status.id_item_status = t_items.id_item_status','left');
				$CI->db->where('t_items.id_item_status','1');
				$CI->db->group_by('t_items_category.id_item_category');
				$row = $CI->db->get()->result();
				return $row;
			}
}
