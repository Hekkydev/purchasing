<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller{

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
    // ---------end session management------------------------------------------------
  }


  function index()
  {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-users',
                    'judul'=>'Account',
                    'sub_judul'=>'Result account',
                    'informasi'=>'Result account',
                    );

    // ---------end section---------------------------------------------------------

      $data['account'] = $this->m_account->get_all();
      $this->load->view('account/list', $data);
  }

  function add()
  {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'ion ion-ios-personadd',
                    'judul'=>'Account',
                    'sub_judul'=>'Tambah akun',
                    'informasi'=>'Tambah akun',
                    );

    // ---------end section---------------------------------------------------------

    $data['group'] = $this->db->get('t_group')->result();
    $this->load->view('account/entri', $data);
  }

  function addproses()
  {
    $id_group = $this->input->post('id_group');
    $nama_akun = $this->input->post('nama_akun');
    $nama_profile = $this->input->post('nama_profile');
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $userData = array(
      'id_user'=>NULL,
      'id_group'=>$id_group,
      'nama_user' =>$nama_akun,
      'nama_profile'=>$nama_profile,
      'username'=>$username,
      'password'=>$password,
     );

     $simpan = $this->db->insert('t_users', $userData);
     if ($simpan == TRUE) {
       redirect(''.base_akses().'account/','refresh');
     }

  }


  function update($id = NULL)
  {
    $cek = $this->db->get_where('t_users', $where = array('id_user'=>$id))->result();
    if(isset($cek) || $cek == TRUE){
      $data ['users'] = $this->db->get_where('t_users',$where = array('id_user'=>$id))->first_row();
    //  print_r($data['users']); die();
    }else{
      redirect(''.base_akses().'account','refresh');
    }

    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'ion ion-ios-person',
                    'judul'=>'Account',
                    'sub_judul'=>'Update akun',
                    'informasi'=>'Update akun',
                    );

    // ---------end section---------------------------------------------------------
    $data['group'] = $this->db->get('t_group')->result();
    $this->load->view('account/update', $data);

  }


  function updateproses()
  {
    $id_user = $this->input->post('id_user');
    $id_group = $this->input->post('id_group');
    $nama_akun = $this->input->post('nama_akun');
    $nama_profile = $this->input->post('nama_profile');
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $userData = array(
      'id_group'=>$id_group,
      'nama_user' =>$nama_akun,
      'nama_profile'=>$nama_profile,
      'username'=>$username,
      'password'=>$password,
     );

     if ($userData == TRUE) {
       $where = $this->db->where('id_user',$id_user);
       $update = $this->db->update('t_users', $userData);
       if ($update == TRUE) {
         redirect(''.base_akses().'account','refresh');
       }
     }
   }

   function delete($id = NULL)
   {
     $delete = $this->db->delete('t_users', $where = array('id_user'=>$id));
     if($delete){
       redirect(''.base_akses().'account','refresh');
     }
   }

   function profile($id)
   {
     $cek = $this->db->get_where('t_users', $where = array('id_user'=>$id))->result();
     if(isset($cek) || $cek == TRUE){


          // ---------start section-------------------------------------------------------
          $data['hal'] = (object) array(
                          'judul_icon'=>'ion ion-ios-person',
                          'judul'=>'Account',
                          'sub_judul'=>'Profile',
                          'informasi'=>'Profile',
                          );

          // ---------end section---------------------------------------------------------
          $data['group'] = $this->db->get('t_group')->result();
          $this->load->view('account/profile', $data);


     }else{
       redirect(''.base_akses().'account','refresh');
     }

   }

   function truncate_activity($id)
   {
     $this->db->delete('t_users_activity', $where = array('id_user'=>$id));
     redirect(''.base_akses().'account/profile/'.$id.'','refresh');
   }


   function profile_edit($id)
   {
     $cek = $this->db->get_where('t_users', $where = array('id_user'=>$id))->result();
     if(isset($cek) || $cek == TRUE){
          // ---------start section-------------------------------------------------------
          $data['hal'] = (object) array(
                          'judul_icon'=>'ion ion-ios-person',
                          'judul'=>'Account',
                          'sub_judul'=>'Edit Profile',
                          'informasi'=>'Edit Profile',
                          );

          // ---------end section---------------------------------------------------------
          $data['group'] = $this->db->get('t_group')->result();
          $this->load->view('account/profile_edit', $data);
     }else{
       redirect(''.base_akses().'account','refresh');
     }

   }

   public function update_profileproses()
   {
     $id_user = $this->input->post('id_user');
     $id_group = $this->input->post('id_group');
     $nama_akun = $this->input->post('nama_akun');
     $nama_profile = $this->input->post('nama_profile');
     $data = array(
       'nama_user'=>$nama_akun,
       'nama_profile'=>$nama_profile,
       'id_group'=>$id_group,
     );
     if($data == TRUE){
       $this->db->where('id_user',$id_user);
      $update = $this->db->update('t_users', $data);
      redirect(''.base_akses().'account/profile_edit/'.$id_user.'');
     }

   }


   function edit($id = null)
   {
     $cek = $this->db->get_where('t_users', $where = array('id_user'=>$id))->result();
     if(isset($cek) || $cek == TRUE){
          // ---------start section-------------------------------------------------------
          $data['hal'] = (object) array(
                          'judul_icon'=>'ion ion-ios-person',
                          'judul'=>'Account',
                          'sub_judul'=>'Edit Account',
                          'informasi'=>'Edit Account',
                          );

          // ---------end section---------------------------------------------------------

          $this->load->view('account/akun_edit', $data);
     }else{
       redirect(''.base_akses().'account','refresh');
     }

   }

   function update_accountproses()
   {
     $id_user = $this->input->post('id_user');
     $username = $this->input->post('username');
     $password = $this->input->post('password');
     $userData = array(
       'username'=>$username,
       'password'=>$password,
      );

      $where = $this->db->where('id_user', $id_user);
      $update = $this->db->update('t_users', $userData);
      if ($update == TRUE) {
          redirect(''.base_akses().'account/edit/'.$id_user.'');
      }
   }


}
