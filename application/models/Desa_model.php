<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desa_model extends CI_Model{

	public function viewByKecamatan($id_kecamatan){
	$hasil=$this->db->query("SELECT * FROM desa WHERE id_kecamatan='$id_kecamatan'");
		return $hasil->result();
	}
	   function sortDesa($id,$kec,$cari,$jenis,$tahun,$limit,$start){
	   	 $array = array('desa.id_kecamatan' => $kec, 'desa.id_desa' => $id, 'rekap.tahun'=>$tahun);

	   	  if (!empty($cari)){

       $this->db->select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        $this->db->join('kecamatan','desa.id_kecamatan = kecamatan.id_kecamatan');
      //  $this->db->where('desa.id_kecamatan',$kec);
        $this->db->where('desa.id_desa',$id);
        $this->db->where('kecamatan.id_kecamatan',$kec);
        $sub = $this->db->_compile_select();
        $this->db->_reset_select();

        $this->db->select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        $this->db->join('kecamatan','desa.id_kecamatan = kecamatan.id_kecamatan');
        if ($jenis=="1"){
             $this->db->like('rekap.nama',$cari);
         }else{
              $this->db->or_like('rekap.nama_usaha',$cari);
         }
        $this->db->where_in($sub);
        $this->db->where('desa.id_desa',$id);
        $this->db->where('kecamatan.id_kecamatan',$kec);
        $this->db->where('rekap.tahun',$tahun);
        $this->db->limit($limit,$start);

        return $this->db->get()->result();   
      }else{
        $this ->db-> select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        $this->db->join('kecamatan','desa.id_kecamatan = kecamatan.id_kecamatan');
        $this->db->where($array);
        $this->db->limit($limit,$start);
        return $this->db->get()->result();    }
  }
    function jumlahSortDesa($id,$tahun){
     $array = array('desa.id_desa' => $id, 'rekap.tahun'=>$tahun);
   		$this ->db-> select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        $this->db->join('kecamatan','desa.id_kecamatan = kecamatan.id_kecamatan');
        $this->db->where($array);
         $query = $this->db->get();
        $num = $query->num_rows();
        return $num;
}
function jumlahSearchDesa($id,$kec,$cari,$tahun,$jenis){
	 $this->db->select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        $this->db->join('kecamatan','desa.id_kecamatan = kecamatan.id_kecamatan');
      //  $this->db->where('desa.id_kecamatan',$kec);
        $this->db->where('desa.id_desa',$id);
        $this->db->where('kecamatan.id_kecamatan',$kec);
        $sub = $this->db->_compile_select();
        $this->db->_reset_select();

        $this->db->select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        $this->db->join('kecamatan','desa.id_kecamatan = kecamatan.id_kecamatan');
            if ($jenis=="1"){
             $this->db->like('rekap.nama',$cari);
         }else{
              $this->db->or_like('rekap.nama_usaha',$cari);
         }
        $this->db->where_in($sub);
        $this->db->where('desa.id_desa',$id);
        $this->db->where('kecamatan.id_kecamatan',$kec);
        $this->db->where('rekap.tahun',$tahun);

        $query = $this->db->get();
        $num = $query->num_rows();
        return $num;
}
function get_subkategori($id){
    $hasil=$this->db->query("SELECT * FROM desa WHERE id_kecamatan='$id'");
    return $hasil->result();
  }
    function get_kecamatanEdit($id){
      $this->db->select('*');
      $this->db->from('desa');
      $this->db->where('id_desa',$id);
     return $this->db->get()->result();    
  }

}