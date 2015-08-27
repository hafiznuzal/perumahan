<?php
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */


class create_pdf extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
        $this->load->library("Pdf");
        $this->load->library("tcpdf/tcpdf");
        $this->load->helper('url');
        $this->load->library('session');
        if(!$this->session->userdata('logged_in')){
          redirect(site_url()."login");
        }
    }

 
  public function rekapitulasi_pembangunan_kecamatan_pdf($tahun,$periode) {

      /// create new PDF document
      $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $pdf->SetCreator(PDF_CREATOR);
      $pdf->SetAuthor('Dinas PU CKTR Sidoarjo');
      $pdf->SetTitle('Rekapitulasi_Pembangunan_Perkecamatan_Triwulan'.$periode.'_'.$tahun);
      $pdf->SetSubject('TCPDF');
      $pdf->SetKeywords('TCPDF, PDF');
      $pdf->SetHeaderData('sidoardjo.png', 20, 'PEMERINTAH KABUPATEN SIDOARDJO', 'DINAS PEKERJAAN UMUM CIPTA KARYA DAN TATA RUANG','REKAPITULASI DATA PEMBANGUNAN RUMAH' );
      $pdf->setFooterData('Tahun '.$tahun);
      $pdf->setBarcode(date('Y-m-d H:i:s'));

      // // set default header data
      // $pdf->SetHeaderData('sidoardjo.png', 20, 'PEMERINTAH KABUPATEN SIDOARDJO', 'DINAS PEKERJAAN UMUM CIPTA KARYA DAN TATA RUANG' );

      // set header and footer fonts
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

      // set default monospaced font
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

      // set margins
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

      // set auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

      // set image scale factor
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

      // set some language-dependent strings (optional)
      if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
          require_once(dirname(__FILE__).'/lang/eng.php');
          $pdf->setLanguageArray($l);
      }

      // ---------------------------------------------------------

      // set font
      $pdf->SetFont('helvetica', 'B', 20);
      // add a page
      $pdf->AddPage('L','A3');
      // $pdf->Write(0, 'PEMBANGUNAN PERUMAHAN / PEMUKIMAN', '', 0, 'C', true, 0, false, false, 0);
      // $pdf->Write(0, 'REKAPITULASI DATA PEMBANGUNAN RUMAH', '', 0, 'C', true, 0, false, false, 0);
      $pdf->SetFont('helvetica', '', 11);
      // $pdf->Write(0, 'Tahun :'  .$tahun, '', 0, 'L', true, 0, false, false, 0);
      // $pdf->Write(0, 'Periode : Triwulan' .$periode, '', 0, 'L', true, 0, false, false, 0);
      //line
      $pdf->SetLineWidth(5);
      $pdf->SetDrawColor(0,128,255);
      $pdf->SetFillColor(255,255,128);
      // -----------------------------------------------------------------------------

      // -----------------------------------------------------------------------------
      $tb="";
      $tb1="";
      $this->load->model('m_report');
          $data= $this->m_report->tabel_pembangunan_kecamatan_all($tahun,$periode);
          $data1= $this->m_report->tabel_jumlah_pem_kec($tahun,$periode);
          $k=1;
          foreach ($data as $i){  
              $tb .= "<tr>
              <td width=\"28px\">".$k."</td>
              <td width=\"180px\">".$i['NAMA_KECAMATAN']."</td>
              <td width=\"106px\">".$i['JML_LOKASI']." </td>
              <td width=\"79px\">".$i['RENC_RSS']." </td>
              <td width=\"79px\">".$i['RENC_RS']." </td>
              <td width=\"79px\">".$i['RENC_RM']." </td>
              <td width=\"79px\">".$i['RENC_MW']." </td>
              <td width=\"79px\">".$i['RENC_RUKO']." </td>
              <td width=\"79px\">".$i['REAL_RSS']." </td>
              <td width=\"79px\">".$i['REAL_RS']." </td>
              <td width=\"79px\">".$i['REAL_RM']." </td>
              <td width=\"79px\">".$i['REAL_MW']." </td>
              <td width=\"79px\">".$i['REAL_RUKO']." </td>
              <td width=\"114px\">".$i['CATATAN']." </td>  
            </tr> ";
            $k++;
          }

          foreach ($data1 as $i){  
              $tb1 .= "<tr>
             
              <td width=\"210px\">JUMLAH</td>
              <td width=\"106px\">".$i['JML_LOKASI']." </td>
              <td width=\"79px\">".$i['RENC_RSS']." </td>
              <td width=\"79px\">".$i['RENC_RS']." </td>
              <td width=\"79px\">".$i['RENC_RM']." </td>
              <td width=\"79px\">".$i['RENC_MW']." </td>
              <td width=\"79px\">".$i['RENC_RUKO']." </td>
              <td width=\"79px\">".$i['REAL_RSS']." </td>
              <td width=\"79px\">".$i['REAL_RS']." </td>
              <td width=\"79px\">".$i['REAL_RM']." </td>
              <td width=\"79px\">".$i['REAL_MW']." </td>
              <td width=\"79px\">".$i['REAL_RUKO']." </td>
              <td width=\"114px\">  </td>  
            </tr> ";
            $k++;
          }

      $tbl = <<<EOD
      <table border="1" cellpadding="2" cellspacing="2">
      <thead>
       <tr style="background-color:#FFFF00;color:#0000FF;">
        <td width="28px" align="center"><b>NO</b></td>
        <td width="180px" align="center"><b>KECAMATAN</b></td>
        <td width="106px" align="center"><b>JUMLAH LOKASI PERUMAHAN</b></td>
        <td width="79px" align="center"> <b>RENCANA RS</b></td>
        <td width="79px" align="center"><b>RENCANA RSS</b></td>
        <td width="79px" align="center"><b>RENCANA RM</b></td>
        <td width="79px" align="center"><b>RENCANA MW</b></td>
        <td width="79px" align="center"><b>RENCANA RUKO</b></td>
        <td width="79px" align="center"><b>REALISASI RS</b></td>
        <td width="79px" align="center"><b>REALISASI RSS</b></td>
        <td width="79px" align="center"><b>REALISASI RM</b></td>
        <td width="79px" align="center"><b>REALISASI MW</b></td>
        <td width="79px" align="center"><b>REALISASI RUKO</b></td>
        <td width="114px" align="center"><b>CATATAN</b></td>
       </tr>
      </thead>
       $tb $tb1
      </table>
