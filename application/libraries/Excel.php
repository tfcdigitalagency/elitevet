<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	define("EXCEL_BASE",dirname(__FILE__).'/excel/');
    class Excel  
    {
        public $workbook;
		public $sheet;
        
        function __construct()
        {
            require_once APPPATH."/third_party/PHPExcel-1.8/Classes/PHPExcel.php";
            require_once APPPATH."/third_party/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php";
           
			$this->sheet = new PHPExcel();
        }
        

		function _getText($objCell = null)
	    {
	         if (is_null($objCell)) {
	             return false;
	         }
	 
	         $txtCell = "";
	         $valueCell = $objCell->getValue();
	 
	         if (is_object($valueCell)) {
	             $rtfCell = $valueCell->getRichTextElements();
	             $txtParts = array();
	             foreach ($rtfCell as $v) {
	                $txtParts[] = $v->getText();
	             }
	             $txtCell = implode("", $txtParts);
	 
	         } else {
	             if (!empty($valueCell)) {
	                 $txtCell = $valueCell;
	             }
	         }	 
	         return $txtCell;
	    }

        function load($template_location,$rowStart)
        {
            // Path to the template file
            if(!$template_location) $template_location = EXCEL_BASE.'resources/template.xls';
        
            $xls_reader = PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $this->workbook = $xls_reader->load($template_location);
			
			$sheets = array();
			if (is_null($sheetIndex)) {
				$sheets = $objPHPExcel->getAllSheets();
			} elseif (is_array($sheetIndex)) {
				foreach($sheetIndex as $idx) {
					$sheets[$idx] = $objPHPExcel->getSheet($idx);
				}
			} elseif (is_int($sheetIndex)) {
				$sheets[$sheetIndex] = $objPHPExcel->getSheet($sheetIndex);
			}
			$data = array();
			if (empty($sheets)) {
				return $data;
			}
			
			foreach ($sheets as $s => $objSheet) {
				$sheetTitle = $objSheet->getTitle();
				$data[$s]['title'] = $sheetTitle;
		 
				$rowMax = $rowCount;
				if (is_null($rowCount)) {
					$rowMax = $objSheet->getHighestRow();
				}
				$colMax = $colCount;
				if (is_null($colCount)) {
					$colMax = $objSheet->getHighestColumn();
				}
	
				$sheetData = array();
				$_row = 99;
				for($r= $rowStart; $r<=$rowMax; $r++) { 
					$col = 0;
					 for($c='A'; $c<=$colMax; $c++) { 
						 $objCell = $objSheet->getCellByColumnAndRow($col, $r);					 
						 $sheetData[$_row][$col]= $this->_getText($objCell);		
						 $col++; 	
					 }
					$_row++;	 
				 }
				 
				 $data[$s]['data'] = $sheetData;
				 $data[$s]['colMax'] = $col;
			}
			return $data[0];
        }
       
		function output($type,$name)
		{
			switch(strtoupper($type))
			{
				case 'EXCEL2007':
					$name .= ".xlsx";
					break;
				case 'EXCEL5':
					$name .= ".xls";
					break;
				case 'PDF':
					$name .= ".pdf";
					break;
				case 'HTML':
					$name .= ".html";
					break;
			}
			 $xls_writer = PHPExcel_IOFactory::createWriter($this->sheet, $type); // Trouble maker
            // Stops here, no error message, output nothing            
            header('Pragma: public');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Content-Type: application/force-download');
            header('Content-Type: application/octet-stream');
            header('Content-Type: application/download');
            header("Content-Disposition: attachment;filename=".$name);
            header('Content-Transfer-Encoding: binary');

            $xls_writer->save('php://output');
		}	
     
    }  
