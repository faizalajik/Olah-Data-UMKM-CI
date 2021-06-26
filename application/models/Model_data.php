<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_data extends CI_Model {
    public function showDataSeluruh($limit,$start){
        $this ->db-> select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        $this->db->limit($limit,$start); 
        return $this->db->get()->result();  
    }

    public function getRekap($id_kecamatan,$id_sektor,$tahun){
        $this ->db-> select ('COUNT(IF( id_jenisusaha = 1,id_jenisusaha,null)) AS mikro,COUNT(IF( id_jenisusaha = 2,id_jenisusaha,null)) AS kecil,COUNT(IF( id_jenisusaha=3,id_jenisusaha,null)) AS menengah,SUM(IF( id_jenisusaha = 1,tenaga_kerja,0)) AS mikrotk,sum(IF( id_jenisusaha = 2,tenaga_kerja,0)) AS keciltk,sum(IF( id_jenisusaha=3,tenaga_kerja,0)) AS menengahtk');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('kecamatan','kecamatan.id_kecamatan = desa.id_kecamatan');
        $this->db->where('desa.id_kecamatan',$id_kecamatan);
        $this->db->where('rekap.id_sektor',$id_sektor);
        $this->db->where('rekap.tahun',$tahun);
        return $this->db->get()->result(); 
    }

    public function showData($cari,$tahun,$limit,$start){
        if (!empty($cari)) {
        $this ->db-> select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        $this->db->like('rekap.nama_usaha',$cari);
        $this->db->or_like('rekap.nama',$cari);
        $this->db->or_like('desa.nama_desa',$cari);
        $this->db->where('rekap.tahun',$tahun);
        $this->db->limit($limit,$start);
        }

        else if (!empty($tahun)){
        $this ->db-> select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        $this->db->where('rekap.tahun',$tahun);
        $this->db->limit($limit,$start);
        }
        else{
        $this ->db-> select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        $this->db->limit($limit,$start); 
        }
        return $this->db->get()->result();     
    }
    function jumlahPageData ($tahun){
       
        if ($tahun=='semua'){
        $this->db->select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        }else{
        $this->db->select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        $this->db->like('rekap.tahun',$tahun);
        }

        $query = $this->db->get();
        $num = $query->num_rows();
        return $num;
    }
    function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
        
    }
     function jumlahPageSearchData ($cari,$tahun){
        $this->db->select ('*');
        $this->db->from('rekap');
        $this->db->join('desa','desa.id_desa = rekap.id_desa');
        $this->db->join('jenis_usaha','jenis_usaha.id_jenisusaha = rekap.id_jenisusaha');
        $this->db->join('sektor','sektor.id_sektor = rekap.id_sektor');
        $this->db->like('rekap.nama_usaha',$cari);
        $this->db->or_like('rekap.nama',$cari);
        $this->db->or_like('desa.nama_desa',$cari);
        $this->db->where('rekap.tahun',$tahun);

        $query = $this->db->get();
        $num = $query->num_rows();
        return $num;
    }
    
  function input_data($data,$table){
    $q=$this->db->insert($table,$data);
    if ($q==''){
    $pesan = 'Input Data Gagal';        
    }else{
       $pesan = 'Input Data Berhasil';     
    }
    return $pesan;
  }
  
 public function sektor(){
      $this ->db-> select ('*');
        $this->db->from('sektor');
         return $this->db->get()->result();     
    }
    public function getJenisusaha(){
      $this ->db-> select ('*');
        $this->db->from('jenis_usaha');
         return $this->db->get()->result();     
    }
    public function getJenisusahaEdit($idj){
      $this ->db-> select ('*');
        $this->db->from('jenis_usaha');
        $this->db->where('id_jenisusaha',$idj);
         return $this->db->get()->result();     
    }
    function hapus_Viasektor($where,$table){
    $this->db->where($where);
    $this->db->delete($table);
  }
  function hapus_Viadesa($where,$table){
    $this->db->where($where);
    $this->db->delete($table);
  }
}
?>