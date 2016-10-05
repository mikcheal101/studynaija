<!DOCTYPE HTML lang="en">
<html>
	<head>
		<title><?=$title;?></title>
		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<!-- <link href='http://fonts.googleapis.com/css?family=Abel|Open+Sans:400,600' rel='stylesheet'> -->
		<link rel="icon" type="img/ico" href="<?=base_url ('assets/images/studynaija.ico');?>" />
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
				color: #6CBA35!important;
			}
			body {
				background-color: #FFF!important;
				font-family: "Helvetica Neue", Helvetica, Arial, sans-serif!important;
				font-weight: normal!important;
			}
			
			.navbar-btn {
				color: #5cb85c!important;
				background-color:transparent!important;
			}
			
			.no-hover:hover, .no-hover:focus {
				background-color: transparent!important;
				border-left: 0px!important;
				outline:0!important;
				box-shadow: none!important;
				-moz-box-shadow:none!important;
			}
			
			.home-bg {
				background-image: url('<?=base_url ("assets/images/home.JPG");?>');
				background-size: cover;
				background-position: 0px 0px;
				background-repeat : no-repeat;
			}
			.home-container {
				border: none!important;
				height: calc(100vh - 55px);
			}
			.hundred-height {
				height: calc(100vh - 55px);
			}
			.bg-green {
				background-color: rgba(51, 223, 51, 0.2)!important;
			}
			.icon-bar { background-color: white!important;}
			.ten-rem { width: 10rem!important; }
 		</style>
	</head>
	<body data-spy="scroll" data-target=".navbar" data-offset="60" id="body" ng-app="homeApp" ng-controller="homeCntrl" class="home-bg">
		<nav class="navbar white m-b-00 no-border">
			<div class="container-fluid" style="border-bottom-color:rgba(108,186,53,0.3); border-top:none; border-right:none; border-left:none;">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" 
						data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse no-overflow no-scroll" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li class=""> 
							<a href="#" class="navbar-link text-ash-02 text-uppercase font-12">register</a>
						</li>
						<li><a href="#" class="navbar-link text-ash-02 text-uppercase font-12">sign in</a></li>
						<li><a href="#" class="navbar-link text-ash-02 text-uppercase font-12">sign in</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		
		<div class="container-fluid home-container text-white font-white" >
			<div class="row">
				<div class="col-md-6 col-md-offset-6 col-sm-12 bg-green hundred-height">
					<div class="col-sm-12 text-center p-t-20">
						<?=img ('assets/images/logo.JPG', false, array ('width'=>'10rem', 'class'=>'ten-rem'));?>
					</div>
					<div class="col-sm-12 text-center p-t-20">
						<h3 class="text-uppercase">
							Do you want a wonderful education and expirence amongst the best higher education expirence?
						</h3>
					</div>
					
					<div class="col-sm-12 text-center p-t-20">
						<p class="text-lowercase text-12 font-12">
							With over 100 private and public Universities, Polytechnics, Monotechnics and instituitions of higher learning. 
						</p>
					</div>
				</div>
			</div>
		</div>

		<script src="<?=base_url('assets/js/jquery.js');?>"></script>
		<script src="<?=base_url('assets/js/bootstrap.3.0.2.min.js');?>"></script>
		<script src="<?=base_url('assets/js/tether.min.js');?>"></script>
	</body>
</html>
