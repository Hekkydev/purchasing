<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rg extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $model_admin  = array('m_account','rg_model');
    $this->load->model($model_admin);
    $this->load->helper(array('url','waktu','app','po','barang','rg'));
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


  public function index($id = NULL)
  {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-download',
                    'judul'=>'Received Goods',
                    'sub_judul'=>'Report Data RG',
                    'informasi'=>'Report Data RG',
                    );

    // ---------end section---------------------------------------------------------


    $jml = $this->db->get('t_rg');
    $config['base_url']   = base_url().base_akses().'rg/index/';
    $config['total_rows'] = $jml->num_rows();
    $config['per_page'] = '5';

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
     $data['RG'] = $this->rg_model->get_rg($config['per_page'],$id);



    $this->load->view('rg/list',$data);
  }



  function add()
  {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-download',
                    'judul'=>'Received Goods',
                    'sub_judul'=>'Entri Data RG',
                    'informasi'=>'Entri Data RG',
                    );

    // ---------end section---------------------------------------------------------
    $data['PO'] = $this->rg_model->supplier_po();
    $kode_rg = unique_kode_rg();
    $data['cek_supplier_rg'] = cek_supplier_rg($kode_rg);
    // kosong kan temp database
    $this->db->truncate('t_rg_temp');
    $this->db->truncate('t_rg_temp_detail');
    // -----------------------------------------------------------------------------
    $this->load->view('rg/entri',$data);
  }

  function cek_supplier_po()
  {
    $kode_rg = $this->input->post('kode_rg');
    $id_supplier = $this->input->post('id_supplier');
    $kriteria = array(
      'kode_rg'=>$kode_rg
    );
    $cek = $this->db->get_where('t_rg_temp',$kriteria)->first_row();
    if($cek == TRUE){
      $data_change = array('id_supplier'=>$id_supplier);
      $this->db->update('t_rg_temp', $data_change, $where = array('kode_rg'=>$kode_rg));
    }
    $data['po_list'] = $this->rg_model->data_po_supplier($id_supplier);
    $data['id_supplier']= $id_supplier;
    $this->db->truncate('t_rg_temp_detail');
    $this->load->view('rg/po_list',$data);

  }

  function get_temp()
  {
    $this->load->view('rg/list_temp');
  }

  function add_temp()
  {
    $kode_rg = $this->input->post('kode_rg');
    $kode_po = $this->input->post('kode_po');
    $id_supplier = $this->input->post('id_supplier');
    $po = $this->rg_model->get_po_data($kode_po);
    $cek_temp_supplier = cek_supplier_rg($kode_rg);
    if($kode_po == TRUE){
    $cek = cek_temp_rg($kode_po);
    if($cek > 0){
      foreach ($po as $p) {
        $data_aktif = array('aktif'=>1);
        $proses = $this->db->update('t_rg_temp_detail', $data_aktif);
      }
      $success = "Berhasil di update";
      echo $success;
    }else{
        foreach ($po as $p) {
          $cek_qty_rg = qty_rg($p->kode_po,$p->id_item);
          $cek_qty_out = qty_rg_out_stand($p->kode_po,$p->id_item);
          if($cek_qty_out == TRUE){
          $rg_detail = array(
            'id_rg_temp_detail' =>NULL,
            'kode_po'=>$p->kode_po,
            'id_item'=>$p->id_item,
            'qty_rg'=>$cek_qty_out,
            'aktif'=>1
          );
          $simpan = $this->db->insert('t_rg_temp_detail', $rg_detail);
        }else {
          $rg_detail = array(
            'id_rg_temp_detail' =>NULL,
            'kode_po'=>$p->kode_po,
            'id_item'=>$p->id_item,
            'qty_rg'=>$p->qty_po,
            'aktif'=>1
          );
          $simpan = $this->db->insert('t_rg_temp_detail', $rg_detail);
        }
          //echo "<pre>";
          //print_r($cek_qty_out);


        }
        $success = "Berhasil disimpan";
        echo $success;
      }
    }else{
      echo "Tidak ada no po yang di simpan!";
    }

  }


  function remove_temp()
  {
    $this->db->truncate('t_rg_temp');
    $this->db->truncate('t_rg_temp_detail');
  }

  function ubah_nilai_temp()
  {
    $id = $this->input->post('id');
    $qty = $this->input->post('number');

    $data = array('qty_rg'=>$qty);
    $where = $this->db->where('id_rg_temp_detail', $id);
    $update = $this->db->update('t_rg_temp_detail',$data);
  }


  function remove_list()
  {
    $id = $this->input->post('id');
    $aktif = array('aktif'=>0);
    $update = $this->db->update('t_rg_temp_detail',$aktif,array('id_rg_temp_detail'=>$id));
  }



  function add_proses()
  {
    $cek = get_temp_rg();
    $supplier_id = $this->input->post('supplier');

    if($cek == TRUE){
      //  print_r($_POST); die();
        $kondisi = $this->input->post('entri');
        if($kondisi == "simpan"){
          $kode_rg = $this->input->post('kode_rg');
          $tgl_plan = $this->input->post('tgl_plan');
          $surat_jalan = $this->input->post('surat_jalan');
          $tgl_rg = date('Y-m-d');
          $supplier_id = $this->input->post('supplier');

          $data_rg = array(
            'id_rg' =>NULL,
            'kode_rg'=>$kode_rg,
            'kode_surat_jln'=>$surat_jalan,
            'tgl_receive'=>$tgl_rg,
            'tgl_plan'=>$tgl_plan,
            'id_supplier'=>$supplier_id
           );

          $simpan_rg = $this->db->insert('t_rg',$data_rg);
          $cek_rg = $this->db->get('t_rg_detail')->result();
          if($simpan_rg == TRUE){
            foreach ($cek as $rd) {
              // rubah po ke on proses
              $data_s = array('id_status_transaksi'=>2);
              $this->db->update('t_po', $data_s, array('kode_po'=>$rd->kode_po));
              //------------------------------------------------------------------
              $qty_po = qty_po($rd->kode_po,$rd->id_item);
              $qty_last_rg = qty_rg($rd->kode_po,$rd->id_item);
              $cek_qty_rg = qty_rg_out_stand($rd->kode_po,$rd->id_item);

                $data_rg_detail = array(
                  'id_rg_detail' =>NULL,
                  'kode_rg'=>$kode_rg,
                  'kode_po'=>$rd->kode_po,
                  'id_item'=>$rd->id_item,
                  'qty_rg'=>$rd->qty_rg,
                  'out_standing'=>$qty_po - $rd->qty_rg - $qty_last_rg,
                );
                $simpan_rg_detail = $this->db->insert('t_rg_detail', $data_rg_detail);



            }
            redirect(''.base_akses().'rg','refresh');
          }else{
            $this->session->set_flashdata('gagal_entri',"Gagal Menyimpan Data");
            redirect(''.base_akses().'rg/add','refresh');
          }


        }
    }else{
      $this->session->set_flashdata('gagal_entri',"Gagal Menyimpan Data");
      redirect(''.base_akses().'rg/add','refresh');
    }
  }



  function detail($id = NULL)
  {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-download',
                    'judul'=>'Received Goods',
                    'sub_judul'=>'Report Data RG',
                    'informasi'=>'Report Data RG',
                    );

    // ---------end section---------------------------------------------------------
    $data['rg'] = $this->rg_model->get_rg_detail($id);
    $data['detail_rg'] = $this->rg_model->get_rg_detail_item($id);
    $this->load->view('rg/detail', $data);
  }

  function detail_pdf($id = NULL)
  {
    $name_app = 'PURCHASE APP';
    $data['RG'] = $this->rg_model->get_rg_detail($id);
    $data['detail_rg'] = $this->rg_model->get_rg_detail_item($id);
    $html = $this->load->view('rg/pdf_detail',$data,TRUE);
    $pdf = $this->pdf->load();
    $pdf->setTitle('Laporan Received Goods');
    $pdf->SetHeader('Laporan Received Goods'.'||'.tgl_lengkap(date('Y-m-d')));
    $pdf->SetFooter($name_app.'|{PAGENO}|'.tgl_lengkap(date('Y-m-d')));
    $pdf->WriteHTML($html);
    header('Content-Type: application/pdf');
    $pdf->Output('LAPORAN RECEIVE GOOD - '.$data['RG']->kode_rg.'.pdf','I');
  }

  function download_pdf($id = NULL)
  {
    $name_app = 'PURCHASE APP';
    $data['RG'] = $this->rg_model->get_rg_detail($id);
    $data['detail_rg'] = $this->rg_model->get_rg_detail_item($id);
    $html = $this->load->view('rg/pdf_detail',$data,TRUE);
    $pdf = $this->pdf->load();
    $pdf->setTitle('Laporan Received Goods');
    $pdf->SetHeader('Laporan Received Goods'.'||'.tgl_lengkap(date('Y-m-d')));
    $pdf->SetFooter($name_app.'|{PAGENO}|'.tgl_lengkap(date('Y-m-d')));
    $pdf->WriteHTML($html);
    header('Content-Type: application/pdf');
    $pdf->Output('LAPORAN RECEIVE GOOD - '.$data['RG']->kode_rg.'.pdf','D');
  }



}
