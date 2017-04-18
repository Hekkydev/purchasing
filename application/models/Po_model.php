<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Po_model extends CI_Model{


    function get_po($num,$offset)
    {

      $this->db->select('*');
      $this->db->from('t_po');
      $this->db->join('t_supplier', 't_supplier.id_supplier = t_po.id_supplier', 'left');
      $this->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_po.id_status_transaksi', 'left');
      $this->db->order_by('t_po.id_po','DESC');
      $this->db->limit($num, $offset);
      $row = $this->db->get();
      return $row->result();
    }

    function get_all_po()
    {

      $this->db->select('*');
      $this->db->from('t_po');
      $this->db->join('t_supplier', 't_supplier.id_supplier = t_po.id_supplier', 'left');
      $this->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_po.id_status_transaksi', 'left');
      $this->db->order_by('t_po.id_po','DESC');
      $row = $this->db->get();
      return $row->result();
    }


    function status_po_rg($kode_po)
    {

      $this->db->select('SUM(qty_rg) AS total_rg');
      $this->db->from('t_rg_detail');
      $this->db->where('kode_po', $kode_po);
      $row = $this->db->get();
      return $row->first_row();
    }


    function status_po_po($kode_po)
    {

      $this->db->select('SUM(qty_po) AS total_po');
      $this->db->from('t_po_detail');
      $this->db->where('kode_po', $kode_po);
      $row = $this->db->get();
      return $row->first_row();
    }

    function get_po_detail($id)
    {

      $this->db->select('*');
      $this->db->from('t_po');
      $this->db->join('t_supplier', 't_supplier.id_supplier = t_po.id_supplier', 'left');
      $this->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_po.id_status_transaksi', 'left');
      $this->db->where('id_po', $id);
      $row = $this->db->get();
      return $row->first_row();
    }

    function get_perhari_po($tanggal)
    {

      $this->db->select('*');
      $this->db->from('t_po');
      $this->db->join('t_supplier', 't_supplier.id_supplier = t_po.id_supplier', 'left');
      $this->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_po.id_status_transaksi', 'left');
      $this->db->order_by('t_po.id_po','DESC');
      $this->db->where('DATE(tgl_plan) = "'.$tanggal.'"');
      $row = $this->db->get();
      return $row->result();
    }


    function get_perbulan_po($bulan,$tahun)
    {

      $this->db->select('*');
      $this->db->from('t_po');
      $this->db->join('t_supplier', 't_supplier.id_supplier = t_po.id_supplier', 'left');
      $this->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_po.id_status_transaksi', 'left');
      $this->db->order_by('t_po.id_po','DESC');
      $this->db->where('MONTH(tgl_plan) = "'.$bulan.'"');
      $this->db->where('YEAR(tgl_plan) = "'.$tahun.'"');
      $row = $this->db->get();
      return $row->result();
    }


    function get_pertahun_po($tahun)
    {

      $this->db->select('*');
      $this->db->from('t_po');
      $this->db->join('t_supplier', 't_supplier.id_supplier = t_po.id_supplier', 'left');
      $this->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_po.id_status_transaksi', 'left');
      $this->db->order_by('t_po.id_po','DESC');
      $this->db->where('YEAR(tgl_plan) = "'.$tahun.'"');
      $row = $this->db->get();
      return $row->result();
    }

}
