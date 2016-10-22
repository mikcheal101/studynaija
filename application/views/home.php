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
 		</style>
	</head>
	<body data-spy="scroll" data-target=".navbar" data-offset="60" id="body" ng-app="homeApp" ng-controller="homeCntrl">
		<nav class="navbar white">
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
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li class=""> 
							<a href="#" class="navbar-link text-ash-02 text-uppercase font-12">register</a>
						</li>
						<li>
							<?=anchor('users/signIn', 'sign in', ['class'=>'navbar-link text-ash-02 text-uppercase font-12']);?>
						</li>
						<li>
							<button class="btn btn-success btn-sm navbar-btn text-uppercase font-12">testing</button>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		
		<div class="container m-t-100">
			<div class="row m-b-10">
				<!-- logo here -->
				<div class="col-sm-8 col-sm-offset-2 text-center">
                	<img alt="studynaija logo" style="border-radius:5px;" src="<?=base_url ('assets/images/studynaija.png');?>" width="100" />
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<?=form_open('users/searchResults', array('class'=>'margin-base-vertical', 'method'=>'get'));?>
						<div class="input-group">
							<input type="text" name="searchbar" class="form-control no-shadow no-radius input-lg font-12" placeholder="enter school or discipline name to search...">
							<span class="input-group-btn">
								<button class="no-hover btn btn-default btn-lg no-border-left no-radius" >
									<i class="fa fa-search p-t-05 text-ash-02" style="padding-bottom:1px;"></i>
								</button>
							</span>
						</div>
					</form>
				</div>
			</div>
			<div class="row m-t-00">
				<div class="col-sm-8 col-sm-offset-2 text-center p-b-60">
					<h4 class="text-mygreen p-b-10 text-uppercase">Do you want a wonderful education and expirence amongst the best higher education expirence?</h4>
					<span class="text-ash-01 p-t-10 p-b-20">
						<p class="font-12 text-uppercase">With over 100 private and public Universities, Polytechnics, Monotechnics and instituitions of higher learning. </p>
					<span>
				</div>
			</div>
			
			<div class="row m-t-00 p-t-05">
				<div class="col-sm-8 col-sm-offset-2 text-center">
					<span class="btn no-background btn-default btn-md facebook">
						<i class="fa  fa-facebook facebook" aria-hidden="true"></i>  facebook
					</span>
					<span class="btn no-background btn-default btn-md linkedin">
						<i class="fa  fa-linkedin linkedin" aria-hidden="true"></i>  linked in
					</span>
				</div>
			</div>
		
		</div>
		<script src="<?=base_url('assets/js/jquery.js');?>"></script>
		<script src="<?=base_url('assets/js/bootstrap.3.0.2.min.js');?>"></script>
		<script src="<?=base_url('assets/js/tether.min.js');?>"></script>
	</body>
</html>
