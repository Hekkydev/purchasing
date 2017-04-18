<?php



if (! function_exists('unique_kode_rg'))
{
	function unique_kode_rg($param = '')
	{
		$th = date('Y');
    $CI =& get_instance();
    $CI->load->database();
           $q = $CI->db->query("select MAX(RIGHT(kode_rg,6)) as kd_max from t_rg");
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
           return "RG".$th.$kd;
	}
}


if (! function_exists('cek_supplier_rg'))
{
	function cek_supplier_rg($kode_rg)
	{
		$CI =& get_instance();
	  $CI->load->database();
		$CI->db->where('kode_rg',$kode_rg);
		$cek = $CI->db->get('t_rg_temp')->num_rows();
		if($cek == 0){
			return $CI->db->insert('t_rg_temp',array('kode_rg'=>$kode_rg));
		}else{
			return $CI->db->get('t_rg_temp')->first_row();
		}
	}
}


if (! function_exists('get_temp_rg'))
{
	function get_temp_rg()
	{
			$CI =& get_instance();
			$CI->load->database();
			$CI->db->select('*');
			$CI->db->from('t_rg_temp_detail');
			$CI->db->join('t_items', 't_items.id_item = t_rg_temp_detail.id_item', 'left');
			$CI->db->join('t_items_atribut','t_items_atribut.id_item_atribut = t_items.id_item_atribut','left');
			$CI->db->order_by('t_rg_temp_detail.id_rg_temp_detail', 'DESC');
			$row = $CI->db->get()->result();
			if ($row == TRUE) {
				return $row;
			}else{
				return $row ;
			}
	}
}



if (! function_exists('cek_temp_rg'))
{
  function cek_temp_rg($id)
  {
      $CI =& get_instance();
      $CI->load->database();
      $CI->db->select('kode_po');
      $CI->db->from('t_rg_temp_detail');
      $CI->db->where('kode_po', $id);

      $row = $CI->db->get();
      return $row->num_rows();
  }
}

if (! function_exists('cek_detail_rg'))
{
	function cek_detail_rg($kode_rg)
	{
	 	$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('DISTINCT(t_rg_detail.id_item),t_items.item_nama,t_rg_detail.kode_po,t_rg_detail.qty_rg');
		$CI->db->from('t_rg_detail');
		$CI->db->join('t_items', 't_items.id_item = t_rg_detail.id_item', 'left');
		$CI->db->where('t_rg_detail.kode_rg', $kode_rg);
		$CI->db->limit(3);
		$row = $CI->db->get();
		return $row->result();
	}
}

if (! function_exists('cek_jml_rg'))
{
	function cek_jml_rg($kode_rg)
	{
	 	$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('SUM(t_rg_detail.qty_rg) AS quantity');
		$CI->db->from('t_rg_detail');
		$CI->db->join('t_items', 't_items.id_item = t_rg_detail.id_item', 'left');
		$CI->db->where('kode_rg', $kode_rg);
		$row = $CI->db->get();
		return $row->result();
	}
}

if (! function_exists('material_rg'))
{
	function material_rg($kode)
	{

		$data = cek_detail_rg($kode);
		foreach ($data as $i) {
			echo "<i>".$i->item_nama.",</i>  ";
		}
	}
}

if (! function_exists('jml_rg'))
{
	function jml_rg($kode)
	{
			$CI =& get_instance();
			$jml = 0;
			$data = cek_jml_rg($kode);
			foreach ($data as $d) {
				$jml = $d->quantity;
			}
			return $jml;
	}
}


if (! function_exists('harga_rg_detail'))
{
	function harga_rg_detail($kode,$item)
	{

		$CI =& get_instance();
    $CI->load->database();
    $CI->db->select('*');
    $CI->db->from('t_po_detail');
    $CI->db->where('t_po_detail.kode_po',$kode);
		$CI->db->where('t_po_detail.id_item',$item);
    $row = $CI->db->get()->first_row();
    if($row == TRUE){
    return $row->harga;
    }
	}
}


if (! function_exists('jml_out'))
{
	function jml_out($kode)
	{
		return $kode;
	}
}


