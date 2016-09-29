<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {
	
	protected $data = array();
	protected $me;
	
	public function __construct () {
		parent::__construct();
		$this->data['title'] 					= "studynaija";
		$this->data['msg_usr'] 					= "admin";
		$this->data['positions'] 				= array("studynaija");
		$this->data['countries'] 				= $this->usersModel->getCountries();
		$this->data['semesters'] 				= $this->usersModel->getSemesters();
		$this->data['payment_options'] 			= $this->usersModel->getPaymentOptions();
		$this->data['highest_qualifications'] 	= $this->usersModel->getHighestQualification();
		$this->data['englishLevels'] 			= $this->usersModel->getEnglishLevel();
		$this->data['states']					= $this->adminModel->getStates();
		$this->data['user'] 					= $this->me = $this->session->user;
		$this->data['positions'][1] = "Administrator";
	}
	
	public function index () {
		$this->verifyUser();
		$this->data['positions'][2] = "Home Page";
		
		$this->load->view("admin/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("admin/side_view", $this->data);
		$this->load->view("admin/index", $this->data);
		$this->load->view("admin/footer", $this->data);
	}
	
	public function commitFaculty () {
		$this->adminModel->commitFaculty ();
	}
	
	public function instituition_types () {
		$this->verifyUser();
		$this->data['positions'][2] = "Instituition Types";
		
		$this->load->view("admin/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("admin/side_view", $this->data);
		$this->load->view("admin/instituition_types", $this->data);
		$this->load->view("admin/footer", $this->data);
	}
	
	public function load_instituition_types () {
		$this->adminModel->load_instituition_types ();
	}
	
	public function check_inst_type () {
		$this->adminModel->check_inst_type ();
	}
	
	public function commit_inst_type () {
		$this->adminModel->commit_inst_type ();
	}
	
	public function drop_inst_type () {
		$this->adminModel->drop_inst_type ();
	}
	
	public function uploadExcelInstituitions () {
		
	}
	
	public function uploadExcelDisciplines () {
		//if ($this->upload->)
	}
	
	public function dropFaculty () {
		$this->adminModel->dropFaculty ();
	}
	
	public function loadFaculties () {
		$this->adminModel->loadFaculties ();
	}
	
	public function checkfacultyname () {
		$this->adminModel->checkfacultyname ();
	}
	
	public function faculties () {
		$this->verifyUser();
		$this->data['positions'][2] = "Faculties";
		
		$this->load->view("admin/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("admin/side_view", $this->data);
		$this->load->view("admin/faculties", $this->data);
		$this->load->view("admin/footer", $this->data);
	}
	
	public function loadNews () {
		$this->adminModel->loadNews ();
	}
	
	public function updateProfile () {
		#var_dump ($_FILES['files']); return;
		$files = $_FILES['files'];
		$_FILES['usr'] = array (
			'name' => $files['name'][0],
			'type' => $files['type'][0],
			'tmp_name' => $files['tmp_name'][0],
			'error' => $files['error'][0],
			'size' => $files['size'][0],
		);
		
		$config = $this->set_upload_options();
		$config['upload_path']	= 'images/admins';
		$this->upload->initialize ($config);
		
		if ($this->upload->do_upload('usr'))
			$this->adminModel->updateProfile ($this->upload->data ());
	}
	
	public function news () {
		$this->verifyUser();
		$this->data['positions'][2] = "News";
		
		$this->load->view("admin/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("admin/side_view", $this->data);
		$this->load->view("admin/news", $this->data);
		$this->load->view("admin/footer", $this->data);
	}

	public function commitNews () {		
		
		$file 	= $_FILES['files'] ?? array ();
		$config = $this->set_upload_options();
		$config['upload_path']	= 'resources/news';
		$this->upload->initialize ($config);
		$data = array (); # data to store all the uploaded file details
		
		if (count ($file) > 0)
			for ($i=0; $i<count ($file['name']); $i++) {
				$_FILES['usr'] = array (
					'name' 		=> $file['name'][$i],
					'type' 		=> $file['type'][$i],
					'tmp_name' 	=> $file['tmp_name'][$i],
					'error' 	=> $file['error'][$i],
					'size' 		=> $file['size'][$i],
				);
			
				if ($this->upload->do_upload('usr'))
					$data[] = $this->upload->data ();
			}
		
		$this->adminModel->commitNews ($data);
	}
	
	public function dropNews () {
		$this->adminModel->dropNews ();
	}
	
	public function ajaxGetDisciplines () {
		#$this->ajaxVerifyUser();
		$this->adminModel->ajaxgetDisciplines ();
		#echo json_encode (array ('date'=> date ()));
	}
	
	public function ajaxSaveDiscipline () {
		$this->adminModel->ajaxSaveDiscipline ();
	}
	
	public function ajaxUpdateDiscipline () {
		$this->adminModel->ajaxUpdateDiscipline ();
	}
	
	public function checkDisciplineName () {
		$this->adminModel->checkDisciplineName ();
	}
	
	public function removeDiscipline () {
		$this->adminModel->removeDiscipline ();
	}
	
	public function disciplines () {
		$this->verifyUser();
		$this->data['positions'][2] = "Disciplines";
		
		$this->load->view("admin/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("admin/side_view", $this->data);
		$this->load->view("admin/disciplines", $this->data);
		$this->load->view("admin/footer", $this->data);
	}
	
	public function assign () {
		$this->verifyUser();
		$this->data['positions'][2] = "Instituitions to disciplines";
		
		$this->load->view("admin/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("admin/side_view", $this->data);
		$this->load->view("admin/assign", $this->data);
		$this->load->view("admin/footer", $this->data);
	}
	
	public function applications () {
		$this->verifyUser();
		$this->load->view("admin/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("admin/applications", $this->data);
		$this->load->view("admin/footer", $this->data);
	}
	
	public function applicant ($param =0) {
		if ($param === 0 || strlen($param) < 1) show_404(); 
		else {
			$this->load->view("admin/header", $this->data);
			$this->load->view("ordinary_bar", $this->data);
			$this->load->view("applicant", $this->data);
			$this->load->view("admin/footer", $this->data);
		}
	}
	
	
	public function ajaxDeleteInstituition () {
		$this->adminModel->deleteInstituition ();
	}
	
	public function ajaxLoadInstituitions () {
		$this->adminModel->ajaxGetInsituitions ();
	}
	
	public function commitScholarship () {
		$this->adminModel->commitScholarship ();
	}
	
	public function dropScholarship () {
		$this->adminModel->dropScholarship ();
	}
	
	public function loadStates () {
		echo json_encode (array ('states'=> $this->data['states']));
	}
	
	public function ajaxSaveInstituition () {
		$files = array ();
		# confirm user / school does not exist 
		#var_dump ($_POST['data']['logo']); return;
		if (isset ($_FILES['logo_file'])) {
			$config = $this->set_upload_options();
			$config['upload_path']	= 'images/schools';
			$this->upload->initialize ($config);
			if ($this->upload->do_upload('logo_file')) {
				$files = $this->upload->data ();
			}
		}
		$this->adminModel->ajaxSaveInstituition ($files);
	}
	
	public function uploadPix () {
		$config = $this->set_upload_options();
		$config['upload_path']	= 'images/schools';
		$this->upload->initialize ($config);
		if ($this->upload->do_upload('logo'))
	        $this->adminModel->saveInstituitionLogo ($this->upload->data ());
	}
	
	public function checkinstname () {
		$this->adminModel->checkinstname ();
	}
	
	private function set_upload_options ( ) {   
	    //upload an image options
	    $config = array();	    
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = 0;
		$config['file_name']			= time();
		$config['encrypt_name']			= TRUE;
		$config['remove_spaces']		= TRUE;
	    return $config;
	}
	
	public function instituitions () {
		$this->verifyUser();
		$this->data['positions'][2] = "Instituitions";
		
		$this->load->view("admin/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("admin/side_view", $this->data);
		$this->load->view("admin/instituitions", $this->data);
		$this->load->view("admin/footer", $this->data);
	}
	
	public function my_profile () {
		$this->verifyUser();
		$this->load->view("admin/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("admin/side_view", $this->data);
		$this->load->view("admin/my_profile", $this->data);
		$this->load->view("admin/footer", $this->data);
	}
	
	public function states () {
		$this->load->view("admin/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("admin/states", $this->data);
		$this->load->view("admin/footer", $this->data);	
	}
	
	private function verifyUser () {
		
		var_dump ($this->session);
		echo "<hr>";
		var_dump ($_SESSION);
		echo "<hr>";
		exit ();
		$usertype = (int)$this->session->user->usertype;
		if ($this->session->user === NULL) {
			redirect('users/signIn');
		} else if (($usertype !== ADMINISTRATOR) && ($usertype !== SUPER_ADMIN)) {
			redirect('users/signIn');
		}
	}
	
	private function ajaxVerifyUser () {
		if ($this->session->user === NULL) {
			echo json_array (array('status'=> 500, 'message'=>"user not allowed", "object"=>array ()));
			return ;
		}
	}
	
	public function webAdmins ( ) {
		$this->verifyUser();
		$this->data['positions'][2] = "Web Administrators";
		$this->load->view("admin/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("admin/side_view", $this->data);
		$this->load->view("admin/webAdmins", $this->data);
		$this->load->view("admin/footer", $this->data);
	}
	
	public function schAdmins ( ) {
		$this->verifyUser();
		$this->data['positions'][2] = "Instituitions Administrators";
		$this->load->view("admin/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("admin/side_view", $this->data);
		$this->load->view("admin/schAdmins", $this->data);
		$this->load->view("admin/footer", $this->data);
	}
	
	/**
	* list of all the applicants
	*/
	public function users ( ) {
		$this->verifyUser();
		$this->data['positions'][2] = "Applicants";
		$this->load->view("admin/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("admin/side_view", $this->data);
		$this->load->view("admin/users", $this->data);
		$this->load->view("admin/footer", $this->data);
	}
	
	public function scholarships ( ) {
		$this->verifyUser();
		$this->data['positions'][2] = "Scholarships";
		$this->load->view("admin/header", $this->data);
		$this->load->view("ordinary_bar", $this->data);
		$this->load->view("admin/side_view", $this->data);
		$this->load->view("admin/scholarships", $this->data);
		$this->load->view("admin/footer", $this->data);
	}
	
	
	public function disciplineTypes () {
		echo json_encode (array ('types' => $this->adminModel->disciplineTypes ()));
	}
	
	public function ajaxUsers () {
		echo json_encode (array ('status' => 200, 'object' => $this->adminModel->ajaxUsers (), 'message' => 'Data retrieved'));
	}
	
	public function ajaxWebAdmins () {
		echo json_encode (array ('status' => 200, 'object' => $this->adminModel->ajaxWebAdmins (), 'message' => 'Data retrieved'));
	}
	
	public function ajaxSchAdmins () {
		echo json_encode (array ('status' => 200, 'object' => $this->adminModel->ajaxSchAdmins (), 'message' => 'Data retrieved'));
	}
	
	public function ajaxScholarships () {
		echo json_encode (array ('status' => 200, 'object' => $this->adminModel->ajaxScholarships (), 'message' => 'Data retrieved'));
	}
	
	public function commitWebAdmin () {
		#$this->adminModel->commitWebAdmin (); return ;
		$boolean = $this->adminModel->commitWebAdmin ();
		echo json_encode (array ('status' => ($boolean > -1) ? 200 : 400, 'object' => $boolean, 
			'message' => ($boolean) ? 'WebAdmin Commited Successfully' : 'Error Commiting Web Admin' ));
	}
	
	
	public function deleteWebAdmin () {
		$boolean = $this->adminModel->deleteWebAdmin ();
		echo json_encode (array ('status' => ($boolean) ? 200 : 400, 'object' => $boolean, 
			'message' => ($boolean) ? 'WebAdmin Deleted Successfully' : 'Error Deleting Web Admin' ));
	}
	
}

 