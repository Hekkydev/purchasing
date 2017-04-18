
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_supplier extends CI_Model {

	function get_data($num,$offset)
	{

			$this->db->select('*');
			$this->db->from('t_supplier');
	    $this->db->order_by('id_supplier','DESC');
	    $this->db->limit($num,$offset);
	    $row = $this->db->get();
	    return   $row->result();

	}


	function get_data_report()
	{
			$this->db->select('*');
			$this->db->from('t_supplier');
			$this->db->order_by('id_supplier','DESC');
			$row = $this->db->get();
			return   $row->result();
	}

}
