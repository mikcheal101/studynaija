<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class UsersController extends CI_Controller {

	protected $me			= null;
	protected $fb 			= null;
	protected $userNode 	= null;
	protected $fbSession 	= null;
	protected $data			= array();
	
	public function __construct () {
		parent::__construct();
		$this->data['title'] 					= "studynaija";
		$this->data['positions'] 				= array("studynaija");
		
		$this->data['countries'] 				= $this->usersModel->getCountries();
		$this->data['semesters'] 				= $this->usersModel->getSemesters();
		$this->data['payment_options'] 			= $this->usersModel->getPaymentOptions();
		$this->data['highest_qualifications'] 	= $this->usersModel->getHighestQualification();
		$this->data['englishLevels'] 			= $this->usersModel->getEnglishLevel();
		$this->data['all_states'] 				= $this->usersModel->getAllStates();
		$this->data['faculties']				= $this->usersModel->getAllFaculties();
		
		$this->data['passporterror'] = "";
		$this->data['user'] = $this->me = ($this->session->user !== null)?$this->usersModel->getApplicant($this->session->user->id):array();
		
		$this->facebook = $this->my_facebook;
	}
	
	
	public function index () {
		$this->data['positions'][1] = "home";
		$this->load->view("home", $this->data);
	}
	
	public function loadNews () {
		$this->usersModel->loadNews ();
	}
	
	public function checkUsername () {
		$this->usersModel->checkUsername ();
	}
	
	public function checkEmail () {
		$this->usersModel->checkEmail ();
	}
	
	public function getProfile () {
		echo json_encode (array ('user'=>$this->session->user));
	}
	
	private function onlyLoggedInApplicant () {
		if ($this->session->user === null || (int)$this->session->user->usertype !== APPLICANT)
			redirect('users/signIn'); 
	}
	
	
	public function my_application () {
		$this->onlyLoggedInApplicant();
		$this->data['sub_title'] 	= "my applications";
		$this->data['positions'][1] = "my applications";
		
		$this->load->view("user/header", $this->data);
		$this->load->view("user/search_bar", $this->data);
		$this->load->view("user/left_mail", $this->data);
		$this->load->view("user/my_applications", $this->data);
		$this->load->view("footer", $this->data);
	}
	
	
	
	public function my_dashboard () {
		$this->onlyLoggedInApplicant();
		
		$this->data['positions'][1] = "profile";
		
		
		$this->data['positions'][2] = "{$this->me->firstname} ".((strlen($this->me->middlename) > 0)?$this->me->middlename." ":"")."{$this->me->lastname}";
		
		$this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
		$this->form_validation->set_rules('middlename', 'Middle Name', 'trim');
		$this->form_validation->set_rules('email', 'Email Address', 'required|trim');
		$this->form_validation->set_rules('tel', 'Telephone Number', 'required|trim');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'required|trim');
		$this->form_validation->set_rules('nationality', 'Nationality', 'numeric|required|trim');
		$this->form_validation->set_rules('gender', 'Gender', 'numeric|required|trim');
		$this->form_validation->set_rules('cor', 'Country of Residence', 'numeric|required|trim');
		$this->form_validation->set_rules('address', 'Address', 'required|trim');
		$this->form_validation->set_rules('start_semester', 'Starting Semester', 'numeric|trim');
		$this->form_validation->set_rules('payment_options', 'Payment Option', 'required|trim|numeric');
		$this->form_validation->set_rules('highest_qualification', 'Highest Qualification', 'required|trim|numeric');
		$this->form_validation->set_rules('cos', 'Country of study', 'required|trim|numeric');
		$this->form_validation->set_rules('yoe', 'Years of Experience', 'required|trim|numeric');
		$this->form_validation->set_rules('el', 'English Level', 'required|trim|numeric');
		$this->form_validation->set_rules('extra_notes', 'Extra Notes', 'required|trim');
		
		if ($this->form_validation->run()) {
			$image 	= ($this->upload->do_upload('documents') )? $this->upload->data():array();
			
			# send the data to the db
			$applicant = array(
				'user' 					=> array(
					'email' 			=> $this->input->post('email'),
					'id'				=> $this->me->id,
				),
				'person' 				=> array(
					'firstname' 		=> $this->input->post('firstname'),
					'lastname' 			=> $this->input->post('lastname'),
					'middlename' 		=> $this->input->post('middlename'),
					'tel' 				=> $this->input->post('tel'),
					'dob' 				=> $this->input->post('dob'),
					'nationality' 		=> $this->input->post('nationality'),
					'gender' 			=> $this->input->post('gender'),
					'country_of_residence'	=> $this->input->post('cor'),
					'address' 			=> base64_encode($this->input->post('address')),
					'start_semester' 	=> $this->input->post('start_semester'),
					'payment_options' 	=> $this->input->post('payment_options'),
					'highest_qualification' => $this->input->post('highest_qualification'),
					'country_of_study' 	=> $this->input->post('cos'),
					'years_of_expirence'=> $this->input->post('yoe'),
					'english_level' 		=> $this->input->post('el'),
					'extra_notes' 		=> base64_encode($this->input->post('extra_notes')),
					'user'				=> $this->me->id,
				),
			);
			
			if (count($image) > 0) 
				$applicant['documents']	= array(
					'url'				=> "images/applicants/documents/{$image['file_name']}",
					'applicant'			=> $this->me->id,
				);
			
			# send to the database
			$this->usersModel->updateProfile($applicant, $image['file_size']);
			unset($_POST);
			unset($_FILES);
			redirect('users/myDashboard');
		} else {
			
			$this->load->view("user/header", $this->data);
			$this->load->view("user/search_bar", $this->data);
			$this->load->view("user/my_dashboard", $this->data);
			$this->load->view("footer", $this->data);
			 
		} 
	}
	
	public function change_password () {
		$this->onlyLoggedInApplicant();
		$this->load->view("user/header", $this->data);
		$this->load->view("user/search_bar", $this->data);
		$this->load->view("user/change_password", $this->data);
		$this->load->view("footer", $this->data);
	}
	
	public function forgot_password () {
		
		$this->data['positions'][1] = "forgot Password";
		
		$this->load->view("user/header", $this->data);
		$this->load->view("user/search_bar", $this->data);
		$this->load->view("user/forgot_password", $this->data);
		$this->load->view("footer", $this->data);
	}
	
	public function sign_up () {
		$this->data['positions'][1] = "signUp";
		
		$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[10]|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[10]');
		$this->form_validation->set_rules('tel', 'Tel Number', 'required|trim|min_length[10]');
		$this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
		$this->form_validation->set_rules('middlename', 'Middle Name', 'trim');
		$this->form_validation->set_rules('gender', 'Gender', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'required|trim');
		
		if($this->form_validation->run()) {
			# send the user a validation email then show the alert message
			
			$user 			= new stdClass();
			$user->user 	= new stdClass();
			$user->person	= new stdClass();
			
			$user->user->username		= $this->input->post('username');
			$user->user->password	 	= md5($this->input->post('password'));
			$user->user->email	 		= $this->input->post('email');
			$user->user->profile_image	= null;
			$user->user->usertype		= 4;
			
			$user->person->firstname 	= $this->input->post('firstname');
			$user->person->lastname 	= $this->input->post('lastname');
			$user->person->middlename 	= $this->input->post('middlename');
			$user->person->tel 			= $this->input->post('tel');
			$user->person->gender 		= $this->input->post('gender');
			$user->person->dob			= $this->input->post('dob');
			
			$this->usersModel->addUser($user);
			$this->data['form'] = true;
			$this->data['mail'] = $this->input->post('email');
		} 
		$this->load->view("header", $this->data);
		$this->load->view("user/search_bar", $this->data);
		$this->load->view("user/signup", $this->data);
		$this->load->view("footer", $this->data);	
	}
	
	public function sign_in () {
		unset($_SESSION['user']);
		unset($_SESSION['school']);
		$this->data['positions'][1] = "signIn";
		
		$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[8]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');
		
		if ($this->form_validation->run()) {
			# send to the model
			$user = new stdClass();
			$user->username		= $this->input->post('username');
			$user->password	 	= md5($this->input->post('password'));
			$result = $this->usersModel->authenticate($user);
			
			if (count($result) > 0) {
				# check user status
				if ($result->status == SUSPENDED_ACCOUNT) {
					# DISPLAY SUSPENDED
					$this->data['error']= "This account has been suspended!";
					$this->data['form'] = FALSE;
				} else if ($result->status == DEACTIVATED_ACCOUNT) {
					# DISPLAY DEACTIVATED
					$this->data['error']= "This account has been deactivated!";
					$this->data['form'] = FALSE;
				} else if ($result->status == ACTIVATED_ACCOUNT) {

					#check if this is a user, school, admin, superadmin
					$this->session->set_userdata(array('user'=>$result));
					
					# DIRECT TO ACCOUNT PAGE
					switch($result->usertype) {
						case SUPER_ADMIN:
							var_dump ($result); 
							echo "<hr>";
							var_dump ($this->session);
							echo "<hr>";
							var_dump ($this->session->user);
							exit ();
							redirect('admin');
							
							break;
						case ADMINISTRATOR:
							redirect('admin');
							break;
						case SCHOOL_ADMINISTRATOR:
							$this->session->school = $this->schoolModel->getSchoolFromUser($this->session->user->id);
							redirect('school');
							break;
						case APPLICANT:
							redirect('users/myDashboard');
							break;	
						default:
							redirect('users/');
							break;
					}
				} else if ($result->status === PENDING_ACCOUNT) {
					# DISPLAY PENDING
					$this->data['error']= "This account is pending confirmation, Please check your email account.";
					$this->data['form'] = FALSE;
				} 
			} else {
				# display username / password in correct
				$this->data['error']= "Username / Password Incorrect";
				$this->data['form'] = FALSE;
			}
			
		}
		
		$this->load->view("header", $this->data);
		$this->load->view("user/search_bar", $this->data);
		
		$this->load->view("user/sign_in", $this->data);
		$this->load->view("footer", $this->data);

	}
	
	public function sign_out () {
		unset($_SESSION['user']);
		unset($_SESSION['school']);
		#var_dump($_SESSION);
		redirect('users/signIn');
	}
	
	public function schools ($fav="false") {
		$this->data['positions'][1] = "schools";
		if ($fav!= "false") $this->data['positions'][2] = "my favourite schools";
		
		$this->load->view("user/header", $this->data);
		$this->load->view("user/search_bar", $this->data);
		$this->load->view("user/schools", $this->data);
		$this->load->view("footer", $this->data);
	}
	
	public function fetchSchools () {
		$this->usersModel->fetchSchools();
	}
	
	public function disciplines ($fav="false") {
		$this->data['positions'][1] = "disciplines";
		if ($fav!= "false") $this->data['positions'][2] = "my favourite disciplines";
		
		
		$this->load->view("user/header", $this->data);
		$this->load->view("user/search_bar", $this->data);
		$this->load->view("user/disciplines", $this->data);
		$this->load->view("footer", $this->data);
	}
	
	public function discipline ($param = 0) {
		$this->data['param'] = $param;
		if ($param === 0 || strlen($param) < 1) show_404();
		
		// fetch from the asscociation table
		$this->data['discipline'] = $discipline = $this->usersModel->getDiscipline($param);
		if ($discipline === NULL) show_404(); 
		else {
			$this->data['positions'][1] = "{$discipline->school_name}";
			$this->data['positions'][2] = "{$discipline->course_name}";
			
			$this->load->view("user/header", $this->data);
			$this->load->view("user/search_bar", $this->data);
			
			$this->load->view("user/course_page", $this->data);
			$this->load->view("footer", $this->data);
		
		}
	}
	
	public function getCourse () {
		$param = $this->input->post('discipline');
		$result = array();
		if ($param !== 0 || strlen($param) > 1) {
			 $result = $this->usersModel->getDiscipline($param);
		} 
		echo json_encode(array('course'=>$result));
	}
	
	public function scholarships () {}
	
	public function scholarship ($param) {}
	
	public function courses () {
		$this->load->view("user/header", $this->data);
		$this->load->view("user/search_bar", $this->data);
		$this->load->view("user/course_page", $this->data);
		$this->load->view("footer", $this->data);
	}
	
	public function search_results () {
		$this->data['positions'][1] = "search results for";
		$url = $this->input->get();
		$result = $this->input->get('searchbar') !== null ? $this->input->get('searchbar') : $this->input->get('school') !== null ? $this->input->get('searchbar') : "";
		
		$this->data['search_url'] = array();
		if(count($url)) {
			$this->data['positions'][1] = "search";
			$this->data['positions'][2] = (key($url) !== "searchbar" ? key($url) : "discipline");
			$this->data['positions'][3] = $url[key($url)];
			$url[key($url)] = str_replace(' ', '_', $url[key($url)]);
			$this->data['search_url']   =  array('url'=> $url);
		}
		
		$this->data['search'] = $result;
		
		$this->load->view("user/header", $this->data);
		$this->load->view("user/search_bar", $this->data);
		$this->load->view("user/left-2sided", $this->data);
		$this->load->view("user/search_results", $this->data);
		$this->load->view("footer", $this->data);
		
	}
	
	public function states ($state='') {
		$this->data['positions'][1] = "states";
		if (strlen($state) > 1) $this->data['positions'][2] = "{$state}";
		
		$this->load->view("user/header", $this->data);
		$this->load->view("user/search_bar", $this->data);
		$this->load->view("user/states", $this->data);
		$this->load->view("footer", $this->data);
	}
	
	public function deleteDocument ($id = 0) {
		if ($id === 0) show_404();
		else {
			$url = $this->usersModel->deleteDocument($id);
			# purge file
			unlink(BASEPATH."../{$url}");
			redirect('users/myDashboard');
		}
	}
	
	public function applicantpassport () {
		# this is where the passport upload is done
		if ($this->upload->do_upload('passportFile')) {
			$this->usersModel->updatePassport($this->upload->data());
		} else {
			$this->data['passporterror'] = $this->upload->display_errors('<div class="error text-red font-12">', '</div>');
		}
		redirect('users/myDashboard');
	}
	
	public function checkout () {
		$this->onlyLoggedInApplicant();
		$this->load->view("user/header", $this->data);
		$this->load->view("user/checkout", $this->data);
		$this->load->view("footer", $this->data);
	}
	
	public function verifyPaystackPayment () {
		$this->onlyLoggedInApplicant();
		$this->load->view("user/header", $this->data);
		$this->load->view("user/verifyPaystackPayment", $this->data);
		$this->load->view("footer", $this->data);
		 
	}

	public function add_to_cart () {
		
		var_dump($this->session->user);
		if ($this->session->user === null){
			$this->session->set_userdata(array('user'=>$this->usersModel->getUserByFacebook()));
			echo "<hr> setting session <hr>";
		}
			
		#$this->usersModel->addToCart();
	}
	
	public function addApplicant () {
		$this->usersModel->addApplicant();
	}
	
	
	// angular calls
	public function fetchAwards () {
		$this->usersModel->fetchAwards();
	}
	
	public function paymentMade () {
		#$this->onlyLoggedInApplicant();
		$this->usersModel->paymentMade();
	}
	
	public function initializePaystackPayment () {
		
		$cnv 				= file_get_contents("http://free.currencyconverterapi.com/api/v3/convert?q=USD_NGN");
		$cnv 				= json_decode($cnv);
		
		$object				= new stdClass();
		$object->reference 	= md5(time()+ $this->input->post('email') + $this->input->post('amount'));
		$object->amount		= $this->input->post('amount') * $cnv->results->USD_NGN->val;
		$object->email		= $this->input->post('email');
		$object->cart		= $this->input->post('cart');
		
		$this->usersModel->initializePayment($object->reference, $object->cart);
		echo $this->paystack->initializePayment($object);
	}
	
	public function ajaxVerifyPayStackPayment () {
		$object = new stdClass();
		$object->reference = $this->input->post('reference');
		echo $this->paystack->verifyPayment($object);
	}
	
	public function ajaxConfirmPayment () {
		$object = new stdClass();
		#$object->reference 			= $this->input->post('reference');
		$object->authorization_code = $this->input->post('authorization_code');
		$object->amount 			= $this->input->post('amount');
		$object->email 				= $this->input->post('email');
		echo $this->paystack->chargePayment($object);
	}
	
	public function getSubDisciplines ($faculty) {
		$this->usersModel->getSubDisciplines($faculty);
	}
	
	public function getSchoolCourses () {
		$this->usersModel->searchData();
	}
	
	public function fetchMyApplications  () {
		echo json_encode(array('applications'=>$this->usersModel->fetchMyApplications()));
	}
	
	public function fetchStates () {
		$this->usersModel->fetchStates();
	}
	
	public function fetchVariants () {
		$this->usersModel->fetchVariants();
	}
	
	public function getFaculties () {
		echo json_encode(array('faculties'=> $this->data['faculties']));
	}
	
	public function getCartItems () {
		echo json_encode(array('cartItems' => $this->usersModel->getMyCart()));
	}
	
	private function verifyUser () {
		if ($this->session->user === NULL) {
			redirect('users/signIn');
		}
	}
	
	
	private function getFbStatus () {
		if (!$this->fb) {
			$url = $this->facebook->getLoginUrl();;
			echo json_encode(array('fb'=>array('status'=>false, 'url'=>$url)));
		} return json_encode(array('fb'=>array('status'=>true)));
	}
	
	public function validateFacebook () {
		# check if user is already in db 
		$user_exists = $this->authModel->confirmFacebookUser();
		
		if (count($user_exists) > 0) {
			# login user
			# check user status
			switch ($user_exists->status) {
				case SUSPENDED_ACCOUNT: 
					# DISPLAY SUSPENDED
					$_SESSION["error"][] = "This account has been suspended!";
				break;
				case DEACTIVATED_ACCOUNT:
					# DISPLAY DEACTIVATED
					$_SESSION["error"][]= "This account has been deactivated!";
				break;
				case ACTIVATED_ACCOUNT:
					#check if this is a user, school, admin, superadmin
					$this->session->set_userdata(array('user'=>$result));
				break;
				case PENDING_ACCOUNT:
					# DISPLAY PENDING
					$_SESSION["error"][]= "This account is pending confirmation, Please check your email account.";
				break;
			} 
		} else {
			# if user isnt a member add to db
			$saved = $this->authModel->saveFacebookUser(); 
			# send message that profile is incomplete
			if ($saved) {
				# send a welcome message
			} else {
				# send a report that the account already aexits
			}
		}
	}
	
	public function logoutFacebook () {
		session_destroy();
		redirect(base_url());
	}
	
	public function ajaxGetFacebookUser () {
		echo json_encode(array('facebook'=>$this->fb));
	}
	
} 