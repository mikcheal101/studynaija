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
		
	</head>
	<body data-spy="scroll" data-target=".navbar" data-offset="60" id="body" ng-app="adminApp" ng-controller="adminCntrl">
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
			        		<a class="white one_half_rm"   href="<?=base_url('/admin');?>">
			        			<span  class="header-icons">Home</span>
			        		</a>
			        	</li>
			        	
			        	<li class="height-x-55">
			        		<div class="line-divider"></div>
			        	</li>
			        	
			        	<li class="">
			        		<a class="white one_half_rm"  href="<?=base_url('admin/disciplines');?>">
			        			<span  class="header-icons" >Disciplines / Courses</span>
			        		</a>
			        	</li>
			        	
			        	<li class="height-x-55">
			        		<div class="line-divider"></div>
			        	</li>
			        	
			        	<li class="">
			        		<a class="white one_half_rm"   href="<?=base_url('admin/instituitions');?>">
			        			<span class="header-icons">Schools / Instituitions</span>
			        		</a>
			        	</li>
			        	
			        	<li class="height-x-55">
			        		<div class="line-divider"></div>
			        	</li>
			        	
			        	<li class="">
			        		<a class="white one_half_rm"   href="<?=base_url('messages/inbox');?>">
			        			<span  class="header-icons" >Messages &amp; Notifications</span>
			        		</a>
			        	</li>
			        	
			        	<li class="height-x-55">
			        		<div class="line-divider"></div>
			        	</li>
			        	
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
								aria-haspopup="true" aria-expanded="false">
								<img class="img-circle height-x-25 width-25x"
			        				src="<?=(strlen($user->profile_image) > 4)?base_url($user->profile_image):"";?>" 
			        				alt="<?=(strlen($user->email) > 1) ? $user->email:"";?>"  
			        				/>&nbsp;&nbsp;
			        			<span  class="header-icons" >My Account <span class="caret"></span></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#">Change Password</a></li>
								<li><?=anchor('admin/profile', 'View Profile');?></li>
								<li role="separator" class="divider"></li>
								<li><?=anchor('users/signOut', 'Sign Out');?></li>
							</ul>
						</li>
			      	</ul>
		    	</div>
		  	</div>
		</nav>