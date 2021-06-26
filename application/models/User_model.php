<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

public function login ($table,$where){
	$this->db->select('*');
	$this->db->from('user');
	$this->db->where($where);
	
		$query = $this->db->get();
        $num = $query->num_rows();
        return $num;
}
public function daftar($table,$data){
$this->db->insert($table,$data);
}
}