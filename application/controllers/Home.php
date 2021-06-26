<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Sektor_model');
        $this->load->model('Model_data');
        $this->load->model('Desa_model');
        $this->load->model('Kecamatan_model');
        $this->load->model('User_model');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->library('pdf');
       
    }
    public function index(){
        if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }
         else{
        $this->load->view('view_home');}
    }

    public function editSektor(){
        if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }
         else{
            $kode = $this->input->get('kode');
            $this->session->set_userdata('kode', $kode);
            $idr = $this->input->get('idr');
            $idd = $this->input->get('idd');
            $data['data'] = $this->Sektor_model->edit($idr);
            foreach($data['data'] as $y);
            $data['sek']=$this->Sektor_model->getSektorEdit($y->id_sektor);
            $data['jusaha']=$this->Model_data->getJenisusahaEdit($y->id_jenisusaha);
            $data['kec']=$this->Desa_model->get_kecamatanEdit($idd);
            $data['sektor']=$this->Sektor_model->getsektor();
            $data['jenisusaha']=$this->Model_data->getJenisusaha();
            foreach($data['kec'] as $x);
            $data['kecdb']=$this->Kecamatan_model->get_kecamatanRekap($x->id_kecamatan);
            $data['kecamatan']=$this->Kecamatan_model->get_kategoriWilayah();
            $this->load->view('view_edit',$data);}

    }
    public function edit_aksi(){
         if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }else{
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $id_desa = $this->input->post('id_desa');
        $id_sektor = $this->input->post('id_sektor');
        $jenisusaha = $this->input->post('jenisusaha');
        $namausaha = $this->input->post('namausaha');
        $jumlahtk = $this->input->post('jumlahtk');
        $lokasiusaha = $this->input->post('lokasiusaha');
        $omset = $this->input->post('omset');
        $assets = $this->input->post('assets');
        $date = $this->input->post('tahun');
        $id_rekap = $this->input->post('id_rekap');;
        $data = array(
            'nama' => $nama,
            'alamat' => $alamat,
            'id_desa' => $id_desa,
            'id_sektor' => $id_sektor,
            'id_jenisusaha' => $jenisusaha,
            'tenaga_kerja' => $jumlahtk,
            'nama_usaha' => $namausaha,
            'lokasi_usaha' => $lokasiusaha,
            'omset' => $omset,
            'asset' => $assets,
            'tahun' => $date
            );

        $where = array(
        'id_rekap' => $id_rekap
        );
        $kode =  $this->session->userdata('kode');
        if ($kode == 1){
            $this->Model_data->update_data($where,$data,'rekap');    
        redirect('home\paginationSektor');}
        }
        if($kode == 2){
        $this->Model_data->update_data($where,$data,'rekap');    
        redirect('home\getSortDesa');}
        
    }

	public function home()
	{
        if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }
         else{
		$this->load->view('view_home');}
    }
    
