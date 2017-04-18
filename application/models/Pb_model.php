<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pb_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();

  }

  function get_pb($num,$offset)
  {
    $this->db->select('*');
    $this->db->from('t_pb');
    $this->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_pb.id_status_transaksi', 'left');
    $this->db->order_by('id_pb', 'desc');
    $this->db->limit($num, $offset);
    return $this->db->get()->result();
  }


 function get_all_pb()
  {
    $this->db->select('*');
    $this->db->from('t_pb');
    $this->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_pb.id_status_transaksi', 'left');
    $this->db->order_by('id_pb', 'desc');
    return $this->db->get()->result();
  }

    function get_pb_aktif()
  {
    $this->db->select('*');
    $this->db->from('t_pb');
    $this->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_pb.id_status_transaksi', 'left');
    $this->db->where('t_pb.id_status_transaksi < 3');
    return $this->db->get()->result();
  }

  function get_pb_detail($id)
  {
    $this->db->select('*');
    $this->db->from('t_pb');
    $this->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_pb.id_status_transaksi', 'left');
    $this->db->where('id_pb', $id);
    return $this->db->get()->first_row();
  }

  public function get_perhari_pb($tgl)
  {

      $this->db->select('*');
      $this->db->from('t_pb');
      $this->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_pb.id_status_transaksi', 'left');
      $this->db->order_by('id_pb', 'desc');
      $this->db->where('DATE(tgl_plan) = "'.$tgl.'"');
      return $this->db->get()->result();
  }



    public function get_perbulan_pb($bulan,$tahun)
    {

        $this->db->select('*');
        $this->db->from('t_pb');
        $this->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_pb.id_status_transaksi', 'left');
        $this->db->order_by('id_pb', 'desc');
        $this->db->where('MONTH(tgl_plan) = "'.$bulan.'"');
        $this->db->where('YEAR(tgl_plan) = "'.$tahun.'"');
        return $this->db->get()->result();
    }

    public function get_pertahun_pb($tahun)
    {

        $this->db->select('*');
        $this->db->from('t_pb');
        $this->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_pb.id_status_transaksi', 'left');
        $this->db->order_by('id_pb', 'desc');
        $this->db->where('YEAR(tgl_plan) = "'.$tahun.'"');
        return $this->db->get()->result();
    }


}