EOD;
      $pdf->writeHTML($tbl, true, false, false, false, '');

     $tb="";
          $tb1="";
          $this->load->model('m_report');
          $data1= $this->m_report->tabel_pembangunan_kecamatan_all_statistic($tahun-1);
          $data2= $this->m_report->tabel_pembangunan_kecamatan_all_statistic($tahun-2);
          $k=1;
          foreach ($data2 as $i){  
              
                $tb .= 
                    "<tr>  
                                
                  <td width=\"320px\">RSS  : TYPE 21-27
                  <br>RS    : TYPE 36-70
                  <br>RM    : TYPE 70-125
                  <br>MW  : TYPE >125
                  <br>RUKO
                  </td>
                  <td width=\"106px\">".$i['RENC_RSS']."
                  <br>".$i['RENC_RS']."
                  <br>".$i['RENC_RM']."
                  <br>".$i['RENC_MW']."
                  <br>".$i['RENC_RUKO']."
                  </td>" ;}
          foreach ($data1 as $i){
                  $tb .="
                  <td width=\"106px\">".$i['RENC_RSS']."
                  <br>".$i['RENC_RS']."
                  <br>".$i['RENC_RM']."
                  <br>".$i['RENC_MW']."
                  <br>".$i['RENC_RUKO']."
                  </td>";}
          foreach ($data2 as $i){  
                   $tb .="
                  <td width=\"106px\">".$i['REAL_RSS']."
                  <br>".$i['REAL_RS']."
                  <br>".$i['REAL_RM']."
                  <br>".$i['REAL_MW']."
                  <br>".$i['REAL_RUKO']."
                  </td>";}
          foreach ($data1 as $i){
                  $tb .="
                  <td width=\"106px\">".$i['REAL_RSS']."
                  <br>".$i['REAL_RS']."
                  <br>".$i['REAL_RM']."
                  <br>".$i['REAL_MW']."
                  <br>".$i['REAL_RUKO']."
                  </td>        
                </tr> ";
                
                }
      $th1=$tahun-1;
      $th2=$tahun-2;
      $tbl = <<<EOD
      <table border="1" cellpadding="2" cellspacing="2">
      <thead>
       <tr style="background-color:#FFFF00;color:#0000FF;">
        
        <td width="320px" align="center"><b>TYPE RUMAH</b></td>
        <td width="106px " align="center"> <b>(Rencana)<br>DES $th2</b></td>     
        <td width="106px " align="center"> <b>(Rencana)<br>DES $th1</b></td>
        <td width="106px " align="center"> <b>(Realisasi)<br>DES $th2</b></td>     
        <td width="106px " align="center"> <b>(Realisasi)<br>DES $th1</b></td>
       </tr>
      </thead>
       $tb $tb1
      </table>
EOD;

//print_r($tbl);
      $pdf->writeHTML($tbl, true, false, false, false, '');

      // -----------------------------------------------------------------------------
      //Close and output PDF document
      $pdf->Output('Rekapitulasi_Pembangunan_Perkecamatan_Triwulan'.$periode.'_'.$tahun.'.pdf', 'I');

      // -----------------------------------------------------------------------------
      }


public function report_lahan_perkecamatan_pdf($id,$tahun,$periode) {

      /// create new PDF document
      $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
       $this->load->model('m_report');
       $datakec= $this->m_report->get_kecamatan($id);
       foreach ($datakec as $i){
        $getkecamatan = $i['NAMA_KECAMATAN'];
        }
      // set document information
     $pdf->SetCreator(PDF_CREATOR);
      $pdf->SetAuthor('Dinas PU CKTR Sidoarjo');
      $pdf->SetTitle('Report_Lahan_Perkecamatan_'.$getkecamatan.'_Triwulan'.$periode.'_'.$tahun);
      $pdf->SetSubject('TCPDF');
      $pdf->SetKeywords('TCPDF, PDF');

      // set default header data
      $pdf->SetHeaderData('sidoardjo.png', 20, 'PEMERINTAH KABUPATEN SIDOARDJO', 'DINAS PEKERJAAN UMUM CIPTA KARYA DAN TATA RUANG','DATA LAHAN PERUMAHAN / PERMUKIMAN ('.$getkecamatan.")" );
      $pdf->setFooterData('Triwulan '.$periode.' Tahun '.$tahun);
      $pdf->setBarcode(date('Y-m-d H:i:s'));
      // set header and footer fonts
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

      // set default monospaced font
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

      // set margins
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

      // set auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

      // set image scale factor
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

      // set some language-dependent strings (optional)
      if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
          require_once(dirname(__FILE__).'/lang/eng.php');
          $pdf->setLanguageArray($l);
      }

      // ---------------------------------------------------------

      // set font
      $pdf->SetFont('helvetica', 'B', 20);
      // add a page
      $pdf->AddPage('L','A3');
      // $pdf->Write(0, 'PEMBANGUNAN PERUMAHAN / PERMUKIMAN', '', 0, 'C', true, 0, false, false, 0);
      // $pdf->Write(0, 'DATA LAHAN PERUMAHAN / PERMUKIMAN', '', 0, 'C', true, 0, false, false, 0);
      
      $pdf->SetFont('helvetica', '', 11);
      // $pdf->Write(0, 'Tahun :'  .$tahun, '', 0, 'L', true, 0, false, false, 0);
      // $pdf->Write(0, 'Periode : Triwulan' .$periode, '', 0, 'L', true, 0, false, false, 0);
      // $pdf->Write(0, 'Kecamatan :'  .$getkecamatan, '', 0, 'L', true, 0, false, false, 0);

      $pdf->SetLineWidth(5);
      $pdf->SetDrawColor(0,128,255);
      $pdf->SetFillColor(255,255,128);
      // -----------------------------------------------------------------------------

      // -----------------------------------------------------------------------------
      $tb="";
      $this->load->model('m_report');
          $data= $this->m_report->lahan_perkecamatan_value($id,$tahun,$periode);
          $k=1;
          foreach ($data as $i){  
              $tb .= "<tr>
              <td width=\"28px\">".$k."</td>
              <td width=\"320px\">Nama Perusahaan :".$i['NAMA_PERUSAHAAN']."
              <br>Pimpinan :".$i['PIMPINAN']."
              <br>Alamat :".$i['ALAMAT']."
              <br>Telepon :".$i['TELP']."
              <br>Fax :".$i['FAX']."
              </td>              
              <td width=\"106px\">".$i['NAMA_LOKASI']." </td>
              <td width=\"59px\">".$i['LOKASI_TGL']." </td>
              <td width=\"59px\">".$i['LUAS']." </td>
              <td width=\"59px\">".$i['RENCANA_TAPAK']." </td>
              <td width=\"59px\">".$i['PEMBEBASAN']." </td>
              <td width=\"59px\">".$i['TERBANGUN']." </td>
              <td width=\"59px\">".$i['BELUM_TERBANGUN']." </td>
              <td width=\"59px\">".$i['DIALOKASIKAN']." </td>
              <td width=\"59px\">".$i['PEMBEBASAN']." </td>
              <td width=\"59px\">".$i['SUDAH_DIMATANGKAN']." </td>
              <td width=\"114px\">".$i['CATATAN']." </td>
              <td width=\"59px\">".$i['AKTIF_DLM_PEMBANGUNAN']." </td>
              <td width=\"59px\">".$i['AKTIF_BERHENTI']." </td>  
              <td width=\"59px\">".$i['AKTIF_SDH_SELESAI']." </td>  
              <td width=\"59px\">".$i['TIDAK_AKTIF']." </td>    
            </tr> ";
            $k++;
          }

      $tbl = <<<EOD
      <table border="1" cellpadding="2" cellspacing="2">
      <thead>
       <tr style="background-color:#FFFF00;color:#0000FF;">
        <td width="28px" align="center"><b>NO</b></td>
        <td width="320px" align="center"><b>PENGEMBANG / PELAKSANA PEMBANGUNAN PERUMAHAN</b></td>
        <td width="106px " align="center"> <b>LOKASI</b></td>
        <td width="59px" align="center"><b>LOKASI TGL/NO</b></td>
        <td width="59px" align="center"><b>LUAS (Ha)</b></td>
        <td width="59px" align="center"><b>RENCANA TAPAK (Ha)</b></td>
        <td width="59px" align="center"><b>PEMBEBASAN (Ha)</b></td>
        <td width="59px" align="center"><b>TERBANGUN (Ha)</b></td>
        <td width="59px" align="center"><b>BELUM TERBANGUN (Ha)</b></td>
        <td width="59px" align="center"><b>DIALOKASIKAN</b></td>
        <td width="59px" align="center"><b>PEMBEBASAN</b></td>
        <td width="59px" align="center"><b>SUDAH DIMATANGKAN</b></td>
        <td width="114px" align="center"><b>CATATAN (PERPANJANGAN IJIN LOKASI)</b></td>
        <td width="59px" align="center"><b>AKTIF DALAM PEMBANGUNAN</b></td>
        <td width="59px" align="center"><b>AKTIF BERHENTI</b></td>
        <td width="59px" align="center"><b>AKTIF SUDAH SELESAI</b></td>
        <td width="59px" align="center"><b>TIDAK AKTIF</b></td>
       </tr>
      </thead>
       $tb
      </table>
EOD;
      $pdf->writeHTML($tbl, true, false, false, false, '');

      // -----------------------------------------------------------------------------
      //Close and output PDF document
      $pdf->Output('Report_Lahan_Perkecamatan_'.$getkecamatan.'_Triwulan'.$periode.'_'.$tahun.'.pdf', 'I');

      // -----------------------------------------------------------------------------
      }

public function report_pembangunan_perkecamatan_pdf($id,$tahun,$periode) {

      /// create new PDF document

      $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
       $this->load->model('m_report');
       $datakec= $this->m_report->get_kecamatan($id);
       foreach ($datakec as $i){
        $getkecamatan = $i['NAMA_KECAMATAN'];
        }
        //print_r($getkecamatan);
      // set document information
     $pdf->SetCreator(PDF_CREATOR);
      $pdf->SetAuthor('Dinas PU CKTR Sidoarjo');
      $pdf->SetTitle('Report_Pembangunan_Perkecamatan_'.$getkecamatan.'_Triwulan'.$periode.'_'.$tahun);
      $pdf->SetSubject('TCPDF');
      $pdf->SetKeywords('TCPDF, PDF');


      $pdf->SetHeaderData('sidoardjo.png', 20, 'PEMERINTAH KABUPATEN SIDOARDJO', 'DINAS PEKERJAAN UMUM CIPTA KARYA DAN TATA RUANG','DATA PEMBANGUNAN RUMAH ('.$getkecamatan.")" );
      $pdf->setFooterData('Triwulan '.$periode.' Tahun '.$tahun);
      $pdf->setBarcode(date('Y-m-d H:i:s'));
      // set header and footer fonts
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

      // set default monospaced font
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

      // set margins
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

      // set auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

      // set image scale factor
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

      // set some language-dependent strings (optional)
      if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
          require_once(dirname(__FILE__).'/lang/eng.php');
          $pdf->setLanguageArray($l);
      }

      // ---------------------------------------------------------

      // set font
      $pdf->SetFont('helvetica', 'B', 20);
      // add a page
      $pdf->AddPage('L','A3');
      // $pdf->Write(0, 'PEMBANGUNAN PERUMAHAN / PEMUKIMAN', '', 0, 'C', true, 0, false, false, 0);
      // $pdf->Write(0, 'DATA PEMBANGUNAN RUMAH', '', 0, 'C', true, 0, false, false, 0);
      
      $pdf->SetFont('helvetica', '', 11);
      // $pdf->Write(0, 'Tahun :'  .$tahun, '', 0, 'L', true, 0, false, false, 0);
      // $pdf->Write(0, 'Periode : Triwulan' .$periode, '', 0, 'L', true, 0, false, false, 0);
      // $pdf->Write(0, 'Kecamatan :'  .$getkecamatan, '', 0, 'L', true, 0, false, false, 0);


      $pdf->SetLineWidth(5);
      $pdf->SetDrawColor(0,128,255);
      $pdf->SetFillColor(255,255,128);
      // -----------------------------------------------------------------------------

      // -----------------------------------------------------------------------------
      $tb="";
      $this->load->model('m_report');
          $data= $this->m_report->tabel_report_kecamatan_value($id,$tahun,$periode);
          $k=1;
          foreach ($data as $i){  
              $tb .= "<tr>
              <td width=\"28px\">".$k."</td>
              <td width=\"320px\">Nama Perusahaan :".$i['NAMA_PERUSAHAAN']."
              <br>Pimpinan :".$i['PIMPINAN']."
              <br>Alamat :".$i['ALAMAT']."
              <br>Telepon :".$i['TELP']."
              <br>Fax :".$i['FAX']."
              </td>              
              <td width=\"150px\">".$i['LOKASI']." </td>
              <td width=\"59px\">".$i['RENC_RSS']." </td>
              <td width=\"59px\">".$i['RENC_RS']." </td>
              <td width=\"59px\">".$i['RENC_RM']." </td>
              <td width=\"59px\">".$i['RENC_MW']." </td>
              <td width=\"59px\">".$i['RENC_RUKO']." </td>
              <td width=\"59px\">".$i['REAL_RSS']." </td>
              <td width=\"59px\">".$i['REAL_RS']." </td>
              <td width=\"59px\">".$i['REAL_RM']." </td>
              <td width=\"59px\">".$i['REAL_MW']." </td>
              <td width=\"59px\">".$i['REAL_RUKO']." </td>
              <td width=\"150px\">".$i['CATATAN']." </td>
              
            </tr> ";
            $k++;
          }

      $tbl = <<<EOD
      <table border="1" cellpadding="2" cellspacing="2">
      <thead>
       <tr style="background-color:#FFFF00;color:#0000FF;">
        <td width="28px" align="center"><b>NO</b></td>
        <td width="320px" align="center"><b>PERUSAHAAN</b></td>
        <td width="150px " align="center"> <b>LOKASI</b></td>
        <td width="59px" align="center"><b>RS</b></td>
        <td width="59px" align="center"><b>RSS (Ha)</b></td>
        <td width="59px" align="center"><b>RM</b></td>
        <td width="59px" align="center"><b>MW (Ha)</b></td>
        <td width="59px" align="center"><b>RUKO (Ha)</b></td>
        <td width="59px" align="center"><b>RS (Ha)</b></td>
        <td width="59px" align="center"><b>RSS</b></td>
        <td width="59px" align="center"><b>RM</b></td>
        <td width="59px" align="center"><b>MW</b></td>
        <td width="59px" align="center"><b>RUKO</b></td>
        <td width="150px" align="center"><b>CATATAN</b></td>   
       </tr>
      </thead>
       $tb
      </table>
EOD;
      $pdf->writeHTML($tbl, true, false, false, false, '');

      // -----------------------------------------------------------------------------
      //Close and output PDF document
      $pdf->Output('Report_Pembangunan_Perkecamatan_'.$getkecamatan.'_Triwulan'.$periode.'_'.$tahun.'.pdf', 'I');

      // -----------------------------------------------------------------------------
      }

