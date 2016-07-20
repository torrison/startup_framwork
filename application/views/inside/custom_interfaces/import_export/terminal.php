
    Export From Table
	<form style="" name="export_form" method="get">
	
	<input type="text" value="<?=$this->input->get('export_table', true)?>" name="export_table" class="" placeholder="TableName" style="margin-bottom:0;" />
	<input type="submit" class="btn" value="Send" />
	
	</form>
	
	Import From xls or csv
	<div style="">
	
	<input type="text" value="" name="" class="" placeholder="TableName" style="margin-bottom:0;" />
	<a class="btn">Send</a>
	
	</div>
	
	
	
<?php


$module = '';
$table = $this->input->get('export_table', true);


// Include PHPExcel
$CI =& get_instance();
$CI->load->library('excel');
// Letters Array 
$abc = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
// Create new PHPExcel object
$objPHPExcel = $CI->excel;
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("PHPExcel Test Document")
							 ->setSubject("PHPExcel Test Document")
							 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
							 ->setKeywords("office PHPExcel php")
							 ->setCategory("Test result file");

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Main');

// --------------------------------------------------   Excel Works -----------------------------------------------------
$stdout = "<br />Table: <b>".$table."</b> Ready To Saved in XLS ! 
<br /> 
<a href='/files/uploads/xls/export_now.xlsx'>Скачать последний экспорт</a> 
<!--
<br /><br />
<a href='javascript:history.go(-1)'>&lt;&lt; Назад</a>
-->

";

if ( ($table != "") && include ('application/config/pdg_tables/'.$table.'.php'))
{
	$stdout .= "<br /><br />Module & Table - Ok!<br /><br />";
	
	$query = $CI->db->query("SELECT * from ".$table." ORDER by ".$table_config['key']." ASC");
	
	$res = $query->result_array();
	
	$excel_id = 1;
	$i = 0;
	
	foreach ($table_columns as $column) {
		// Excel Add
		
		//B
		$objRichText = new PHPExcel_RichText();
		$objBold = $objRichText->createTextRun($column['name']);
		$objBold->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getCell($abc[$i].$excel_id)->setValue($objRichText);
			
		$objPHPExcel->getActiveSheet()->getStyle($abc[$i].$excel_id)->applyFromArray(
			array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => 'DDDDFF')
				)
			)
		);
		$i++;
		//----------------------------------------------------------------------------------------
	}	
	
	$excel_id++;
	foreach ($res as $row) {	
			
		$i = 0;
		foreach ($table_columns as $column) {
		
		
		
		$objPHPExcel->getActiveSheet()->setCellValue($abc[$i].$excel_id, $row[$column['name']]);
		
		/*	
			if (strlen($catalog_tree[$i]['content']) > 5) {
			$excel_id++;			
			$objPHPExcel->getActiveSheet()->mergeCells('A'.$excel_id.':I'.$excel_id);
			$objPHPExcel->getActiveSheet()->setCellValue("A".$excel_id, $catalog_tree[$i]['content']);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$excel_id)->getAlignment()->setWrapText(true);
			$objPHPExcel->getActiveSheet()->getRowDimension($excel_id)->setRowHeight(200);
			}
		*/	
			
		$i++;
		}
			
		$excel_id++;
	    
	}


// More Width for Name
$objPHPExcel->getActiveSheet()->getColumnDimension($abc[1])->setWidth(70);

// ------------------------   Save and Export Excel 2007 file   -----------------------------------------------

try{

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save($_SERVER['DOCUMENT_ROOT']."/files/uploads/xls/export_now.xlsx");

}catch(Exception $e){
  echo $e->__toString();
}

	// $filename='just_some_random_name.xls'; //save our workbook as this file name
	// header('Content-Type: application/vnd.ms-excel'); //mime type
	// header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	// header('Cache-Control: max-age=0'); //no cache
				 
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	// $objWriter = PHPExcel_IOFactory::createWriter($CI->excel, 'Excel5');  
	//force user to download the Excel file without writing it to server's HD
	// $objWriter->save('php://output');


}

echo $stdout;