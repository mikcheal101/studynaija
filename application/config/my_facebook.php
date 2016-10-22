<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


$config['facebook']['api_id'] 		= '605081073007423';
$config['facebook']['app_secret'] 	= 'ca4aa34cc5c097c8f735654b6f786045';
$config['facebook']['redirect_url'] = 'http://localhost/ngschools/users/changeToCaller';
$config['facebook']['permissions'] 	= array(
    'email',
    'user_location',
    'user_birthday',
    'public_profile',
    'user_education_history',
    'user_friends',
);

?>