public function report_pembangunan_pdf($tahun) {

      /// create new PDF document
      $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      $pdf->SetCreator(PDF_CREATOR);
      $pdf->SetAuthor('Dinas PU CKTR Sidoarjo');
      $pdf->SetTitle('Report_Pembangunan_Kabupaten_Sidoarjo_'.$tahun);
      $pdf->SetSubject('TCPDF');
      $pdf->SetKeywords('TCPDF, PDF');

      $pdf->SetHeaderData('sidoardjo.png', 20, 'PEMERINTAH KABUPATEN SIDOARDJO', 'DINAS PEKERJAAN UMUM CIPTA KARYA DAN TATA RUANG','REKAPITULASI DATA PEMBANGUNAN RUMAH' );
      $pdf->setFooterData(' Tahun '.$tahun);
      $pdf->setBarcode(date('Y-m-d H:i:s'));
      // set header and footer fonts
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

      // set default monospaced font
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

      // set margins
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

      // set auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

      // set image scale factor
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

      // set some language-dependent strings (optional)
      if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
          require_once(dirname(__FILE__).'/lang/eng.php');
          $pdf->setLanguageArray($l);
      }

      // ---------------------------------------------------------

      // set font
      $pdf->SetFont('helvetica', 'B', 20);
      // add a page
      $pdf->AddPage('L','A3');
      // $pdf->Write(0, 'PEMBANGUNAN PERUMAHAN / PEMUKIMAN', '', 0, 'C', true, 0, false, false, 0);
      // $pdf->Write(0, 'REKAPITULASI DATA PEMBANGUNAN RUMAH', '', 0, 'C', true, 0, false, false, 0);
      
      $pdf->SetFont('helvetica', '', 11);
      // $pdf->Write(0, 'Tahun :'  .$tahun, '', 0, 'L', true, 0, false, false, 0);
      
      $pdf->SetLineWidth(5);
      $pdf->SetDrawColor(0,128,255);
      $pdf->SetFillColor(255,255,128);
      // -----------------------------------------------------------------------------

      // -----------------------------------------------------------------------------
      $tb="";
      $this->load->model('proyek_model');
          $data= $this->proyek_model->get_data_pembangunan_periode($tahun);
          $k=1;
          foreach ($data as $i){  
              $tb .= "<tr>
              <td width=\"28px\">".$k."</td>
              <td width=\"150px\">".$i['nama_kecamatan']."</td>              
              <td width=\"150px\">".$i['nama_perusahaan']." </td>
              <td width=\"150px\">".$i['nama_perumahan']." </td>
              <td width=\"150px\">".$i['nama_lokasi']." </td>
              <td width=\"59px\">".$i['renc_rss']." </td>
              <td width=\"59px\">".$i['renc_rs']." </td>
              <td width=\"59px\">".$i['renc_rm']." </td>
              <td width=\"59px\">".$i['renc_mw']." </td>
              <td width=\"59px\">".$i['renc_ruko']." </td>
              <td width=\"59px\">".$i['real_rss']." </td>
              <td width=\"59px\">".$i['real_rs']." </td>
              <td width=\"59px\">".$i['real_rm']." </td>
              <td width=\"59px\">".$i['real_mw']." </td>
              <td width=\"59px\">".$i['real_ruko']." </td>
              <td width=\"114px\">".$i['catatan']." </td>
              
            </tr> ";
            $k++;
          }

      $tbl = <<<EOD
      <table border="1" cellpadding="2" cellspacing="2">
      <thead>
       <tr style="background-color:#FFFF00;color:#0000FF;">
        <td width="28px" align="center"><b>NO</b></td>
        <td width="150px" align="center"><b>Kecamatan</b></td>
        <td width="150px " align="center"> <b>Perusahaan</b></td>
        <td width="150px" align="center"><b>Nama Perumahaan</b></td>
        <td width="150px" align="center"><b>Nama Lokasi (Ha)</b></td>
        <td width="59px" align="center"><b>Rencana RSS</b></td>
        <td width="59px" align="center"><b>Rencana RS (Ha)</b></td>
        <td width="59px" align="center"><b>Rencana RM (Ha)</b></td>
        <td width="59px" align="center"><b>Rencana MW (Ha)</b></td>
        <td width="59px" align="center"><b>Rencana Ruko</b></td>
        <td width="59px" align="center"><b>Realisasi RSS</b></td>
        <td width="59px" align="center"><b>Realisasi RS</b></td>
        <td width="59px" align="center"><b>Realisasi RM</b></td>
        <td width="59px" align="center"><b>Realisasi MW</b></td>
        <td width="59px" align="center"><b>Realisasi RUKO</b></td>
        <td width="114px" align="center"><b>CATATAN</b></td>   
       </tr>
      </thead>
       $tb
      </table>
