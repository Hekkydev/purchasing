<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pb extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $model_admin  = array('m_account','pb_model');
    $this->load->model($model_admin);
    $this->load->helper(array('url','waktu','app','pb','barang'));
    $this->load->library(array('session','pagination','pdf'));
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
                    'judul_icon'=>'fa fa-clipboard',
                    'judul'=>'Purchase Requestion',
                    'sub_judul'=>'Report Data',
                    'informasi'=>'Report Data',
                    );

    // ---------end section---------------------------------------------------------


    $status = $this->pb_model->get_all_pb();

    foreach ($status as $s) {
      $pb = status_pb_2($s->kode_pb)->total_pb;
      $po = status_pb($s->id_pb)->total_po;
      $cek = $this->db->get_where('t_po_detail', array('id_pb'=>$s->id_pb))->result();
      if($cek == TRUE){
        if($pb == $po){
         $data_s = array('id_status_transaksi'=>3);
         $condition = array('id_pb'=>$s->id_pb);
         $this->db->update('t_pb', $data_s, $condition);
       }

      }
    }


    $jml = $this->db->get('t_pb');
    $config['base_url']   = base_url().base_akses().'pb/index/';
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
     $data['PB'] = $this->pb_model->get_pb($config['per_page'],$id);
    // template---------------------------------------------------------------------
    $this->load->view('pb/list', $data);
  }

  function add()
  {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-clipboard',
                    'judul'=>'Purchase Requestion',
                    'sub_judul'=>'Form Request',
                    'informasi'=>'Form Request',
                    );

    // ---------end section---------------------------------------------------------
    //print_r(items()); die();
    $this->load->view('pb/entri',$data);
  }

  function simpan_ke_list()
  {
    $id  = $this->input->post('id_item');
    $qty = $this->input->post('qty');
      if ($id == TRUE) {
        if($qty > 0 ){
        $data = array(
          'id_temp'=>NULL,
          'id_item'=>$id,
          'qty'=>$qty,
          'info'=>'pb',
        );
        $cek = $this->db->get_where('temp',array('id_item'=>$id));
        if($cek->num_rows() > 0){
          $jml = $cek->first_row();
          $qty_update = $jml->qty + $qty;
          $update_data = array('qty'=>$qty_update);
          $condition = array('id_item'=>$id);
          $update = $this->db->update('temp', $update_data, $condition);
          echo "<p style='color:#ff0000;'><i class='fa fa-check'></i> Berhasil di Update</p>";
        }else{
          $simpan = $this->db->insert('temp', $data);
          echo "<p style='color:#ff0000;'><i class='fa fa-check'></i> Berhasil Menyimpan</p>";
        }
        }
      }else{
        echo "<p style='color:#ff0000;'><i class='fa fa-warning'></i> Gagal Menyimpan</p>";
      }
  }


  function get_list_pb()
  {
      $object = get_pb_temp();
      if($object == TRUE){
        $qty_total = 0;
        foreach ($object as $o) {
          $link = "<a href=".site_url(''.base_akses().'pb/delete_temp?id_temp='.$o->id_temp.'')." class='pull-right-app' style='color:#ff0000;'> <i class='fa fa-close '></i> Hapus</a>";
          $qty_total += $o->qty;
          echo "<tr>";
          echo "<td>".$o->unique_kode."</td>";
          echo "<td>".$o->item_nama."</td>";
          echo "<td>".$o->qty."</td>";
          echo "<td style='width:7%;'>".$link."</td>";

          echo "</tr>";
        }
        echo "<tr style='border-top:2px solid; border-top-color:#ddd;'>";
        echo "<td colspan='2'><b>Total Barang</b></td><td><b>".$qty_total."</b></td>";
        echo "</tr>";
      }else{
        echo "<tr><td colspan='5'><div align='center'><i class='fa  fa-exclamation-triangle'></i> Data Permintaan Kosong</div></td></tr>";
      }

  }

  function delete_temp()
  {
    $id = $this->input->get('id_temp');
    $delete = $this->db->delete('temp',array('id_temp'=> $id));
    if($delete == TRUE){

      redirect(''.base_akses().'pb/add','refresh');
    }
  }

  function add_proses()
  {
    $temp = count(get_pb_temp());
    if($temp > 0){
      $kode_pb = $this->input->post('unique_kode_pb');
      $keterangan = $this->input->post('keterangan');
      $tgl_plan = $this->input->post('tgl_plan');
      $tgl_pb = tgl_database($this->input->post('tgl_create'));

      $pb_data = array(
          'id_pb' =>NULL,
          'id_status_transaksi'=>1,
          'kode_pb'=>$kode_pb,
          'tgl_create'=>$tgl_pb,
          'tgl_update'=>$tgl_pb,
          'tgl_plan'=>$tgl_plan,
          'keterangan'=>$keterangan,
      );
      //print_r($pb_data); die();
      $insert = $this->db->insert('t_pb',$pb_data);
      if($insert == TRUE){
        foreach (get_pb_temp() as $temp) {
          $pb_detail = array(
            'id_pb_detail'=>NULL,
            'kode_pb'=>$kode_pb,
            'id_item'=>$temp->id_item,
            'qty'=>$temp->qty,
          );
          $this->db->insert('t_pb_detail', $pb_detail);
        }
        $this->db->truncate('temp');
        redirect(''.base_akses().'pb/','refresh');
      }else{
        redirect(''.base_akses().'pb/add','refresh');
      }

    }else{
      $data = error_proses();
      $this->session->set_flashdata('info',$data);
      redirect(''.base_akses().'pb/add','refresh');
    }

  }



  function detail($id = NULL)
  {
    $data['PB'] = get_pb_detail($id);
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-clipboard',
                    'judul'=>'Purchase Requestion',
                    'sub_judul'=>'Detail Request',
                    'informasi'=>'Detail Request',
                    );

    // ---------end section---------------------------------------------------------
    //print_r(items()); die();
    $this->load->view('pb/detail',$data);
  }

  function detail_pdf($id = null)
  {
    $name_web = 'PURCHASE APP';
    $data['pb'] = $this->pb_model->get_pb_detail($id);
    $html = $this->load->view('pb/pdf_detail',$data,TRUE);
    $pdf = $this->pdf->load();
    $pdf->setTitle('Laporan Data Permintaan');
    $pdf->SetHeader('Laporan Data Permintaan'.'||'.tgl_lengkap(date('Y-m-d')));
    $pdf->SetFooter($name_web.'|{PAGENO}|'.tgl_lengkap(date('Y-m-d')));
    $pdf->WriteHTML($html);
    header('Content-Type: application/pdf');
    $pdf->Output('LAPORAN PERMINTAAN - '.$data['pb']->kode_pb.'.pdf','I');
  }

  function download_pdf($id = null)
  {
    $name_web = 'PURCHASE APP';
    $data['pb'] = $this->pb_model->get_pb_detail($id);
    $html = $this->load->view('pb/pdf_detail',$data,TRUE);
    $pdf = $this->pdf->load();
    $pdf->setTitle('Laporan Data Permintaan');
    $pdf->SetHeader('Laporan Data Permintaan'.'||'.tgl_lengkap(date('Y-m-d')));
    $pdf->SetFooter($name_web.'|{PAGENO}|'.tgl_lengkap(date('Y-m-d')));
    $pdf->WriteHTML($html);
    header('Content-Type: application/pdf');
    $pdf->Output('LAPORAN PERMINTAAN - '.$data['pb']->kode_pb.'.pdf','D');
  }

}
