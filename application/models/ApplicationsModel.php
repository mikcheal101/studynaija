<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApplicationsModel extends CI_Model {
	
	public function __construct () {
		parent::__construct();
	}
	
	public function getAllApplications () {
		$db = $this->db
			->get('applications')
			->order_by('last_date', 'ASC');
		return $db->result_array();
	}
	
	public function getApplicant ($application) {
		$sql = "
			SELECT 
				`u`.`id`, `u`.`username`, `u`.`email`, `a`.`firstname`, `a`.`middlename`, `a`.`lastname` 
			FROM 
				`users` AS `u`, `applicant` AS `a`, `static_usertypes` as `sa`, `applications` as `app`  
			WHERE 
				`u`.`id` = `a`.`user` AND
				`a`.`id` = `app`.`applicant` AND
				`u`.`usertype` = `sa`.`id` AND
				`app`.`id` = {$application->id} AND
				`sa`.`id`=4 ORDER BY `u`.`username` ASC";
		$data = $this->db->query($sql);
		return $db->result_array();
	}
	
	public function addApplication ($application) {
		$sql 	= "INSERT INTO `applications` (applicant, subdiscipline, semester, status, delivery_mode, educational_variant, creations_date) VALUES 
			('{$application->applicant}', '{$application->subdiscipline}', '{$application->semester}', '{$application->status}', '{$application->delivery_mode}', 
			'{$application->educational_variant}', '{$application->creations_date}')";	
		$db 	= $this->db->query();
		return $db->result_row();
	}
	
	public function editApplication ($application) {
		$sql 	= "UPDATE `applications` SET `applicant`='{$application->applicant}', `subdiscipline`='{$application->subdiscipline}', `semester`='{$application->semester}', `status`='{$application->status}', 
			`delivery_mode`='{$application->delivery_mode}', educational_variant``='{$application->educational_variant}', `last_date`='NOW()', WHERE `id`={$application->id}";	
		$this->db->query($sql);
	}
	
	public function deleteApplication ($application) {
		$this->db
			->delete("applications")
			->where("id", $application->id);
	}
	
	public function getSubDiscipline ($application) {
		$sql 	= "SELECT * FROM `static_sub_disciplines` WHERE `id`=(SELECT `subdiscipline` FROM `applications` WHERE `id`={$application->id})";	
		$db 	= $this->db->query();
		return $db->result_row();
	}
	
	public function getSemester ($applciation) {
		$sql 	= "SELECT * FROM `static_semesters` WHERE `id`=(SELECT `semester` FROM `applications` WHERE `id`={$application->id})";	
		$db 	= $this->db->query();
		return $db->result_row();
	}
	
	public function getStatus ($applciation) {
		$sql 	= "SELECT * FROM `static_application_status` WHERE `id`=(SELECT status`` FROM `applications` WHERE `id`={$application->id})";
		$db 	= $this->db->query();
		return $db->result_row();
	}
	
	public function setStatus ($application) {
		$sql 	= "UPDATE `application` SET `status`={$application->status} WHERE `id`={$application->id})";
		$this->db->query();
	}
	
	public function getDeliveryMode ($application) {
		$sql 	= "SELECT * FROM `static_delivery_mode` WHERE `id`=(SELECT `delivery_mode` FROM `applications` WHERE `id`={$application->id})";
		$db 	= $this->db->query();
		return $db->result_row();
	}
	
	public function getEducationalVariant ($application) {
		$sql 	= "SELECT * FROM `static_educational_variant` WHERE `id`=(SELECT `educational_variant` FROM `applications` WHERE `id`={$application->id})";
		$db 	= $this->db->query();
		return $db->result_row();
	}
}