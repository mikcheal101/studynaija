<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['upload_path']          = 'images/applicants/documents';
$config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|docx';
$config['max_size']             = 10000;
$config['file_name']			= time();
$config['encrypt_name']			= TRUE;
$config['remove_spaces']		= TRUE;
		