EOD;
      $pdf->writeHTML($tbl, true, false, false, false, '');

       



       $tb="";
          $tb1="";
          $this->load->model('m_report');
          $data1= $this->m_report->tabel_statistik2_rencana($tahun-1);
          $data1rs= $this->m_report->tabel_statistik2_realisasi($tahun-1);
          $data2= $this->m_report->tabel_statistik2_rencana($tahun-2);
          $data2rs= $this->m_report->tabel_statistik2_realisasi($tahun-2);
          $k=1;
          foreach ($data2 as $i){  
              
                $tb .= 
                    "<tr>  
                                
                  <td width=\"320px\">RSS  : TYPE 21-27
                  <br>RS    : TYPE 36-70
                  <br>RM    : TYPE 70-125
                  <br>MW  : TYPE >125
                  <br>RUKO
                  </td>
                  <td width=\"106px\">".$i['RENC_RSS']."
                  <br>".$i['RENC_RS']."
                  <br>".$i['RENC_RM']."
                  <br>".$i['RENC_MW']."
                  <br>".$i['RENC_RUKO']."
                  </td>" ;}
          foreach ($data1 as $i){
                  $tb .="
                  <td width=\"106px\">".$i['RENC_RSS']."
                  <br>".$i['RENC_RS']."
                  <br>".$i['RENC_RM']."
                  <br>".$i['RENC_MW']."
                  <br>".$i['RENC_RUKO']."
                  </td>";}
          foreach ($data2rs as $i){  
                   $tb .="
                  <td width=\"106px\">".$i['REAL_RSS']."
                  <br>".$i['REAL_RS']."
                  <br>".$i['REAL_RM']."
                  <br>".$i['REAL_MW']."
                  <br>".$i['REAL_RUKO']."
                  </td>";}
          foreach ($data1rs as $i){
                  $tb .="
                  <td width=\"106px\">".$i['REAL_RSS']."
                  <br>".$i['REAL_RS']."
                  <br>".$i['REAL_RM']."
                  <br>".$i['REAL_MW']."
                  <br>".$i['REAL_RUKO']."
                  </td>        
                </tr> ";
                
                }
      $th1=$tahun-1;
      $th2=$tahun-2;
      $tbl = <<<EOD
      <table border="1" cellpadding="2" cellspacing="2">
      <thead>
       <tr style="background-color:#FFFF00;color:#0000FF;">
        
        <td width="320px" align="center"><b>TYPE RUMAH</b></td>
        <td width="106px " align="center"> <b>(Rencana)<br>DES $th2</b></td>     
        <td width="106px " align="center"> <b>(Rencana)<br>DES $th1</b></td>
        <td width="106px " align="center"> <b>(Realisasi)<br>DES $th2</b></td>     
        <td width="106px " align="center"> <b>(Realisasi)<br>DES $th1</b></td>
       </tr>
      </thead>
       $tb $tb1
      </table>
EOD;

//print_r($tbl);
      $pdf->writeHTML($tbl, true, false, false, false, ''); 


     
      // -----------------------------------------------------------------------------
      //Close and output PDF document
      $pdf->Output('Report_Pembangunan_Kabupaten_Sidoarjo_'.$tahun.'.pdf', 'I');

      // -----------------------------------------------------------------------------
      } 

      public function report_lahan_pdf($tahun) {

      /// create new PDF document
      $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      $pdf->SetCreator(PDF_CREATOR);
      $pdf->SetAuthor('Dinas PU CKTR Sidoarjo');
      $pdf->SetTitle('Report_Lahan_Kabupaten_Sidoarjo_'.$tahun);
      $pdf->SetSubject('TCPDF');
      $pdf->SetKeywords('TCPDF, PDF');

      // set default header data
      $pdf->SetHeaderData('sidoardjo.png', 20, 'PEMERINTAH KABUPATEN SIDOARDJO', 'DINAS PEKERJAAN UMUM CIPTA KARYA DAN TATA RUANG','REKAPITULASI DATA LAHAN PERUMAHAN / PEMUKIMAN' );
      $pdf->setFooterData('Tahun '.$tahun);
      $pdf->setBarcode(date('Y-m-d H:i:s'));
      // set header and footer fonts
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

      // set default monospaced font
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

      // set margins
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

      // set auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

      // set image scale factor
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

      // set some language-dependent strings (optional)
      if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
          require_once(dirname(__FILE__).'/lang/eng.php');
          $pdf->setLanguageArray($l);
      }

      // ---------------------------------------------------------

      // set font
      $pdf->SetFont('helvetica', 'B', 20);
      // add a page
      $pdf->AddPage('L','A3');
      // $pdf->Write(0, 'PEMBANGUNAN PERUMAHAN / PEMUKIMAN', '', 0, 'C', true, 0, false, false, 0);
      // $pdf->Write(0, 'REKAPITULASI DATA LAHAN PERUMAHAN / PEMUKIMAN', '', 0, 'C', true, 0, false, false, 0);
      
      $pdf->SetFont('helvetica', '', 11);
      // $pdf->Write(0, 'Tahun :'  .$tahun, '', 0, 'L', true, 0, false, false, 0);

      $pdf->SetLineWidth(5);
      $pdf->SetDrawColor(0,128,255);
      $pdf->SetFillColor(255,255,128);
      // -----------------------------------------------------------------------------

      // -----------------------------------------------------------------------------
      $tb="";
      $this->load->model('proyek_model');
      $data= $this->proyek_model->get_data_lokasi_periode($tahun);
          $k=1;
          foreach ($data as $i){  
              $tb .= "<tr>
              <td width=\"28px\">".$k."</td>
              <td width=\"100px\">".$i['nama_kecamatan']."</td>              
              <td width=\"100px\">".$i['nama_perusahaan']." </td>
              <td width=\"100px\">".$i['nama_perumahan']." </td>
              <td width=\"100px\">".$i['nama_lokasi']." </td>
              <td width=\"59px\">".$i['lokasi_no']." </td>
              <td width=\"59px\">".$i['lokasi_tgl']." </td>
              <td width=\"59px\">".$i['luas']." </td>
              <td width=\"59px\">".$i['rencana_tapak']." </td>
              <td width=\"59px\">".$i['pembebasan']." </td>
              <td width=\"59px\">".$i['terbangun']." </td>
              <td width=\"59px\">".$i['belum_terbangun']." </td>
              <td width=\"59px\">".$i['fs_dialokasikan']." </td>
              <td width=\"59px\">".$i['fs_pembebasan']." </td>
              <td width=\"59px\">".$i['fs_sudah_dimatangkan']." </td>
              <td width=\"100px\">".$i['catatan']." </td>
              <td width=\"59px\">".$i['aktif_dlm_pembangunan']." </td>
              <td width=\"59px\">".$i['aktif_berhenti']." </td>
              <td width=\"59px\">".$i['aktif_sdh_selesai']." </td>
              <td width=\"59px\">".$i['tidak_aktif']." </td>
              
            </tr> ";
            $k++;
          }

      $tbl = <<<EOD
      <table border="1" cellpadding="2" cellspacing="2">
      <thead>
       <tr style="background-color:#FFFF00;color:#0000FF;">
        <td width="28px" align="center"><b>NO</b></td>
        <td width="100px" align="center"><b>Kecamatan</b></td>
        <td width="100px " align="center"> <b>Perusahaan</b></td>
        <td width="100px" align="center"><b>Nama Perumahaan</b></td>
        <td width="100px" align="center"><b>Nama Lokasi (Ha)</b></td>
        <td width="59px" align="center"><b>No Lokasi</b></td>
        <td width="59px" align="center"><b>Tanggal Lokasi Dimiliki</b></td>
        <td width="59px" align="center"><b>Luas Lokasi</b></td>
        <td width="59px" align="center"><b>Rencana Tapak</b></td>
        <td width="59px" align="center"><b>Pembebasan</b></td>
        <td width="59px" align="center"><b>Terbangun</b></td>
        <td width="59px" align="center"><b>Belum Terbangun</b></td>
        <td width="59px" align="center"><b>Dialokasikan</b></td>
        <td width="59px" align="center"><b>Pembebasan</b></td>
        <td width="59px" align="center"><b>Sudah Dimatangkan</b></td>
        <td width="100px" align="center"><b>Catatan</b></td>
        <td width="59px" align="center"><b>Aktif dalam Pembangunan</b></td>
        <td width="59px" align="center"><b>Aktif Berhenti</b></td>
        <td width="59px" align="center"><b>Aktif Sudah Selesai</b></td>
        <td width="59px" align="center"><b>Tidak Aktif</b></td>
        

       </tr>
      </thead>
       $tb
      </table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$tb="";
          $tb1="";
          $this->load->model('m_report');
          $data1 = $this->m_report->tabel_statistik1($tahun-1);
          $data2 = $this->m_report->tabel_statistik1($tahun-2);
          
          foreach ($data2 as $i){  
              
                $tb .= 
                    "<tr>  
                                
                  <td width=\"320px\">JUMLAH PENGEMBANG
                  <br>JUMLAH IJIN LOKASI
                  <br>LUAS IJIN LOKASI
                  <br>RENCANA TAPAK
                  <br>PEMBEBASAN
                  <br>TERBANGUN
                  <br>BELUM TERBANGUN
                  </td>
                  <td width=\"200px\">".$i['PENGEMBANG']."
                  <br>".$i['IJIN_LOKASI']."
                  <br>".$i['LUAS_IJIN_LOKASI']."
                  <br>".$i['RENCANA_TAPAK']."
                  <br>".$i['PEMBEBASAN']."
                  <br>".$i['TERBANGUN']."
                  <br>".$i['BELUM_TERBANGUN']."
                  </td>";}
          foreach ($data1 as $i){     
                  $tb.="<td width=\"200px\">".$i['PENGEMBANG']."
                  <br>".$i['IJIN_LOKASI']."
                  <br>".$i['LUAS_IJIN_LOKASI']."
                  <br>".$i['RENCANA_TAPAK']."
                  <br>".$i['PEMBEBASAN']."
                  <br>".$i['TERBANGUN']."
                  <br>".$i['BELUM_TERBANGUN']."
                  </td>      
                </tr> ";
              }
                
                
      $th1=$tahun-1;
      $th2=$tahun-2;
      $tbl = <<<EOD
      <table border="1" cellpadding="2" cellspacing="2">
      <thead>
       <tr style="background-color:#FFFF00;color:#0000FF;">
        
        <td width="320px" align="center"><b>TYPE RUMAH</b></td>
        <td width="200px " align="center"> <b>DES $th2</b></td>     
        <td width="200px " align="center"> <b>DES $th1</b></td>
       </tr>
      </thead>
       $tb $tb1
      </table>
EOD;

//print_r($tbl);
      $pdf->writeHTML($tbl, true, false, false, false, '');

// $tb="";
//           $this->load->model('report');
//           $data= $this->report->tabel_statistik1();
//           $k=1;
//           foreach ($data as $i){  
              
//                 $tb .= 
//                     "<tr>  
//                     <td width=\"28px\">".$k."</td>            
//                   <td width=\"320px\">RSS  : TYPE 21-27
//                   <br>Jumlah Pengembang
//                   <br>Ijin Lokasi
//                   <br>Luas Ijin Lokasi
//                   <br>Rencana Tapak
//                   <br>Pembebasan
//                   <br>Terbangun
//                   <br>Belum Terbangun
//                   </td>
//                   <td width=\"320px\">".$i['RENC_RSS']."
//                   <br>".$i['PENGEMBANG']."
//                   <br>".$i['IJIN_LOKASI']."
//                   <br>".$i['LUAS_IJIN_LOKASI']."
//                   <br>".$i['RENCANA_TAPAK']."
//                   <br>".$i['PEMBEBASAN']."
//                   <br>".$i['TERBANGUN']."
//                   <br>".$i['BELUM_TERBANGUN']."
//                   </td>    
//                 </tr> ";
//                 $k++;
                       
//           }

//       $tbl = <<<EOD
//       <table border="1" cellpadding="2" cellspacing="2">
//       <thead>
//        <tr style="background-color:#FFFF00;color:#0000FF;">
//         <td width="28px" align="center"><b>NO</b></td>
//         <td width="320px" align="center"><b>TYPE RUMAH</b></td>
//         <td width="106px " align="center"> <b>2 Tahun Sebelum</b></td>     
        
//        </tr>
//       </thead>
//        $tb
//       </table>
// EOD;

//print_r($tbl);
     
      // -----------------------------------------------------------------------------
      //Close and output PDF document
      $pdf->Output('Report_Lahan_Kabupaten_Sidoarjo_'.$tahun.'.pdf', 'I');

      // -----------------------------------------------------------------------------
      } 

public function rekapitulasi_lahan_kecamatan_pdf($tahun,$periode) {

     /// create new PDF document
      $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $pdf->SetCreator(PDF_CREATOR);
      $pdf->SetAuthor('Dinas PU CKTR Sidoarjo');
      $pdf->SetTitle('Rekapitulasi_Lahan_Perkecamatan_Triwulan'.$periode.'_'.$tahun);
      $pdf->SetSubject('TCPDF');
      $pdf->SetKeywords('TCPDF, PDF');

      $pdf->SetHeaderData('sidoardjo.png', 20, 'PEMERINTAH KABUPATEN SIDOARDJO', 'DINAS PEKERJAAN UMUM CIPTA KARYA DAN TATA RUANG','REKAPITULASI DATA LAHAN PERUMAHAH / PEMUKIMAN' );
      $pdf->setFooterData('Triwulan '.$periode.' Tahun '.$tahun);
      $pdf->setBarcode(date('Y-m-d H:i:s'));
      // set header and footer fonts
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

      // set default monospaced font
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

      // set margins
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

      // set auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

      // set image scale factor
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

      // set some language-dependent strings (optional)
      if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
          require_once(dirname(__FILE__).'/lang/eng.php');
          $pdf->setLanguageArray($l);
      }

      // ---------------------------------------------------------

      // set font
      $pdf->SetFont('helvetica', 'B', 20);
      // add a page
      $pdf->AddPage('L','A3');
     //  $pdf->Write(0, 'PEMBANGUNAN PERUMAHAN / PEMUKIMAN', '', 0, 'C', true, 0, false, false, 0);
     //  $pdf->Write(0, 'REKAPITULASI DATA LAHAN PERUMAHAH / PEMUKIMAN', '', 0, 'C', true, 0, false, false, 0);
      
      $pdf->SetFont('helvetica', '', 11);
     
     // $pdf->Write(0, 'Tahun :'  .$tahun, '', 0, 'L', true, 0, false, false, 0);
     //  $pdf->Write(0, 'Periode : Triwulan' .$periode, '', 0, 'L', true, 0, false, false, 0);
     

      $pdf->SetLineWidth(5);
      $pdf->SetDrawColor(0,128,255);
      $pdf->SetFillColor(255,255,128);
      // -----------------------------------------------------------------------------

      // -----------------------------------------------------------------------------
      



      $k['JML_IJIN_LOKASI']=$k['LUAS']=$k['RENCANA_TAPAK']=$k['PEMBEBASAN']=$k['TERBANGUN']=$k['BELUM_TERBANGUN']=$k['DIALOKASIKAN']=$k['PEMBEBASAN']=$k['DIMATANGKAN']=$k['AKTIF_DLM_PEMBANGUNAN']=$k['AKTIF_BERHENTI']=$k['AKTIF_SDH_SELESAI']=$k['TIDAK_AKTIF']=0;
        
      $tb="";
      $this->load->model('m_report');
          $nilai = $this->m_report->jumlah_kecamatan();
          foreach ($nilai as $nil)
          {
            $jmlkec = $nil['JUMLAH'];
            $data['jumlah'] = $nil['JUMLAH'];
          }

          for ($j=1; $j <= $jmlkec ; $j++)
          {

                $data['lah_kec'][$j]= $this->m_report->tabel_lahan_kecamatan_all($j,$tahun,$periode);
                $data['aktifpemb'][$j]= $this->m_report->aktif_dalam_pembangunan($j,$tahun,$periode);
                $data['aktifber'][$j]= $this->m_report->aktif_berhenti($j,$tahun,$periode);
                $data['aktifsel'][$j]= $this->m_report->aktif_sdh_selesai($j,$tahun,$periode);
                $data['tdkaktif'][$j]= $this->m_report->tidak_aktif($j,$tahun,$periode);

          } 
          for($c=1;$c<$jmlkec;$c++){

            foreach ($data['lah_kec'][$c] as $i){

              $tb .= "<tr>
              <td width=\"28px\">".$c."</td>
              <td width=\"100px\">".$i['NAMA_KECAMATAN']."</td>              
              <td width=\"87px\">".$i['JML_IJIN_LOKASI']." </td>
              <td width=\"87px\">".$i['LUAS']." </td>
              <td width=\"87px\">".$i['RENCANA_TAPAK']." </td>
              <td width=\"90px\">".$i['PEMBEBASAN']." </td>
              <td width=\"87px\">".$i['TERBANGUN']." </td>
              <td width=\"87px\">".$i['BELUM_TERBANGUN']." </td>
              <td width=\"90px\">".$i['DIALOKASIKAN']." </td>
              <td width=\"90px\">".$i['PEMBEBASAN']." </td>
              <td width=\"87px\">".$i['DIMATANGKAN']." </td>";

              $k['JML_IJIN_LOKASI']+=$i['JML_IJIN_LOKASI'];
              $k['LUAS']+=$i['LUAS'];
              $k['RENCANA_TAPAK']+=$i['RENCANA_TAPAK'];
              $k['PEMBEBASAN']+=$i['PEMBEBASAN'];
              $k['TERBANGUN']+=$i['TERBANGUN'];
              $k['BELUM_TERBANGUN']+=$i['BELUM_TERBANGUN'];
              $k['DIALOKASIKAN']+=$i['DIALOKASIKAN'];
              $k['PEMBEBASAN']+=$i['PEMBEBASAN'];
              $k['DIMATANGKAN']+=$i['DIMATANGKAN'];

            }

              foreach ($data['aktifpemb'][$c] as $i) {
              $tb .="<td width=\"87px\">".$i['AKTIF_DLM_PEMBANGUNAN']."</td>";
              $k['AKTIF_DLM_PEMBANGUNAN']+=$i['AKTIF_DLM_PEMBANGUNAN'];}

              foreach ($data['aktifber'][$c] as $i){
              $tb .="<td width=\"87px\">".$i['AKTIF_BERHENTI']." </td>";
              $k['AKTIF_BERHENTI']+=$i['AKTIF_BERHENTI'];}

              foreach ($data['aktifsel'][$c] as $i){
              $tb .="<td width=\"87px\">".$i['AKTIF_SDH_SELESAI']." </td>";
              $k['AKTIF_SDH_SELESAI']+=$i['AKTIF_SDH_SELESAI'];}

              foreach ($data['tdkaktif'][$c] as $i){
              $tb .="<td width=\"87px\">".$i['TIDAK_AKTIF']." </td>                            
              </tr> ";
              $k['TIDAK_AKTIF']+=$i['TIDAK_AKTIF'];}            
          }

              $tb1="";
              $tb1 .= "<tr>
             
              <td width=\"130px\">JUMLAH</td>
              <td width=\"87px\">".$k['JML_IJIN_LOKASI']." </td>
              <td width=\"87px\">".$k['LUAS']." </td>
              <td width=\"87px\">".$k['RENCANA_TAPAK']." </td>
              <td width=\"90px\">".$k['PEMBEBASAN']." </td>
              <td width=\"87px\">".$k['TERBANGUN']." </td>
              <td width=\"87px\">".$k['BELUM_TERBANGUN']." </td>
              <td width=\"90px\">".$k['DIALOKASIKAN']." </td>
              <td width=\"90px\">".$k['PEMBEBASAN']." </td>
              <td width=\"87px\">".$k['DIMATANGKAN']." </td>
              <td width=\"87px\">".$k['AKTIF_DLM_PEMBANGUNAN']." </td>
              <td width=\"87px\">".$k['AKTIF_BERHENTI']." </td>
              <td width=\"87px\">".$k['AKTIF_SDH_SELESAI']." </td>
              <td width=\"87px\">".$k['TIDAK_AKTIF']." </td>
              
            </tr> ";
            

      $tbl = <<<EOD
      <table border="1" cellpadding="2" cellspacing="2">
      <thead>
       <tr style="background-color:#FFFF00;color:#0000FF;">
        <td width="28px" align="center"><b>NO</b></td>
        <td width="100px" align="center"><b>Kecamatan</b></td>
        <td width="87px " align="center"> <b>Perusahaan</b></td>
        <td width="87px" align="center"><b>Nama Perumahaan</b></td>
        <td width="87px" align="center"><b>Nama Lokasi (Ha)</b></td>
        <td width="87px" align="center"><b>No Lokasi</b></td>
        <td width="87px" align="center"><b>Tanggal Lokasi Dimiliki</b></td>
        <td width="87px" align="center"><b>Luas Lokasi</b></td>
        <td width="87px" align="center"><b>Rencana Tapak</b></td>
        <td width="90px" align="center"><b>Pembebasan</b></td>
        <td width="87px" align="center"><b>Terbangun</b></td>
        <td width="87px" align="center"><b>Belum Terbangun</b></td>
        <td width="90px" align="center"><b>Dialokasikan</b></td>
        <td width="90px" align="center"><b>Pembebasan</b></td>
        <td width="87px" align="center"><b>Sudah Dimatangkan</b></td>
        
        

       </tr>
      </thead>
       $tb $tb1
      </table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$tb="";
          $tb1="";
          $this->load->model('m_report');
          $data1 = $this->m_report->tabel_lahan_kecamatan_all_statistic($tahun-1);
          $data2 = $this->m_report->tabel_lahan_kecamatan_all_statistic($tahun-2);
          
          foreach ($data2 as $i){  
              
                $tb .= 
                    "<tr>  
                                
                  <td width=\"320px\">JUMLAH PENGEMBANG
                  <br>JUMLAH IJIN LOKASI
                  <br>LUAS IJIN LOKASI
                  <br>RENCANA TAPAK
                  <br>PEMBEBASAN
                  <br>TERBANGUN
                  <br>BELUM TERBANGUN
                  </td>
                  <td width=\"200px\">".$i['JML_PENGEMBANG']."
                  <br>".$i['JML_IJIN_LOKASI']."
                  <br>".$i['LUAS']."
                  <br>".$i['RENCANA_TAPAK']."
                  <br>".$i['PEMBEBASAN']."
                  <br>".$i['TERBANGUN']."
                  <br>".$i['BELUM_TERBANGUN']."
                  </td>";}
          foreach ($data1 as $i){     
                  $tb.="<td width=\"200px\">".$i['JML_PENGEMBANG']."
                  <br>".$i['JML_IJIN_LOKASI']."
                  <br>".$i['LUAS']."
                  <br>".$i['RENCANA_TAPAK']."
                  <br>".$i['PEMBEBASAN']."
                  <br>".$i['TERBANGUN']."
                  <br>".$i['BELUM_TERBANGUN']."
                  </td>      
                </tr> ";
              }
                
                
      $th1=$tahun-1;
      $th2=$tahun-2;
      $tbl = <<<EOD
      <table border="1" cellpadding="2" cellspacing="2">
      <thead>
       <tr style="background-color:#FFFF00;color:#0000FF;">
        
        <td width="320px" align="center"><b>TYPE RUMAH</b></td>
        <td width="200px " align="center"> <b>DES $th2</b></td>     
        <td width="200px " align="center"> <b>DES $th1</b></td>
       </tr>
      </thead>
       $tb $tb1
      </table>
EOD;

//print_r($tbl);
      $pdf->writeHTML($tbl, true, false, false, false, '');


$pdf->Output('Rekapitulasi_Lahan_Perkecamatan_Triwulan'.$periode.'_'.$tahun.'.pdf', 'I');


}

}
//============================================================+
// END OF FILE
//============================================================+



                      
        