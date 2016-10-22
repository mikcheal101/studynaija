<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SchoolModel extends CI_Model {
	
	public function __construct () {
		parent::__construct();
	}
	
	public function getAllSchools () {
		$this->db
			->select()
			->from('school');
			
		$db = $this->db->get();
		return $db->result_array();
	}
	
	public function getSchool($id) {
		return $this->db->query("SELECT * FROM school WHERE id={$id} LIMIT 1")->row();
	}
	
	public function getSchoolUserDetails ($school) {
		$sql = "select * from users where id = (select user from schoolToUsers where school = {$school})";
		$db = $this->db->query($sql);
		return $db->row();
	}
	
	public function getSchoolStateDetails ($state) {
		$this->db
			->select()
			->from('static_states')
			->where("id", $state)
			->limit(1);
			
		$db = $this->db->get();
		return $db->result_row();
	}
	
	public function getSchoolApplications ($school) {
		$sql = "SELECT * FROM `applications` WHERE `id` = (SELECT `application` FROM `schoolToApplications` WHERE `school`={$school})";
		$db = $this->db->query($sql);
		return $db->result_array();
	}
	
	public function getAllNews ($school) {
		$sql = "SELECT * FROM `news` WHERE `id` IN (SELECT `news` FROM `schoolToNews` WHERE ``={$school})";
		$db = $this->db->query($sql);
		return $db->result_array();
	}
	
	public function getAllDisciplines ($school) {
		$sql = "SELECT * FROM `static_sub_disciplines` WHERE `id` IN (SELECT `discipline` FROM `schoolToDisciplines` WHERE `school` = {$school})";
		$db = $this->db->query($sql);
		return $db->result_array();
	}
	
	public function addSchool ($school) {
		$sql = "INSERT INTO `school` (name, year_of_est, url, logo, state) VALUES ('{$school->name}', '{$school->year_of_est}', '{$school->url}', '{$school->logo}')";
		$this->db->query($sql);
	}
	
	public function dropSchool ($school) {
		$sql = "DELETE FROM `school` WHERE `id`={$school}";
		$this->db->query($sql);
	}
	
	public function editSchool ($school) {
		$sql = "UPDATE `school` SET `name`='{$school->name}', `year_of_est`='{$school->year_of_est}', `url`='{$school->url}', `logo`='{$school->logo}', `state`={$school->state} WHERE `id`={$school->id}";
		$this->db->query($sql);
	}
	
	public function getFaculties () {
		return $this->db->get('static_faculty')->result();
	}
	
	public function getEducationalVariants () {
		$result = $this->db->get('static_educational_variant');
		$data = array();
		foreach($result->result() as $x) {
			$data[$x->id] = $x->name;
		}
		return $data;
	}
	
	public function getAllQueryDisciplines () {
		$data = array();
		$this->db
			->select("ssd.id, ssd.name, (SELECT std.faculty FROM schoolToDisciplines AS std WHERE discipline = ssd.id) AS faculty,
					(SELECT std.id FROM schoolToDisciplines AS std WHERE discipline = ssd.id) AS std_id")
			->from("static_sub_disciplines as ssd");
		return $this->db->get()->result();
	}
	
	public function assignDisciplineSchool ($association = array()) {
		$this->db->insert('schoolToDisciplines', $association);
	}
	
	public function assignDisciplineSchoolUpdate ($association = array(), $id = 0) {
		$this->db->update('schoolToDisciplines', $association, array('id'=>$id));
		$this->db->last_query();
	}
	
	public function getSchoolFromUser ($userId) {
		$this->db
			->select('*')
			->from('school')
			->where("id = (SELECT school FROM schoolToUsers WHERE user='{$userId}' LIMIT 1)")
			->limit(1);
		return $this->db->get()->row();
	}
	
	public function updateDiscipline ($param) { # id of the schoolTodiscipline
		$discipline = array(
			'description'		=> base64_encode($this->input->post('description')),
			'local' 			=> $this->input->post('local'),
			'intl'				=> $this->input->post('intl'),
			'duration'			=> $this->input->post('duration'),
			'variant'			=> json_encode($this->input->post('variant')),
			'delivery_mode'		=> json_encode($this->input->post('delivery_mode')),
			'adm_experience'	=> base64_encode($this->input->post('adm_experience')),
			'content'			=> base64_encode($this->input->post('content')),
			'work_experience'	=> base64_encode($this->input->post('work_experience')),
		);
		$this->db->update('schoolToDisciplines', $discipline, array('discipline'=>$param, 'school'=>$this->session->school->id));
	}
	
	public function updateProfile ($uploadedData) {
		$school_data 				= new stdClass();
		$school_data->name 			= $this->input->post('name');
		$school_data->year_of_est	= $this->input->post('year');
		$school_data->url			= $this->input->post("url");
		$school_data->state			= $this->input->post("state");
		$school_data->email			= $this->input->post("email");
		$school_data->address		= base64_encode($this->input->post("address"));
		$school_data->history		= base64_encode($this->input->post("history"));
		
		$this->session->school->name 		= $school_data->name;
		$this->session->school->year_of_est	= $school_data->year_of_est;
		$this->session->school->url 		= $school_data->url;
		$this->session->school->state		= $school_data->state;
		$this->session->school->email		= $school_data->email;
		$this->session->school->address		= $school_data->address;
		
		
		if ($uploadedData->emblem != null) {
			# emblem sent
			$school_data->logo		= "images/applicants/documents/".$uploadedData->emblem['file_name'];
			$this->session->school->logo = $school_data->logo;
		}
		
		if ($uploadedData->cover != null) {
			# cover sent
			echo "<hr>";
			$school_data->cover_photo	= "images/applicants/documents/".$uploadedData->cover['file_name'];
			$this->session->school->cover_photo = $school_data->cover_photo;
		}
		
		$this->db->update('school', $school_data, array('id'=>$this->session->school->id));
		#echo $this->db->last_query();
	}

	public function confirmSchoolEmailDuplication ($email) {
		$r = $this->db->query("SELECT * FROM school WHERE id!={$this->session->school->id} AND email='{$email}' LIMIT 1")->row();
		return (isset($r));
	}
	
	public function confirmSchoolNameDuplication ($param) {
		$r = $this->db->query("SELECT * FROM school WHERE id!={$this->session->school->id} AND name='{$param}' LIMIT 1")->row();
		return (isset($r));
	}
	
	public function confirmSchoolUrlDuplication ($param) {
		$r = $this->db->query("SELECT * FROM school WHERE id!={$this->session->school->id} AND url='{$param}' LIMIT 1")->row();
		return (isset($r));
	}
	
	public function getSingleDiscipline ($id) {
		$this->db
			->select('*, 
				(SELECT ssd.name FROM static_sub_disciplines AS ssd WHERE ssd.id = a.discipline) AS discipline_name,
				(SELECT sf.name FROM static_faculty AS sf WHERE sf.id = a.faculty) AS faculty_name')
			->from('schoolToDisciplines AS a')
			->where("a.discipline = {$id}")
			->limit(1);
		$discipline = $this->db->get()->row();

		
		$variants = array();
		$delivery_modes = aray();
		
		foreach(json_decode($discipline->variant) as $variant) 
			$variants[$variant] = $this->getVariant($variant)->name;
		$discipline->variant = $variants;
		
		foreach(json_decode($discipline->delivery_mode) as $delivery_mode) 
			$delivery_modes[$delivery_mode] = $this->getDeliveryMode($delivery_mode)->name;
		$discipline->delivery_mode = $delivery_modes;
		
		return $discipline;
	}
	
	public function getSchoolDisciplines () {
		$this->db
			->select('*, 
				(SELECT ssd.name FROM static_sub_disciplines AS ssd WHERE ssd.id = a.discipline) AS discipline_name,
				(SELECT sf.name FROM static_faculty AS sf WHERE sf.id = a.faculty) AS faculty_name,
				(SELECT v.name FROM static_educational_variant AS v WHERE v.id = a.variant ) AS variant_name')
			->from('schoolToDisciplines AS a')
			->where("a.school = {$this->session->school->id}");
		$result = $this->db->get()->result();
		foreach($result as $discipline) {
			$discipline->variant 		= json_decode($discipline->variant);
			$discipline->delivery_mode	= json_decode($discipline->delivery_mode);
		}
		return $result;
	}
	
	public function getAllStates () {
		return $this->db->get('static_states')->result();
	}
	
	public function deleteSchoolApplication () {
		$disciplines = $this->input->post('disciplines');
		$this->db->trans_start();
			$this->db->delete('schoolApplications', array('id'=>$this->input->post('id'), 'school'=>$this->session->school->id));
		$this->db->trans_complete();
		echo json_encode(array('status' => $this->db->trans_status()));
	}
	
	public function updateSchoolApplication () {
		$this->db->trans_start();
			$this->db->update('schoolApplications', array(
			'name' 			=> $this->input->post('name'),
			'deadline' 		=> date('Y-m-d', strtotime($this->input->post('deadline'))),
			'resumption' 	=> date('Y-m-d', strtotime($this->input->post('resumption'))),
			'discipline'	=> base64_encode(json_encode($disciplines)),
			'school'		=> $this->session->school->id,	
		), array(
			'id'=>$this->input->post('id'), 
			'school'=>$this->session->school->id,
		));
		$this->db->trans_complete();
		echo json_encode(array('status' => $this->db->trans_status()));
	}
	
	public function fetchApplicants () {
		# unimplemented
		echo json_encode(array('applicants'=>array()));
	}
	
	public function saveSchoolApplication () {
		$disciplines = $this->input->post('disciplines');
		$insert_id = 0;
		$this->db->trans_start();
		$this->db->insert('schoolApplications', array(
			'name' 			=> $this->input->post('name'),
			'deadline' 		=> date('Y-m-d', strtotime($this->input->post('deadline'))),
			'resumption' 	=> date('Y-m-d', strtotime($this->input->post('resumption'))),
			'discipline'	=> base64_encode(json_encode($disciplines)),
			'school'		=> $this->session->school->id,	
		));
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		echo json_encode(array('status'=>$this->db->trans_status(), 'id'=>$insert_id));
	}

	public function getSchoolApplicationsFrames () {
		$this->db
			->select("s.id, s.name, s.deadline, s.resumption, s.discipline, s.school, 
				(SELECT count(a.id) from `applications` as `a` where `a`.`application` = `s`.`id`) AS `counter`")
			->from("`schoolApplications` as `s`")
			->where("`s`.`school`", $this->session->school->id)
			->order_by("`s`.`name`");
		$result = $this->db->get()->result();
		foreach($result as $k) $k->discipline = json_decode(base64_decode($k->discipline));
		echo json_encode(array('applications'=>$result));
	}
	
	public function getApplication () {
		$this->db
			->select("s.id, s.name, s.deadline, s.resumption, s.discipline, s.school")
			->from("`schoolApplications` as `s`")
			->where("`s`.`school`", $this->session->school->id)
			->where("`s`.`id`", $this->input->post('id'))
			->limit(1);
		$result = $this->db->get()->row();
		$result->discipline = base64_decode($result->discipline);
		
		echo json_encode(array('application'=>$result));
	}
	
	public function updateApplication () {
		$disciplines = $this->input->post('disciplines');
		$this->db->trans_start();
		$this->db->update('schoolApplications', array(
			'name' 			=> $this->input->post('name'),
			'deadline' 		=> date('Y-m-d', strtotime($this->input->post('deadline'))),
			'resumption' 	=> date('Y-m-d', strtotime($this->input->post('resumption'))),
			'discipline'	=> base64_encode(json_encode($disciplines)),
			'school'		=> $this->session->school->id,	
		), array('id'=>$this->input->post('id')));
		$this->db->trans_complete();
		echo json_encode(array('status'=>$this->db->trans_status()));
	}
	
	public function deleteApplication () {
		$this->db->delete('schoolApplications', array('id'=>$this->input->post('id')));
	}
	
	public function getDeliveryModes () {
		$result = $this->db->get('static_delivery_mode');
		$data = array();
		foreach($result->result() as $x) {
			$data[$x->id] = $x->name;
		}
		return $data;
	}
	
	public function getNews () {
		$data = $this->db->get_where('news', array('poster'=>$this->session->user->id))->result();
		foreach($data as $news) {
			$news->subject = base64_decode($news->subject);
			$news->details = base64_decode($news->details);
		}
		echo json_encode(array('news'=>$data));
	}
	
	public function commitNews() {
		$this->schoolModel->commitNews();
	}
	
	public function dropNews () {
		$this->schoolModel->dropNews();
	}
	
	public function commitScholarship() {
		$this->schoolModel->commitScholarship();
	}
	
	public function dropScholarship () {
		$this->schoolModel->dropScholarship();
	}
	
	public function updateNews () {
		$this->db->trans_start();
		$this->db->update('news', 
			array(
				'subject'=> base64_encode($this->input->post('subject')),
				'details'=> base64_encode($this->input->post('details')),
			), 
			array(
				'id'=>$this->input->post('id'), 
				'poster'=>$this->session->user->id
			));
		
		# echo json_encode(array('data'=>$this->db->last_query()));
		$this->db->trans_complete();
		echo json_encode(array('status'=>$this->db->trans_status()));
	}
	
	public function saveNews () {
		$insert_id = 0;
		$this->db->trans_start();
		$this->db->insert('news', array(
			'subject'=> base64_encode($this->input->post('subject')),
			'details'=> base64_encode($this->input->post('details')),
			'poster' => $this->session->user->id,
		));
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		echo json_encode(array('status'=>$this->db->trans_status(), 'id'=>$insert_id));
	}
	
	public function deleteNews () {
		
		$this->db->trans_start();
			$this->db->delete('news', array('id'=>$this->input->post('id'), 'poster'=>$this->session->user->id));
		$this->db->trans_complete();
		echo json_encode(array('status'=>$this->db->trans_status()));
	}
	
	public function getSingleNews () {
		$data = $this->db->get_where('news', array('poster'=>$this->session->user->id, 'id'=>$this->input->post('id')))->row();
		foreach($data as $news) {
			$news->subject = base64_decode($news->subject);
			$news->details = base64_decode($news->details);
		}
		echo json_encode(array('news'=>$data));
	}
	
	public function getScholarships () {
		$data = $this->db->get_where('scholarships', array('poster'=>$this->session->user->id))->result();
		foreach($data as $scholarships) {
			$scholarships->name = base64_decode($scholarships->name);
			$scholarships->details = base64_decode($scholarships->details);
		}
		echo json_encode(array('scholarships'=>$data));
	}
	
	public function updateScholarships () {
		$this->db->trans_start();
		$this->db->update('scholarships', 
			array(
				'name'=> base64_encode($this->input->post('name')),
				'details'=> base64_encode($this->input->post('details')),
			), 
			array(
				'id'=>$this->input->post('id'), 
				'poster'=>$this->session->user->id
			));
		
		# echo json_encode(array('data'=>$this->db->last_query()));
		$this->db->trans_complete();
		echo json_encode(array('status'=>$this->db->trans_status()));
	}
	
	public function saveScholarships () {
		$insert_id = 0;
		$this->db->trans_start();
		$this->db->insert('scholarships', array(
			'name'=> base64_encode($this->input->post('name')),
			'details'=> base64_encode($this->input->post('details')),
			'poster' => $this->session->user->id,
		));
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();
		echo json_encode(array('status'=>$this->db->trans_status(), 'id'=>$insert_id));
	}
	
	public function deleteScholarships () {
		
		$this->db->trans_start();
			$this->db->delete('scholarships', array('id'=>$this->input->post('id'), 'poster'=>$this->session->user->id));
		$this->db->trans_complete();
		echo json_encode(array('status'=>$this->db->trans_status()));
	}
	
	public function getSingleScholarships () {
		$data = $this->db->get_where('scholarships', array('poster'=>$this->session->user->id, 'id'=>$this->input->post('id')))->row();
		foreach($data as $scholarships) {
			$scholarships->name = base64_decode($scholarships->name);
			$scholarships->details = base64_decode($scholarships->details);
		}
		echo json_encode(array('scholarships'=>$data));
	}
	
	
	private function getVariant ($id) {
		return $this->db->get_where('static_educational_variant', array('id'=>$id))->row();
	}
	
	private function getDeliveryMode ($id) {
		return $this->db->get_where('static_delivery_mode', array('id'=>$id))->row();
	}
	
	private function hasInArray ($array, $id) {
		foreach($array as $arr) {
			if ($arr->id === $id) return true;
		} return false;
	}
} 