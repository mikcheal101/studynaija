<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


$config['facebook']['app_id'] 		= '605081073007423';
$config['facebook']['app_secret'] 	= 'ca4aa34cc5c097c8f735654b6f786045';
$config['facebook']['redirect_url'] = 'http://'.$_SERVER['SERVER_NAME'].'/ngschools/users/changeToCaller';
$config['facebook']['permissions'] 	= array(
    'email',
    'user_location',
    'user_birthday',
    'public_profile',
    'user_education_history',
    'user_friends',
);
$cofig['facebook']['requests']		= "id,name,email,about,bio,birthday,education,gender,first_name,middle_name,last_name,picture";

?>
