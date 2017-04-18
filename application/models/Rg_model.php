<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rg_model extends CI_Model{

  function get_rg($num,$offset)
  {
    $this->db->select('*');
    $this->db->from('t_rg');
    $this->db->join('t_supplier', 't_supplier.id_supplier = t_rg.id_supplier', 'left');
    $this->db->order_by('id_rg', 'DESC');
    $this->db->limit($num, $offset);
    $row = $this->db->get()->result();
    return $row;
  }


  function get_rg_detail($id)
  {
    $this->db->select('*');
    $this->db->from('t_rg');
    $this->db->join('t_supplier', 't_supplier.id_supplier = t_rg.id_supplier', 'left');
    $this->db->where('id_rg', $id);
    $row = $this->db->get()->first_row();
    return $row;
  }

  function get_rg_detail_item($id)
  {
    $this->db->select('t_rg_detail.qty_rg,t_rg_detail.out_standing,t_rg_detail.kode_po,t_items.item_nama,t_items.id_item,t_items.unique_kode,t_items_atribut.nama_atribut');
    $this->db->from('t_rg_detail');
    $this->db->join('t_rg','t_rg.kode_rg = t_rg_detail.kode_rg','left');
    $this->db->join('t_items', 't_items.id_item = t_rg_detail.id_item', 'left');
    $this->db->join('t_items_atribut', 't_items_atribut.id_item_atribut = t_items.id_item_atribut', 'left');
    $this->db->where('t_rg.id_rg', $id);
    $row = $this->db->get()->result();
    return $row;
  }

  function supplier_po()
  {
    $this->db->select('distinct(t_po.id_supplier),t_supplier.id_supplier, t_supplier.nama_supplier');
    $this->db->from('t_po');
    $this->db->join('t_supplier', 't_supplier.id_supplier = t_po.id_supplier', 'left');
    $row = $this->db->get()->result();
    return $row;
  }

  function data_po_supplier($id)
  {
    $this->db->select('*');
    $this->db->from('t_po');
    $this->db->join('t_supplier', 't_supplier.id_supplier = t_po.id_supplier', 'left');
    $this->db->where('t_po.id_supplier', $id);
    $row = $this->db->get()->result();
    return $row;
  }


  function get_po_data($kode)
  {
    $this->db->select('*');
    $this->db->from('t_po_detail');
    $this->db->join('t_po', 't_po.kode_po = t_po_detail.kode_po', 'left');
    $this->db->where('t_po_detail.kode_po', $kode);
    $this->db->order_by('t_po_detail.id_po_detail', 'DESC');
    $row = $this->db->get()->result();
    return $row;
  }



   function get_rg_report()
  {
    $this->db->select('*');
    $this->db->from('t_rg');
    $this->db->join('t_supplier', 't_supplier.id_supplier = t_rg.id_supplier', 'left');
    $this->db->order_by('id_rg', 'DESC');
    $row = $this->db->get()->result();
    return $row;
  }

  function get_rg_report_perhari($tanggal)
 {
   $this->db->select('*');
   $this->db->from('t_rg');
   $this->db->join('t_supplier', 't_supplier.id_supplier = t_rg.id_supplier', 'left');
   $this->db->order_by('id_rg', 'DESC');
   $this->db->where('DATE(tgl_plan) = "'.$tanggal.'"');
   $row = $this->db->get()->result();
   return $row;
 }

 function get_rg_report_perbulan($bulan,$tahun)
{
  $this->db->select('*');
  $this->db->from('t_rg');
  $this->db->join('t_supplier', 't_supplier.id_supplier = t_rg.id_supplier', 'left');
  $this->db->order_by('id_rg', 'DESC');
  $this->db->where('MONTH(tgl_plan) = "'.$bulan.'"');
  $this->db->where('YEAR(tgl_plan) = "'.$tahun.'"');
  $row = $this->db->get()->result();
  return $row;
}

 function get_rg_report_pertahun($tahun)
{
  $this->db->select('*');
  $this->db->from('t_rg');
  $this->db->join('t_supplier', 't_supplier.id_supplier = t_rg.id_supplier', 'left');
  $this->db->order_by('id_rg', 'DESC');
  $this->db->where('YEAR(tgl_plan) = "'.$tahun.'"');
  $row = $this->db->get()->result();
  return $row;
}

}
