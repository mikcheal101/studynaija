<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SchoolsController extends CI_Controller {
	
	protected $data = array();
	
	public function __construct () {
		parent::__construct();
		$this->verifyUser ();
		
		$this->data['title'] 		= "studynaija";
		$this->data['msg_usr'] 		= "school";
		$this->data['positions'] 	= array("studynaija");
		
		$this->data['school'] 		= $this->schoolModel->getSchool($this->session->school->id);
		$this->data['user'] 		= $this->session->user;
		
		$this->data['states'] 		= $this->schoolModel->getAllStates();
		$this->data['faculties'] 	= $this->schoolModel->getFaculties();
		$this->data['variants'] 	= $this->schoolModel->getEducationalVariants();
		$this->data['delivery_modes']= $this->schoolModel->getDeliveryModes();
		$this->data['courses']		= $this->schoolModel->getAllQueryDisciplines();
				
	}
	
	public function index () {
		$this->verifyUser();
		$this->data['positions'][1] = $this->session->school->name;
		$this->data['positions'][2] = "Home";
		
		$this->data['school'] = $this->schoolModel->getSchool($this->session->school->id);
		#var_dump ($this->data['school']); return;
		$this->load->view("schools/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("schools/left-side", $this->data);
		$this->load->view("schools/index", $this->data);
		$this->load->view("schools/footer", $this->data);
	}
	
	public function getFaculties () {
		echo json_encode(array('faculties'=>$this->data['faculties']));
	}
	
	public function applications () {
		$this->verifyUser();
		$this->data['positions'][1] = $this->session->school->name;
		$this->data['positions'][2] = "Applications";
		
		$this->load->view("schools/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("schools/left-side", $this->data);
		$this->load->view("schools/applications", $this->data);
		$this->load->view("schools/footer", $this->data);
	}
	
	public function news () {
		$this->verifyUser();
		$this->data['positions'][1] = $this->session->school->name;
		$this->data['positions'][2] = "News";
		
		$this->load->view("schools/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("schools/left-side", $this->data);
		$this->load->view("schools/news", $this->data);
		$this->load->view("schools/footer", $this->data);
	}
	
	public function disciplines () {
		$this->verifyUser();
		$this->data['positions'][1] = $this->session->school->name;
		$this->data['positions'][2] = "Disciplines";
		
		$this->load->view("schools/header", $this->data);
		$this->load->view("user/search_bar", $this->data);
		$this->load->view("schools/left-side", $this->data);
		$this->load->view("schools/disciplines", $this->data);
		$this->load->view("schools/footer", $this->data);
	}
	
	
	public function compose () {
		$this->verifyUser();
		$this->data['positions'][1] = $this->session->school->name;
		$this->data['positions'][2] = "Messages";
		$this->data['positions'][3] = "Compose";
		
		$this->load->view("schools/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("left_mail", $this->data);
		$this->load->view("schools/compose_mail", $this->data);
		$this->load->view("schools/footer", $this->data);
	}
	
	
	public function inbox () {
		$this->data['msg_link'] = "Inbox";
		$this->verifyUser();
		$this->data['positions'][1] = $this->session->school->name;
		$this->data['positions'][2] = "Messages";
		$this->data['positions'][3] = "Inbox";
		
		$this->load->view("schools/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("left_mail", $this->data);
		$this->load->view("schools/mail_page", $this->data);
		$this->load->view("schools/footer", $this->data);
	}
	
	public function outbox () {
		$this->data['msg_link'] = "Outbox";
		$this->verifyUser();
		$this->data['positions'][1] = $this->session->school->name;
		$this->data['positions'][2] = "Messages";
		$this->data['positions'][3] = "Sent Messages";
		
		$this->load->view("schools/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("left_mail", $this->data);
		$this->load->view("schools/mail_page", $this->data);
		$this->load->view("schools/footer", $this->data);
	}
	
	public function saved () {
		$this->data['msg_link'] = "Drafts";
		$this->verifyUser();
		$this->data['positions'][1] = $this->session->school->name;
		$this->data['positions'][2] = "Messages";
		$this->data['positions'][3] = "Saved Messages";
		
		$this->load->view("schools/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("left_mail", $this->data);
		$this->load->view("schools/mail_page", $this->data);
		$this->load->view("schools/footer", $this->data);
	}
	
	public function trash () {
		$this->data['msg_link'] = "Trash";
		$this->verifyUser();
		$this->data['positions'][1] = $this->session->school->name;
		$this->data['positions'][2] = "Messages";
		$this->data['positions'][3] = "Trashed Messages";
		
		$this->load->view("schools/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("left_mail", $this->data);
		$this->load->view("schools/mail_page", $this->data);
		$this->load->view("schools/footer", $this->data);
	}
	
	public function email_check ($email) {
		if ($this->schoolModel->confirmSchoolEmailDuplication($email)) {
			$this->form_validation->set_message('email_check', "The email address {$email} is already taken");
			return false;
		} else return true;
	}
	
	public function url_check ($param) {
		if ($this->schoolModel->confirmSchoolUrlDuplication($param)) {
			$this->form_validation->set_message('url_check', "The website address {$param} is already taken");
			return false;
		} else return true;
	}
	
	public function name_check ($param) {
		if ($this->schoolModel->confirmSchoolNameDuplication($param)) {
			$this->form_validation->set_message('name_check', "The Instituition Name {$param} is already taken");
			return false;
		} else return true;
	}
	
	public function my_profile () {
		$this->verifyUser();
		$this->data['positions'][1] = "<a href='".base_url('school')."'>Profile</a>";
		$this->data['positions'][2] = $this->session->school->name;
		
		$this->form_validation->set_rules("name", "Instituition Name", "required|trim|callback_name_check");
		$this->form_validation->set_rules("year", "Year of Establishment", "required|trim");
		$this->form_validation->set_rules("url", "Website Url", "required|trim|callback_url_check");
		$this->form_validation->set_rules("email", "Official Admission Email", "required|trim|callback_email_check");
		$this->form_validation->set_rules("address", "Official Campus Address", "required");
		$this->form_validation->set_rules("state", "State", "required");
		
		$uploads 			= new stdClass();
		$uploads->cover 	= null;
		$uploads->emblem	= null;
			
		if ($this->form_validation->run() && ($_FILES['emblem']['size']) > 0 && ($_FILES['cover']['size']) > 0) {
			
			$this->upload->do_upload('cover');
			$uploads->cover 	= $this->upload->data();
			
			$this->upload->do_upload('emblem');
			$uploads->emblem	= $this->upload->data();
			
			$this->schoolModel->updateProfile($uploads);
			redirect('school');
		} else if ($this->form_validation->run() && $_FILES['emblem']['size'] > 0 && ($_FILES['cover']['size']) <= 0) {
				
			$this->upload->do_upload('emblem');
			$uploads->emblem	= $this->upload->data();
			
			$this->schoolModel->updateProfile($uploads);
			redirect('school');
		} else if ($this->form_validation->run() && ($_FILES['emblem']['size']) <= 0 && ($_FILES['cover']['size']) > 0) {
			
			$this->upload->do_upload('cover');
			$uploads->cover 	= $this->upload->data();
			
			$this->schoolModel->updateProfile($uploads);
			redirect('school');
		} else if ($this->form_validation->run() && ($_FILES['emblem']['size']) <= 0 && ($_FILES['cover']['size']) <= 0) {
			$this->schoolModel->updateProfile($uploads);	
			redirect('school');
		} else {

			$this->load->view("schools/header", $this->data);
			$this->load->view("ordinary_bar", $this->data);
			$this->load->view("schools/profile", $this->data);
			$this->load->view("schools/footer", $this->data);	
		}
		
	}
	
	public function discipline ($param = 0) {
		$this->verifyUser();
		$this->data['positions'][1] = $this->session->school->name;
		$this->data['positions'][2] = "<a href='".base_url('school/disciplines')."'>Disciplines</a>";
		$this->data['discipline'] 	= $discipline = $this->schoolModel->getSingleDiscipline($param);
		$this->data['status']		= false;
			
		if ($param === 0 || strlen($param) < 1 || $discipline === NULL) show_404(); 
		else {
			$this->data['positions'][3] = "{$discipline->discipline_name}";
			
			$this->form_validation->set_rules("local", "Local Student Fees", "required|trim|numeric");
			$this->form_validation->set_rules("intl", "International Student Fees", "required|trim|numeric");
			$this->form_validation->set_rules("duration", "Course Duration", "required|trim");
			$this->form_validation->set_rules("variant", "Course Variant", "required|trim");
			$this->form_validation->set_rules("delivery_mode", "Course Delivery Mode", "required|trim");
			$this->form_validation->set_rules("description", "Course Description", "required|trim");
			$this->form_validation->set_rules("content", "Course Content", "required|trim");
			$this->form_validation->set_rules("adm_experience", "Admission Requirements", "required|trim");
			$this->form_validation->set_rules("work_experience", "Work Experience", "required|trim");
			
			if ($this->form_validation->run()) {
				$this->schoolModel->updateDiscipline($param);
				$this->data['status']	= true;
				$this->session->set_flashdata('updated', array('status'=>TRUE, 'title'=>'Updated', 'message'=>'Program Successfully Updated!'));
				redirect('school/discipline/'.$param);
			} 
			$this->load->view("schools/header", $this->data);
			$this->load->view("ordinary_bar", $this->data);
			$this->load->view("schools/course_page", $this->data);
			$this->load->view("schools/right_side_ads", $this->data);
			$this->load->view("schools/footer", $this->data);
		} 
	}
	
	public function scholarships () {
		$this->verifyUser();
		$this->data['positions'][1] = $this->session->school->name;
		$this->data['positions'][2] = "Scholarships";
		
		$this->load->view("schools/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("schools/scholarships", $this->data);
		$this->load->view("schools/right_side_ads", $this->data);
		$this->load->view("schools/footer", $this->data);
	}
	
	public function applicant ($param = 0) {
		$this->verifyUser();
		$this->data['positions'][1] = $this->session->school->name;
		$this->data['positions'][2] = "Applicant";
		
		if ($param === 0 || strlen($param) < 1) show_404(); 
		else {
			$this->load->view("schools/header", $this->data);
			$this->load->view("ordinary_bar", $this->data);
			$this->load->view("applicant", $this->data);
			$this->load->view("schools/footer", $this->data);	
		}
	}
	
	public function getCourses () {
		$result = $this->schoolModel->getAllQueryDisciplines();
		foreach($result as $k) $k->description = base64_decode($k->description);
		echo json_encode(array('courses'=>$result)); 
	}

	public function assignDisciplineSchool () {
		
		$assoc = array(
			'school'  		=> $this->session->school->id,
			'faculty' 		=> $this->input->post('faculty'),
			'discipline' 	=> $this->input->post('discipline'),
			'description' 	=> "",
			
		);
		$this->schoolModel->assignDisciplineSchool($assoc);
	}
	
	public function assignDisciplineSchoolUpdate () {
		$assoc = array(
			'school'  		=> $this->session->school->id,
			'faculty' 		=> $this->input->post('faculty'),
			'discipline' 	=> $this->input->post('discipline'),
			'description' 	=> "",
		);
		$this->schoolModel->assignDisciplineSchoolUpdate($assoc, $this->input->post('id'));
	}
	
	public function getSchoolDisciplines () {
		$result = $this->schoolModel->getSchoolDisciplines();
		foreach($result as $k) {
			$k->description = base64_decode($k->description);
		}
		echo json_encode(array('courses'=>$result)); 
	}
	
	public function saveSchoolApplication () {
		$this->schoolModel->saveSchoolApplication();
	}
	
	public function updateSchoolApplication () {
		$this->schoolModel->updateSchoolApplication();
	}
	
	public function deleteSchoolApplication() {
		$this->schoolModel->deleteSchoolApplication ();
	}
	
	public function getSchoolApplicationFrames () {
		$this->schoolModel->getSchoolApplicationsFrames();
	}
	
	public function fetchApplicants () {
		$this->schoolModel->fetchApplicants();
	}
	
	public function getNews () {
		$this->schoolModel->getNews();
	}
	
	public function commitNews() {
		$this->schoolModel->commitNews();
	}
	
	public function dropNews () {
		$this->schoolModel->dropNews();
	}

	public function getScholarships () {
		$this->schoolModel->getScholarships();
	}
	
	public function commitScholarship() {
		$this->schoolModel->commitScholarship();
	}
	
	public function dropScholarship () {
		$this->schoolModel->dropScholarship();
	}
	
	private function verifyUser () {
		
		if ($this->session->user === NULL) {
			redirect('users/signIn');
		} 
	}
}