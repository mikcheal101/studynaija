<div class="container">
	<div class="row m-b-00 m-t-10">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="panel panel-success">
				<h4 class="m-t-00 panel-heading">reset password</h4>
			
				<div class="panel-body">
					<div class="col-sm-12 m-b-20">
						<span>Enter your username / email address to get a reset link for your password</span>
					</div>
					<div class="col-sm-12"></div>
					<div class="col-sm-12 p-l-00 p-r-00">
						<?=form_open('', array('class'=>'form'));?>
						
							<div class="col-sm-12 input-box m-b-10 m-t-10">
								<label for="username" class="text-green">Username:</label><br>
								<input class="font-13" type="text" placeholder="enter username" name="username"/>
								<div class="font-11 text-red"><?=form_error('username');?></div>
							</div>
							<div class="col-sm-12 text-center">
								OR
							</div>
							
							<div class="col-sm-12 input-box m-b-10 m-t-10">
								<label for="email" class="text-green">email:</label><br>
								<input class="font-13" type="email" name="email" placeholder="enter email address" />
								<div class="font-11 text-red"><?=form_error('email');?></div>
							</div>
							
							<div class="col-sm-12 m-b-10 padding-00">
								<button class="btn btn-success btn-block">Request Password</button>
							</div>
							
							<div class="col-sm-12 right text-right padding-00">
								<p class="p-r-20">Already have an account? <a  href="<?=base_url('users/signIn');?>" >Sign In</a></p>
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