public function LaporanRekap()
    {
         if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }else{
        $kec = $this->input->get('idk');
        $tahun = $this->session->userdata('tahun_rekap');
        $kcm = $this->session->userdata('kecamatan_rekap');
        $idkcm = $this->session->userdata('idkec_rekap');
        $no=0;
        $data['kecamatan']=$this->Kecamatan_model->get_kategoriWilayah();
        $data['sektor']=$this->Sektor_model->getSektor();
            $data['satu']=$this->Model_data->getRekap($idkcm,1,$tahun);
            $data['dua']=$this->Model_data->getRekap($idkcm,2,$tahun);
            $data['tiga']=$this->Model_data->getRekap($idkcm,3,$tahun);
            $data['empat']=$this->Model_data->getRekap($idkcm,4,$tahun);
            $data['lima']=$this->Model_data->getRekap($idkcm,5,$tahun);
            $data['enam']=$this->Model_data->getRekap($idkcm,6,$tahun);
            $data['tujuh']=$this->Model_data->getRekap($idkcm,7,$tahun);
            $data['delapan']=$this->Model_data->getRekap($idkcm,8,$tahun);
            $data['sembilan']=$this->Model_data->getRekap($idkcm,9,$tahun);
        
        $pdf = new FPDF('l',"cm",array(31.5,48));
       foreach($data['kecamatan'] as $x);
       foreach($data['satu'] as $satu);
        foreach($data['dua'] as $dua);
         foreach($data['tiga'] as $tiga);
        foreach($data['empat'] as $empat);
          foreach($data['lima'] as $lima);
        foreach($data['enam'] as $enam);
       foreach($data['tujuh'] as $tujuh);
         foreach($data['delapan'] as $delapan);
        foreach($data['sembilan'] as $sembilan);
        $pdf->SetMargins(5,2.5,2.5);
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',13);
        $pdf->Cell(0,1,"REKAP DATA JUMLAH UMKM KECAMATAN ".$kcm,0,0,'C');
        $pdf->ln(1);
        $pdf->Cell(0,1,"KABUPATEN BANYUMAS TAHUN ".$tahun,0,0,'C');
        $pdf->ln(1);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(6,1,"Di cetak pada : ".date("d/m/Y"),0,0,'C');
        $pdf->ln(1);
        $pdf->Cell(1, 2, 'No.', 1, 0, 'C');
        $pdf->Cell(8, 2, 'SEKTOR EKONOMI', 1, 0, 'C');
        $pdf->Cell(9, 1, 'JUMLAH UNIT USAHA', 1, 0, 'C');
        $pdf->Cell(7, 2, 'TOTAL UNIT USAHA', 1, 0, 'C');
        $pdf->Cell(9, 1, 'JUMLAH TENAGA KERJA', 1, 0, 'C');
        $pdf->Cell(7, 2, 'TOTAL TENAGA KERJA', 1, 0, 'C');

        $pdf->Cell(0, 1, '', 0, 1, 'C');
        $pdf->Cell(9, 1, '', 0, 0, 'C');
        $pdf->Cell(3, 1, 'MIKRO', 1, 0, 'C');
        $pdf->Cell(3, 1, 'KECIL', 1, 0, 'C');
        $pdf->Cell(3, 1, 'MENENGAH', 1, 0, 'C');
        $pdf->Cell(7, 1, '', 0, 0, 'C');
        $pdf->Cell(3, 1, 'MIKRO', 1, 0, 'C');
        $pdf->Cell(3, 1, 'KECIL', 1, 0, 'C');
        $pdf->Cell(3, 1, 'MENENGAH', 1, 1, 'C');
        foreach($data['satu'] as $satu);
        foreach($data['dua'] as $dua);
         foreach($data['tiga'] as $tiga);
        foreach($data['empat'] as $empat);
          foreach($data['lima'] as $lima);
        foreach($data['enam'] as $enam);
       foreach($data['tujuh'] as $tujuh);
         foreach($data['delapan'] as $delapan);
        foreach($data['sembilan'] as $sembilan);
         foreach($data['sektor'] as $sek){
            $no++;
            if($no==1){
                $jml_jnmikro1=$satu->mikro;
                            $jml_jnkecil1=$satu->kecil;
                            $jml_jnmenengah1=$satu->menengah;
                            $jml_jn1=$satu->mikro+$satu->kecil+$satu->menengah;
                            $jml_tkmikro1=$satu->mikrotk;
                            $jml_tkkecil1=$satu->keciltk;
                            $jml_tkmenengah1=$satu->menengahtk;
                            $jml_tk1=$satu->mikrotk+$satu->keciltk+$satu->menengahtk;
            $pdf->Cell(1, 1, $no, 1, 0, 'C');
            $pdf->Cell(8, 1, $sek->nama_sektor, 1, 0, 'L');
            $pdf->Cell(3, 1, $satu->mikro, 1, 0, 'C');
            $pdf->Cell(3, 1, $satu->kecil, 1, 0, 'C');
            $pdf->Cell(3, 1, $satu->menengah, 1, 0, 'C');
            $pdf->Cell(7, 1, $satu->mikro+$satu->kecil+$satu->menengah, 1, 0, 'C');
            $pdf->Cell(3, 1, $satu->mikrotk, 1, 0, 'C');
            $pdf->Cell(3, 1, $satu->keciltk, 1, 0, 'C');
            $pdf->Cell(3, 1, $satu->menengahtk, 1, 0, 'C');
            $pdf->Cell(7, 1, $satu->mikrotk+$satu->keciltk+$satu->menengahtk, 1, 1, 'C');
            }
            if($no==2){
                $jml_jnmikro2=$dua->mikro;
                            $jml_jnkecil2=$dua->kecil;
                            $jml_jnmenengah2=$dua->menengah;
                            $jml_jn2=$dua->mikro+$dua->kecil+$dua->menengah;
                            $jml_tkmikro2=$dua->mikrotk;
                            $jml_tkkecil2=$dua->keciltk;
                            $jml_tkmenengah2=$dua->menengahtk;
                            $jml_tk2=$dua->mikrotk+$dua->keciltk+$dua->menengahtk;
            $pdf->Cell(1, 1, $no, 1, 0, 'C');
            $pdf->Cell(8, 1, $sek->nama_sektor, 1, 0, 'L');
            $pdf->Cell(3, 1, $dua->mikro, 1, 0, 'C');
            $pdf->Cell(3, 1, $dua->kecil, 1, 0, 'C');
            $pdf->Cell(3, 1, $dua->menengah, 1, 0, 'C');
            $pdf->Cell(7, 1, $dua->mikro+$dua->kecil+$dua->menengah, 1, 0, 'C');
            $pdf->Cell(3, 1, $dua->mikrotk, 1, 0, 'C');
            $pdf->Cell(3, 1, $dua->keciltk, 1, 0, 'C');
            $pdf->Cell(3, 1, $dua->menengahtk, 1, 0, 'C');
            $pdf->Cell(7, 1, $dua->mikrotk+$dua->keciltk+$dua->menengahtk, 1, 1, 'C');
            }
            if($no==3){
                $jml_jnmikro3=$tiga->mikro;
                            $jml_jnkecil3=$tiga->kecil;
                            $jml_jnmenengah3=$tiga->menengah;
                            $jml_jn3=$tiga->mikro+$tiga->kecil+$tiga->menengah;
                            $jml_tkmikro3=$tiga->mikrotk;
                            $jml_tkkecil3=$tiga->keciltk;
                            $jml_tkmenengah3=$tiga->menengahtk;
                            $jml_tk3=$tiga->mikrotk+$tiga->keciltk+$tiga->menengahtk;
            $pdf->Cell(1, 1, $no, 1, 0, 'C');
            $pdf->Cell(8, 1, $sek->nama_sektor, 1, 0, 'L');
            $pdf->Cell(3, 1, $tiga->mikro, 1, 0, 'C');
            $pdf->Cell(3, 1, $tiga->kecil, 1, 0, 'C');
            $pdf->Cell(3, 1, $tiga->menengah, 1, 0, 'C');
            $pdf->Cell(7, 1, $tiga->mikro+$tiga->kecil+$tiga->menengah, 1, 0, 'C');
            $pdf->Cell(3, 1, $tiga->mikrotk, 1, 0, 'C');
            $pdf->Cell(3, 1, $tiga->keciltk, 1, 0, 'C');
            $pdf->Cell(3, 1, $tiga->menengahtk, 1, 0, 'C');
            $pdf->Cell(7, 1, $tiga->mikrotk+$tiga->keciltk+$tiga->menengahtk, 1, 1, 'C');
            }
            if($no==4){
                $jml_jnmikro4=$empat->mikro;
                            $jml_jnkecil4=$empat->kecil;
                            $jml_jnmenengah4=$empat->menengah;
                            $jml_jn4=$empat->mikro+$empat->kecil+$empat->menengah;
                            $jml_tkmikro4=$empat->mikrotk;
                            $jml_tkkecil4=$empat->keciltk;
                            $jml_tkmenengah4=$empat->menengahtk;
                            $jml_tk4=$empat->mikrotk+$empat->keciltk+$empat->menengahtk;
            $pdf->Cell(1, 1, $no, 1, 0, 'C');
            $pdf->Cell(8, 1, $sek->nama_sektor, 1, 0, 'L');
            $pdf->Cell(3, 1, $empat->mikro, 1, 0, 'C');
            $pdf->Cell(3, 1, $empat->kecil, 1, 0, 'C');
            $pdf->Cell(3, 1, $empat->menengah, 1, 0, 'C');
            $pdf->Cell(7, 1, $empat->mikro+$empat->kecil+$empat->menengah, 1, 0, 'C');
            $pdf->Cell(3, 1, $empat->mikrotk, 1, 0, 'C');
            $pdf->Cell(3, 1, $empat->keciltk, 1, 0, 'C');
            $pdf->Cell(3, 1, $empat->menengahtk, 1, 0, 'C');
            $pdf->Cell(7, 1, $empat->mikrotk+$empat->keciltk+$empat->menengahtk, 1, 1, 'C');
            }
            if($no==5){
                $jml_jnmikro5=$lima->mikro;
                            $jml_jnkecil5=$lima->kecil;
                            $jml_jnmenengah5=$lima->menengah;
                            $jml_jn5=$lima->mikro+$lima->kecil+$lima->menengah;
                            $jml_tkmikro5=$lima->mikrotk;
                            $jml_tkkecil5=$lima->keciltk;
                            $jml_tkmenengah5=$lima->menengahtk;
                            $jml_tk5=$lima->mikrotk+$lima->keciltk+$lima->menengahtk;
            $pdf->Cell(1, 1, $no, 1, 0, 'C');
            $pdf->Cell(8, 1, $sek->nama_sektor, 1, 0, 'L');
            $pdf->Cell(3, 1, $lima->mikro, 1, 0, 'C');
            $pdf->Cell(3, 1, $lima->kecil, 1, 0, 'C');
            $pdf->Cell(3, 1, $lima->menengah, 1, 0, 'C');
            $pdf->Cell(7, 1, $lima->mikro+$lima->kecil+$lima->menengah, 1, 0, 'C');
            $pdf->Cell(3, 1, $lima->mikrotk, 1, 0, 'C');
            $pdf->Cell(3, 1, $lima->keciltk, 1, 0, 'C');
            $pdf->Cell(3, 1, $lima->menengahtk, 1, 0, 'C');
            $pdf->Cell(7, 1, $lima->mikrotk+$lima->keciltk+$lima->menengahtk, 1, 1, 'C');
            }
            if($no==6){
                $jml_jnmikro6=$enam->mikro;
                            $jml_jnkecil6=$enam->kecil;
                            $jml_jnmenengah6=$enam->menengah;
                            $jml_jn6=$enam->mikro+$enam->kecil+$enam->menengah;
                            $jml_tkmikro6=$enam->mikrotk;
                            $jml_tkkecil6=$enam->keciltk;
                            $jml_tkmenengah6=$enam->menengahtk;
                            $jml_tk6=$enam->mikrotk+$enam->keciltk+$enam->menengahtk;
            $pdf->Cell(1, 1, $no, 1, 0, 'C');
            $pdf->Cell(8, 1, $sek->nama_sektor, 1, 0, 'L');
            $pdf->Cell(3, 1, $enam->mikro, 1, 0, 'C');
            $pdf->Cell(3, 1, $enam->kecil, 1, 0, 'C');
            $pdf->Cell(3, 1, $enam->menengah, 1, 0, 'C');
            $pdf->Cell(7, 1, $enam->mikro+$enam->kecil+$enam->menengah, 1, 0, 'C');
            $pdf->Cell(3, 1, $enam->mikrotk, 1, 0, 'C');
            $pdf->Cell(3, 1, $enam->keciltk, 1, 0, 'C');
            $pdf->Cell(3, 1, $enam->menengahtk, 1, 0, 'C');
            $pdf->Cell(7, 1, $enam->mikrotk+$enam->keciltk+$enam->menengahtk, 1, 1, 'C');
            }
            if($no==7){
                $jml_jnmikro7=$tujuh->mikro;
                            $jml_jnkecil7=$tujuh->kecil;
                            $jml_jnmenengah7=$tujuh->menengah;
                            $jml_jn7=$tujuh->mikro+$tujuh->kecil+$tujuh->menengah;
                            $jml_tkmikro7=$tujuh->mikrotk;
                            $jml_tkkecil7=$tujuh->keciltk;
                            $jml_tkmenengah7=$tujuh->menengahtk;
                            $jml_tk7=$tujuh->mikrotk+$tujuh->keciltk+$tujuh->menengahtk;
            $pdf->Cell(1, 1, $no, 1, 0, 'C');
            $pdf->Cell(8, 1, $sek->nama_sektor, 1, 0, 'L');
            $pdf->Cell(3, 1, $tujuh->mikro, 1, 0, 'C');
            $pdf->Cell(3, 1, $tujuh->kecil, 1, 0, 'C');
            $pdf->Cell(3, 1, $tujuh->menengah, 1, 0, 'C');
            $pdf->Cell(7, 1, $tujuh->mikro+$tujuh->kecil+$tujuh->menengah, 1, 0, 'C');
            $pdf->Cell(3, 1, $tujuh->mikrotk, 1, 0, 'C');
            $pdf->Cell(3, 1, $tujuh->keciltk, 1, 0, 'C');
            $pdf->Cell(3, 1, $tujuh->menengahtk, 1, 0, 'C');
            $pdf->Cell(7, 1, $tujuh->mikrotk+$tujuh->keciltk+$tujuh->menengahtk, 1, 1, 'C');
            }
            if($no==8){
                $jml_jnmikro8=$delapan->mikro;
                            $jml_jnkecil8=$delapan->kecil;
                            $jml_jnmenengah8=$satu->menengah;
                            $jml_jn8=$delapan->mikro+$delapan->kecil+$delapan->menengah;
                            $jml_tkmikro8=$delapan->mikrotk;
                            $jml_tkkecil8=$delapan->keciltk;
                            $jml_tkmenengah8=$delapan->menengahtk;
                            $jml_tk8=$delapan->mikrotk+$delapan->keciltk+$delapan->menengahtk;
            $pdf->Cell(1, 1, $no, 1, 0, 'C');
            $pdf->Cell(8, 1, $sek->nama_sektor, 1, 0, 'L');
            $pdf->Cell(3, 1, $delapan->mikro, 1, 0, 'C');
            $pdf->Cell(3, 1, $delapan->kecil, 1, 0, 'C');
            $pdf->Cell(3, 1, $delapan->menengah, 1, 0, 'C');
            $pdf->Cell(7, 1, $delapan->mikro+$delapan->kecil+$delapan->menengah, 1, 0, 'C');
            $pdf->Cell(3, 1, $delapan->mikrotk, 1, 0, 'C');
            $pdf->Cell(3, 1, $delapan->keciltk, 1, 0, 'C');
            $pdf->Cell(3, 1, $delapan->menengahtk, 1, 0, 'C');
            $pdf->Cell(7, 1, $delapan->mikrotk+$delapan->keciltk+$delapan->menengahtk, 1, 1, 'C');
            }
            if($no==9){
                $jml_jnmikro9=$sembilan->mikro;
                            $jml_jnkecil9=$sembilan->kecil;
                            $jml_jnmenengah9=$sembilan->menengah;
                            $jml_jn9=$sembilan->mikro+$sembilan->kecil+$sembilan->menengah;
                            $jml_tkmikro9=$sembilan->mikrotk;
                            $jml_tkkecil9=$sembilan->keciltk;
                            $jml_tkmenengah9=$sembilan->menengahtk;
                            $jml_tk9=$sembilan->mikrotk+$sembilan->keciltk+$sembilan->menengahtk;
            $pdf->Cell(1, 1, $no, 1, 0, 'C');
            $pdf->Cell(8, 1, $sek->nama_sektor, 1, 0, 'L');
            $pdf->Cell(3, 1, $sembilan->mikro, 1, 0, 'C');
            $pdf->Cell(3, 1, $sembilan->kecil, 1, 0, 'C');
            $pdf->Cell(3, 1, $sembilan->menengah, 1, 0, 'C');
            $pdf->Cell(7, 1, $sembilan->mikro+$sembilan->kecil+$sembilan->menengah, 1, 0, 'C');
            $pdf->Cell(3, 1, $sembilan->mikrotk, 1, 0, 'C');
            $pdf->Cell(3, 1, $sembilan->keciltk, 1, 0, 'C');
            $pdf->Cell(3, 1, $sembilan->menengahtk, 1, 0, 'C');
            $pdf->Cell(7, 1, $sembilan->mikrotk+$sembilan->keciltk+$sembilan->menengahtk, 1, 1, 'C');
            }
            
        }
        $jml_jnmikro=$jml_jnmikro1+$jml_jnmikro2+$jml_jnmikro3+$jml_jnmikro4+$jml_jnmikro5+$jml_jnmikro6+$jml_jnmikro7+$jml_jnmikro8+$jml_jnmikro9;
                    $jml_jnkecil=$jml_jnkecil1+$jml_jnkecil2+$jml_jnkecil3+$jml_jnkecil4+$jml_jnkecil5+$jml_jnkecil6+$jml_jnkecil7+$jml_jnkecil8+$jml_jnkecil9;
                    $jml_jnmenengah=$jml_jnmenengah1+$jml_jnmenengah2+$jml_jnmenengah3+$jml_jnmenengah4+$jml_jnmenengah5+$jml_jnmenengah6+$jml_jnmenengah7+$jml_jnmenengah8+$jml_jnmenengah9;
                    $jml_jn=$jml_jn1+$jml_jn2+$jml_jn3+$jml_jn4+$jml_jn5+$jml_jn6+$jml_jn7+$jml_jn8+$jml_jn9;
                    $jml_tkmikro=$jml_tkmikro1+$jml_tkmikro2+$jml_tkmikro3+$jml_tkmikro4+$jml_tkmikro5+$jml_tkmikro6+$jml_tkmikro7+$jml_tkmikro8+$jml_tkmikro9;
                    $jml_tkkecil=$jml_tkkecil1+$jml_tkkecil2+$jml_tkkecil3+$jml_tkkecil4+$jml_tkkecil5+$jml_tkkecil6+$jml_tkkecil7+$jml_tkkecil8+$jml_tkkecil9;
                    $jml_tkmenengah=$jml_tkmenengah1+$jml_tkmenengah2+$jml_tkmenengah3+$jml_tkmenengah4+$jml_tkmenengah5+$jml_tkmenengah6+$jml_tkmenengah7+$jml_tkmenengah8+$jml_tkmenengah9;
                    $jml_tk=$jml_tk1+$jml_tk2+$jml_tk3+$jml_tk4+$jml_tk5+$jml_tk6+$jml_tk7+$jml_tk8+$jml_tk9;
            $pdf->SetFont('Arial','B',13);
            $pdf->Cell(9, 1, 'TOTAL', 1, 0, 'C');
            $pdf->Cell(3, 1, $jml_jnmikro, 1, 0, 'C');
            $pdf->Cell(3, 1, $jml_jnkecil, 1, 0, 'C');
            $pdf->Cell(3, 1, $jml_jnmenengah, 1, 0, 'C');
            $pdf->Cell(7, 1, $jml_jn, 1, 0, 'C');
            $pdf->Cell(3, 1, $jml_tkmikro, 1, 0, 'C');
            $pdf->Cell(3, 1, $jml_tkkecil, 1, 0, 'C');
            $pdf->Cell(3, 1, $jml_tkmenengah, 1, 0, 'C');
            $pdf->Cell(7, 1, $jml_tk, 1, 1, 'C');
        $pdf->Output();
    }
    }
     public function getRekapKecamatan()
    {
        if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }
         else{
            $kec = $this->input->get('kecamatan');
            $tahun = $this->input->get('tahun');
            $this->session->set_userdata('tahun_rekap', $tahun);
            $this->session->set_userdata('idkec_rekap', $kec);
            $data['sektor']=$this->Sektor_model->getSektor();
            $data['satu']=$this->Model_data->getRekap($kec,1,$tahun);
            $data['dua']=$this->Model_data->getRekap($kec,2,$tahun);
            $data['tiga']=$this->Model_data->getRekap($kec,3,$tahun);
            $data['empat']=$this->Model_data->getRekap($kec,4,$tahun);
            $data['lima']=$this->Model_data->getRekap($kec,5,$tahun);
            $data['enam']=$this->Model_data->getRekap($kec,6,$tahun);
            $data['tujuh']=$this->Model_data->getRekap($kec,7,$tahun);
            $data['delapan']=$this->Model_data->getRekap($kec,8,$tahun);
            $data['sembilan']=$this->Model_data->getRekap($kec,9,$tahun);
            $data['status'] = 1;
            $data['kcm']=$this->Kecamatan_model->get_kecamatanRekap($kec);
            foreach($data['kcm'] as $x)
            $this->session->set_userdata('kecamatan_rekap', $x->nama_kecamatan);
            $data['kecamatan']=$this->Kecamatan_model->get_kategoriWilayah();
            $this->load->view('view_rekap',$data);}
    }
     public function Rekap()
    {
        if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }
         else{
            $data['status'] = 0;
            $data['kecamatan']=$this->Kecamatan_model->get_kategoriWilayah();
            $this->load->view('view_rekap',$data);}
    }


    public function viewUkm(){

        if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }
         else{
            $data['status'] = 0;
            $this->load->view('view_dataukm',$data);}
    }
    

    public function LaporanDesa()
    {
         if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }else{
        $id_desa = $this->input->get('idd');
        $no=0;
        $select = $this->session->userdata('sess_ringkasan');
        $kec = $this->session->userdata('sess_ringkasan1');
        $tahun = $this->session->userdata('sess_ringkasan3');
        $cari = $this->session->userdata('sess_ringkasan2');
        $jenis = $this->session->userdata('jenis');
        $data = $this->Desa_model->sortDesa($id_desa,$kec,$cari,$jenis,$tahun,null,null);
        //$data = $this->db->get()->result();
        $pdf = new FPDF('l',"cm",array(31.5,48));
        foreach($data as $x);

        $pdf->SetMargins(5,2.5,2.5);
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',12);
       // $pdf->Cell(0,1,"SEKTOR ".$x->nama_sektor." KECAMATAN ".$x->nama_kecamatan,0,0,'C');
       // $pdf->ln(1);
        $pdf->Cell(0,1,"KABUPATEN BANYUMAS TAHUN ".$x->tahun,0,0,'C');
        $pdf->ln(1);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(6,1,"Di cetak pada : ".date("d/m/Y"),0,0,'C');
        $pdf->ln(1);
        $pdf->Cell(1, 1, 'No.', 1, 0, 'C');
        $pdf->Cell(5.5, 1, 'Nama', 1, 0, 'C');
        $pdf->Cell(4, 1, 'Alamat', 1, 0, 'C');
        $pdf->Cell(4, 1, 'Sektor', 1, 0, 'C');
        $pdf->Cell(4, 1, 'Jenis Usaha', 1, 0, 'C');
        $pdf->Cell(4, 1, 'Tenaga Kerja', 1, 0, 'C');
        $pdf->Cell(5, 1, 'Nama Usaha', 1, 0, 'C');
        $pdf->Cell(5.5, 1, 'Lokasi Usaha', 1, 0, 'C');
        $pdf->Cell(4, 1, 'Omset (Rp)', 1, 0, 'C');
        $pdf->Cell(4, 1, 'Assets (Rp)', 1, 1, 'C');
        
        foreach ($data as $row){
            $no++;
            $pdf->Cell(1, 1, $no, 1, 0, 'C');
            $pdf->Cell(5.5, 1, $row->nama, 1, 0, 'C');
            $pdf->Cell(4, 1, $row->alamat, 1, 0, 'C');
            $pdf->Cell(4, 1, $row->nama_sektor, 1, 0, 'C');

            $pdf->Cell(4, 1, $row->jenis_usaha, 1, 0, 'C');
            $pdf->Cell(4, 1, $row->tenaga_kerja, 1, 0, 'C');
            $pdf->Cell(5, 1, $row->nama_usaha, 1, 0, 'C');
            $pdf->Cell(5.5, 1, $row->lokasi_usaha, 1, 0, 'C');
            $pdf->Cell(4, 1, $row->omset, 1, 0, 'C');
            $pdf->Cell(4, 1, $row->asset, 1, 1, 'C');
        }
        $pdf->Output();
    }
    }
    public function Laporan()
    {
         if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }else{
        $id_sektor = $this->input->get('ids');
        $id_desa = $this->input->get('idk');
        $no=0;
        $select = $this->session->userdata('sess_ringkasan');
        $kec = $this->session->userdata('sess_ringkasan1');
        $tahun = $this->session->userdata('sess_ringkasan3');
        $cari = $this->session->userdata('sess_ringkasan2');
        $jenis = $this->session->userdata('jenis');
        $data = $this->Sektor_model->searchSektor($select,$cari,$jenis,$kec,$tahun,null,null);

        $pdf = new FPDF('l',"cm",array(31.5,48));
        foreach($data as $x);

        $pdf->SetMargins(5,2.5,2.5);
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,1,"SEKTOR ".$x->nama_sektor." KECAMATAN ".$x->nama_kecamatan,0,0,'C');
        $pdf->ln(1);
        $pdf->Cell(0,1,"KABUPATEN BANYUMAS TAHUN ".$x->tahun,0,0,'C');
        $pdf->ln(1);
        $pdf->SetFont('Arial','B',11);
        $pdf->Cell(6,1,"Di cetak pada : ".date("d/m/Y"),0,0,'C');
        $pdf->ln(1);
        $pdf->Cell(1, 1, 'No.', 1, 0, 'C');
        $pdf->Cell(5.5, 1, 'Nama', 1, 0, 'C');
        $pdf->Cell(4, 1, 'Alamat', 1, 0, 'C');
        $pdf->Cell(4, 1, 'Desa', 1, 0, 'C');
        $pdf->Cell(4, 1, 'Jenis Usaha', 1, 0, 'C');
        $pdf->Cell(4, 1, 'Tenaga Kerja', 1, 0, 'C');
        $pdf->Cell(5, 1, 'Nama Usaha', 1, 0, 'C');
        $pdf->Cell(5.5, 1, 'Lokasi Usaha', 1, 0, 'C');
        $pdf->Cell(4, 1, 'Omset (Rp)', 1, 0, 'C');
        $pdf->Cell(4, 1, 'Assets (Rp)', 1, 1, 'C');
        
        foreach ($data as $row){
            $no++;
            $pdf->Cell(1, 1, $no, 1, 0, 'C');
            $pdf->Cell(5.5, 1, $row->nama, 1, 0, 'C');
            $pdf->Cell(4, 1, $row->alamat, 1, 0, 'C');
            $pdf->Cell(4, 1, $row->nama_desa, 1, 0, 'C');
            $pdf->Cell(4, 1, $row->jenis_usaha, 1, 0, 'C');
            $pdf->Cell(4, 1, $row->tenaga_kerja, 1, 0, 'C');
            $pdf->Cell(5, 1, $row->nama_usaha, 1, 0, 'C');
            $pdf->Cell(5.5, 1, $row->lokasi_usaha, 1, 0, 'C');
            $pdf->Cell(4, 1, $row->omset, 1, 0, 'C');
            $pdf->Cell(4, 1, $row->asset, 1, 1, 'C');
        }
        $pdf->Output();
    }
    }
    public function viewDataUkm(){
        if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
        }else{
            $state = 0;
            $cari = '';
        if (isset($_GET['cari'])){

            $state = 1;
            $cari = $this->input->get('cari');
            $this->session->set_userdata('state', $state);
            $this->session->set_userdata('cari', $cari);
            $tahun = $this->session->userdata('tahun');
            $config['total_rows'] = $this->Model_data->jumlahPageSearchData($cari,$tahun);
        }
        else if (isset($_GET['tahun'])){
                    $tahun = $this->input->get('tahun');
        $state = 2;
        $this->session->set_userdata('tahun', $tahun);
        $this->session->set_userdata('state', $state);
        $config['total_rows'] = $this->Model_data->jumlahPageData($tahun);
         //$cari =  $this->session->userdata('cari');
        }else {
            $state=3;

             $config['total_rows'] = $this->db->count_all('rekap');
             $tahun = $this->session->userdata('tahun');
             $state =  $this->session->userdata('state');

             
        }

        if ($state==1){
               $config['total_rows'] = $this->Model_data->jumlahPageSearchData($cari,$tahun);
                     $cari =  $this->session->userdata('cari');
        }
        elseif($state==2){
               $config['total_rows'] = $this->Model_data->jumlahPageData($tahun);
        }
        $config['base_url'] = site_url('home/viewDataUkm'); //site url
        //total row
        $config['per_page'] = 50;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 5;

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
       
        $this->pagination->initialize($config);

        $data['status']= $state;
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['pagination'] = $this->pagination->create_links();
        $data['ukm'] = $this->Model_data->showData($cari,$tahun,$config["per_page"], $data['page']);
        $this->load->view('view_dataukm',$data);
    }
    }

    public function tambah_aksi(){
         if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }else{
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $id_desa = $this->input->post('id_desa');
        $id_sektor = $this->input->post('id_sektor');
        $jenisusaha = $this->input->post('jenisusaha');
        $namausaha = $this->input->post('namausaha');
        $jumlahtk = $this->input->post('jumlahtk');
        $lokasiusaha = $this->input->post('lokasiusaha');
        $omset = $this->input->post('omset');
        $assets = $this->input->post('assets');
        $date = date('Y');
        $id_rekap =null;
        $data = array(
            'id_rekap' => $id_rekap,
            'nama' => $nama,
            'alamat' => $alamat,
            'id_desa' => $id_desa,
            'id_sektor' => $id_sektor,
            'id_jenisusaha' => $jenisusaha,
            'tenaga_kerja' => $jumlahtk,
            'nama_usaha' => $namausaha,
            'lokasi_usaha' => $lokasiusaha,
            'omset' => $omset,
            'asset' => $assets,
            'tahun' => $date
            );
        echo $id_desa, $id_sektor, $jenisusaha;
        if ($id_desa == 0 || $id_sektor == 0 || $jenisusaha == 0){
            $this->session->set_flashdata('msg', 
                '<div class="alert alert-success">
                    <h4>Gagal </h4>
                    <p>Input Gagal.</p>
                </div>');    
        redirect('home\inputUkm','view_inputukm');
        }else{
        $pesan = $this->Model_data->input_data($data,'rekap');
         $this->session->set_flashdata('msg', 
                '<div class="alert alert-success">
                    <h4>Berhasil </h4>
                    <p>'.$pesan.'.</p>
                </div>');    
        redirect('home\inputUkm','view_inputukm');}
        }
    }
     public function inputUkm(){
         if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }else{
        $x['sektor']=$this->Sektor_model->getsektor();
        $x['jenisusaha']=$this->Model_data->getJenisusaha();
        $x['data']=$this->Kecamatan_model->get_kategoriWilayah();
        $this->load->view('view_inputukm',$x);
    }
    }
    public function viewSortDesa(){
         if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }else{
         $x['kec']=$this->Kecamatan_model->get_kategoriWilayah();
         $x['status'] = 0;
        $this->load->view('view_desa',$x);}
    }
    public function getSortDesa(){
         if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }else{
            $data['status'] = 1;

            $state = 0;
            $cari='';
             $idd = $this->input->get('idd');
         if (isset($_GET['kecamatan'])) {
                $state = 1;
                $desa = $this->input->get('desa');
                $kec = $this->input->get('kecamatan');
                $cari = $this->input->get('cari');
                $tahun = $this->input->get('tahun');
              
                $this->session->set_userdata('sess_ringkasan', $desa);
                $this->session->set_userdata('sess_ringkasan1', $kec);
                $this->session->set_userdata('sess_ringkasan3', $tahun);
                $this->session->set_userdata('state', $state);
                $jenis = $this->session->userdata('jenis');
                $this->session->set_userdata('sess_ringkasan2',null);
                $data['jum'] = $this->Desa_model->jumlahSortDesa($desa,$tahun);
                $config['total_rows'] = $data['jum'] ;             
                
        }elseif(isset($_GET['cari'])){
            $cari = $this->input->get('cari');
              $jenis = $this->input->get('jenis');
            $desa = $this->session->userdata('sess_ringkasan');
            $kec = $this->session->userdata('sess_ringkasan1');
            $tahun = $this->session->userdata('sess_ringkasan3');
          
            $this->session->set_userdata('sess_ringkasan2', $cari);
            $this->session->set_userdata('jenis', $jenis);
            $data['jum'] = $this->Desa_model->jumlahSearchDesa($desa,$kec,$cari,$tahun,$jenis);
            $config['total_rows'] = $data['jum'] ;
            $state = 2;
            $this->session->set_userdata('state', $state);
        }
        elseif($idd!=''){
            
        $where = array('id_desa' => $idd); 
        $this->Model_data->hapus_Viadesa($where,'rekap');
         $desa = $this->session->userdata('sess_ringkasan');
                $kec = $this->session->userdata('sess_ringkasan1');
                $state = $this->session->userdata('state');
                $tahun = $this->session->userdata('sess_ringkasan3');
                $jenis = $this->session->userdata('jenis');
        }
        else{
                $desa = $this->session->userdata('sess_ringkasan');
                $kec = $this->session->userdata('sess_ringkasan1');
                $state = $this->session->userdata('state');
                $tahun = $this->session->userdata('sess_ringkasan3');
                $jenis = $this->session->userdata('jenis');

        }
        
        if ($state==1){
                $data['jum'] = $this->Desa_model->jumlahSortDesa($desa,$tahun);
                $config['total_rows'] = $data['jum'];
        }
        elseif($state==2){
                $cari = $this->session->userdata('sess_ringkasan2');
                $data['jum'] = $this->Desa_model->jumlahSearchDesa($desa,$kec,$cari,$tahun,$jenis);
                $config['total_rows'] = $data['jum'];
        }
        $config['base_url'] = site_url('index.php/home/getSortDesa'); //site url

        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
       
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['per_page'] = 50;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        // $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 5;
        $data['kec']=$this->Kecamatan_model->get_kategoriWilayah();
        $data['des']=$this->Desa_model->sortDesa($desa,$kec,$cari,$jenis,$tahun,$config["per_page"], $data['page']);

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('view_desa',$data);}
  }
   
    public function listDesa(){
        $id=$this->input->post('id');
        $data=$this->Desa_model->get_subkategori($id);
        echo json_encode($data);
  }
    public function viewSektor(){
         if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }else{
        $data['status'] = 0;
        $data['sek'] = $this->Sektor_model->getsektor();
        $data['data']=$this->Kecamatan_model->get_kategoriWilayah();
        $this->load->view('view_sektor',$data);}
    }
    public function sektor(){
         if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }else{
        $select = $this->input->get('select');
        $data['status'] = 1;
        $data['rek'] = $this->Sektor_model->searchSektor($select);
        $data['sek'] = $this->Sektor_model->getsektor();
        $data['data']=$this->Kecamatan_model->get_kategoriWilayah();
        $this->load->view('view_sektor',$data);
    }
    }
    public function paginationSektor(){
         if ($this->session->userdata('login')==null) {
          $this->load->view('login');
       
         }else{
            $state = 0;
            $cari='';
             $jenis='';
             $idr = $this->input->get('idr');
         if (isset($_GET['select'])) {
                $state = 1;
                $select = $this->input->get('select');
                $kec = $this->input->get('kecamatan');
                $tahun = $this->input->get('tahun');
                $cari = $this->input->get('cari');
                $this->session->set_userdata('sess_ringkasan3', $tahun);
                $this->session->set_userdata('sess_ringkasan', $select);
                $this->session->set_userdata('sess_ringkasan1', $kec);
                $this->session->set_userdata('state', $state);
                 $this->session->set_userdata('sess_ringkasan2', null);
        //        $cari = $this->session->userdata('sess_ringkasan2');\
                $data['jum'] = $this->Sektor_model->jumlahPageSektor($select,$kec,$tahun);
                $config['total_rows'] = $data['jum'] ;    
        }elseif(isset($_GET['cari'])){
            $cari = $this->input->get('cari');
               $jenis = $this->input->get('jenis');
            $select = $this->session->userdata('sess_ringkasan');
            $kec = $this->session->userdata('sess_ringkasan1');
            $tahun = $this->session->userdata('sess_ringkasan3');
            
            $this->session->set_userdata('sess_ringkasan2', $cari);
             $this->session->set_userdata('jenis', $jenis);
            $data['jum'] = $this->Sektor_model->jumlahPageSearchSektor($select,$kec,$cari,$tahun,$jenis);
            $config['total_rows'] = $data['jum'] ;
            $state = 2;

            $this->session->set_userdata('state', $state);
        }
        elseif ($idr!=''){
        $where = array('id_rekap' => $idr); 
        $this->Model_data->hapus_Viasektor($where,'rekap');
        $select = $this->session->userdata('sess_ringkasan');
                $kec = $this->session->userdata('sess_ringkasan1');
                $state = $this->session->userdata('state');
                $tahun = $this->session->userdata('sess_ringkasan3');
                $cari = $this->session->userdata('sess_ringkasan2');
                $jenis = $this->session->userdata('jenis');
        }
        else{
                $select = $this->session->userdata('sess_ringkasan');
                $kec = $this->session->userdata('sess_ringkasan1');
                $state = $this->session->userdata('state');
                $tahun = $this->session->userdata('sess_ringkasan3');
                $cari = $this->session->userdata('sess_ringkasan2');
                $jenis = $this->session->userdata('jenis');
            
        }
        
        if ($state==1){
                $data['jum'] = $this->Sektor_model->jumlahPageSektor($select,$kec,$tahun);
                $config['total_rows'] = $data['jum'];
        }
        elseif($state==2){
                $cari = $this->session->userdata('sess_ringkasan2');
                $data['jum'] = $this->Sektor_model->jumlahPageSearchSektor($select,$kec,$cari,$tahun,$jenis);
                $config['total_rows'] = $data['jum'];
        }
        $config['base_url'] = site_url('index.php/home/paginationSektor'); //site url
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
       
        $data['page'] =$this->uri->segment(3);
        $config['per_page'] = 50;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        // $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = 5;
       
                $data['rek'] = $this->Sektor_model->searchSektor($select,$cari,$jenis,$kec,$tahun,$config["per_page"], $data['page']);
                $data['data']= $this->Kecamatan_model->get_kategoriWilayah();
                $data['sek'] = $this->Sektor_model->getsektor();
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model.
        
        $this->pagination->initialize($config);
        $data['status'] = 1;
        $data['pagination'] = $this->pagination->create_links();
        //load view mahasiswa view
        $this->load->view('view_sektor',$data);
        }
        
    }
    public function logout(){
        $status = null;
        $this->session->set_userdata('login',$status);
        $this->load->view('login');
    }
   public function login (){
        $username = $this->input->post('username');
        $password=  $this->input->post('password');

        $where = array(
                'username' => $username,
                'password' => $password
                );
        $cek = $this->User_model->login("user",$where);
        if ($cek>0) {
            $data_session = $username;
            $status = 1;
            $this->session->set_userdata('user',$data_session);
            $this->session->set_userdata('login',$status);
 
           $this->load->view('view_home');
        }
        else{
            redirect('home\index');
        }
    }

        public function daftar(){
        $this->load->view('daftar');
    }
    public function inputDaftar(){
        $nama =  $this->input->post('nama');
        $username =  $this->input->post('username');
        $password =  $this->input->post('password');
        $data = array(
            'nama' => $nama,
            'username' => $username,
            'password' => $password
            );
        $this->User_model->daftar("user",$data);
         $this->load->view('login');
    }
}