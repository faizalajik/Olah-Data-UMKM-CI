<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sektor_model extends CI_Model{

public function getSektor(){
	$this->db->select('*');
	$this->db->from('sektor');
	return $this->db->get()->result();
}
public function getSektorEdit($ids){
  $this->db->select('*');
  $this->db->from('sektor');
  $this->db->where('id_sektor',$ids);
  return $this->db->get()->result();
}
public function sektor(){
      $this ->db-> select ('*');
        $this->db->from('sektor');
         return $this->db->get()->result();     
    }
  public function edit($idr){
    $this ->db-> select ('*');
    $this->db->from('rekap');
    $this->db->where('id_rekap',$idr);
   return $this->db->get()->result(); 
  }

  public function searchSektor($select,$cari,$jenis,$kec,$tahun,$limit,$start){
       $array = array('desa.id_kecamatan' => $kec, 'sektor.nama_sektor' => $select, 'rekap.tahun' => $tahun);

      if (!empty($cari)){

       
        $this->db->select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        $this->db->join('kecamatan','desa.id_kecamatan = kecamatan.id_kecamatan');
      //  $this->db->where('desa.id_kecamatan',$kec);
        $this->db->where('sektor.nama_sektor',$select);
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
        $this->db->where('sektor.nama_sektor',$select);
        $this->db->where('kecamatan.id_kecamatan',$kec);
        $this->db->where('rekap.tahun',$tahun);


        $this->db->limit($limit,$start);


        return $this->db->get()->result();   
      }

      else{
     	 $array = array('desa.id_kecamatan' => $kec, 'sektor.nama_sektor' => $select, 'rekap.tahun' => $tahun);
        $this ->db-> select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        $this->db->join('kecamatan','desa.id_kecamatan = kecamatan.id_kecamatan');
        $this->db->where($array);
        $this->db->limit($limit,$start);

         return $this->db->get()->result();    
      }
     
       
    }
     public function jumlahPageSektor ($select,$kec,$tahun){
          	 $array = array('desa.id_kecamatan' => $kec, 'sektor.nama_sektor' => $select, 'rekap.tahun' => $tahun);
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
    public function jumlahPageSearchSektor ($select,$kec,$cari,$tahun,$jenis){
        $array = array('desa.id_kecamatan' => $kec, 'sektor.nama_sektor' => $select, 'rekap.tahun' => $tahun);
        
        $this->db->select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        $this->db->join('kecamatan','desa.id_kecamatan = kecamatan.id_kecamatan');
      //  $this->db->where('desa.id_kecamatan',$kec);
        $this->db->where('sektor.nama_sektor',$select);
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
        $this->db->where('sektor.nama_sektor',$select);
        $this->db->where('kecamatan.id_kecamatan',$kec);
        $this->db->where('rekap.tahun',$tahun);
        $query = $this->db->get();
        $num = $query->num_rows();
        return $num;
    }


}