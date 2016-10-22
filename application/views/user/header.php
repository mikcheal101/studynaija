<!DOCTYPE HTML lang="en">
<html>
	<head>
		<title><?="{$title} - {$positions[count($positions) - 1]}";?></title>
		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="<?=base_url('assets/css/backgrounds.css');?>" rel="stylesheet" type="text/css">
		<link href="<?=base_url('assets/css/border.css');?>" rel="stylesheet" type="text/css">
		<link href="<?=base_url('assets/css/font-awesome.css');?>" rel="stylesheet" type="text/css">
		<link href="<?=base_url('assets/css/font-face.css');?>" rel="stylesheet" type="text/css">
		<link href="<?=base_url('assets/css/cascade.css');?>" rel="stylesheet" type="text/css">
		<link href="<?=base_url('assets/css/inputBoxes.css');?>" rel="stylesheet" type="text/css">
		<link href="<?=base_url('assets/css/animate.css');?>" rel="stylesheet" type="text/css">
		<link href="<?=base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
		<link href="<?=base_url('assets/css/styles.css');?>" rel="stylesheet" type="text/css">
		<link href="<?=base_url('assets/css/home.css');?>" rel="stylesheet" type="text/css">
		<style>
			.line-divider {height: 55px; border:none; width: 1px!important; background-color:#dedede;}
			.one_half_rm {font-size: 1.5rem!important;}
			.header-icons {vertical-align: middle!important; font-size: 0.9em;}
			.three_rm {font-size: 3rem!important;}
		</style>
 		
 		
 		<style >
 			button.multiselect { white-space: initial; }
 		</style>
	
	</head>
	<body data-spy="scroll" data-target=".navbar" data-offset="60" id="body" ng-app="generalApp" ng-controller="generalCntrl">
		<nav class="navbar navbar-fixed-top transparent-border nav-black" style="background-color: #f9f9f9!important;" role="navigation" id="header">
			<div class="container">
		    	<div class="navbar-header">
		      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapsible">
			        	<span class="sr-only ">Toggle navigation</span>
				        <span class="icon-bar "></span>
				        <span class="icon-bar "></span>
				        <span class="icon-bar "></span>
		      		</button>
		      		<a id="homeBtn" class="navbar-brand white p-l-00 three_rm" href="#section-1">
						<span class="logo prefix">study</span><span class="logo suffix">naija</span>
					</a>
	    		</div>
		    	<div class="navbar-collapse collapse" id="navbar-collapsible">
			     	<ul class="nav navbar-nav navbar-right">
			     		
			        	<li >
			        		<a class="white one_half_rm" href="<?=base_url('/');?>">
			        			<span class="header-icons">Home</span>
			        		</a>
			        	</li>
			        	
			        	<li class="line-divider">
			        		<div class="line-divider"></div>
			        	</li>
			        	
			        	<li >
			        		<a class="white one_half_rm" href="<?=base_url('users/disciplines');?>">
			        			<span class="header-icons">Disciplines / Courses</span>
			        		</a>
			        	</li>
			        	
			        	<li class="line-divider">
			        		<div class="line-divider"></div>
			        	</li>
			        	
			        	<li >
			        		<a class="white one_half_rm" href="<?=base_url('users/schools');?>">
			        			<span class="header-icons">Schools / Instituitions</span>
			        		</a>
			        	</li>
			        	
			        	<li class="line-divider">
			        		<div class="line-divider"></div>
			        	</li>
			        	
			        	<?php if ($this->session->user !== null) { ?>
			        		 
			        	<li >
			        		<a class="white one_half_rm" href="<?=base_url('messages/inbox');?>">
			        			<span class="header-icons">Messages &amp; Notifications</span>
			        		</a>
			        	</li>
			        	
			        	<li class="line-divider">
			        		<div class="line-divider"></div>
			        	</li>
			        	
			        	<?php if ($this->session->user->usertype == APPLICANT) { ?>
			        	<li class="dropdown">
				          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
				          		aria-haspopup="true" aria-expanded="false">
				          		<img class="img-circle"
			        				src="<?=(count($user) > 0)? $user->profile_image:"http://placehold.it/400x400";?>" 
			        				alt="<?=(count($user) > 0)? $user->email:'';?>"  
			        				style="width: 25px!important; height: 25px!important;"/>&nbsp;&nbsp;
			        			<span class="header-icons">My Account</span> 
				          		<span class="caret"></span>
				          	</a>
				          		
				          	<ul class="dropdown-menu">
					            <li><a href="<?=base_url('users/myDashboard');?>">My Profile</a></li>
					            <li><a href="<?=base_url('users/checkout');?>">Shopping Cart</a></li>
					            <li><a href="<?=base_url('users/myApplications');?>">My Applications</a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="<?=base_url('messages/inbox');?>">Mails <span class="label label-info pull-right" style="marin-top:3px;">Info</span></a></li>
					            <li role="separator" class="divider"></li>
					            <li><a href="<?=base_url('users/signOut');?>">Sign Out</a></li>
				          	</ul>
				        </li>
				        

			        	<li class="line-divider">
			        		<div class="line-divider"></div>
			        	</li>
			        	<?php 
			        		} else if ($this->session->user->usertype == SCHOOL_ADMINISTRATOR ) { ?> 
			        		
							<li >
								<a class="white one_half_rm" href="<?=base_url('users/signIn');?>">
									<span class="header-icons">Sign In</span>
								</a>
							</li>
			        	<?php	} 
						
						} else  { ?>
							<li >
								<a class="white one_half_rm" href="<?=base_url('users/signIn');?>">
									<span class="header-icons">Sign In</span>
								</a>
							</li>
			        	
			        	<li class="line-divider">
			        		<div class="line-divider"></div>
			        	</li>
			        	<?php } ?>
			      	</ul>
		    	</div>
		  	</div>
		</nav>