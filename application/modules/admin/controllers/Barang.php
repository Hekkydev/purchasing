<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $model_admin  = array('m_account','m_barang');
    $this->load->model($model_admin);
    $this->load->helper(array('url','waktu','app','barang'));
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

  function index($id = NULL)
  {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-cubes',
                    'judul'=>'Barang',
                    'sub_judul'=>'Data Barang',
                    'informasi'=>'Report data',
                    );

    // ---------end section---------------------------------------------------------

    $jml = $this->db->get('t_items');
    $config['base_url']   = base_url().base_akses().'barang/index/';
    $config['total_rows'] = $jml->num_rows();
    $config['per_page'] = '10';

        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active "><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

    //inisialisasi config
     $this->pagination->initialize($config);

    //buat pagination
     $data['paginator'] = $this->pagination->create_links();
     $data['barang'] = $this->m_barang->get_data($config['per_page'],$id);
    
     // load view-------------------------------------------------------------------

    $this->load->view('barang/list', $data);
  }


  function add()
  {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-cubes',
                    'judul'=>'Barang',
                    'sub_judul'=>'Entri Barang',
                    'informasi'=>'Entri Barang',
                    );

    // ---------end section---------------------------------------------------------


    $this->load->view('barang/entri', $data);
  }

  function add_proses()
  {
    if($this->input->post('entri') == "simpan"){
      $kode = $this->input->post('unique_kode', TRUE);
      $nama = $this->input->post('item_nama', TRUE);
      $desc = $this->input->post('item_desc', TRUE);
      $category = $this->input->post('id_item_category', TRUE);
      $atribut = $this->input->post('id_item_atribut', TRUE);
      $status = "1";

      $object = array(
        'id_item' =>NULL,
        'id_item_category'=>$category,
        'id_item_atribut'=>$atribut,
        'id_item_status'=>$status,
        'unique_kode'=>$kode,
        'item_nama'=>$nama,
        'item_desc'=>$desc,
      );
      if(isset($object)){
        $simpan = $this->db->insert('t_items',$object);
        if($simpan == TRUE){
          $this->session->set_flashdata('info',flash_barang("success"));
          redirect('admin/barang/','refresh');
        }else{
          redirect('admin/barang/add','refresh');
        }
      }else{
        redirect('admin/barang/add','refresh');
      }
    }

  }

  function b_open($i)
  {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-cubes',
                    'judul'=>'Barang',
                    'sub_judul'=>'Update Barang',
                    'informasi'=>'Update Barang',
                    );

    // ---------end section---------------------------------------------------------


    if($i == TRUE){
      $data['items'] = get_items($i);
      if($data['items'] == TRUE){
        $this->load->view('barang/update',$data);
      }else{
        redirect('admin/barang','refresh');
      }
    }

  }


  function update_proses()
  {

    if ($_POST['entri'] == "simpan") {
      $kode = $this->input->post('unique_kode', TRUE);
      $nama = $this->input->post('item_nama', TRUE);
      $desc = $this->input->post('item_desc', TRUE);
      $category = $this->input->post('id_item_category', TRUE);
      $atribut = $this->input->post('id_item_atribut', TRUE);
      $status = "1";

      $object = array(
        'id_item_category'=>$category,
        'id_item_atribut'=>$atribut,
        'id_item_status'=>$status,
        'unique_kode'=>$kode,
        'item_nama'=>$nama,
        'item_desc'=>$desc,
      );
      if(isset($object)){
                    $this->db->where('id_item',$_POST['id_item']);
          $update = $this->db->update('t_items',$object);
          if($update == TRUE){
              redirect('admin/barang/','refresh');
          }
      }else{
        redirect('admin/barang/b_open/'.$_POST['id_item'].'','refresh');
      }

    }

  }


