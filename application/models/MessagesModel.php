<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MessagesModel extends CI_Model {
	
	public function __construct () {
		parent::__construct();
	}
	
	public function postMessage () {
		$msg = $_POST['data'];
		$this->db->trans_start ();
		foreach ($msg['to'] as $to) {	
			$composed = array(
				'msg_from' 		=> $this->session->user->id,
				'msg_to'		=> $to['id'],
				'msg_message'	=> base64_encode($msg['mesg']),
				'msg_subject'	=> base64_encode($msg['sub']),
				'from_status'	=> 2,
				'to_status'		=> 2,
			);
			
			$this->db->insert('messages', $composed);
		}
		$this->db->trans_complete ();
		return $this->db->trans_status ();
	}
	
	public function saveMessage () {
		$msg = $_POST['data'];
		$this->db->trans_start ();
		foreach ($msg['to'] as $to) {	
			$composed = array(
				'msg_from' 		=> $this->session->user->id,
				'msg_to'		=> $to['id'],
				'msg_message'	=> base64_encode($msg['mesg']),
				'msg_subject'	=> base64_encode($msg['sub']),
				'from_status'	=> 5,
				'to_status'		=> 2,
			);
			
			$this->db->insert('messages', $composed);
		}
		$this->db->trans_complete ();
		return $this->db->trans_status ();
	}
	
	public function trashMessage () {
		$type = $this->input->post ('type');
		switch ((int)$type) {
			case INBOX:
				return $this->deleteToMessage ();
				break;
			case SENT:
				return $this->deleteFromMessage ();
				break;
		}
	}
	
	private function deleteFromMessage ( ) {
		$data = $this->input->post ('data');
		$this->db->trans_start();
			$this->db->update('messages', array('from_status' => 4), array('id'=>$data['id'], 'msg_from'=>$this->session->user->id));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	private function deleteToMessage ( ) {
		$data = $this->input->post ('data');
		$this->db->trans_start();
			$this->db->update('messages', array('to_status' => 4), array('id'=>$data['id'], 'msg_to'=>$this->session->user->id));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	
	public function junkMessage () {
		$type = $this->input->post ('type');
		switch ((int)$type) {
			case INBOX:
				return $this->junkToMessage ();
				break;
			case SENT:
				return $this->junkFromMessage ();
				break;
		}
	}
	
	public function junkFromMessage ( ) {
		$data = $this->input->post ('data');
		$this->db->trans_start();
			$this->db->update('messages', array('from_status' => 1), array('id'=>$data['id'], 'msg_from'=>$this->session->user->id));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function junkToMessage ( ) {
		$data = $this->input->post ('data');
		$this->db->trans_start();
			$this->db->update('messages', array('to_status' => 1), array('id'=>$data['id'], 'msg_to'=>$this->session->user->id));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function restoreMessage () {
		$data = $this->input->post ('data');
		if ((int)$data['msg_from'] === (int)$this->session->user->id) {
			return $this->unDeleteFromMessage ();
		} else if ((int)$data['msg_to'] === (int)$this->session->user->id) {
			return $this->unDeleteToMessage ();
		}
	}
	
	private function unDeleteFromMessage ( ) {
		$data = $this->input->post ('data');
		$this->db->trans_start();
			$this->db->update('messages', array('from_status' => 1), array('id'=>$data['id'], 'msg_from'=>$this->session->user->id));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	private function unDeleteToMessage ( ) {
		$data = $this->input->post ('data');
		$this->db->trans_start();
			$this->db->update('messages', array('to_status' => 1), array('id'=>$data['id'], 'msg_to'=>$this->session->user->id));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	# figure out to change this to unread
	public function markAsUnread ($message) {
		$this->db->trans_start();
			$this->db->update('messages', array('msg_status' => 2), array('id'=>$id));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function markAsJunk ($message) {
		$this->db->trans_start();
			$this->db->update('messages', array('msg_status' => 3), array('id'=>$id));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	public function fetchInbox () {
		$sql = "SELECT
				m.id, m.msg_from, m.msg_to, m.msg_message, m.msg_subject, m.msg_date, m.from_status, m.to_status, m.msg_status,
				(SELECT usertype FROM users AS u  WHERE u.id = m.msg_from LIMIT 1) AS sender_usertype,
				(SELECT usertype FROM users AS u  WHERE u.id = m.msg_to LIMIT 1) AS reciever_usertype,
				(SELECT username FROM users AS u  WHERE u.id = m.msg_from LIMIT 1) AS sender_username,
				(SELECT username FROM users AS u  WHERE u.id = m.msg_from LIMIT 1) AS left_side,
				(SELECT username FROM users AS u  WHERE u.id = m.msg_to LIMIT 1) AS reciever_username,
				(SELECT profile_image FROM users AS u WHERE u.id = m.msg_from LIMIT 1) AS sender_image,
				(SELECT profile_image FROM users AS u WHERE u.id = m.msg_to LIMIT 1) AS reciever_image,
				(SELECT name FROM school AS s WHERE s.id = (SELECT school FROM schoolToUsers AS su WHERE su.user = m.msg_from LIMIT 1) LIMIT 1) AS sender_name,
				(SELECT name FROM school AS s WHERE s.id = (SELECT school FROM schoolToUsers AS su WHERE su.user = m.msg_to LIMIT 1) LIMIT 1)  AS reciever_name
			FROM 
				messages AS m 
			WHERE 
				msg_to = {$this->session->user->id} AND to_status = 2 AND from_status != 5 
			ORDER BY  
				m.msg_date DESC
				";
		
		$data = $this->db->query($sql);
		$result = $data->result();
		foreach ($result as $d) {
			$d->msg_subject =  base64_decode ($d->msg_subject);
			$d->msg_message = base64_decode ($d->msg_message);
			$d->msg_date= date ('dS M, Y', strtotime ($d->msg_date));
		}
		return $result;
	}
	
	public function fetchOutbox () {
		$sql = "SELECT
				m.id, m.msg_from, m.msg_to, m.msg_message, m.msg_subject, m.msg_date, m.from_status, m.to_status, m.msg_status,
				(SELECT usertype FROM users AS u  WHERE u.id = m.msg_from LIMIT 1) AS sender_usertype,
				(SELECT usertype FROM users AS u  WHERE u.id = m.msg_to LIMIT 1) AS reciever_usertype,
				(SELECT username FROM users AS u  WHERE u.id = m.msg_from LIMIT 1) AS sender_username,
				(SELECT username FROM users AS u  WHERE u.id = m.msg_to LIMIT 1) AS reciever_username,
				(SELECT username FROM users AS u  WHERE u.id = m.msg_to LIMIT 1) AS left_side,
				(SELECT profile_image FROM users AS u WHERE u.id = m.msg_from LIMIT 1) AS sender_image,
				(SELECT profile_image FROM users AS u WHERE u.id = m.msg_to LIMIT 1) AS reciever_image,
				(SELECT name FROM school AS s WHERE s.id = (SELECT school FROM schoolToUsers AS su WHERE su.user = m.msg_from LIMIT 1) LIMIT 1) AS sender_name,
				(SELECT name FROM school AS s WHERE s.id = (SELECT school FROM schoolToUsers AS su WHERE su.user = m.msg_to LIMIT 1) LIMIT 1)  AS reciever_name
			FROM 
				messages AS m 
			WHERE 
				msg_from = {$this->session->user->id} AND from_status < 4 
			ORDER BY 
				m.msg_date DESC
				";
		$data = $this->db->query($sql);
		$result = $data->result();
		foreach ($result as $d) {
			$d->msg_subject =  base64_decode ($d->msg_subject);
			$d->msg_message = base64_decode ($d->msg_message);
			$d->msg_date= date ('dS M, Y', strtotime ($d->msg_date));
		}
		return $result;
	}

	public function fetchJunk () {
		$sql = "SELECT
				m.id, m.msg_from, m.msg_to, m.msg_message, m.msg_subject, m.msg_date, m.from_status, m.to_status, m.msg_status,
				(SELECT usertype FROM users AS u  WHERE u.id = m.msg_from LIMIT 1) AS sender_usertype,
				(SELECT usertype FROM users AS u  WHERE u.id = m.msg_to LIMIT 1) AS reciever_usertype,
				(SELECT username FROM users AS u  WHERE u.id = m.msg_from LIMIT 1) AS sender_username,
				(SELECT username FROM users AS u  WHERE u.id = m.msg_to LIMIT 1) AS reciever_username,
				(SELECT profile_image FROM users AS u WHERE u.id = m.msg_from LIMIT 1) AS sender_image,
				(SELECT profile_image FROM users AS u WHERE u.id = m.msg_to LIMIT 1) AS reciever_image,
				(SELECT name FROM school AS s WHERE s.id = (SELECT school FROM schoolToUsers AS su WHERE su.user = m.msg_from LIMIT 1) LIMIT 1) AS sender_name,
				(SELECT name FROM school AS s WHERE s.id = (SELECT school FROM schoolToUsers AS su WHERE su.user = m.msg_to LIMIT 1) LIMIT 1)  AS reciever_name
			FROM 
				messages AS m 
			WHERE 
				msg_to = {$this->session->user->id} AND from_status = 3 
			ORDER BY  
				m.msg_date DESC
				";
		$data = $this->db->query($sql);
		$result = $data->result();
		foreach ($result as $d) {
			$d->msg_subject =  base64_decode ($d->msg_subject);
			$d->msg_message = base64_decode ($d->msg_message);
			$d->msg_date= date ('dS M, Y', strtotime ($d->msg_date));
		}
		return $result;
	}
	
	public function fetchTrash () {
		$sql = "SELECT 
				m.id, m.msg_from, m.msg_to, m.msg_message, m.msg_subject, m.msg_date, m.from_status, m.to_status, m.msg_status,
				(SELECT usertype FROM users AS u  WHERE u.id = m.msg_from LIMIT 1) AS sender_usertype,
				(SELECT usertype FROM users AS u  WHERE u.id = m.msg_to LIMIT 1) AS reciever_usertype,
				(SELECT username FROM users AS u  WHERE u.id = m.msg_from LIMIT 1) AS sender_username,
				(SELECT username FROM users AS u  WHERE u.id = m.msg_to LIMIT 1) AS reciever_username,
				(SELECT profile_image FROM users AS u WHERE u.id = m.msg_from LIMIT 1) AS sender_image,
				(SELECT profile_image FROM users AS u WHERE u.id = m.msg_to LIMIT 1) AS reciever_image,
				(SELECT name FROM school AS s WHERE s.id = (SELECT school FROM schoolToUsers AS su WHERE su.user = m.msg_from LIMIT 1) LIMIT 1) AS sender_name,
				(SELECT name FROM school AS s WHERE s.id = (SELECT school FROM schoolToUsers AS su WHERE su.user = m.msg_to LIMIT 1) LIMIT 1)  AS reciever_name
			FROM 
				messages AS m
			WHERE 
				(msg_to = {$this->session->user->id} AND to_status = 4) OR (msg_from = {$this->session->user->id} AND from_status = 4) 
			ORDER BY 
				m.msg_date DESC
				";
		$data = $this->db->query($sql);
		$result = $data->result();
		foreach ($result as $d) {
			$d->msg_subject =  base64_decode ($d->msg_subject);
			$d->msg_message = base64_decode ($d->msg_message);
			$d->msg_date= date ('dS M, Y', strtotime ($d->msg_date));
		}
		return $result;
	}
	
	public function fetchDrafts () {
		$sql = "SELECT 
				m.id, m.msg_from, m.msg_to, m.msg_message, m.msg_subject, m.msg_date, m.from_status, m.to_status, m.msg_status,
				(SELECT usertype FROM users AS u  WHERE u.id = m.msg_from LIMIT 1) AS sender_usertype,
				(SELECT usertype FROM users AS u  WHERE u.id = m.msg_to LIMIT 1) AS reciever_usertype,
				(SELECT username FROM users AS u  WHERE u.id = m.msg_from LIMIT 1) AS sender_username,
				(SELECT username FROM users AS u  WHERE u.id = m.msg_to LIMIT 1) AS reciever_username,
				(SELECT profile_image FROM users AS u WHERE u.id = m.msg_from LIMIT 1) AS sender_image,
				(SELECT profile_image FROM users AS u WHERE u.id = m.msg_to LIMIT 1) AS reciever_image,
				(SELECT name FROM school AS s WHERE s.id = (SELECT school FROM schoolToUsers AS su WHERE su.user = m.msg_from LIMIT 1) LIMIT 1) AS sender_name,
				(SELECT name FROM school AS s WHERE s.id = (SELECT school FROM schoolToUsers AS su WHERE su.user = m.msg_to LIMIT 1) LIMIT 1)  AS reciever_name
			FROM 
				messages AS m
			WHERE 
				msg_from = {$this->session->user->id} AND from_status = 5  
			ORDER BY 
				m.msg_date DESC
				";
		$data = $this->db->query($sql);
		$result = $data->result();
		foreach ($result as $d) {
			$d->msg_subject =  base64_decode ($d->msg_subject);
			$d->msg_message = base64_decode ($d->msg_message);
			$d->msg_date= date ('dS M, Y', strtotime ($d->msg_date));
		}
		return $result;
	}
	
	public function fetchWhomTo () {
		$sql = "";		
		
		switch ($this->session->user->usertype) {
			case ADMINISTRATOR:
			case SUPER_ADMIN:
				# fetch everyone on the system
				$sql = "SELECT u.id as id, u.username FROM users as u WHERE (u.id != {$this->session->user->id})";
				break;
			case SCHOOL_ADMINISTRATOR:
				# fetch all web admins of the school and applicants
				$sql = "SELECT u.id as id, u.username FROM users as u WHERE 
					(u.usertype < 3) OR 
					(u.usertype = 3 AND 
						u.id IN (SELECT su.user FROM schooltousers AS su WHERE su.school = {$this->session->school->id})) AND 
					(u.id != {$this->session->user->id})";
				break;
			case APPLICANT:
				# fetch all schools aplications have been sent to and the admin's of this system
				break;
			default: 
				# fetch on the admins of the system
				break;
		}
		return $this->db->query ($sql)->result ();
	}
	
}