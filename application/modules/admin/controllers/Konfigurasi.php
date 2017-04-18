<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $model_admin  = array('m_account');
    $this->load->model($model_admin);
    $this->load->helper(array('url','waktu','app'));
    $this->load->library(array('session','pagination'));
    // ---------start session management----------------------------------------------
    if($this->session->userdata('username') == TRUE){
      $this->id = $this->session->userdata('id');
      $this->user = cek_users($this->id);
      if ($this->user->id_group != 1) {
        $this->session->set_flashdata('login','Tidak diperkenankan mengakses');
        redirect('/','refresh');
      }
    }else{
      $this->session->set_flashdata('login','Silahkan login terlebih dahulu');
      redirect('/','refresh');
    }
    // ---------end session management----------------------------------------------
  }

  function index()
  {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-cog',
                    'judul'=>'Konfigurasi',
                    'sub_judul'=>'Konfigurasi',
                    'informasi'=>'',
                    );

    // ---------end section---------------------------------------------------------



    // template---------------------------------------------------------------------
    $this->load->view('konfigurasi/konfigurasi',$data);

  }

  function drop_pb()
  {
    $kosongkan_pb = $this->db->truncate('t_pb');
    $kosongkan_pb_detail = $this->db->truncate('t_pb_detail');

    if ($kosongkan_pb_detail == TRUE) {
      redirect(''.base_akses().'konfigurasi','refresh');
    }

  }

  function drop_po()
  {

      $kosongkan_po = $this->db->truncate('t_po');
      $kosongkan_po_detail = $this->db->truncate('t_po_detail');

      if ($kosongkan_po_detail == TRUE) {
        redirect(''.base_akses().'konfigurasi','refresh');
      }
  }

  function drop_rg()
  {

      $kosongkan_rg = $this->db->truncate('t_rg');
      $kosongkan_rg_detail = $this->db->truncate('t_rg_detail');

      if ($kosongkan_rg_detail == TRUE) {
        redirect(''.base_akses().'konfigurasi','refresh');
      }
  }


  function drop_barang()
  {

    $kosongkan_barang = $this->db->truncate('t_items');
    if ($kosongkan_barang == TRUE) {
      redirect(''.base_akses().'konfigurasi','refresh');
    }
  }

  function drop_barang_atribut()
  {

      $kosongkan_barang_atribut = $this->db->truncate('t_items_atribut');
      if ($kosongkan_barang_atribut == TRUE) {
        redirect(''.base_akses().'konfigurasi','refresh');
      }
  }

  function drop_barang_category()
  {

      $kosongkan_barang_category = $this->db->truncate('t_items_category');
      if ($kosongkan_barang_category == TRUE) {
        redirect(''.base_akses().'konfigurasi','refresh');
      }
  }


    function drop_supplier()
    {

        $kosongkan_supplier = $this->db->truncate('t_supplier');
        if ($kosongkan_supplier == TRUE) {
          redirect(''.base_akses().'konfigurasi','refresh');
        }
    }


}
