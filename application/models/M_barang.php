
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_barang extends CI_Model {

	function get_data($num,$offset)
	{
		$this->db->select('*');
		$this->db->from('t_items');
		$this->db->join('t_items_atribut', 't_items_atribut.id_item_atribut = t_items.id_item_atribut', 'left');
		$this->db->join('t_items_category', 't_items_category.id_item_category = t_items.id_item_category', 'left');
		$this->db->order_by('t_items.id_item', 'desc');
		$this->db->limit($num, $offset);
		$row = $this->db->get();
		return $row->result();
	}


	function get_data_all()
	{
		$this->db->select('*');
		$this->db->from('t_items');
		$this->db->join('t_items_atribut', 't_items_atribut.id_item_atribut = t_items.id_item_atribut', 'left');
		$this->db->join('t_items_category', 't_items_category.id_item_category = t_items.id_item_category', 'left');
		$this->db->order_by('t_items.id_item', 'desc');
		$row = $this->db->get();
		return $row->result();
	}

}



/* End of file M_barang.php */
/* Location: ./application/models/M_barang.php */
