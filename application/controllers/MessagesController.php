<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MessagesController extends CI_Controller {
	
	public $data; 
	public function __construct () {
		parent::__construct();
		$this->data['title'] 					= "ngschools";
		$this->data['positions'] 				= array("ngschools");
		
		$this->data['user'] = $this->me = $this->session->user;
	}
	
	public function index () {
		
	}
	
	
	public function loadPage ($view) {
		$this->onlyLoggedInUser ();
		switch ($this->session->user->usertype) {
			case ADMINISTRATOR:
			case SUPER_ADMIN:
				$this->load->view("admin/header", $this->data);
				$this->load->view("ordinary_bar", $this->data);
				$this->load->view("admin/side_view", $this->data);
				$this->load->view($view, $this->data);
				$this->load->view("admin/footer", $this->data);				
				break;
			case SCHOOL_ADMINISTRATOR:
				$this->data['school'] = $this->schoolModel->getSchool($this->session->school->id);
				$this->load->view("schools/header", $this->data);
				$this->load->view("ordinary_bar", $this->data);
				$this->load->view("schools/left-side", $this->data);
				$this->load->view($view, $this->data);
				$this->load->view("schools/footer", $this->data);
				break;
			case APPLICANT:
				$this->load->view("user/header", $this->data);
				$this->load->view("user/search_bar", $this->data);
				$this->load->view("user/left_mail", $this->data);
				
				$this->load->view($view, $this->data);
				
				$this->load->view("footer", $this->data);
				break;
			default: 
				show_404(); 
				break;
		}
	}
	
	public function compose () {
		$this->onlyLoggedInUser();
		$this->data['positions'][1] = "messages";
		$this->data['positions'][2] = "compose message";
		
		$this->loadPage("messages/compose_mail");
	}
	
	public function my_messages () {
		$this->onlyLoggedInUser();
		$this->data['msg_link'] = "INBOX";
		$this->data['msg_type'] = 0;
		$this->data['positions'][1] = "messages";
		$this->data['positions'][2] = "inbox";
		
		$this->loadPage ("messages/messages");
	}
	
	public function out_messages () {
		$this->onlyLoggedInUser();
		$this->data['msg_link'] = "SENT MESSAGES";
		$this->data['msg_type'] = 1;
		$this->data['positions'][1] = "messages";
		$this->data['positions'][2] = "sent messages";
		
		$this->loadPage("messages/messages");
	}
	
	public function drafts () {
		$this->onlyLoggedInUser();
		$this->data['msg_link'] = "SAVED MESSAGES";
		$this->data['msg_type'] = 2;
		$this->data['positions'][1] = "messages";
		$this->data['positions'][2] = "drafts";
		
		$this->loadPage("messages/messages");
	}
	
	public function deleted_messages () {
		$this->onlyLoggedInUser();
		$this->data['msg_link'] = "TRASHED MESSAGES";
		$this->data['msg_type'] = 3;
		$this->data['positions'][1] = "messages";
		$this->data['positions'][2] = "trashed messages";
		
		$this->loadPage("messages/messages");
	}
	
	private function onlyLoggedInUser () {
		if ($this->session->user == null) {
			show_404(); 
			exit();
		}
	}
	
	private function validUser () {
		if ($this->session->user == null) {
			echo json_encode (array ('status' => 400, 'object' => array (), 'message' => 'user not loggedIn'));
		}
	}
	
	public function my_recipients () {
		echo json_encode (array ('status' => 200, 'object' => $this->messagesModel->fetchWhomTo (), 'message' => ''));
	}
	
	public function getInbox () {
		echo json_encode (
			array (
				'status' => 200, 
				'object' => $this->messagesModel->fetchInbox (), 
				'message' => ''
			)
		);
	}
	
	public function getSent () {
		echo json_encode (array ('status' => 200, 'object' => $this->messagesModel->fetchOutbox (), 'message' => 'user not loggedIn'));
	}
	
	public function getTrash () {
		echo json_encode (array ('status' => 200, 'object' => $this->messagesModel->fetchTrash (), 'message' => 'user not loggedIn'));
	}
	
	public function getSaved () {
		echo json_encode (array ('status' => 200, 'object' => $this->messagesModel->fetchDrafts (), 'message' => 'user not loggedIn'));
	}
	
	public function postMessage () {
		$boolean = $this->messagesModel->postMessage ();
		echo json_encode (array ('status' => ($boolean) ? 200 : 400, 'object' => array (), 
			'message' => ($boolean) ? 'Message Sent Successfully' : 'Error Sending Message' ));
	}
	
	public function saveMessage () {
		$boolean = $this->messagesModel->saveMessage ();
		echo json_encode (array ('status' => ($boolean) ? 200 : 400, 'object' => array (), 
			'message' => ($boolean) ? 'Message Saved Successfully' : 'Error Saving Message' ));
	}
	
	public function trashMessage () {
		$boolean = $this->messagesModel->trashMessage ();
		echo json_encode (array ('status' => ($boolean) ? 200 : 400, 'object' => array (), 
			'message' => ($boolean) ? 'Message Deleted Successfully' : 'Error Deleting Message' ));
	}
	
	public function junkMessage () {
		$boolean = $this->messagesModel->junkMessage ();
		echo json_encode (array ('status' => ($boolean) ? 200 : 400, 'object' => array (), 
			'message' => ($boolean) ? 'Messages Saved Successfully' : 'Error Saving Messages' ));
	}
	
	public function restoreMessage () {
		$boolean = $this->messagesModel->restoreMessage ();
		echo json_encode (array ('status' => ($boolean) ? 200 : 400, 'object' => array (), 
			'message' => ($boolean) ? 'Messages Restored Successfully' : 'Error Restoring Messages' ));
	}
	
	public function replyMessage () {
		
	}
}
