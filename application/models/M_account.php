<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_account extends CI_Model{

  function get_all()
  {
    $this->db->select('*');
    $this->db->from('t_users');
    $this->db->join('t_group', 't_group.id_group = t_users.id_group', 'left');
    return $this->db->get()->result();
  }

}
