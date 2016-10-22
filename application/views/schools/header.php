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
		<link href="<?=base_url('assets/css/select.css');?>" rel="stylesheet" type="text/css">
		<style>
			.line-divider {height: 55px; border:none; width: 1px!important; background-color:#dedede;}
			.one_half_rm {font-size: 1.5rem!important;}
			.header-icons {vertical-align: middle!important; font-size: 0.9em;}
			.three_rm {font-size: 3rem!important;}
		</style>
 		
	</head>
	<body data-spy="scroll" data-target=".navbar" data-offset="60" id="body" ng-app="schoolApp" ng-controller="schoolCntrl" ng-init="init();">
		<nav class="navbar navbar-fixed-top transparent-border nav-black" style="background-color: #f9f9f9!important;" role="navigation" id="header">
			<div class="container-fluid no-border">
		    	<div class="navbar-header">
		      		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapsible">
			        	<span class="sr-only ">Toggle navigation</span>
				        <span class="icon-bar "></span>
				        <span class="icon-bar "></span>
				        <span class="icon-bar "></span>
		      		</button>
		      		<a id="homeBtn" class="navbar-brand white p-l-20 three_rm" href="#section-1">
						<span class="logo prefix">study</span><span class="logo suffix">naija</span>
					</a>
	    		</div>
		    	<div class="navbar-collapse collapse" id="navbar-collapsible">
			     	<ul class="nav navbar-nav navbar-right p-r-10">
			     		
			        	<li class="">
			        		<a class="white one_half_rm" href="<?=base_url('school');?>">
			        			<img src="<?=base_url('assets/images/icons/home-icon.svg');?>" style="height: 15px!important;"/>&nbsp;&nbsp;
			        			<span class="header-icons">home</span>
			        		</a>
			        	</li>
			        	
			        	<li class="height-x-55">
			        		<div class="line-divider"></div>
			        	</li>
			        	
			        	<li class="">
			        		<a class="white one_half_rm" href="<?=base_url('school/disciplines');?>">
			        			<img src="<?=base_url('assets/images/icons/course-icon.svg');?>" style="height: 15px!important;"/>&nbsp;&nbsp;
			        			<span class="header-icons">disciplines / courses</span>
			        		</a>
			        	</li>
			        	
			        	<li class="height-x-55">
			        		<div class="line-divider"></div>
			        	</li>
			        	
			        	<li class="">
			        		<a class="white one_half_rm" href="<?=base_url('school/applications');?>">
			        			<img src="<?=base_url('assets/images/icons/school-icon.svg');?>" style="height: 15px!important;"/>&nbsp;&nbsp;
			        			<span class="header-icons">applications</span>
			        		</a>
			        	</li>
			        	
			        	<li class="height-x-55">
			        		<div class="line-divider"></div>
			        	</li>
			        	
			        	<li class="">
			        		<a class="white one_half_rm" href="<?=base_url('messages/inbox');?>">
			        			<img src="<?=base_url('assets/images/icons/notification-icon.svg');?>" style="height: 15px!important;"/>&nbsp;&nbsp;
			        			<span class="header-icons">messages & notifications</span>
			        		</a>
			        	</li>
			        	
			        	<li class="height-x-55">
			        		<div class="line-divider"></div>
			        	</li>
			        	
			        	<li class="">
			        		<a class="white one_half_rm" href="<?=base_url('school/news');?>">
			        			<img src="<?=base_url('assets/images/icons/news-icon.svg');?>" style="height: 15px!important;"/>&nbsp;&nbsp;
			        			<span class="header-icons">news</span>
			        		</a>
			        	</li>
			        	
			        	
			        	<li class="height-x-55">
			        		<div class="line-divider"></div>
			        	</li>
			        	
			        	<li class="">
			        		<a class="white p-r-10" style="font-size: 1.5rem!important;"  href="<?=base_url('school/scholarships');?>">
			        			<img src="<?=base_url('assets/images/icons/scholarship-icon.svg');?>" style="height: 15px!important;"/>&nbsp;&nbsp;
			        			<span class="header-icons">scholarships</span>
			        		</a>
			        	</li>
			        	<li class="height-x-55">
			        		<div class="line-divider"></div>
			        	</li>
						
						<?php if ($this->session->user !== null) { ?>
			        	
							<?php if ($this->session->user->usertype == SCHOOL_ADMINISTRATOR ) { ?> 
								
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
									aria-haspopup="true" aria-expanded="false">
									<img class="img-circle"
										src="<?=(count($user) > 0)? base_url ($school->logo):"http://placehold.it/400x400";?>" 
										alt="<?=(count($user) > 0)? $user->email:'';?>"  
										style="width: 25px!important; height: 25px!important;"/>&nbsp;&nbsp;
									<span class="header-icons">My Account</span> 
									<span class="caret"></span>
								</a>
									
								<ul class="dropdown-menu">
									<li><a href="<?=base_url('school');?>">My Profile</a></li>
									<li><a href="<?=base_url('school/applications');?>">Recieved Applications</a></li>
									<li role="separator" class="divider"></li>
									<li>
										<a href="<?=base_url('messages/inbox');?>">
											Mails 
											<span class="label label-info pull-right" style="margin-top:4px!important;">0</span>
										</a>
									</li>
									<li role="separator" class="divider"></li>
									<li><a href="<?=base_url('users/signOut');?>">Sign Out</a></li>
								</ul>
							</li>
							
							<?php 
								} 
						
						} else  { ?>
							<li class="myHover">
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