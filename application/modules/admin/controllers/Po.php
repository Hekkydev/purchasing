<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Po extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $model_admin  = array('m_account','pb_model','po_model');
    $this->load->model($model_admin);
    $this->load->helper(array('url','waktu','app','po','barang','pb','supplier'));
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
                    'judul_icon'=>'fa fa-credit-card',
                    'judul'=>'Purchase Order',
                    'sub_judul'=>'Report Data PO',
                    'informasi'=>'Report Data PO',
                    );

    // ---------end section---------------------------------------------------------

    $po_stat = $this->po_model->get_all_po();
    foreach($po_stat as $po){
      $cek = $this->po_model->status_po_rg($po->kode_po);
      $cek_po = $this->po_model->status_po_po($po->kode_po);
      if($cek == TRUE){
        $total_rg = $cek->total_rg;
        $total_po = $cek_po->total_po;
        if($total_rg == $total_po){
          $data_s = array('id_status_transaksi'=>3);
          $this->db->update('t_po', $data_s, array('kode_po'=>$po->kode_po));
        }

      }
    }

    $jml = $this->db->get('t_po');
    $config['base_url']   = base_url().base_akses().'po/index/';
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
     $data['po'] = $this->po_model->get_po($config['per_page'],$id);

    $this->load->view('po/list',$data);
  }

  function add()
  {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-credit-card',
                    'judul'=>'Purchase Order',
                    'sub_judul'=>'Form Purchase Order',
                    'informasi'=>'Form Purchase Order',
                    );

    $data['pb_aktif'] = $this->pb_model->get_pb_aktif();
    // ---------end section---------------------------------------------------------
      $this->load->view('po/entri',$data);
  }

  function add_temp()
  {

    $pb = $this->input->post('id_pb',TRUE);

    if ($pb == TRUE) {
        $cek = cek_temp_po($pb);
        if($cek->num_rows() > 0){
          foreach ($cek->result() as $list) {
            $nilai_qty = $list->qty_po;
                         $this->db->select('SUM(t_po_detail.qty_po) AS total_po');
                         $this->db->from('t_po_detail');
                         $this->db->where('id_pb',$list->id_pb);
                         $this->db->where('id_item',$list->id_item);
            $cek_list1 = $this->db->get()->first_row();
            if($cek_list1 == TRUE){
              $nilai_qty = $list->qty_po - $cek_list1->total_po;
            }

            $data = array('aktif'=>1,'qty_po'=>$nilai_qty);
            $proses = cek_per_id($list->id_pb,$list->id_po_temp,$data);
          }
          echo "listing di update";
        }else{
          $pb_detail = get_pb_detail($pb);
          $kode_pb = $pb_detail->kode_pb;
          $data_pb_detail = get_pb_detail_material($kode_pb);
        //print_r($data_pb_detail); die();
          foreach ($data_pb_detail as $m) {

                         $this->db->select('SUM(t_po_detail.qty_po) AS total_po');
                         $this->db->from('t_po_detail');
                         $this->db->where('id_pb',$m->id_pb);
                         $this->db->where('id_item',$m->id_item);
            $cek_list2 = $this->db->get()->first_row();
            if($cek_list2 == TRUE){
              $nilai_qty_2 = $m->qty - $cek_list2->total_po;

              $data = array(
                'id_po_temp'=>NULL,
                'id_pb'=>$pb,
                'id_item'=>$m->id_item,
                'qty_po'=>$nilai_qty_2,
                'aktif'=>1,
                );
            }else{

              $nilai_qty_2 = $m->qty;
              $data = array(
                'id_po_temp'=>NULL,
                'id_pb'=>$pb,
                'id_item'=>$m->id_item,
                'qty_po'=>$nilai_qty_2,
                'aktif'=>1,
                );
            }
            $insert = simpan_temp($data);
          }
          $success = "Berhasil Menyimpan";
          echo json_encode($success);
        }

     }else{
       echo "Tidak ada permintaan !";
     }


  }


  function get_temp()
  {
    $temp = get_temp_po();
    foreach($temp as $t){
      if($t->qty_po <= 0){
        $this->db->delete('t_po_temp',array('id_po_temp'=>$t->id_po_temp));
      }
    }
    $this->load->view('po/list_temp');
  }

  function remove_temp()
  {
    $this->db->truncate('t_po_temp');
  }

  function remove_temp_po()
  {
    $id = $this->input->post('id');
    $condition = $this->db->where('id_po_temp', $id);
    $data = array('aktif'=>0);
    $this->db->update('t_po_temp', $data, $condition);
  }
  function qty_edit_temp()
  {
    $id = $this->input->post('id');
    $qty = $this->input->post('qty');
    $condition = $this->db->where('id_po_temp', $id);
    $data = array('qty_po'=>$qty);
    $this->db->update('t_po_temp', $data, $condition);
  }

  function tax()
  {
      $data = array('tax'=>$this->input->post('tax'));
      $cek = $this->db->get('t_po_tax')->result();
      if ($cek == TRUE) {
        $this->db->update('t_po_tax', $data);
      }else{
        $this->db->insert('t_po_tax', $data);
      }

  }

  function save_price()
  {
    $id = $this->input->post('id');
    if ($id == TRUE) {
      $data = array('harga'=>$this->input->post('harga'));
      $this->db->update('t_po_temp', $data, $condition = array('id_po_temp'=>$id));
    }
  }


  function add_proses()
  {

      $kode_po = $this->input->post('kode_po');
      $tgl_create = date('Y-m-d');
      $tgl_plan = $this->input->post('tgl_plan');
      $keterangan = $this->input->post('keterangan');
      $id_supplier = $this->input->post('id_supplier');
      $tax = $this->input->post('tax');
      
      $po = array(
        'id_po'=>NULL,
        'kode_po'=>$kode_po,
        'tgl_create'=>$tgl_create,
        'tgl_plan'=>$tgl_plan,
        'keterangan'=>$keterangan,
        'tax'=>$tax,
        'id_supplier'=>$id_supplier,
        'id_status_transaksi'=>1,
      );
      $pb_list = pb_distinct_qty();
      foreach ($pb_list as $i) {
        $data = array('id_status_transaksi'=>2);
        $condition = array('kode_pb'=>$i->kode_pb);
        $this->db->update('t_pb',$data,$condition);
      }

      if (isset($po)) {
          $simpan = $this->db->insert('t_po', $po);
          if ($simpan == TRUE) {
            $po_temp = get_temp_po_all();
            foreach($po_temp as $temp){
              $po_detail = array(
                'id_po_detail'=>NULL,
                'kode_po'=>$kode_po,
                'id_pb'=>$temp->id_pb,
                'id_item'=>$temp->id_item,
                'qty_po'=>$temp->qty_po,
                'harga'=>$temp->harga,
                'qty_pb'=> max_pb($temp->kode_pb,$temp->id_item),
                'aktif'=>$temp->aktif,
              );
              $simpan_detail = $this->db->insert('t_po_detail', $po_detail);
            }
            $this->db->truncate('t_po_temp');
            redirect(''.base_akses().'po','refresh');
          }

      }
  }

  function detail($id = NULL)
  {
    $data['PO'] = get_po_detail($id);
    $data['items'] = get_po_detail_item($data['PO']->kode_po);
    //print_r($data['items']); die();
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-credit-card',
                    'judul'=>'Purchase Order',
                    'sub_judul'=>'Review Purchase Order',
                    'informasi'=>'Review Purchase Order',
                    );

    // ---------end section---------------------------------------------------------
    $this->load->view('po/detail', $data);
  }

  function detail_pdf($id = NULL)
  {
    $name_app = 'PURCHASE APP';
    $data['po'] = $this->po_model->get_po_detail($id);
    $data['items'] = get_po_detail_item($data['po']->kode_po);
    $html = $this->load->view('po/pdf_detail',$data,TRUE);
    $pdf = $this->pdf->load();
    $pdf->setTitle('Laporan Purchase Order');
    $pdf->SetHeader('Laporan Purchase Order'.'||'.tgl_lengkap(date('Y-m-d')));
    $pdf->SetFooter($name_app.'|{PAGENO}|'.tgl_lengkap(date('Y-m-d')));
    $pdf->WriteHTML($html);
    header('Content-Type: application/pdf');
    $pdf->Output('LAPORAN PURCHASE ORDER - '.$data['po']->kode_po.'.pdf','I');
  }

  function download_pdf($id = NULL)
  {
    $name_app = 'PURCHASE APP';
    $data['po'] = $this->po_model->get_po_detail($id);
    $data['items'] = get_po_detail_item($data['po']->kode_po);
    $html = $this->load->view('po/pdf_detail',$data,TRUE);
    $pdf = $this->pdf->load();
    $pdf->setTitle('Laporan Purchase Order');
    $pdf->SetHeader('Laporan Purchase Order'.'||'.tgl_lengkap(date('Y-m-d')));
    $pdf->SetFooter($name_app.'|{PAGENO}|'.tgl_lengkap(date('Y-m-d')));
    $pdf->WriteHTML($html);
    $pdf->Output('LAPORAN PURCHASE ORDER - '.$data['po']->kode_po.'.pdf','D');
  }

}
