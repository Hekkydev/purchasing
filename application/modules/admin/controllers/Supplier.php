<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $model_admin  = array('m_account','m_supplier');
    $this->load->model($model_admin);
    $this->load->helper(array('url','waktu','app','supplier'));
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
                    'judul_icon'=>'ion ion-ios-people',
                    'judul'=>'Supplier',
                    'sub_judul'=>'Data Supplier',
                    'informasi'=>'Report data',
                    );

    // ---------end section---------------------------------------------------------
    
    $jml = $this->db->get('t_supplier');
    $config['base_url']   = base_url().base_akses().'supplier/index/';
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
     $data['supplier'] = $this->m_supplier->get_data($config['per_page'],$id);
    
     // load view-------------------------------------------------------------------
    $this->load->view('supplier/list', $data);

  }



  function add()
  {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-database',
                    'judul'=>'Supplier',
                    'sub_judul'=>'Entri Supplier',
                    'informasi'=>'Entri Supplier',
                    );

    // ---------end section---------------------------------------------------------


    $this->load->view('supplier/entri', $data);

  }


    function add_proses()
    {
      if ($this->input->post('entri') == "simpan") {
        $data = array(
            'id_supplier'=>NULL,
            'kode_supplier'=>$this->input->post('unique_kode_supplier'),
            'nama_supplier'=>$this->input->post('nama_supplier'),
            'alamat'=>$this->input->post('alamat'),
            'telepon'=>$this->input->post('telepon'),
            'fax'=>$this->input->post('fax'),
        );
          $simpan = $this->db->insert('t_supplier', $data);
        if ($simpan == TRUE) {
          redirect('admin/supplier','refresh');
        }else{
          redirect('admin/supplier/add','refresh');
        }
      }else{
        redirect('admin/supplier/add','refresh');
      }
    }


    function update($id = NULL)
    {
      if ($id == TRUE) {

        // ---------start section-------------------------------------------------------
        $data['hal'] = (object) array(
                        'judul_icon'=>'fa fa-database',
                        'judul'=>'Supplier',
                        'sub_judul'=>'Update Supplier',
                        'informasi'=>'Update Supplier',
                        );

        // ---------end section---------------------------------------------------------
        $data['sp'] = get_supplier($id);
        $this->load->view('supplier/update', $data);
      }else{
        redirect('admin/supplier','refresh');
      }
    }

    function update_proses()
    {
      if ($this->input->post('entri') == "simpan") {
        $data = array(
            'kode_supplier'=>$this->input->post('unique_kode_supplier'),
            'nama_supplier'=>$this->input->post('nama_supplier'),
            'alamat'=>$this->input->post('alamat'),
            'telepon'=>$this->input->post('telepon'),
            'fax'=>$this->input->post('fax'),
        );
          $id = $this->input->post('id_supplier');
          $this->db->where('id_supplier',$id);
          $update = $this->db->update('t_supplier', $data);
        if ($update == TRUE) {
          redirect('admin/supplier','refresh');
        }else{
          redirect('admin/supplier/update/'.$id.'','refresh');
        }
      }else{
        redirect('admin/supplier/','refresh');
      }
    }



    function delete($id = NULL)
    {
      if ($id == TRUE) {
        $this->db->where('id_supplier',$id);
        $delete = $this->db->delete('t_supplier');
        redirect('admin/supplier','refresh');
      }else{
        redirect('admin/supplier','refresh');
      }
    }

}
