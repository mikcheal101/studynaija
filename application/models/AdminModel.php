<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {
	
	public function __construct () {
		parent::__construct();
	}
	
	public function updateProfile (array $image) {
		$data = array ();
		$this->session->user->username 		= $data['username'] = $this->input->post ('username');
		if (strlen (trim ($this->input->post ('password'))) > 0)
			$data['password'] = md5 ($this->input->post ('password'));
		$this->session->user->email 		= $data['email'] = $this->input->post ('email');
		$this->session->user->profile_image = $data['profile_image'] = "images/admins/{$image['file_name']}";
		
		$this->db->update ('users', $data, array ('id'=> $this->session->user->id));
	}
	
	public function load_instituition_types () {
		$data = $this->db->get ('instituition_types')->result ();
		echo json_encode (array ('types'=>$data));
	}
	
	public function check_inst_type () {
		$data = $this->db->get_where ('instituition_types', array ('name'=>$this->input->post ('name'), 'id!=' => $this->input->post ('id')))->row ();
		echo json_encode (array ('data'=> isset($data)));
	}
	
	public function commit_inst_type () {
		$param = $this->input->post ('param');
		$id = $param['id'];
		if ((int)$id === 0) {
			$type = 'save';
			$this->db->insert ('instituition_types', array ('name'=>$param['name']));
			$id = $this->db->insert_id ();
		} else {
			$type = 'update';
			$this->db->update ('instituition_types', array ('name'=>$param['name']), array ('id'=>$id));
		}
		echo json_encode (array ('id'=>$id, 'type'=>$type));
	}
	
	public function drop_inst_type () {
		$id = $this->input->post ('id');
		$this->db->delete ('instituition_types', array ('id'=>$id));
	}
	
	
	public function disciplineTypes () {
		return $this->db->get ('static_highest_qualification')->result ();
	}
	
	public function saveDiscipline ($discipline) {
		$this->db->insert('static_sub_disciplines', $discipline);
	}
	
	public function updateDiscipline ($discipline, $id) {
		$this->db->update('static_sub_disciplines', $discipline, array('id'=>$id));
	}
	
	public function deleteDiscipline ($id) {
		$this->db->delete('static_sub_disciplines', array('id'=>$id));
	}
	
	public function commitFaculty () {
		$faculty = $this->input->post ('faculty');
		if ((int)$faculty['id'] === 0) {
			# save
			$type = 'save';
			$this->db->insert ('static_faculty', array ('name'=>$faculty['name']));
			$id = $this->db->insert_id ();
		} else {
			
			$id = $faculty['id'];
			$type = 'update';
			$this->db->update ('static_faculty', array ('name'=>$faculty['name']), array ('id'=>$id));
		}
		echo json_encode (array ('id'=>$id, 'type'=>$type));
	}
	
	public function checkfacultyname () {
		$data = $this->db->get_where ('static_faculty', array ('name' => $this->input->post ('name'), 'id!=' => $this->input->post ('id')))->row ();
		echo json_encode (array ('result' => isset ($data)));
	}
	
	public function dropFaculty () {
		$id = $this->input->post ('id');
		$this->db->delete ('static_faculty', array ('id'=>$id));
	}
	
	public function loadFaculties () {
		$d = $this->db->get ('static_faculty')->result ();
		echo json_encode (array ('faculties' => $d));
	}
	
	public function getDisciplines () {
		$x = $this->db
			->select('*')
			->from('static_sub_disciplines')
			->order_by('name', 'ASC');
		$result = $this->db->get()->result();
		foreach ($result as $d) {
			$d->type_brand = $this->db->get_where ('static_highest_qualification', array ('id' => $d->type))->row ();
			$d->faculty = $this->db->get_where ('static_faculty', array ('id'=>$d->faculty))->row ();
		}
		return $result;
	}
	
	public function ajaxgetDisciplines () {
		echo json_encode (array("status"=>200, "message"=>"", "object"=>$this->getDisciplines ()));
	}
	
	public function removeDiscipline () {
		$this->db->delete ('static_sub_disciplines', array ('id'=> $this->input->post ('data')));
	}
	
	public function checkDisciplineName () {
		$name 	= $this->input->get ('name');
		$id 	= $this->input->get ('id');
		
		$return = $this->db->get_where ('static_sub_disciplines', array ('name'=>$name, 'id !=' => $id))->row ();
		echo json_encode (array ('return'=>$return));
		#echo json_encode (array ('return'=>$this->db->last_query ()));
	}
	
	public function loadNews () {
		$this->db->select('*')->from('news')->order_by('date', 'DESC');
		$news = $this->db->get ()->result ();
		
		foreach ($news as $n) {
			$n->subject 	= base64_decode ($n->subject);
			$n->details		= base64_decode ($n->details);
			$n->resources 	= $this->db->get_where ('news_resources', array ('news'=>$n->id))->result();
		}
		echo json_encode (array ('news'=> $news));
	}
	
	public function commitNews (array $data) {
		
		$param 		= $this->input->post ('param');
		$postData 	= new stdClass ();
		
		$postData->id = $param['id'];
		$postData->subject = base64_encode ($param['subject']);
		$postData->details = base64_encode ($param['details']);
		$postData->poster	= $this->session->user->id;
		
		if ((int)$postData->id === 0) {
			# save
			$this->db->insert ('news', $postData);
			
			$postData->id = $this->db->insert_id ();
			foreach ($data as $resource) {
				$r = new stdclass ();
				$r->resource = "resources/news/{$resource['file_name']}";
				$r->news = $postData->id;
				$this->db->insert ('news_resources', $r);
				$r->id = $this->db->insert_id ();
				$postData->resources[] = $r;
			}
			$type = 'save';
		} else {
			# update
			$this->db->update ('news', $postData, array ('id'=>$postData->id));
			if (count ($data) > 0) {
				$this->removeNewsResources ($postData->id);
				foreach ($data as $resource) {
					$r = new stdclass ();
					$r->resource = "resources/news/{$resource['file_name']}";
					$r->news = $postData->id;
					$this->db->insert ('news_resources', $r);
					$r->id = $this->db->insert_id ();
					$postData->resources[] = $r;
				}
			}
			$type = 'update';
		}
		$postData->subject = base64_decode ($postData->subject);
		$postData->details = base64_decode ($postData->details);
		echo json_encode (array ('news'=>$postData, 'type'=>$type));
	}
	
	public function dropNews () {
		$id = $this->input->post ('id');
		$this->removeNewsResources ($id);
		$this->db->delete ('news', array('id'=>$id));
	}
	
	private function removeNewsResources ($id) {
		$res = $this->db->get_where ('news_resources', array ('news'=>$id))->result ();
		foreach ($res as $r) {
			unlink ($r->resource);
			$this->db->delete ('news_resources', array ('id'=>$r->id));
		}
	}
	
	public function ajaxUpdateDiscipline () {
		
		$param 				= $this->input->post ('param');
		$discipline 		= new stdClass ();
		$discipline->id 	= $param['id'];
		$discipline->name 	= $param['name'];
		$discipline->type 	= $param['type_brand']['id'];
		$discipline->faculty= $param['faculty']['id'];
		$type = "";
		
		if ((int)$discipline->id === 0) {
			# insert
			$this->db->insert ('static_sub_disciplines', $discipline);
			$discipline->id = $this->db->insert_id ();
			$type = 'save';
		} else {
			#update 
			$this->db->update ('static_sub_disciplines', $discipline, array ('id'=> $discipline->id));
			$type = 'update';
		}
		echo json_encode (array ('id'=>$discipline->id, 'type'=>$type));
	}
	
	public function ajaxSaveDiscipline () {
		$this->db->insert ('static_sub_disciplines', array ('name'=>$this->input->post ('data')));
		echo json_encode (array ('id'=>$this->db->insert_id ()));
	}
	
	public function ajaxGetInsituitions () { 
		$schools = $this->db->get ('school')->result ();
		foreach ($schools as $sch) {
			
			$sch->address 	= base64_decode ($sch->address);
			$sch->state 	= $this->db->get_where ('static_states', array ('id'=>$sch->state))->row ();
			$sch->type		= $this->db->get_where ('instituition_types', array ('id'=>$sch->type))->row ();
			$sch->user		= $this->db->query ("SELECT u.id, u.username, u.password FROM users AS u WHERE u.id = 
				(SELECT x.user FROM schooltousers AS x WHERE x.school={$sch->id} LIMIT 1) LIMIT 1")->row ();
		}
		echo json_encode (array ('instituitions' => $schools));
	}
	
	
	public function checkinstname () {
		$name = $this->input->post ('name');
		$id = $this->input->post ('id');
		$data = $this->db->get_where ('school', array ('name'=>$name, 'id!='=>$id))->row ();
		echo json_encode (array ('available'=> isset ($data)));
	}
	
	public function saveInstituition (array $instituition) {
		$association = array();
		
		$this->db->trans_start();
			$this->db->insert('school', $instituition['school']);
			$association['school'] = $this->db->insert_id();
			
			$this->db->insert('users', $instituition['user']);
			$association['user'] = $this->db->insert_id();
		
			$this->db->insert('schoolToUsers', $association);
		$this->db->trans_complete();
	}
	
	public function updateInstituition ($instituition, $id) {
		$this->db->trans_start();
			$this->db->update('school', $instituition['school'], array('id'=>$id));
			$this->db->update('users', $instituition['user'], array('id'=>$instituition->user_id));
		$this->db->trans_complete();
	}
	
	public function saveInstituitionLogo ($array) {
		
	}
	
	public function confirmSchool () {
		$username 	= $this->input->post ('username');
		$email		= $this->input->post ('email');
		$name 		= $this->input->post ('name');
		
		$data = $this->db
			->query ("SELECT COUNT(*) AS numb FROM `school` AS `s`, `users` AS `u` WHERE 
				`u`.`username` = '{$username}' OR `s`.`email` = '{$email}' OR `s`.`name` = '{$name}'")
			->row ();
		return ((int)$data->numb > 0);
	}
	
	
	public function ajaxSaveInstituition ($files) {
		$post 	= $_POST['data'] ?? $_POST;
		$id 	= (int)$post['id'];
		
		$array 	= array (
			'name' 			=> $post['name'],
			'year_of_est'	=> isset ($post['year_of_est']) ? date('Y', strtotime ($post['year_of_est'])) : null,
			'url'			=> $post['url'] ?? null,
			'state'			=> (int)$post['state']['id'] === 0 ? null : $post['state']['id'],
			'email'			=> $post['email'] ?? null,
			'address'		=> base64_encode ($post['address']),
			'type'			=> (int)$post['type']['id'] === 0 ? null : $post['type']['id'],
		);
		
		if (!is_null ($post['user']['username']) && !is_null ($post['user']['password']) && !is_null ($post['email'])) {
			$user = array (
				'username'		=> $post['user']['username'],
				'password'		=> md5 ($post['user']['password']),
				'email'			=> $post['email'],
				'usertype'		=> SCHOOL_ADMINISTRATOR,
				'status'		=> ACTIVATED_ACCOUNT,
			);
		}

		if (count ($files) > 0) {
			$user['profile_image'] = $array['logo'] = "images/schools/".$files['file_name'];
			if (!empty ($post['logo'])) {
				unlink ("./{$post['logo']}");
			}
		}
		
		if ($id === 0) {
			# save
			$type = 'save';
			$this->db->insert ('school', $array);
			$id = $this->db->insert_id ();
			$this->db->insert ('users', $user);
			$user['id'] = $this->db->insert_id ();
			$this->db->insert ('schoolToUsers', array ('school'=>$id, 'user'=>$user['id']));
		} else {
			$type = 'update';
			$this->db->trans_start ();
			$this->db->update ('school', $array, array ('id'=>$id));
			echo $this->db->last_query ();
			$this->db->update ('users', $user, array ('id'=>$post['user']['id']));
			$this->db->trans_complete ();
		}
		echo json_encode (array ('id'=>$id, 'type'=>$type));
	}
	
	public function deleteInstituition ( ) {
		$data = $_POST['data'][0];
		
		$this->db->delete('schoolToUsers', array('school'=>$data['id'], 'user'=>$data['user_id']));
		$this->db->delete('school', array('id'=>$data['id']));
		$this->db->delete('users', array('id'=>$data['user_id']));
	}

	
	public function getStates () {
		return $this->db->get ('static_states')->result ();
	}
	
	public function useable_username ($param) {
		# check if it was a save button clicked
		if ($this->input->post('btn') === "save") {
			# check if the username exists
			$this->db->get_where('users', array('username'=>$param));
		} return true;
	}
	
	public function ajaxUsers () {
		return $this->db->get_where ('users', array ('usertype' => APPLICANT))->result ();
	}
	
	public function ajaxWebAdmins () {
		return $this->db->get_where ('users', array ('usertype' => ADMINISTRATOR))->result ();
	}
	
	public function ajaxSchAdmins () {
		
		$this->db
			->select ('*')
			->from ('users AS u')
			->where (array ('usertype' => SCHOOL_ADMINISTRATOR))
			->or_where (array ('usertype' => SCHOOL_SUB_ADMIN));
		
		$result = $this->db->get ()->result ();
		foreach ($result as $r) {
			$r->school = $this->db
				->query ("SELECT * FROM school AS s WHERE s.id=
					(SELECT su.school FROM schooltousers AS su WHERE su.user={$r->id})")->row ();
			$r->usertype = $this->db->get_where ('static_usertypes', 
				array ('id'=>$r->usertype))->row ();
		}
		return $result;
	}
	
	public function ajaxScholarships () {
		$this->db->select ()->from ('scholarships')->order_by ('ts', 'DESC');
		$data = $this->db->get ()->result ();
		foreach ($data as $d) {
			$d->details = base64_decode ($d->details);
		}
		return $data;
	}
	
	public function commitScholarship () {
		$post = $this->input->post ('param');
		$id = (int)$post['id'];
		if ($id === 0) {
			$type = 'save';
			$this->db->insert ('scholarships', array (
				'name' 		=> $post['name'],
				'details' 	=> base64_encode ($post['details']),
				'poster'	=> $this->session->user->id,
			));
			$id = $this->db->insert_id ();
		} else {
			$type = 'update';
			$this->db->update ('scholarships', array ('name'=>$post['name'], 'details'=>base64_encode ($post['details'])), array ('id'=>$id));
		}
		echo json_encode (array ('id'=>$id, 'type'=>$type));
	}
	
	public function dropScholarship () {
		$id = $this->input->post ('id');
		$this->db->delete ('scholarships', array ('id'=>$id));
	}
	
	public function commitWebAdmin () {
		$data = $_POST['data'];
		# confirm user does not exist already in the system ie username
		$user = $this->db->get_where ("users", array ('username'=>$data['username']));
		
		if ((int)$data['id'] === 0) {
			# save webadmin
			if ($user->num_rows () > 0) return -1;
			$this->db->insert ('users', array ('username'=>$data['username'], 'password'=> md5($data['password']), 'status' => $data['status'], 'usertype' => ADMINISTRATOR));
			return $this->db->insert_id ();
		} else {
			# update web admin
			$this->db->update ('users', array ('username' => $data['username'], 'status' => $data['status']), array ('id' => $data['id'], 'usertype'=> ADMINISTRATOR));
			return 0;
		}
	}
	
	public function deleteWebAdmin () {
		$data = $_POST['id'];
		$this->db->delete ('users', array ('id'=>$data, 'usertype'=>ADMINISTRATOR));
		return true;
	}
} 