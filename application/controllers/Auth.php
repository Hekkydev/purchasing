<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{

		parent::__construct();
    $this->load->database();
    $model_auth  = array('m_account');
    $this->load->model($model_auth);
    $this->load->helper(array('url','waktu','app'));
    $this->load->library(array('session','pagination'));

	}
	public function index()
	{
		// ---------start session management----------------------------------------------
		if($this->session->userdata('username') == TRUE){
			$this->id = $this->session->userdata('id');
			$this->user = cek_users($this->id);
			if ($this->user->id_group == 1) {
				redirect(''.base_akses().'home','refresh');
			}else {
				redirect(''.base_akses().'home','refresh');
			}
		}else{
			$this->load->view('login');
		}
		// ---------end session management----------------------------------------------

	}

	public function login()
	{
			$username = $this->input->post('username', TRUE);
			$password = $this->input->post('password', TRUE);

			$query = $this->m_account->db->get_where('t_users',array('username'=>$username,'password' => $password));

			if($query->num_rows() == 1) {
			$row = $this->m_account->db->query('SELECT id_user,id_group FROM t_users where username = "'.$username.'"');
			$group_cek = $row->row();
					if ($group_cek->id_group == 1) {
						$this->session->set_userdata('username',$username);
						$this->session->set_userdata('id_login',uniqid(rand()));
						$this->session->set_userdata('id',$group_cek->id_user);
						$activity_time = aktivitas_users($group_cek->id_user,"insert","login");
						redirect(''.base_akses().'home','refresh');
					}else {
						$this->session->set_userdata('username',$username);
						$this->session->set_userdata('id_login',uniqid(rand()));
						$this->session->set_userdata('id',$group_cek->id_user);
						$activity_time = aktivitas_users($group_cek->id_user,"insert","login");
						redirect(''.base_akses().'home','refresh');
					}
			}else{
			$this->session->set_flashdata('login','Oops... Username/password salah');
			redirect(base_url('auth/'),'refresh');
			}
			return false;
	}

  public function logout()
	{

			$id = $this->session->userdata('id');
			$activity_time = aktivitas_users($id,"insert","logout");

			$this->session->sess_destroy();
			redirect('/','refresh');
	}

	
}
