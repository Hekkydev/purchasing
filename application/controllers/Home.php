<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $model_admin  = array('m_account','rg_model');
    $this->load->model($model_admin);
    $this->load->helper(array('url','waktu','app','po','barang','rg'));
    $this->load->library(array('session','pagination'));
    // ---------start session management----------------------------------------------
    if($this->session->userdata('username') == TRUE){
      $this->id = $this->session->userdata('id');
      $this->user = cek_users($this->id);
      if ($this->user->id_group == 1) {
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
                    'judul_icon'=>'fa fa-dashboard',
                    'judul'=>'Dashboard',
                    'sub_judul'=>'Halaman Utama',
                    'informasi'=>'Hello, Selamat datang '.$this->user->nama_user,
                    );

    // ---------end section---------------------------------------------------------


    // template---------------------------------------------------------------------

    $data['graf'] = $this->graf_item();
    $data['kategori'] = $this->graf_category();

    $this->load->view('home/home',$data);

  }

  public function graf_item()
  {
    $data = get_items_graf();
    $graf = array();
    foreach($data as $n){
    	$jml = $n->jml_item;
    	array_push($graf, $jml);
    }
    return json_encode($graf,JSON_NUMERIC_CHECK);
  }

  public function graf_category()
  {
    $data = get_items_graf();
    $graf = array();
    foreach($data as $n){
      $jml = $n->nama_category;
      array_push($graf, $jml);
    }
    return json_encode($graf,JSON_NUMERIC_CHECK);
  }

}