if (! function_exists('qty_po'))
{
	function qty_po($kode,$item)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('SUM(t_po_detail.qty_po) as qty_po');
		$CI->db->from('t_po_detail');
		$CI->db->where('t_po_detail.kode_po',$kode);
		$CI->db->where('t_po_detail.id_item',$item);
		$row = $CI->db->get()->first_row();
		if($row == TRUE){
		return $row->qty_po;
		}
	}
}

if (! function_exists('qty_rg'))
{
	function qty_rg($kode,$item)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('*');
		$CI->db->from('t_rg_detail');
		$CI->db->where('t_rg_detail.kode_po',$kode);
		$CI->db->where('t_rg_detail.id_item',$item);
		$CI->db->order_by('t_rg_detail.id_rg_detail','DESC');
		$row = $CI->db->get()->first_row();
		if($row == TRUE){
		return $row->qty_rg;
		}
	}
}


if (! function_exists('qty_rg_out_stand'))
{
	function qty_rg_out_stand($kode,$item)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('*');
		$CI->db->from('t_rg_detail');
		$CI->db->where('t_rg_detail.kode_po',$kode);
		$CI->db->where('t_rg_detail.id_item',$item);
		$CI->db->order_by('t_rg_detail.id_rg_detail','DESC');
		$row = $CI->db->get()->first_row();
		if($row == TRUE){
		return $row->out_standing;
		}
	}
}

if (! function_exists('qty_result_rg'))
{
	function qty_result_rg($id)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('SUM(t_rg_detail.qty_rg) AS total_rg');
    $CI->db->from('t_rg_detail');
    $CI->db->join('t_rg','t_rg.kode_rg = t_rg_detail.kode_rg','left');
    $CI->db->join('t_items', 't_items.id_item = t_rg_detail.id_item', 'left');
    $CI->db->join('t_items_atribut', 't_items_atribut.id_item_atribut = t_items.id_item_atribut', 'left');
    $CI->db->where('t_rg_detail.id_item', $id);
    $row = $CI->db->get()->first_row();
    return $row;
	}
}

if (! function_exists('get_po_data_outstand'))
{
	function get_po_data_outstand($kode)
	{
			$CI =& get_instance();
			$CI->load->database();
			$CI->db->select('SUM(out_standing) as out_standing');
			$CI->db->from('t_rg_detail');
			$CI->db->where('t_rg_detail.kode_rg', $kode);
			$CI->db->order_by('t_rg_detail.id_rg_detail', 'DESC');
			$row = $CI->db->get();
			return $row->first_row();
	}
}

if (! function_exists('cek_outstanding_rg'))
{
	function cek_outstanding_rg($rg)
	{
			$CI =& get_instance();
			$CI->load->database();
			$po = get_po_data_outstand($rg);
			print_r($po->out_standing);

	}
}


if (! function_exists('cek_rg_po'))
{
	function cek_rg_po($kode_rg)
	{

		 $CI =& get_instance();
		 $CI->load->database();
		 $CI->db->select('*');
		 $CI->db->from('t_rg_detail');
		 $CI->db->join('t_items', 't_items.id_item = t_rg_detail.id_item', 'left');
		 $CI->db->join('t_items_atribut','t_items_atribut.id_item_atribut = t_items.id_item_atribut','left');
		 $CI->db->where('kode_rg', $kode_rg);
		 $CI->db->order_by('kode_po',"DESC");
		 $row = $CI->db->get()->result();
		 return $row;

	}
}


if (! function_exists('cek_harga_material'))
{
	function cek_harga_material($id,$kode_po)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('*');
		$CI->db->from('t_po_detail');
		$CI->db->where('kode_po', $kode_po);
		$CI->db->where('id_item', $id);
		$row = $CI->db->get()->first_row();
		return $row->harga;
	}
}


if (! function_exists('tax_po'))
{
	function tax_po($kode_po)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->select('*');
		$CI->db->from('t_po');
		$CI->db->where('kode_po', $kode_po);
		$row = $CI->db->get()->first_row();
		return $row->tax;
	}
}
