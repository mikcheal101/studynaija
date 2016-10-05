<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function authenticate($user) {
        $this->db
            ->select()
            ->from('users')
            ->where('username', $user->username)
            ->where('password', $user->password)
            ->limit(1);
        $db = $this->db->get();
        return $db->row();
    }
	
	public function loadNews () {
		$this->db->order_by('date', 'DESC');
		$news = $this->db->get ('news')->result ();
		
		foreach ($news as $n) {
			$n->subject 	= base64_decode ($n->subject);
			$n->details		= base64_decode ($n->details);
			$n->resources 	= $this->db->get_where ('news_resources', array ('news'=>$n->id))->result();
		}
		return $news;
	}
	
	public function checkUsername () {
		$row = $this->db->get_where ('users', array ('username' => $this->input->post ('username'), 'username!=' => $this->session->user->username))->row ();
		echo json_encode (array ('return' => isset ($row)));
	}
	
	public function checkEmail () {
		$row = $this->db->get_where ('users', array ('email' => $this->input->post ('email'), 'email !=' => $this->session->user->email))->row ();
		echo json_encode (array ('return' => isset ($row)));
	}
	
    public function addUser($user) {
        $this->db->trans_start();
        $this->db->insert('users', $user->user);
        $user->person->user = $this->db->insert_id();
        $this->db->insert('applicant', $user->person);
        $this->db->trans_complete();
    }

    public function updateProfile($applicant, $size = 0) {
        $this->db->trans_start();
        $this->db->update('users', $applicant['user'], array('id' => $applicant['user']['id']));
        $this->db->update('applicant', $applicant['person'], array('user' => $applicant['person']['user']));
        # save doc if any sent
        if ($size >= 1)
            $q = $this->db->insert('documents', $applicant['documents']);
        $this->db->trans_complete();
    }

    public function changePassword($user) {
        $sql = "UPDATE `users` SET `password`='{$user->password}' WHERE `id`={$user->id}";
        $this->db->query($sql);
    }

    public function dropUser($user) {
        $sql = "";
        if (strlen($user->profile_image) > 0)
            $sql = "UPDATE `users` SET `username`='{$user->username}', `password`='{$user->password}', `email`='{$user->email}', `profile_image`='{$user->profile_image}' ";
        else
            $sql = "UPDATE `users` SET `username`='{$user->username}', `password`='{$user->password}', `email`='{$user->email}' ";
        $sql.= "WHERE `id`={$user->id}";
        $this->db->query($sql);
    }

    public function editUser($user) {
        $this->db->query("DELETE FROM `users` WHERE `id`={$user}");
    }

    public function getApplicant($id) {
        $this->db
                ->select('
                    u.id, u.username, u.password, u.email, u.profile_image, 
                    p.firstname, p.lastname, p.middlename, p.dob, p.nationality, p.gender, p.tel, p.gender, p.country_of_residence,
                    p.address, p.start_semester, p.payment_options, p.highest_qualification, p.country_of_study, p.years_of_expirence,
                    p.english_level, p.extra_notes')
                ->from('users as u, applicant as p')
                ->where('u.id = p.user')
				->where("u.id = {$id}");
        $result = $this->db->get();

        $applicant = $result->row();
		if ($applicant)
        	$applicant->documents = $this->getMyDocumentsList($applicant->id);
        return $applicant;
    }

    public function getCountries() {
        $result = $this->db->get('static_country');
        $data = array();
        foreach ($result->result() as $x) {
            $data[$x->id] = $x->name;
        }
        return $data;
    }

    public function getSemesters() {
        $result = $this->db->get('static_semesters');
        $data = array();
        foreach ($result->result() as $x) {
            $data[$x->id] = $x->name;
        }
        return $data;
    }

    public function getPaymentOptions() {
        $result = $this->db->get('static_payment_options');
        $data = array();
        foreach ($result->result() as $x) {
            $data[$x->id] = $x->name;
        }
        return $data;
    }

    public function getHighestQualification() {
        $result = $this->db->get('static_highest_qualification');
        $data = array();
        foreach ($result->result() as $x) {
            $data[$x->id] = $x->name;
        }
        return $data;
    }

    public function getEnglishLevel() {
        $result = $this->db->get('static_english_level');
        $data = array();
        foreach ($result->result() as $x) {
            $data[$x->id] = $x->name;
        }
        return $data;
    }

    public function getDocument($id) {
        $data = $this->db->get_where('documents', array('id' => $id));
        return $data->row();
    }

    public function getMyDocumentsList($applicantid) {
        $data = $this->db->get_where('documents', array('applicant' => $applicantid));
        return $data->result();
    }

    public function deleteDocument($id) {
        $x = $this->getDocument($id);
        $this->db->delete('documents', array('id' => $id));
        return $x->url;
    }

    public function updatePassport($image_data) {
        # remove the old image if any exists
        if ($this->session->user->profile_image !== NULL)
            unlink(BASEPATH . "../{$this->session->user->profile_image}");

        # update user session to display the image
        $this->session->user->profile_image = base_url("images/applicants/documents/{$image_data['file_name']}");

        # save the new image
        $this->db->update('users', array('profile_image' => $this->session->user->profile_image), array('id' => $this->session->user->id));
    }

    public function getAllStates() {
        $this->db
                ->select('*')
                ->from('static_states')
                ->order_by('name', 'ASC');
        return $this->db->get()->result();
    }

    public function getSubDisciplines($faculty) {
        $this->db->query("
			SELECT 
				`ssd`.`name`, `std`.`id` AS `std_id`
			FROM 
				`static_sub_disciplines` AS `ssd`, `schoolToDisciplines` as `std`, `static_educational_variant` AS `v`, `school` AS `s`
			WHERE 
				`ssd`.`id` IN (SELECT `std`.`discipline` FROM `schoolToDisciplines`) AND `v`.`id` = `std`.`variant` AND `s`.`id` = `std`.`school`
		");
        echo jsson_encode(array('disciplines', $this->db->get()->result()));
    }

    public function searchData() {
        $sql = "SELECT 
				std.id, std.discipline, std.school, std.description, std.qualifications_given as certificate, std.faculty,
			    std.local, std.intl, std.duration, std.content, std.school,
				std.delivery_mode, std.variant, (select name from static_educational_variant as v where std.variant = v.id) as variant_name,
			    (SELECT name from static_delivery_mode where id=std.delivery_mode) as deliver_mode_name,
			    (select name from school where id = std.school) as school_name,
			    (SELECT name from static_sub_disciplines where id = std.discipline) as course_name,
			    (SELECT logo from school where id = std.school) as school_logo,
			    (SELECT state from school where id = std.school) as school_state
			FROM 
				`schoolToDisciplines` as std";
        $result = $this->db->query($sql)->result();
        foreach ($result as $x) {
            $x->content = base64_decode($x->content);
            $x->description = base64_decode($x->description);
            $x->variant_name = (strlen($x->variant_name) >= 1) ? json_encode(array('variants' => json_decode(base64_decode($x->variant_name)))) : "---";
            $x->certificate = json_encode(array('certifications' => json_decode(base64_decode($x->certificate))));
        }
        echo json_encode(array('search_data' => $result));
    }

    public function getDiscipline($param) {
        $sql = "SELECT 
                std.id, std.discipline, std.school, std.description, std.qualifications_given as certificate, std.faculty,
                std.adm_experience, std.work_experience, std.local, std.intl, std.duration, std.content,
                std.delivery_mode, std.variant, (select name from static_educational_variant as v where std.variant = v.id) as variant_name,
                sa.id as sa_id, sa.name as sa_name, sa.deadline as sa_deadline, sa.resumption as sa_resumption, sa.discipline as sa_discipline,
                (SELECT name from static_delivery_mode where id=std.delivery_mode) as deliver_mode_name,
                (select name from school where id = std.school) as school_name,
                (SELECT name from static_sub_disciplines where id = std.discipline) as course_name,
                (SELECT logo from school where id = std.school) as school_logo,
                (SELECT state from school where id = std.school) as school_state,
                ";
        if ($this->session->user !== null)
            $sql .= "(select count(*) FROM cart where std.id=course AND applicant=(SELECT id FROM applicant WHERE user={$this->session->user->id})) as cart_available";
        else 
           $sql .= "(select count(*) FROM cart where std.id=course AND applicant='0') as cart_available";
           
        $sql.=" FROM `schoolToDisciplines` AS `std`, `schoolApplications` AS `sa` WHERE std.id = '{$param}' AND `sa`.`school`= std.school LIMIT 1";
        
        $result = $this->db->query($sql)->row();


        if ($result !== null) {
            $result->sa_discipline = json_decode(base64_decode($result->sa_discipline));
            $sql = "SELECT 
				std.id,
			    (select name from school where id = std.school) as school_name,
			    (select url from school where id = std.school) as school_logo,
			    (SELECT name from static_sub_disciplines where id = std.discipline) as name,
			    (SELECT logo from school where id = std.school) as school_logo,
			    (SELECT state from school where id = std.school) as school_state
			FROM 
				`schoolToDisciplines` AS `std`
			WHERE
				std.discipline = '{$result->discipline}' AND std.id != '{$result->id}'";
            $result->related = array('related' => $this->db->query($sql)->result_array());
        }
        return $result;
    }

	public function getUserByFacebook () {
		$fb = $this->input->post('facebook');
		return $this->db->get_where('users', array('email'=>$fb['email']))->row();	
	}
	
    public function addToCart() {
        $item = $this->input->post('item');
        
		
        $applicant = $this->db->get_where("applicant", array('user'=>$this->session->user->id))->row();
        
		$exists = $this->db->get_where('cart', array('applicant'=>$applicant->id, 'application'=>$item['sa_id'], 'course'=>$item['id']))->row();
		
		if ($exists == NULL) {
			$sql = "INSERT INTO cart (applicant, application, course) values ('{$applicant->id}', '{$item['sa_id']}', '{$item['id']}')";
        	$this->db->query($sql);	
		}
		
    }
    
    public function initializePayment ($reference, $items) {
    	# send the ref number to the cart
    	
    	$this->db->trans_start();
    		foreach($items as $item) 
    			$this->db->update('cart', array('reference_code'=>$reference), array('id'=>$item['id']));
    	$this->db->trans_complete();
    }
    
    public function sample () {
    	$query = $this->db->query("SELECT * FROM schoolApplications WHERE id = 22")->result();
		foreach($query as $x) {
			$x->discipline = json_decode(base64_decode($x->discipline));
			
			foreach($x->discipline as $d) {
				var_dump($d);
				echo ("<br> <hr> <br>");
			}
		}
    }

	public function paymentMade () {
		$reference = $this->input->post('ref');
		
		$this->db->trans_start();
			$this->db->update('cart', array('status'=>1), array('reference_code'=>$reference));
			
			$applicant = $this->db->get_where("applicant", array("user"=>$this->session->user->id))->row();
			$cartItems = $this->db->get_where("cart", array("status"=>1, "reference_code"=>$reference, "applicant"=>$applicant->id))->result();
			
			foreach($cartItems as $cartItem) {
				$sql = "SELECT * FROM schoolApplications WHERE id = {$cartItem->application}";
				
				$schoolApplication = $this->db->query($sql)->row();
				if ($schoolApplication) {
					
					$this->db->insert('applications', array(
						'applicant' 		=> $applicant->id,
						'subdiscipline'		=> $cartItem->course,
						'status'			=> 1,
						'last_date'			=> $schoolApplication->deadline,
						'application'		=> $cartItem->application,
					));	
				}
			}
		$this->db->trans_complete();
	}
    
    public function getMyCart () {
    	$applicant = $this->db->get_where("applicant", array('user'=>$this->session->user->id))->row();
    	$sql = "SELECT 
    			c.id, 
    			(SELECT name FROM school WHERE id = (SELECT school FROM schoolToDisciplines WHERE id = c.course LIMIT 1) LIMIT 1) AS school_name,
    			(SELECT logo FROM school WHERE id = (SELECT school FROM schoolToDisciplines WHERE id = c.course LIMIT 1) LIMIT 1) AS school_logo,
    			(SELECT name from static_sub_disciplines WHERE id = (SELECT discipline FROM schoolToDisciplines WHERE id = c.course LIMIT 1) LIMIT 1) AS course_name 
    		FROM 
    			cart as c 
    		WHERE c.applicant = {$applicant->id} AND status = 0";
		return $this->db->query($sql)->result();
    }


	public function fetchMyApplications () {
		$applicant = $this->db->get_where("applicant", array('user'=>$this->session->user->id))->row();
    	$sql = "SELECT 
    			c.id, 
    			(SELECT a.status FROM applications AS a WHERE a.applicant = {$applicant->id} AND a.subdiscipline = c.course AND a.application = c.application) AS app_status,
    			(SELECT a.creation_date FROM applications AS a WHERE a.applicant = {$applicant->id} AND a.subdiscipline = c.course AND a.application = c.application) AS app_submission,
    			(SELECT a.last_date FROM applications AS a WHERE a.applicant = {$applicant->id} AND a.subdiscipline = c.course AND a.application = c.application) AS app_deadline,
    			(SELECT name FROM school WHERE id = (SELECT school FROM schoolToDisciplines WHERE id = c.course LIMIT 1) LIMIT 1) AS school_name,
    			(SELECT logo FROM school WHERE id = (SELECT school FROM schoolToDisciplines WHERE id = c.course LIMIT 1) LIMIT 1) AS school_logo,
    			(SELECT name from static_sub_disciplines WHERE id = (SELECT discipline FROM schoolToDisciplines WHERE id = c.course LIMIT 1) LIMIT 1) AS course_name 
    		FROM 
    			cart as c 
    		WHERE c.applicant = {$applicant->id} AND status = 1";
    	$result = $this->db->query($sql)->result();
    	foreach($result as $x) {
    		$x->app_submission = date("M jS, Y", strtotime($x->app_submission));
    		$x->app_deadline = date("M jS, Y", strtotime($x->app_deadline));
    	}
		return $result;
	}
	
    public function addApplicant() {
        $session_user = new stdClass();
        $user = new stdClass();

        $session_user->username = $_POST['user']['email'];
        $user->username = $_POST['user']['email'];

        $user->password = md5($_POST['user']['email']);

        $session_user->email = $_POST['user']['email'];
        $user->email = $_POST['user']['email'];

        $session_user->profile_image = $_POST['user']['picture']['data']['url'];
        $user->image = $_POST['user']['picture']['data']['url'];


        $applicant = new stdClass();
        $applicant->lastname = $_POST['user']['last_name'];
        $applicant->firstname = $_POST['user']['first_name'];
        $applicant->middlename = isset($_POST['user']['middle_name']) ? $_POST['user']['middle_name'] : "";
        $applicant->gender = ("male" === strtolower($_POST['user']['gender'])) ? 1 : 0;
        $applicant->dob = $_POST['user']['birthday'];
        $applicant->id = $_POST['user']['id'];


        $this->db->trans_start();
        $data = $this->db->get_where("users", array('email' => $user->email));
        if ($data->num_rows() <= 0) {
        	
	        $sql = "INSERT INTO users (username, password, email, profile_image, usertype, status) values 
					('{$user->username}', '{$user->password}', '{$user->email}', '{$user->image}', '4', '3')";
	
	        $this->db->query($sql);
	        $id = $this->db->insert_id();
	
	        $session_user->id = $id;
	        $this->session->set_userdata('user', $session_user);
	
	        $this->db->insert('applicant', array(
	            'user' => $id,
	            'firstname' => $applicant->firstname,
	            'middlename' => $applicant->middlename,
	            'lastname' => $applicant->lastname,
	            'gender' => $applicant->gender,
	            'dob' => $applicant->dob,
	            'oAuthType' => 2,
	            'oAuthId' => $applicant->id,
	        ));
		}
        $this->db->trans_complete();
    }

    public function fetchAwards() {
        $result = $this->db->get('static_highest_qualification');
        echo json_encode(array('awards' => $result->result()));
    }

    public function fetchStates() {
        echo json_encode(array('states' => $this->getAllStates()));
    }

    public function fetchVariants() {
        echo json_encode(array('variants' => $this->db->get('static_educational_variant')->result()));
    }

    public function fetchSchools() {
        $data = $this->db
                ->select('*')
                ->from('school')
                ->order_by('name', 'ASC');
        echo json_encode(array('schools' => $this->db->get()->result()));
    }

    public function getAllFaculties() {
        return $this->db->get('static_faculty')->result();
    }

    public function getAllScholarships () {
        $this->db->order_by ('ts', 'DESC');
        return $this->db->get ('scholarships')->result ();
    }

}