function kategori($n = NULL)
{
  if ($n == "") {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-tag',
                    'judul'=>'Barang',
                    'sub_judul'=>'Data Kategori',
                    'informasi'=>'Report data',
                    );

    // ---------end section---------------------------------------------------------
    $this->load->view('barang/kategori/list', $data);
  }elseif($n == "add"){
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-tag',
                    'judul'=>'Kategori',
                    'sub_judul'=>'Entri Kategori',
                    'informasi'=>'Entri Kategori',
                    );

    // ---------end section---------------------------------------------------------
    $this->load->view('barang/kategori/entri', $data);
  }elseif ($n == "open") {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-tag',
                    'judul'=>'Kategori',
                    'sub_judul'=>'Update Kategori',
                    'informasi'=>'Update Kategori',
                    );

    // ---------end section---------------------------------------------------------
    $id = $this->uri->segment(5);
    $data['cat'] = get_items_category($id);
    $this->load->view('barang/kategori/update', $data);
  }

}

function add_kategori_proses()
{
  if($this->input->post('nama_category') == TRUE){
    $nama = $this->input->post('nama_category');
    $simpan = $this->db->insert('t_items_category', array('nama_category'=>$nama));
    if ($simpan == TRUE) {
      redirect('admin/barang/kategori','refresh');
    }else {
      redirect('admin/kategori/add','refresh');
    }
  }else{
    redirect('admin/kategori/add','refresh');
  }
}


function update_kategori_proses()
{
  if($this->input->post('id_item_category') == TRUE){
    $nama = $this->input->post('nama_category');
    $id = $this->input->post('id_item_category');
              $this->db->where('id_item_category', $id);
    $update = $this->db->update('t_items_category', array('nama_category'=>$nama));
    if ($update == TRUE) {
      redirect('admin/barang/kategori','refresh');
    }else {
      redirect('admin/barang/kategori/','refresh');
    }
  }else{
    redirect('admin/barang/kategori/','refresh');
  }
}

function atribut($n = NULL)
{
  if ($n == "") {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-tags',
                    'judul'=>'Barang',
                    'sub_judul'=>'Data Atribut',
                    'informasi'=>'Report data',
                    );

    // ---------end section---------------------------------------------------------
    $this->load->view('barang/atribut/list', $data);
  }elseif($n == "add"){
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-tags',
                    'judul'=>'Barang',
                    'sub_judul'=>'Entri Atribut',
                    'informasi'=>'Entri Atribut',
                    );

    // ---------end section---------------------------------------------------------
    $this->load->view('barang/atribut/entri', $data);
  }elseif ($n == "open") {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-tags',
                    'judul'=>'Barang',
                    'sub_judul'=>'Update Atribut',
                    'informasi'=>'Update Atribut',
                    );

    // ---------end section---------------------------------------------------------
    $id = $this->uri->segment(5);
    $data['atrib'] = get_items_atribut($id);
    $this->load->view('barang/atribut/update', $data);
  }
}


function add_atribut_proses()
{
  if($this->input->post('nama_atribut') == TRUE){
    $nama = $this->input->post('nama_atribut');
    $simpan = $this->db->insert('t_items_atribut', array('nama_atribut'=>$nama));
    if ($simpan == TRUE) {
      redirect('admin/barang/atribut','refresh');
    }else {
      redirect('admin/atribut/add','refresh');
    }
  }else{
    redirect('admin/atribut/add','refresh');
  }
}



function update_atribut_proses()
{
  if($this->input->post('id_item_atribut') == TRUE){
    $nama = $this->input->post('nama_atribut');
    $id = $this->input->post('id_item_atribut');
              $this->db->where('id_item_atribut', $id);
    $update = $this->db->update('t_items_atribut', array('nama_atribut'=>$nama));
    if ($update == TRUE) {
      redirect('admin/barang/atribut','refresh');
    }else {
      redirect('admin/barang/atribut/','refresh');
    }
  }else{
    redirect('admin/barang/atribut/','refresh');
  }
}


function delete_data()
{
  $database = $this->input->get('get');
  $id = $this->input->get('id');
  if($database == "1"){
    $where = array("id_item"=>$id);
    $proses = delete_helper("t_items",$where);
    redirect('admin/barang/','refresh');
  }elseif ($database == "2") {
    $where = array("id_item_category"=>$id);
    $proses = delete_helper("t_items_category",$where);
    redirect('admin/barang/kategori','refresh');
  }elseif ($database == "3") {
    $where = array("id_item_atribut"=>$id);
    $proses = delete_helper("t_items_atribut",$where);
    redirect('admin/barang/atribut','refresh');
  }

}

}
