
<!DOCTYPE HTML lang="en">
<html>
	<head>
		<title><?=$title;?></title>
		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<!-- <link href='http://fonts.googleapis.com/css?family=Abel|Open+Sans:400,600' rel='stylesheet'> -->

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
			.text-mygreen {
				color: #01a14b!important;
			}
 		</style>
	</head>
	<body data-spy="scroll" data-target=".navbar" data-offset="60" id="body" ng-app="homeApp" ng-controller="homeCntrl">
		<!--
		<h1>Do you want a wonderful education and expirence amongst the best higher education expirence?</h1>
		<p>With over 100 private and public Universities, Polytecnics, Monotechnics and instituitions of higher learning. </p>
		<p>A country with a vast culture, rich Heritage and history...</p>
		<p>We wish to solve the question and profer solutions to a wonderful education and expirence amongst the best higher education expirence.</p>
		-->
		<nav class="navbar navbar-fixed-top transparent-border" role="navigation" id="header">
			<div class="container">
		    	<div class="navbar-header">
		      		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapsible">
			        	<span class="sr-only white">Toggle navigation</span>
				        <span class="icon-bar white"></span>
				        <span class="icon-bar white"></span>
				        <span class="icon-bar white"></span>
		      		</button>
		      		<a id="homeBtn" class="navbar-brand white p-l-00" style="font-size: 3rem!important;" href="#section-1">
						<span class="logo prefix">study</span><span class="logo suffix text-white">naija</span>
					</a>
	    		</div>
		    	<div class="navbar-collapse collapse" id="navbar-collapsible">
			     	<ul class="nav navbar-nav navbar-right">
			        	<li><a class="white" style="font-size: 1.5rem!important;"  href="<?=base_url('users/signUp');?>">Sign Up</a></li>
			        	<li class="padding-15"><span class="white" style="font-size: 1.5rem!important;"  href="<?=base_url('');?>">|</span></li>
			        	<li><a class="white" style="font-size: 1.5rem!important;"  href="#how_it_works">How It works</a></li>
			        	<li class="padding-15"><span class="white" style="font-size: 1.5rem!important;"  href="<?=base_url('');?>">|</span></li>
			        	<li><a class="white" style="font-size: 1.5rem!important;"  href="<?=base_url('users/signIn');?>">Login</a></li>
			      	</ul>
		    	</div>
		  	</div>
		</nav>
		
		
		<div class="container-fluid full-height" id="starter">
			<header class="row full-height background-image background-3 text-white" id="section-1">
				<div class="col-md-6 col-md-offset-3 m-t-100 background-black-1 p-t-40 p-l-60 p-r-60 p-b-60 border-5r">
					<h2 class="margin-base-vertical text-center">SEARCH FOR THE COURSE, SCHOOL FOR A WONDERFUL EDUCATION AND EXPIRENCE AMONGST NON OTHER...</h2>
		
					<?=form_open('users/searchResults', array('class'=>'margin-base-vertical', 'method'=>'get'));?>
						<p class="input-group">
							<input type="search" name="searchbar" id="searchbar" class="form-control input-lg" placeholder="enter school or discipline name to search..."/>
							<span class="input-group-addon btn btn-white">
								<button class="glyphicon glyphicon-search" style="background-color: rgba(0, 0, 0, 0)!important; border:none!important;"></button>
							</span>
						</p>
						
					<?=form_close();?>
					
					<div class="help-block text-center">
						<?=anchor('#', 'Engineering & Technology, ', array('class'=>'text-white'));?>
						<?=anchor('#', 'Computer Science & IT, ', array('class'=>'text-white'));?>
						<?=anchor('#', 'Natural Sicence & Mathematics, ', array('class'=>'text-white'));?>
						<?=anchor('#', 'Arts, ', array('class'=>'text-white'));?>
						<?=anchor('#', 'Design & Architecture, ', array('class'=>'text-white'));?>
						<?=anchor('#', 'Business & Management, ', array('class'=>'text-white'));?>
						<?=anchor('#', 'Law, ', array('class'=>'text-white'));?>
						<?=anchor('#', 'Social Science, ', array('class'=>'text-white'));?>
						<?=anchor('#', 'Humanities, ', array('class'=>'text-white'));?>
						<?=anchor('#', 'Medicine & Health, ', array('class'=>'text-white'));?>
						<?=anchor('#', 'Education & training, ', array('class'=>'text-white'));?>
						<?=anchor('#', 'Others, ', array('class'=>'text-white'));?>
					</div>
					
					
				</div>
				
				<div class="col-sm-12 col-xs-12 p-t-20 p-b-10" style="text-align: center!important;">
					<a href="#section-2" id="downBtn">
						<img src="<?=base_url('assets/images/arrow-down.svg');?>" alt="go down" style="height: 50px!important;" />
					</a>		
				</div>
			</header>
			
			<section id="section-2" class="row background-white-complete p-t-70 p-b-70">
				<div class="col-md-6 p-t-30 p-b-30 p-l-50 p-r-30">
					<p class="font-15 brand-color">Fast &amp; Responsive Search results</p>
					
					<h2 class="text-former-brand">Amazing Schooling Expirence...</h2>
					<p class="font-15 ">
						Find and compare Ordinary Diplomas, Higher National Diplomas, 
						Barchelors and Master's degrees and postgraduate studies (diplomas, 
						certificates) from top universities and higher instituitions in Nigeria.
					</p>
					
					<h2 class="text-former-brand" >Take A Free Personality Test!</h2>
					<p class="font-15 ">
						Find out what programs suite you best...
					</p>
					
					<a class="font-14" href="<?=base_url('');?>">Coming Soon</a>
				</div>
				
				
				<div class="col-md-6 p-t-30 p-b-30 ">
					<div class="row p-r-20">
						<div class="col-md-3 height-20 p-l-05 p-r-05">
							<div class="border-5r col-md-12 background-image background-06 full-height"></div>
						</div>
						
						<div class="col-md-3 height-20 p-l-05 p-r-05">
							<div class="border-5r col-md-12 background-image background-05 full-height"></div>
						</div>
						
						<div class="col-md-3 height-20 p-l-05 p-r-05">
							<div class="border-5r col-md-12 background-image background-09 full-height"></div>
						</div>
						
						<div class="col-md-3 height-20 p-l-05 p-r-05">
							<div class="border-5r col-md-12 background-image background-04 full-height"></div>
						</div>
						
					</div>
					
					<div class="row p-r-20 p-t-10">
						<div class="col-md-3 height-20 p-l-05 p-r-05">
							<div class="border-5r col-md-12 background-image background-02 full-height"></div>
						</div>
						
						<div class="col-md-3 height-20 p-l-05 p-r-05">
							<div class="border-5r col-md-12 background-image background-16 full-height"></div>
						</div>
						
						<div class="col-md-3 height-20 p-l-05 p-r-05">
							<div class="border-5r col-md-12 background-image background-15 full-height"></div>
						</div>
						
						<div class="col-md-3 height-20 p-l-05 p-r-05">
							<div class="border-5r col-md-12 background-image background-12 full-height"></div>
						</div>
						
					</div>
				</div>
			</section>
			
			<section class="row background-brand text-white p-l-10 p-t-90 p-b-90" id="section-3">
				<div class="col-md-4 p-t-30 p-b-30 p-l-50 p-r-30">
					<a href="<?=base_url('users/schools');?>">
						<div class="row p-r-50 text-white" style="border-right:1px solid rgba(255, 255, 255, 0.35);">
							<div class="col-md-12 text-center">
								<h2>INSTITUITIONS</h2>
							</div>
							<div class="col-md-12 text-center p-t-20 p-b-20">
								<i class="fa fa-5x fa-building"></i>
							</div>
							<div class="col-md-12 text-center">
								<p>
									Universities, Polytecnics, Colleges of Education, <br>
									Monotechnics, Colleges of Agriculture, and more...
								</p>
							</div>
						</div>
					</a>
				</div>
				
				<div class="col-md-4 p-t-30 p-b-30 p-l-50 p-r-30">
					<a href="<?=base_url('users/disciplines');?>">
						<div class="row p-r-55 text-white" style="border-right:1px solid rgba(255, 255, 255, 0.35);">
							<div class="col-md-12 text-center">
								<h2>DISCIPLINES</h2>
							</div>
							<div class="col-md-12 text-center p-t-20 p-b-20">
								<i class="fa fa-5x fa-graduation-cap"></i>
							</div>
							<div class="col-md-12 text-center">
								<p>B.Sc. Computer Engineering, B.A. Linguistics, Geography, B.Edu Physics, English & Yoruba and more...</p>
							</div>
						</div>
					</a>
				</div>
				
				<div class="col-md-4 p-t-30 p-b-30 p-l-50 p-r-30">
					<a href="<?=base_url('users/scholarships');?>">
						<div class="row text-white">
							<div class="col-md-12 text-center">
								<h2>SCHOLARSHIPS</h2>
							</div>
							<div class="col-md-12 text-center p-t-20 p-b-20">
								<i class="fa fa-5x fa-money"></i>
							</div>
							<div class="col-md-12 text-center">
								<p>Dangote Achievement Award for Excellence.<br>
								UNESCO, and much more...</p>
							</div>
						</div>
					</a>	
				</div>
			</section>
			
			<section class="row p-l-10 p-t-30 p-b-30 background-17" id="section-4" >
				<div class="col-md-12 p-t-30 p-b-30 p-l-50 p-r-30">
					<div class="row p-r-50" style="border-right:1px solid rgba(255, 255, 255, 0.35);">
						<div class="col-md-12 text-center">
							<h2>BROWSE BY STATE</h2>
							
							<div class="row p-t-10">
								<div class="col-md-4 p-l-05 p-r-05">
									<div class="row">
										<div class="col-md-12">
											<a href="<?=base_url('users/searchResults?state=abuja,%20FCT&state_selected=37');?>" title="Higher Instituitions in Abuja / Federal Capital Territory, Nigeria">
												<div class="background-image background-07 height-40 border-5r">
													<p class="text-white font-30" style="width: calc(100% - 30px); position: absolute; bottom: 0px; left: 15px; background-color: rgba(0, 0, 0, 0.5)!important; border-bottom-left-radius:5px!important; border-bottom-right-radius:5px!important;">Abuja</p>
												</div>
											</a>
										</div>
									</div>
								</div>
								
								<div class="col-md-4 p-l-05 p-r-05">
									<div class="row">
										<div class="col-md-12">
											<a href="<?=base_url('users/searchResults?state=Cross%20River&state_selected=9');?>" title="Higher Instituitions in Cross River State, Nigeria">
											<div class="background-image background-08 height-40 border-5r">
												<p class="text-white font-30" style="width: calc(100% - 30px); position: absolute; bottom: 0px; left: 15px; background-color: rgba(0, 0, 0, 0.5)!important; border-bottom-left-radius:5px!important; border-bottom-right-radius:5px!important;">Cross River State</p>
											</div>
											</a>
										</div>
									</div>
								</div>
								
								<div class="col-md-4 p-l-05 p-r-05">
									<div class="row">
										<div class="col-md-12">
											<a href="<?=base_url('users/searchResults?state=Lagos&state_selected=24');?>" title="Higher Instituitions in Lagos State, Nigeria">
											<div class="background-image background-14 height-40 border-5r">
												<p class="text-white font-30" style="width: calc(100% - 30px); position: absolute; bottom: 0px; left: 15px; background-color: rgba(0, 0, 0, 0.5)!important; border-bottom-left-radius:5px!important; border-bottom-right-radius:5px!important;">Lagos State</p>
											</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row p-t-10">
								<div class="col-md-4 p-l-05 p-r-05">
									<div class="row">
										<div class="col-md-12">
											<a href="<?=base_url('users/searchResults?state=Enugu&state_selected=14');?>" title="Higher Instituitions in Enugu State, Nigeria">
											<div class="background-image background-10 height-40 border-5r">
												<p class="text-white font-30" style="width: calc(100% - 30px); position: absolute; bottom: 0px; left: 15px; background-color: rgba(0, 0, 0, 0.5)!important; border-bottom-left-radius:5px!important; border-bottom-right-radius:5px!important;">Enugu State</p>
											</div>
											</a>
										</div>
									</div>
								</div>
								
								<div class="col-md-4 p-l-05 p-r-05">
									<div class="row">
										<div class="col-md-12">
											<a href="<?=base_url('users/searchResults?state=Ogun&state_selected=27');?>" title="Higher Instituitions in Ogun State, Nigeria">
											<div class="background-image background-11 height-40 border-5r">
												<p class="text-white font-30" style="width: calc(100% - 30px); position: absolute; bottom: 0px; left: 15px; background-color: rgba(0, 0, 0, 0.5)!important; border-bottom-left-radius:5px!important; border-bottom-right-radius:5px!important;">Ogun State</p>
											</div>
											</a>
										</div>
									</div>
								</div>
								
								<div class="col-md-4 p-l-05 p-r-05">
									<div class="row">
										<div class="col-md-12">
											<a href="<?=base_url('users/searchResults?state=Kaduna&state_selected=18');?>" title="Higher Instituitions in Kaduna State, Nigeria">
												<div class="background-image background-13 height-40 border-5r">
													<p class="text-white font-30" style="width: calc(100% - 30px); position: absolute; bottom: 0px; left: 15px; background-color: rgba(0, 0, 0, 0.5)!important; border-bottom-left-radius:5px!important; border-bottom-right-radius:5px!important;">Kaduna State</p>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
							
							<h5 class="p-t-20">
								<a class="font-20" href="<?=base_url('users/states');?>">View All States</a>
							</h5>
						</div>
					</div>
				</div>
			</section>
			
			<section class="row p-l-10 p-t-10 p-b-30 text-white background-18" id="section-4" >
				<div class="col-md-12 p-t-10 p-b-30 p-l-50 p-r-60">
					
					<div class="container p-r-10">
						<div class="row">
							
							<div class="col-md-4 col-md-offset-1 text-left bold">
								<h2>studynaija</h2>
							</div>
							
							<div class="col-md-3 text-left">
								<h3 class="p-b-10">Popular Items</h3>
							</div>
							
							<div class="col-md-4 text-left">
								<h3>Privacy & Terms</h3>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<hr class="footer-line">
							</div>
						</div>
						
						<div class="row p-t-20 p-b-15">
							
							<div class="col-md-4 col-md-offset-1 text-left">
								<img src="<?=base_url('assets/images/bg-9.jpg');?>" style="max-width: 150px;" class="img-rounded img-responsive img-fluid p-b-10" />
								<p class="text-justify">
									At studynaija our database, you can search for
									a Undergraduate degree, Master's degrees, and much more in all academic fields
									Business, Economics, Social Studies, Natural
									Sciences, Law, Engineering, Humanities, 
									Environmental Science and many more... 
								</p>
								<p class="text-right">
									<i class="fa fa-2x fa-facebook-square p-r-05"></i>
									<i class="fa fa-2x fa-twitter-square p-r-05"></i>
									<i class="fa fa-2x fa-skype p-r-05"></i>
									<i class="fa fa-2x fa-google-plus-square p-r-05"></i>
								</p>
							</div>
							
							<div class="col-md-3 text-left">
								<dl>
									<dd class="p-b-10"><a class="text-white" href="<?=base_url('users/states');?>">Disciplines By State</a></dd>
									<dd class="p-b-10"><a class="text-white" href="<?=base_url('users/schools');?>">Disciplines By Schools</a></dd>
									<dd class="p-b-10"><a class="text-white" href="<?=base_url('users/scholarships');?>">Scholarships</a></dd>
								</dl>
							</div>
							
							<div class="col-md-4 text-left">
								<dl>
									<dd class="p-b-10"><a href="<?=base_url('');?>" class="text-white"><a href="<?=base_url('');?>" class="text-white">Privacy Policy</a></dd>
									<dd class="p-b-10"><a href="<?=base_url('');?>" class="text-white"><a href="<?=base_url('');?>" class="text-white">Terms of Use</a></dd>
									<dd class="p-b-10"><a href="<?=base_url('');?>" class="text-white"><a href="<?=base_url('');?>" class="text-white">Terms of Service</a></dd>
									<dd class="p-b-10"><a href="<?=base_url('');?>" class="text-white"><a href="<?=base_url('');?>" class="text-white">Acceptable Use Policy</a></dd>
									<dd class="p-b-10"><a href="<?=base_url('');?>" class="text-white"><a href="<?=base_url('');?>" class="text-white">Disclaimer</a></dd>
								</dl>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<hr class="footer-line">
							</div>
						</div>
						
						<div class="row p-t-10">
							<div class="col-md-8">
								<p>&copy <?=date('Y');?> studynaija.com</p>
							</div>
							
							<div class="col-md-4 text-right">
								<p>
									<b class="bold" style="color:rgba(255, 255, 255, 0.5); font-weight: bolder;">customer support: </b> <a href="mailto:support@studynaija.com" class="text-white">support@studynaija.com</a>
								</p>
							</div>
						</div>
						
					</div>
				</div>
			</section>
		</div>
		
		<script src="<?=base_url('assets/js/jquery.js');?>"></script>
		<script src="<?=base_url('assets/js/bootstrap.3.0.2.min.js');?>"></script>
		<script src="<?=base_url('assets/js/tether.min.js');?>"></script>
		<script src="<?=base_url('assets/js/bootstrap-notify.js');?>"></script>
		
		
		<script>
			
			$(function () {
				var starter 	= $('#starter');
				var section_1 	= $('#section-1');
				var section_2 	= $('#section-2');
				var header 		= $('#header');
				
				var downBtn 	= $('#downBtn');
				var homeBtn		= $('#homeBtn');

				var turn_white = (parseInt(starter.height()));
				var trans_area = (parseInt(section_1.position().top) * -1);
				
				homeBtn.on('click', function () {
					turnToWhite();
					scrollToPosition(starter, section_1);
				});
				
				downBtn.on('click', function () {
					turnToWhite();
					scrollToPosition(starter, section_2);
				});
				
				starter.on('scroll', function () {
					turnToWhite();
				});
			});    
			
			function scrollToPosition (parent, param) {
				parent.animate({
					scrollTop: param.offset().top
				}, 1500);
			}
			
			function turnToWhite () {
				
				var starter 	= $('#starter');
				var section_1 	= $('#section-1');
				var section_2 	= $('#section-2');
				var header 		= $('#header');
				let suffix 		= $('.suffix');
				var turn_white = (parseInt(starter.height()) - 1);
				var trans_area = (parseInt(section_1.position().top) * -1);
				
				if (trans_area >= turn_white) {
					header.removeClass('transparent-border');
					header.addClass('nav-black');
					suffix.addClass('text-mygreen');
					suffix.removeClass('text-white');
				} else {
					//console.log('turn white');
					header.removeClass('nav-black');
					header.addClass('transparent-border');
					suffix.removeClass('text-mygreen');
					suffix.addClass('text-white');
				}
			}
			
		</script>
		
	</body>
</html>