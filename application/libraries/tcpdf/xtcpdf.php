<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class XTCPDF extends TCPDF
{ 
 
    /* function ColoredTable
     * @param $w array of column widths array(40, 30,70);
     * @param array of header names array("Address", "Comment", "Date")
     * @param array of data array( array( r1col1, r1col2, r1col3), array(r2col1, r2col2, r3col3))
     */
 
 
    public function ColoredTable($w, $header,$data) {
      
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
  
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
         
        $fill = 0;
        //print_r($data);
         
        foreach($data as $row) {
             
            $cellcount = array();
            //write text first
            $startX = $this->GetX();
            $startY = $this->GetY();
            //draw cells and record maximum cellcount
            //cell height is 6 and width is 80
            $i=0;     
            foreach ($row as $key => $column):
                 //print_r($key);
                 $cellcount[] = $this->MultiCell($w[$i],6,$column,0,'L',$fill,0);
                $i++;
            endforeach;
         
            $this->SetXY($startX,$startY);
  
            //now do borders and fill
            //cell height is 6 times the max number of cells
         
            $maxnocells = max($cellcount);
            $i=0;
            foreach ($row as $key => $column):
                 $this->MultiCell($w[$i],$maxnocells * 6,'','LR','L',$fill,0);
                $i++;
            endforeach;
     
        $this->Ln();
            // fill equals not fill (flip/flop)
            $fill=!$fill;
             
        }
         
        // draw bottom row border
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}