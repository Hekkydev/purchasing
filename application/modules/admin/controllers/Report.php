<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $model_admin  = array('m_account','pb_model','po_model','rg_model','m_barang','m_supplier');
    $this->load->model($model_admin);
    $this->load->helper(array('url','waktu','app','po','barang','pb','supplier','report','rg'));
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

  function index()
  {
    // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-file',
                    'judul'=>'Laporan',
                    'sub_judul'=>'Report Data',
                    'informasi'=>'Report Data',
                    );

    // ---------end section---------------------------------------------------------

    $this->load->view('report/index',$data);
  }

  function barang()
  {
      // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'ion ion-ios-cube',
                    'judul'=>'Laporan',
                    'sub_judul'=>'Report Data Barang',
                    'informasi'=>'Report Data Barang',
                    );

    // ---------end section---------------------------------------------------------
    $data['barang'] = $this->data_rekap_barang();
    $this->load->view('report/barang',$data);
  }


  function supplier()
  {
      // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'ion ion-ios-people',
                    'judul'=>'Laporan',
                    'sub_judul'=>'Report Data Supplier',
                    'informasi'=>'Report Data Supplier',
                    );

    // ---------end section---------------------------------------------------------
    $data['supplier'] = $this->data_rekap_supplier();
    $this->load->view('report/supplier',$data);
  }

  function pb()
  {
      // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'fa fa-clipboard',
                    'judul'=>'Laporan',
                    'sub_judul'=>'Report Data Purchase Requestion',
                    'informasi'=>'Report Data Purchase Requestion',
                    );

    // ---------end section---------------------------------------------------------
    $data['pb'] = $this->pb_model->get_all_pb();
    $this->load->view('report/pb',$data);
  }

  function po()
  {
      // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'ion ion-card',
                    'judul'=>'Laporan',
                    'sub_judul'=>'Report Data PO',
                    'informasi'=>'Report Data PO',
                    );

    // ---------end section---------------------------------------------------------
    $data['po'] = $this->po_model->get_all_po();
    $this->load->view('report/po',$data);
  }

  function rg()
  {
      // ---------start section-------------------------------------------------------
    $data['hal'] = (object) array(
                    'judul_icon'=>'ion ion-clipboard',
                    'judul'=>'Laporan',
                    'sub_judul'=>'Report Data RG',
                    'informasi'=>'Report Data RG',
                    );

    // ---------end section---------------------------------------------------------
    $data['rg'] = $this->rg_model->get_rg_report();
    $this->load->view('report/rg',$data);
  }

  function type_rekap()
  {
    $n = $this->input->get('jenis_rekap', TRUE);
    if($n == "ph"){
    echo  '<label>Tanggal : </label>
           <input type="date" style="width:150px; height:20px;" name="tanggal" value="'.date('Y-m-d').'" id="tanggal" >';
      echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    }elseif($n == "pb"){
      echo '<label>Bulan : </label>&nbsp;<select name="bulan" id="bulan">';
             $bulan_awal = 1;
             $bulan_akhir = 12;
             for ($i=$bulan_awal; $i <= $bulan_akhir ; $i++) {
                  if ( $i == date('m')) {
                     echo "<option value=".$i." selected=''>".bulan($i)."</option>";
                  }else{
                     echo "<option value=".$i." selected=''>".bulan($i)."</option>";
                  }
             }
      echo  '</select>';
      echo "&nbsp;&nbsp;&nbsp;&nbsp;";
      echo '<label>Tahun : </label>&nbsp;<select  name"tahun" id="tahun">';
             $tahun_awal = 2011;
             $tahun_akhir = date('Y');
             for ($i=$tahun_akhir; $i >= $tahun_awal ; $i--) {
                if ($i == date('Y')) {
                  echo "<option value=".$i." selected=''>".$i."</option>";
                }else{
                  echo "<option value=".$i.">".$i."</option>";
                }
             }
      echo  '</select>';
      echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    }elseif($n == "pt"){
      echo '<label>Tahun : </label>&nbsp;<select  name"tahun" id="tahun">';
             $tahun_awal = 2011;
             $tahun_akhir = date('Y');
             for ($i=$tahun_akhir; $i >= $tahun_awal ; $i--) {
                if ($i == date('Y')) {
                  echo "<option value=".$i." selected=''>".$i."</option>";
                }else{
                  echo "<option value=".$i.">".$i."</option>";
                }
             }
      echo  '</select>';
      echo "&nbsp;&nbsp;&nbsp;&nbsp;";
    }
  }

  function data_rekap_pb()
  {
    $tanggal = $this->input->get('tanggal', TRUE);
    $bulan  = $this->input->get('bulan', TRUE);
    $tahun = $this->input->get('tahun', TRUE);
    $j = $this->input->get('jenis_rekap');

    if ($j == "ph") {
      $data['pb'] = $this->pb_model->get_perhari_pb($tanggal);
      $this->load->view('report/laporan/pb',$data);
    }elseif($j == "pb"){
      $data['pb'] = $this->pb_model->get_perbulan_pb($bulan,$tahun);
      $this->load->view('report/laporan/pb',$data);
    }elseif ($j == "pt") {
      $data['pb'] = $this->pb_model->get_pertahun_pb($tahun);
      $this->load->view('report/laporan/pb',$data);
    }

  }


  public function data_rekap_pb_laporan()
  {

      $tanggal = $this->input->get('tanggal', TRUE);
      $bulan  = $this->input->get('bulan', TRUE);
      $tahun = $this->input->get('tahun', TRUE);
      $j = $this->input->get('jenis_rekap');

      if ($j == "ph") {
        $data['pb'] = $this->pb_model->get_perhari_pb($tanggal);
        $data['get'] = "?jenis_rekap=".$j."&tanggal=".$tanggal;
        $this->load->view('report/laporan/pb_iframe',$data);
      }elseif($j == "pb"){
        $data['pb'] = $this->pb_model->get_perbulan_pb($bulan,$tahun);
        $data['get'] = "?jenis_rekap=".$j."&bulan=".$bulan."&tahun=".$tahun;
        $this->load->view('report/laporan/pb_iframe',$data);
      }elseif ($j == "pt") {
        $data['pb'] = $this->pb_model->get_pertahun_pb($tahun);
        $data['get'] = "?jenis_rekap=".$j."&tahun=".$tahun;
        $this->load->view('report/laporan/pb_iframe',$data);
      }else{
        $data['pb'] = $this->pb_model->get_all_pb();
        $data['get'] = "";
        $this->load->view('report/laporan/pb_iframe',$data);
      }
  }

   function data_rekap_po()
  {
    $tanggal = $this->input->get('tanggal', TRUE);
    $bulan  = $this->input->get('bulan', TRUE);
    $tahun = $this->input->get('tahun', TRUE);
    $j = $this->input->get('jenis_rekap');

    if ($j == "ph") {
      $data['po'] = $this->po_model->get_perhari_po($tanggal);
      $this->load->view('report/laporan/po',$data);
    }elseif($j == "pb"){
      $data['po'] = $this->po_model->get_perbulan_po($bulan,$tahun);
      $this->load->view('report/laporan/po',$data);
    }elseif ($j == "pt") {
      $data['po'] = $this->po_model->get_pertahun_po($tahun);
      $this->load->view('report/laporan/po',$data);
    }

  }

  function data_rekap_po_laporan()
 {
   $tanggal = $this->input->get('tanggal', TRUE);
   $bulan  = $this->input->get('bulan', TRUE);
   $tahun = $this->input->get('tahun', TRUE);
   $j = $this->input->get('jenis_rekap');

   if ($j == "ph") {
     $data['po'] = $this->po_model->get_perhari_po($tanggal);
     $data['get'] = "?jenis_rekap=".$j."&tanggal=".$tanggal;
     $this->load->view('report/laporan/po_iframe',$data);
   }elseif($j == "pb"){
     $data['po'] = $this->po_model->get_perbulan_po($bulan,$tahun);
     $data['get'] = "?jenis_rekap=".$j."&bulan=".$bulan."&tahun=".$tahun;
     $this->load->view('report/laporan/po_iframe',$data);
   }elseif ($j == "pt") {
     $data['po'] = $this->po_model->get_pertahun_po($tahun);
     $data['get'] = "?jenis_rekap=".$j."&tahun=".$tahun;
     $this->load->view('report/laporan/po_iframe',$data);
   }else{
     $data['po'] = $this->po_model->get_all_po($tahun);
     $data['get'] = "";
     $this->load->view('report/laporan/po_iframe',$data);
   }

 }

   function data_rekap_rg()
  {
    $tanggal = $this->input->get('tanggal', TRUE);
    $bulan  = $this->input->get('bulan', TRUE);
    $tahun = $this->input->get('tahun', TRUE);
    $j = $this->input->get('jenis_rekap');

    if ($j == "ph") {
      $data['rg'] = $this->rg_model->get_rg_report_perhari($tanggal);
      $this->load->view('report/laporan/rg',$data);
    }elseif($j == "pb"){
      $data['rg'] = $this->rg_model->get_rg_report_perbulan($bulan,$tahun);
      $this->load->view('report/laporan/rg',$data);
    }elseif ($j == "pt") {
      $data['rg'] = $this->rg_model->get_rg_report_pertahun($tahun);
      $this->load->view('report/laporan/rg',$data);
    }

  }


  function data_rekap_rg_laporan()
 {
   $tanggal = $this->input->get('tanggal', TRUE);
   $bulan  = $this->input->get('bulan', TRUE);
   $tahun = $this->input->get('tahun', TRUE);
   $j = $this->input->get('jenis_rekap');

   if ($j == "ph") {
     $data['rg'] = $this->rg_model->get_rg_report_perhari($tanggal);
     $data['get'] = "?jenis_rekap=".$j."&tanggal=".$tanggal;
     $this->load->view('report/laporan/rg_iframe',$data);
   }elseif($j == "pb"){
     $data['rg'] = $this->rg_model->get_rg_report_perbulan($bulan,$tahun);
     $data['get'] = "?jenis_rekap=".$j."&bulan=".$bulan."&tahun=".$tahun;
     $this->load->view('report/laporan/rg_iframe',$data);
   }elseif ($j == "pt") {
     $data['rg'] = $this->rg_model->get_rg_report_pertahun($tahun);
     $data['get'] = "?jenis_rekap=".$j."&tahun=".$tahun;
     $this->load->view('report/laporan/rg_iframe',$data);
   }else{
     $data['rg'] = $this->rg_model->get_rg_report();
     $data['get']= "";
     $this->load->view('report/laporan/rg_iframe',$data);
   }

 }

  public function data_rekap_barang()
  {
    $data['barang'] = $this->m_barang->get_data_all();
    return $data["barang"];
  }


  public function data_rekap_supplier()
  {
    $supplier = $this->m_supplier->get_data_report();
    return $supplier;
  }


  function get_pdf_barang()
  {
    header('Content-Type: application/pdf');
    $data['barang'] = $this->data_rekap_barang();
    $name_web = 'PURCHASE APP';
    $html = $this->load->view('report/pdf/barang',$data,TRUE);
    $pdf = $this->pdf->load();
    $pdf->setTitle('Laporan Data Barang');
    $pdf->SetHeader('Laporan Data Barang'.'||'.tgl_lengkap(date('Y-m-d')));
    $pdf->SetFooter($name_web.'|{PAGENO}|'.tgl_lengkap(date('Y-m-d')));
    $pdf->WriteHTML($html); // write the HTML into the PDF
    $pdf->Output('laporan-data-barang.pdf','I');
     // save to file because we can
  }

  function get_pdf_supplier()
  {
    header('Content-Type: application/pdf');
    $data['supplier'] = $this->data_rekap_supplier();
    $name_web = 'PURCHASE APP';
    $html = $this->load->view('report/pdf/supplier',$data,TRUE);
    $pdf = $this->pdf->load();
    $pdf->setTitle('Laporan Data Supplier');
    $pdf->SetHeader('Laporan Data Supplier'.'||'.tgl_lengkap(date('Y-m-d')));
    $pdf->SetFooter($name_web.'|{PAGENO}|'.tgl_lengkap(date('Y-m-d')));
    $pdf->WriteHTML($html); // write the HTML into the PDF
    $pdf->Output('laporan-data-supplier.pdf','I');
  }


  function get_pdf_pb()
  {
    header('Content-Type: application/pdf');

    $tanggal = $this->input->get('tanggal', TRUE);
    $bulan  = $this->input->get('bulan', TRUE);
    $tahun = $this->input->get('tahun', TRUE);
    $j = $this->input->get('jenis_rekap');

    if ($j == "ph") {
      $data['info'] = "Laporan Periode Tanggal : ".tgl_indo($tanggal);
      $data['pb'] = $this->pb_model->get_perhari_pb($tanggal);
    }elseif($j == "pb"){
      $data['info'] = "Laporan Periode Bulan : ".bulan($bulan).'-'.$tahun;
      $data['pb'] = $this->pb_model->get_perbulan_pb($bulan,$tahun);
    }elseif ($j == "pt") {
      $data['info'] = "Laporan Periode Tahun : ".$tahun;
      $data['pb'] = $this->pb_model->get_pertahun_pb($tahun);
    }else{
      $data['info'] = "";
      $data['pb'] = $this->pb_model->get_all_pb();
    }


    $name_web = 'PURCHASE APP';
    $html = $this->load->view('report/pdf/pb',$data,TRUE);
    $pdf = $this->pdf->load();
    $pdf->setTitle('Laporan Data Purchase Requestion');
    $pdf->SetHeader('Laporan Data Purchase Requestion'.'||'.tgl_lengkap(date('Y-m-d')));
    $pdf->SetFooter($name_web.'|{PAGENO}|'.tgl_lengkap(date('Y-m-d')));
    $pdf->WriteHTML($html); // write the HTML into the PDF
    $pdf->Output('laporan-data-purchase-requestion.pdf','I');

  }


  function get_pdf_po()
  {
    header('Content-Type: application/pdf');
    $tanggal = $this->input->get('tanggal', TRUE);
    $bulan  = $this->input->get('bulan', TRUE);
    $tahun = $this->input->get('tahun', TRUE);
    $j = $this->input->get('jenis_rekap');

    if ($j == "ph") {
      $data['info'] = "Laporan Periode Tanggal : ".tgl_indo($tanggal);
      $data['po'] = $this->po_model->get_perhari_po($tanggal);
    }elseif($j == "pb"){
      $data['info'] = "Laporan Periode Bulan : ".bulan($bulan)." - ".$tahun;
      $data['po'] = $this->po_model->get_perbulan_po($bulan,$tahun);
    }elseif ($j == "pt") {
      $data['info'] = "Laporan Periode Tahun : ".$tahun;
      $data['po'] = $this->po_model->get_pertahun_po($tahun);
    }else{
      $data['info'] = "";
      $data['po'] = $this->po_model->get_all_po();
    }

    $name_web = 'PURCHASE APP';
    $html = $this->load->view('report/pdf/po',$data,TRUE);
    $pdf = $this->pdf->load();
    $pdf->setTitle('Laporan Data Purchase Order');
    $pdf->SetHeader('Laporan Data Purchase Order'.'||'.tgl_lengkap(date('Y-m-d')));
    $pdf->SetFooter($name_web.'|{PAGENO}|'.tgl_lengkap(date('Y-m-d')));
    $pdf->WriteHTML($html); // write the HTML into the PDF
    $pdf->Output('laporan-data-purchase-order.pdf','I');
     // save to file because we can
  }

  function get_pdf_rg()
  {
    header('Content-Type: application/pdf');

    $tanggal = $this->input->get('tanggal', TRUE);
    $bulan  = $this->input->get('bulan', TRUE);
    $tahun = $this->input->get('tahun', TRUE);
    $j = $this->input->get('jenis_rekap');

    if ($j == "ph") {
      $data['rg'] = $this->rg_model->get_rg_report_perhari($tanggal);
      $data["info"] = "Laporan Periode Tanggal : ".tgl_indo($tanggal);
    }elseif($j == "pb"){
      $data['rg'] = $this->rg_model->get_rg_report_perbulan($bulan,$tahun);
      $data['info'] = "Laporan Periode Bulan : ".bulan($bulan)." - ".$tahun;
    }elseif ($j == "pt") {
      $data['rg'] = $this->rg_model->get_rg_report_pertahun($tahun);
      $data["info"] = "Laporan Periode Tahun : ".$tahun;
    }else{
      $data['rg'] = $this->rg_model->get_rg_report();
      $data['info']= "";
    }


    $name_web = 'PURCHASE APP';
    $html = $this->load->view('report/pdf/rg',$data,TRUE);
    $pdf = $this->pdf->load();
    $pdf->setTitle('Laporan Data Received Goods');
    $pdf->SetHeader('Laporan Data Received Goods'.'||'.tgl_lengkap(date('Y-m-d')));
    $pdf->SetFooter($name_web.'|{PAGENO}|'.tgl_lengkap(date('Y-m-d')));
    $pdf->WriteHTML($html); // write the HTML into the PDF
    $pdf->Output('laporan-data-receive-goods.pdf','I');
     // save to file because we can
  }



}
