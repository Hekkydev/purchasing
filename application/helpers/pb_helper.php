<?php
if (!function_exists('unique_kode_pb')){
  function unique_kode_pb()
  {
    $th = date('Y');
    $CI =& get_instance();
    $CI->load->database();
           $q = $CI->db->query("select MAX(RIGHT(kode_pb,6)) as kd_max from t_pb");
           $kd = "";
           if($q->num_rows()>0)
           {
               foreach($q->result() as $k)
               {
                   $tmp = ((int)$k->kd_max)+1;
                   $kd = sprintf("%06s", $tmp);
               }
           }
           else
           {
               $kd = "001";
           }
           return "PB".$th.$kd;
  }
}


if (!function_exists('get_pb_temp')) {
  function get_pb_temp()
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('temp.id_item,t_items.item_nama,temp.qty,t_items.unique_kode,temp.id_temp');
    $CI->db->from('temp');
    $CI->db->join('t_items','t_items.id_item = temp.id_item','left');
    $CI->db->where(array('info'=>'pb'));
    $row = $CI->db->get();
    return $row->result();
  }
}

if (!function_exists('error_proses')) {
  function error_proses()
  {
    $CI =& get_instance();
    $data =  '<div id="info" class="modal show" role="dialog">
      <div class="modal-dialog" >

        <!-- Modal content-->
        <div class="modal-content" style="border-radius:5px;  border:1px solid; border-color:#ddd;">

          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12" align="center">

                <a href="'.site_url(base_akses().'pb/add').'" class="close" data-dismiss="modal">&times;</a>
                <h5><i class="fa fa-exclamation-triangle"></i> Pilih item terlebih dahulu jika menyimpan data !</h5>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>';
    return $data;
  }
}


if (!function_exists('material_item')) {
  function material_item_pb_detail($id)
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('*');
    $CI->db->from('t_pb_detail');
    $CI->db->join('t_items','t_items.id_item = t_pb_detail.id_item','left');
    $CI->db->join('t_items_atribut','t_items_atribut.id_item_atribut = t_items.id_item_atribut','left');
    $CI->db->where('t_pb_detail.kode_pb',$id);
    $row = $CI->db->get();
    return $row->result();
  }
}

if (!function_exists('material_item')) {
  function material_item($id)
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('DISTINCT(item_nama)');
    $CI->db->from('t_pb_detail');
    $CI->db->join('t_items','t_items.id_item = t_pb_detail.id_item','left');
    $CI->db->where('t_pb_detail.kode_pb',$id);
    $CI->db->limit(3);
    $row = $CI->db->get();
    return $row->result();
  }
}

if (!function_exists('jml_material_item')) {
  function jml_material_item($id)
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('SUM(t_pb_detail.qty) AS jml');
    $CI->db->from('t_pb_detail');
    $CI->db->join('t_items','t_items.id_item = t_pb_detail.id_item','left');
    $CI->db->where('t_pb_detail.kode_pb',$id);
    $row = $CI->db->get();
    return $row->row();
  }
}

if (!function_exists('material_item_data')) {
  function material_item_data($id)
  {
    $items = material_item($id);
    foreach ($items as $i) {
      echo '<i>'.$i->item_nama.'</i>  ,';
    }
  }
}


if (!function_exists('get_pb_detail')) {
  function get_pb_detail($id)
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('*');
    $CI->db->from('t_pb');
    $CI->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_pb.id_status_transaksi', 'left');
    $CI->db->where('id_pb',$id);
    $row = $CI->db->get();
    return $row->row();
  }
}


if (! function_exists('get_pb_detail_material'))
{
  function get_pb_detail_material($id)
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('*');
    $CI->db->from('t_pb_detail');
    $CI->db->join('t_pb','t_pb.kode_pb = t_pb_detail.kode_pb','left');
    $CI->db->join('t_items','t_items.id_item = t_pb_detail.id_item','left');
    $CI->db->where('t_pb_detail.kode_pb',$id);
    $row = $CI->db->get();
    return $row->result();
  }
}

if (! function_exists('label_status'))
{
  function label_status($id)
  {
    //print_r($id); die();
      if ($id == 1) {
        echo "label-warning";
      }else if($id == 2){
        echo "label-success";
      }else if($id == 3){
        echo "label-info";
      }
  }
}

if (! function_exists('status_pb'))
{
  function status_pb($id)
  {
      $CI =& get_instance();
      $CI->load->database();
      $CI->db->select('SUM(t_po_detail.qty_po) as total_po');
      $CI->db->from('t_po_detail');
      $CI->db->where('id_pb',$id);

      $row = $CI->db->get()->row();
      return $row;
  }
}



if (! function_exists('status_pb_2'))
{
  function status_pb_2($id)
  {
      $CI =& get_instance();
      $CI->load->database();
      $CI->db->select('SUM(t_pb_detail.qty) as total_pb');
      $CI->db->from('t_pb_detail');
      $CI->db->where('t_pb_detail.kode_pb',$id);

      $row = $CI->db->get()->row();
      return $row;
  }
}


if (!function_exists('pb_status_open')) {
  function pb_status_open()
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('*');
    $CI->db->from('t_pb');
    $CI->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_pb.id_status_transaksi', 'left');
    $CI->db->where('t_status_transaksi.id_status_transaksi',1);
    $row = $CI->db->get();
    return $row->result();
  }
}

if (!function_exists('pb_status_onproses')) {
  function pb_status_onproses()
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('*');
    $CI->db->from('t_pb');
    $CI->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_pb.id_status_transaksi', 'left');
    $CI->db->where('t_status_transaksi.id_status_transaksi',2);
    $row = $CI->db->get();
    return $row->result();
  }
}

if (!function_exists('pb_status_full')) {
  function pb_status_full()
  {
    $CI =& get_instance();
    $CI->load->database();
    $CI->db->select('*');
    $CI->db->from('t_pb');
    $CI->db->join('t_status_transaksi', 't_status_transaksi.id_status_transaksi = t_pb.id_status_transaksi', 'left');
    $CI->db->where('t_status_transaksi.id_status_transaksi',3);
    $row = $CI->db->get();
    return $row->result();
  }
}
