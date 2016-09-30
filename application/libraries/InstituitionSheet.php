<?php
require_once 'PHPExcel.php';
class InstituitionSheet {

	private $sheet_count;
	private $excel;
	private $instituitions;
	private $disciplines;
	
	public function __construct () {
		$this->instituition = [];
		$this->disciplines = [];
	}
	
	public function getInstituitions () : array {
		return $this->instituitions;
	}
	
	public function getDisciplines () : array {
		return $this->disciplines;
	}
	
	public function init ($excel) {
		$this->excel = $excel;
		$this->sheet_count = $excel->getSheetCount ();
		return $this;
	}
	
	public function loadInstituitions () {
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
					$this->instituitions[]	= $instituition;
				}				
				$counter++;
			}
		}
		return $this;
	}
	
	public function loadDisciplines () {
		for ($count=0; $count < $this->sheet_count; $count++) {
			$active_sheet = $this->excel->getSheet ($count);
			$counter = 0;
			$faculty = $active_sheet->getTitle ();
			foreach ($active_sheet->getRowIterator () as $row) {
				if ($counter > 0) {
					$discipline 			= new Discipline ();
					$discipline->name 		= $active_sheet->getCellByColumnAndRow (0, ($counter + 1))->getValue ();
					$discipline->faculty	= $faculty;
					$this->disciplines[] 	= $discipline;
				}				
				$counter++;
			}
		}
		return $this;
	}
}

class Instituition {
	public $name	= '';
	public $abbrv	= '';
	public $mail	= '';
	public $email	= '';
	public $tel		= '';
	public $website	= '';
	public $type	= '';
}

class Discipline {
	public $name 			= '';
	public $faculty 		= '';
	public $type			= '';
	public $instituitions 	= [];
}

?>