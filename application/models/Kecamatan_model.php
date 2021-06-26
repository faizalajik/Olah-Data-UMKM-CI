<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan_model extends CI_Model{

	public function getKecamatan(){
		// return $this->db->get('kecamatan')->result();
		$this->db->select('*');
        $this->db->from('kecamatan');
        return $this->db->get()->result();
}
function get_kategori(){
    $hasil=$this->db->query("SELECT * FROM kecamatan");
    return $hasil;
  }
  function get_kategoriWilayah(){
      $this->db->select('*');
      $this->db->from('kecamatan');
     return $this->db->get()->result();    
  }
function get_kecamatanRekap($id){
      $this->db->select('*');
      $this->db->from('kecamatan');
      $this->db->where('id_kecamatan',$id);
     return $this->db->get()->result();    
  }
}