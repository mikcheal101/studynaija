<?php
require_once 'PHPExcel.php';
class InstituitionSheet {

	private $sheet_count;
	private $sheets;
	private $excel;
	private $instituition;
	
	public function __construct () {
		$this->instituition = array ();
	}
	
	public function init ($excel) {
		$this->excel = $excel;
		$this->sheet_count = $excel->getSheetCount ();
		$this->loadFile ();
	}
	
	private function loadFile () {
		for ($count=0; $count < $this->sheet_count; $count++) {
			$active_sheet = $this->excel->getSheet ($count);
			
			$counter = 0;
			foreach ($active_sheet->getRowIterator () as $row) {
				if ($counter > 0) {
					$instituition = new Instituition ();
					$instituition->name 	= $active_sheet->getCellByColumnAndRow (0, ($counter + 1))->getValue ();
					$instituition->abbrv	= $active_sheet->getCellByColumnAndRow (1, ($counter + 1))->getValue ();
					$instituition->mail		= $active_sheet->getCellByColumnAndRow (2, ($counter + 1))->getValue ();
					$instituition->email	= $active_sheet->getCellByColumnAndRow (3, ($counter + 1))->getValue ();
					$instituition->tel		= $active_sheet->getCellByColumnAndRow (4, ($counter + 1))->getValue ();
					$instituition->website	= $active_sheet->getCellByColumnAndRow (5, ($counter + 1))->getValue ();
					$instituition->type		= $active_sheet->getCellByColumnAndRow (6, ($counter + 1))->getValue ();
					$this->instituition[]	= $instituition;
				}				
				$counter++;
			}
		}
		
		echo json_encode ($this->instituition);
	}

}

class Instituition {
	public $name;
	public $abbrv;
	public $mail;
	public $email;
	public $tel;
	public $website;
	public $type;
}

?>