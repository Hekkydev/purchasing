<?php
if (!function_exists('unique_kode_supplier')) {
  function unique_kode_supplier()
  {
    $CI =& get_instance();
    $CI->load->database();
           $q = $CI->db->query("select MAX(RIGHT(kode_supplier,6)) as kd_max from t_supplier");
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
           return "SP".$kd;
  }
}


if (!function_exists('supplier')) {
  function supplier()
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->order_by('id_supplier','DESC');
    $row = $CI->db->get('t_supplier');
    return   $row->result();
  }
}

if (!function_exists('get_supplier')) {
  function get_supplier($id)
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->where('id_supplier',$id);
    $CI->db->order_by('id_supplier','DESC');
    $row = $CI->db->get('t_supplier');
    return   $row->row();
  }
}


if (!function_exists('supplier_aktif')) {
  function supplier_aktif()
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->where('id_supplier_status',1);
    $CI->db->order_by('id_supplier','DESC');
    $row = $CI->db->get('t_supplier');
    return   $row->result();
  }
}



if (!function_exists('supplier_pasif')) {
  function supplier_pasif()
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->where('id_supplier_status',0);
    $CI->db->order_by('id_supplier','DESC');
    $row = $CI->db->get('t_supplier');
    return   $row->result();
  }
}
