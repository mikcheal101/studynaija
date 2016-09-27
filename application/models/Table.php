<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table extends CI_Model {
	
	public function __construct () {
		parent::__construct();
	}
	
	public static $APPLICANT	= "applicant";
	public static $USERS		= "users";
}
?>