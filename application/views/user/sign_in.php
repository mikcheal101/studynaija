<div class="container">
	<div class="row m-b-00 m-t-10">
		<div class="col-sm-6 col-sm-offset-3">
			<div class=" panel panel-success">
				<h4 class="panel-heading m-t-00">signIn to studynaija</h4>
				
				<div class="panel-body">
					<div class="col-sm-12 m-b-20 ">
						<span>Welcome back.<br>Enter your username / email address and password to continue</span>
					</div>
					<div class="col-sm-12 p-l-00 p-r-00">
						<?=form_open('', array('class'=>'form m-b-10 m-t-00 p-b-10'));?>
						
							<?php 
								if (isset($form)) {
									if ($form === FALSE) {
										echo '<div class="alert alert-danger alert-dismissible m-t-00" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											'.$error.' 
											<br>Thanks<br>Webadmin studynaija
										</div>';	
									}
								}
							?>
							
							<div class="col-sm-12 input-box m-b-10">
								<label for="name" class="text-green">Username:</label><br>
								<input class="font-13" type="text" placeholder="enter username" name="username" value="<?=set_value('username');?>" aria-describedby="searchBtn" />
								<div class="font-11 text-red"><?=form_error('username');?></div>
							</div>
							
							<div class="col-sm-12 input-box m-b-20">
								<label for="name" class="text-green">Password:</label><br>
								<input class="font-13" type="password" placeholder="enter password" name="password" value="<?=set_value('password');?>" aria-describedby="searchBtn" />
								<div class="font-11 text-red"><?=form_error('password');?></div>
							</div>
							
							<div class="col-sm-12 m-b-10 padding-00">
								<button class="btn btn-success btn-block">Login</button>
							</div>
							
							<div class="col-sm-12 right text-right padding-00">
								<a href="<?=base_url('users/signUp');?>" class="p-r-20">Register Account</a> | 
								<a href="<?=base_url('users/forgotPassword');?>" class="p-l-20">Forgot Password ?</a>
							</div>
							
							<div class="col-sm-12 m-t-25 padding-00">
								<div class=" line-ash"></div>
							</div>
							
							<div class="col-sm-12 padding-00">
								<div class="btn-block text-right">
									<button class="btn btn-sm btn-default" id="fb"><i class="fa fa-facebook"></i></button>
									<button class="btn btn-sm btn-default" id="fb"><i class="fa fa-twitter"></i></button>
									<button class="btn btn-sm btn-default" id="fb"><i class="fa fa-google-plus"></i></button>
									<button class="btn btn-sm btn-default" id="fb"><i class="fa fa-linkedin"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>