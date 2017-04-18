<?php
if (!function_exists('unique_kode_po')){
  function unique_kode_po()
  {
    $th = date('Y');
    $CI =& get_instance();
    $CI->load->database();
           $q = $CI->db->query("select MAX(RIGHT(kode_po,6)) as kd_max from t_po");
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
           return "PO".$th.$kd;
  }
}


if (! function_exists('simpan_temp'))
{
  function simpan_temp($data)
  {
    $CI =& get_instance();
    $row = $CI->db->insert('t_po_temp', $data);
    return $row;
  }
}

if (! function_exists('get_temp_po')) {
  function get_temp_po()
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('t_pb.kode_pb,t_po_temp.id_po_temp,t_po_temp.id_pb,t_po_temp.aktif,t_po_temp.id_item,t_po_temp.harga,t_po_temp.qty_po AS qty_po,t_items.item_nama,t_items.unique_kode,t_items_atribut.nama_atribut');
    $CI->db->from('t_po_temp');
    $CI->db->join('t_pb','t_pb.id_pb = t_po_temp.id_pb','left');
    $CI->db->join('t_items', 't_items.id_item = t_po_temp.id_item', 'left');
    $CI->db->join('t_items_atribut', 't_items_atribut.id_item_atribut = t_items.id_item_atribut', 'left');
    $CI->db->where('t_po_temp.aktif','1');
    $CI->db->order_by('t_po_temp.id_po_temp','DESC');
    $row = $CI->db->get();
    return $row->result();
  }
}


if (! function_exists('get_temp_po_all')) {
  function get_temp_po_all()
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('t_pb.kode_pb,t_po_temp.id_po_temp,t_po_temp.id_pb,t_po_temp.aktif,t_po_temp.id_item,t_po_temp.harga,t_po_temp.qty_po AS qty_po,t_items.item_nama,t_items.unique_kode,t_items_atribut.nama_atribut');
    $CI->db->from('t_po_temp');
    $CI->db->join('t_pb','t_pb.id_pb = t_po_temp.id_pb','left');
    $CI->db->join('t_items', 't_items.id_item = t_po_temp.id_item', 'left');
    $CI->db->join('t_items_atribut', 't_items_atribut.id_item_atribut = t_items.id_item_atribut', 'left');
    $CI->db->order_by('t_po_temp.id_po_temp','DESC');
    $row = $CI->db->get();
    return $row->result();
  }
}

if (! function_exists('cek_temp_po'))
{
  function cek_temp_po($id)
  {
      $CI =& get_instance();
      $CI->load->database();
      $CI->db->select('*');
      $CI->db->from('t_po_temp');
      $CI->db->where('id_pb', $id);
      $row = $CI->db->get();
      return $row;
  }
}

if (! function_exists('max_pb'))
{
  function max_pb($kode,$id)
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('*');
    $CI->db->from('t_pb_detail');
    $CI->db->where('kode_pb', $kode);
    $CI->db->where('id_item', $id);

    $row = $CI->db->get()->first_row();
    return $row->qty;
  }
}

if (! function_exists('cek_per_id'))
{
  function cek_per_id($kode,$id,$data)
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->where('id_pb', $kode);
    $CI->db->where('id_po_temp', $id);
    $row = $CI->db->update('t_po_temp',$data);
    return $row;
  }
}

if (! function_exists('tax'))
{
  function tax()
  {
      $CI =& get_instance();
      $CI->load->database();
      $row = $CI->db->get_where('t_po_tax')->first_row();


      if($row == TRUE){
        return $row;
      }else{
        $row = (object) array('tax'=> 0);
        return $row;
      }
  }
}

if (! function_exists('rupiah'))
{
  function rupiah($angka)
  {
    $angka = $angka;
    $jumlah_desimal ="2";
    $pemisah_desimal =",";
    $pemisah_ribuan =".";

    return "Rp ".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);

  }
}

if (! function_exists('get_po_detail'))
{
  function get_po_detail($id)
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('*');
    $CI->db->from('t_po');
    $CI->db->join('t_supplier','t_supplier.id_supplier = t_po.id_po','left');
    $CI->db->where('t_po.id_po',$id);
    $row = $CI->db->get()->first_row();
    if($row == TRUE){
      return $row;
    }else{
      return $row = (object) array();
    }

  }
}


if (! function_exists('get_po_detail_item'))
{
  function get_po_detail_item($kode_po)
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('*');
    $CI->db->from('t_po_detail');
    $CI->db->join('t_items','t_items.id_item = t_po_detail.id_item','left');
    $CI->db->join('t_pb','t_pb.id_pb = t_po_detail.id_pb','left');
    $CI->db->join('t_items_atribut','t_items_atribut.id_item_atribut = t_items.id_item_atribut','left');
    $CI->db->where('t_po_detail.kode_po',$kode_po);
    $CI->db->where('t_po_detail.aktif','1');
    $row = $CI->db->get()->result();
    if ($row == TRUE) {
      return $row;
    }else {
      return $row = (object) array();
    }
  }
}


if (! function_exists('qty_po_total'))
{
  function qty_po_total($kode_po)
  {
    $data = get_po_detail_item($kode_po);
    $total = 0;
    foreach ($data as $d) {
      $total += $d->qty_po;
    }
    return $total;
  }
}

if (! function_exists('pb_distinct_qty'))
{
  function pb_distinct_qty()
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('DISTINCT(t_po_temp.id_pb), t_pb.kode_pb');
    $CI->db->join('t_pb','t_pb.id_pb = t_po_temp.id_pb','left');
    $CI->db->from('t_po_temp');
    $row = $CI->db->get();
    return $row->result();
  }
}



if (!function_exists('po_status_open')) {
  function po_status_open()
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('*');
    $CI->db->from('t_po');
    $CI->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_po.id_status_transaksi', 'left');
    $CI->db->where('t_status_transaksi.id_status_transaksi',1);
    $row = $CI->db->get();
    return $row->result();
  }
}

if (!function_exists('po_status_onproses')) {
  function po_status_onproses()
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('*');
    $CI->db->from('t_po');
    $CI->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_po.id_status_transaksi', 'left');
    $CI->db->where('t_status_transaksi.id_status_transaksi',2);
    $row = $CI->db->get();
    return $row->result();
  }
}

if (!function_exists('po_status_full')) {
  function po_status_full()
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('*');
    $CI->db->from('t_po');
    $CI->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_po.id_status_transaksi', 'left');
    $CI->db->where('t_status_transaksi.id_status_transaksi',3);
    $row = $CI->db->get();
    return $row->result();
  }
}


if (! function_exists('data_po_pb'))
{
  function data_po_pb($kode_po)
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('*');
    $CI->db->from('t_po_detail');
    $CI->db->join('t_pb','t_pb.id_pb = t_po_detail.id_pb','left');
    $CI->db->join('t_items','t_items.id_item = t_po_detail.id_item','left');
    $CI->db->join('t_items_atribut','t_items_atribut.id_item_atribut = t_items.id_item_atribut','left');
    $CI->db->where('t_po_detail.kode_po',$kode_po);
    $row = $CI->db->get();
    return $row->result();
  }
}
