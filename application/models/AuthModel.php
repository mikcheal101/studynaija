<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {
	
	
	public function __construct () {
		parent::__construct();
	}
	
	public function confirmFacebookUser () {
		$user = $this->session->userdata('facebookUser');
		
		# check if user exists
		$query = $this->db->get_where(Table::$APPLICANT, array('oAuthType'=>1, 'oAuthId'=> $user->getId()));
		return $query->result();
	}
	
	public function saveFacebookUser () {
		$user = $this->session->userdata('facebookUser');
		
		$this->db->trans_start();
		try {
			$this->db->insert(Table::$USERS, array(
				'username'		=> ($user['email'] !== null) ? $user['email']: '',
				'password'		=> md5(($user['email'] !== null) ? $user['email']: ''),
				'email'			=> ($user['email'] !== null) ? $user['email']: '',
				'profile_image'	=> ($user['picture'] !== null) ? $user['picture']['url']: '',
				'usertype'		=> APPLICANT,
				'status'		=> ACTIVATED_ACCOUNT,
				));
			$user_id = $this->db->insert_id();
			
			# insert into the db
			$this->db->insert(Table::$APPLICANT, array(
				'firstname' 	=> ($user->getFirstName() !== null) ? $user->getFirstName(): '',
				'middlename'	=> ($user->getMiddlename() !== null) ? $user->getMiddlename(): '',
				'lastname'		=> ($user->getLastName() !== null) ? $user->getLastName(): '',
				'gender'		=> ($user->getGender() !== null) ? AuthModel::getGender($user->getGender()): '',
				'dob'			=> ($user->getBirthday() !== null) ? $user->getBirthday()->format('Y-m-d'): '',
				'oAuthType'		=> 1,
				'oAuthId'		=> $user->getId(),
				'user'			=> $user_id,
				));
			$this->db->trans_complete();
			return $this->db->trans_status();
		} catch (Exception $e) {
			return false;
		}
	}

	static function getGender ($string) {
		$string = strtolower($string);
		return ($string == "male") ? 1:2;
	}
}
 
?>