<div class="container">
	<div class="row m-b-00 m-t-10">
		<div class="col-sm-6 col-sm-offset-3 ">
			
			<div class="panel panel-success">
				<h4 class="m-t-00 panel-heading">create an studynaija account</h4>
				
				<div class="panel-body">
					<h4 class="m-b-30 text-green text-justify">studynaija is fully equiped to get you from start to finish in your pursuit for gretness and quality education.</h4>
					<div class="line-ash m-b-20"></div>
					
					<p class="text-black text-justify">Aim for success, not perfection. Never give up your right to be wrong, because then you will lose the ability to learn new things and move forward with your life. Remember that fear always lurks behind perfectionism. <caption class="text-green">David M. Burns</caption></p>
	
					<?=form_open('', array('class'=>'form m-b-10 m-t-20 p-b-10'));?>
					
						<?php 
							if (isset($form)) {
								echo '<div class="alert alert-success alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										A confirmation e-mail was sent to <a href="mailto:'.$mail.'">'.$mail.'</a>. 
										Please verify email address.<br>Thanks<br>Webadmin studynaija
									</div>';
							}
						?>
						
						<div class="col-sm-12 input-box m-b-10 m-t-10">
							<label for="username" class="text-green">Username:</label><br>
							<input class="font-13" type="text" placeholder="enter username" name="username"  value="<?=set_value('username');?>" />
							<div class="font-11 text-red"><?=form_error('username');?></div>
						</div>
						
						<div class="col-sm-12 input-box m-b-10">
							<label for="password" class="text-green">Password:</label><br>
							<input class="font-13" type="password" placeholder="enter password" name="password"  value="<?=set_value('password');?>"  />
							<div class="font-11 text-red"><?=form_error('password');?></div>
						</div>
						
						<div class="col-sm-12 m-t-10 line-ash m-b-15"></div>
						
						<div class="col-sm-12 m-b-00 p-l-00 p-r-00">
							<div class="col-sm-12 input-box m-b-10">
								<label for="firstname" class="text-green">Firstname:</label><br>
								<input class="font-13" type="text" placeholder="enter firstname" name="firstname"  value="<?=set_value('firstname');?>"    />
								<div class="font-11 text-red"><?=form_error('firstname');?></div>
							</div>
							
							<div class="col-sm-12 input-box m-b-10">
								<label for="lastname" class="text-green">Lastname:</label><br>
								<input class="font-13" type="text" placeholder="enter lastname" name="lastname"  value="<?=set_value('lastname');?>"    />
								<div class="font-11 text-red"><?=form_error('lastname');?></div>
							</div>
						</div>
						
						<div class="col-sm-12 m-b-00 p-l-00 p-r-00">
							<div class="col-sm-12 input-box m-b-10">
								<label for="middlename" class="text-green">Middlename:</label><br>
								<input class="font-13" type="text" placeholder="enter middlename" name="middlename"  value="<?=set_value('middlename');?>"    />
								<div class="font-11 text-red"><?=form_error('middlename');?></div>
							</div>
							
							<div class="col-sm-12 input-box m-b-10">
								<label for="gender" class="text-green">Gender: </label>
								<div class="btn-group btn-xs p-l-00 pull-right" style="margin-top: -2px;!important;" data-toggle="buttons">
					                <label class="btn btn-xs btn-default" style="max-height: 22px;">
					                    <input type="radio" class="active" checked="checked" id="q156" name="gender" value="0" /> 
					                    Male
					                </label>
					                <label class="btn btn-xs btn-default" style="max-height: 22px;">
					                    <input type="radio" id="q156" name="gender" value="1" /> 
					                    Female
					                </label>
					            </div>  
								<div class="font-11 text-red" ><?=form_error('gender');?></div>
							</div>
						</div>
						
						<div class="col-sm-12 m-t-10 line-ash m-b-15"></div>
	
						<div class="col-sm-12 input-box m-b-10">
							<label for="email" class="text-green">Email:</label><br>
							<input class="font-13" type="email" placeholder="enter email" name="email"  value="<?=set_value('email');?>"    />
							<div class="font-11 text-red"><?=form_error('email');?></div>
						</div>
						
						<div class="col-sm-12 m-b-10 p-l-00 p-r-00">
							<div class="col-sm-12 input-box m-b-10">
								<label for="tel" class="text-green">Tel Number:</label><br>
								<input class="font-13" type="tel" placeholder="enter tel number"  name="tel"  value="<?=set_value('tel');?>"   />
								<div class="font-11 text-red"><?=form_error('tel');?></div>
							</div>
							
							<div class="col-sm-12 input-box m-b-10">
								<label for="dob" class="text-green">dob:</label><br>
								<input class="font-13" type="date" placeholder="enter date of birth" name="dob"  value="<?=set_value('dob');?>"    />
								<div class="font-11 text-red"><?=form_error('dob');?></div>
							</div>
							
						</div>
						
						<div class="col-sm-12 m-b-10 p-l-00 p-r-00">
							<button class="btn btn-block btn-success">Register</button>
						</div>
						
					</form>
					
					<div class="line-ash m-b-20"></div>
					
					
					<p class="text-black col-sm-6 p-l-00">Already have an account ? <a href="<?=base_url('users/signIn');?>">Sign in</a></p>
					<div class="col-sm-6 p-r-00">
						<div class="btn-block text-right">
							<button class="btn btn-sm btn-default" id="fb"><i class="fa fa-facebook"></i></button>
							<button class="btn btn-sm btn-default" id="fb"><i class="fa fa-twitter"></i></button>
							<button class="btn btn-sm btn-default" id="fb"><i class="fa fa-google-plus"></i></button>
							<button class="btn btn-sm btn-default" id="fb"><i class="fa fa-linkedin"></i></button>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
