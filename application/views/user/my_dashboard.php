<div class="container">
	<div class="row m-t-05">
		<aside class="col-sm-3 p-l-00 p-r-05">
			<div class="col-sm-12 m-b-05 border-ash background-white-complete padding-00">
				<div class="col-sm-12 padding-00" style="text-align: -webkit-center;">
					<img class="img-fluid img-responsive m-b-05 passport" style="min-width: 100%;" src="<?=($user->profile_image !== NULL)? $user->profile_image :"http://placehold.it/400x400";?>" alt="<?=$user->email;?>" />
					<div class="col-sm-12 m-b-10">
						<?=$passporterror;?>
						<?=form_open_multipart('users/applicantpassport', array('class'=>' m-b-05'));?>
						<input type="file" name="passportFile" class="col-sm-12 padding-00 m-t-05 m-b-05 passportFile" id="" />
						<div class="col-sm-12 padding-00 text-left" id="passportid" >
							<button class="btn btn-xs btn-success">save passport</button>
						</div>
						<?=form_close();?>
					</div>
				</div>
			</div>
			
			<div class="col-sm-12 m-b-05 border-ash background-white-complete padding-10">
				<h4 class="text-green m-t-00 m-b-10">Messages</h4>
				<ul style="list-style: none!important;" class="p-l-00">
					<li style="border-bottom: 1px solid #F9F9F9;" class="p-l-05 p-b-05 p-t-05">
						<i class="fa fa-inbox text-purple"> </i> &nbsp; &nbsp;
						<a href="<?=base_url('messages/inbox');?>" class="m-b-10">Inbox <small>(100)</small></a>	
					</li>
					<li style="border-bottom: 1px solid #F9F9F9!important;" class="p-l-05 p-b-10 p-t-10">
						<i class="fa fa-paper-plane text-purple"> </i> &nbsp; &nbsp;
						<a href="<?=base_url('messages/sent');?>">Outbox <small>(100)</small></a>	
					</li>
					<li style="border-bottom: 1px solid #F9F9F9!important;" class="p-l-05 p-b-10 p-t-10">
						<i class="fa fa-floppy-o text-purple"> </i> &nbsp; &nbsp;
						<a href="<?=base_url('messages/saved');?>">Saved <small>(100)</small></a>	
					</li>
					<li style="" class="p-l-05 p-b-00 p-t-10">
						<i class="fa fa-trash text-purple"> </i> &nbsp; &nbsp;
						<a href="<?=base_url('messages/trash');?>">Trash <small>(100)</small></a>	
					</li>
					
				</ul>
				
			</div>
			
			<div class="col-sm-12 m-b-05 border-ash background-white-complete padding-10">
				<h4 class="text-green m-t-00 m-b-10">Extras</h4>
				<ul style="list-style: none!important;" class="p-l-00">
					<li style="border-bottom: 1px solid #F9F9F9;" class="p-l-05 p-b-05 p-t-05">
						<i class="fa fa-pencil-square-o text-purple"> </i> &nbsp; &nbsp;
						<a href="<?=base_url('users/myApplications');?>" class="m-b-10">My Applications <small>(2)</small></a>	
					</li>
					<li style="border-bottom: 1px solid #F9F9F9!important;" class="p-l-05 p-b-10 p-t-10">
						<i class="fa fa-building text-purple"> </i> &nbsp; &nbsp;
						<a href="<?=base_url('users/schools/fav');?>">My Favourite Schools <small>(10)</small></a>	
					</li>
					<li style="" class="p-l-05 p-b-00 p-t-10">
						<i class="fa fa-graduation-cap text-purple"> </i> &nbsp;
						<a href="<?=base_url('users/disciplines/fav');?>">My Favourite Disciplines <small>(100)</small></a>	
					</li>
					
				</ul>
				
			</div>
		</aside>
		
		<div class="col-sm-9 p-l-00 p-r-00">
			<?=form_open_multipart();?>
			<div class="col-sm-12 padding-10 border-ash background-white-complete m-b-05">
				<h3 class="text-green m-t-00 m-b-00">Complete your profile to get the best fit schools for you.</h3>
			</div>
			
			<div class="col-sm-12 padding-10 border-ash background-white-complete m-b-05">
				<h4 class="col-sm-12 m-b-20 text-blue">Personal Information</h4>
				
				<div class="col-sm-12">
					<fieldset class="m-b-30 col-sm-4 p-l-00">
						<legend class="font-14 m-b-00 no-border text-blue">First Name : <span class="text-red bold">*</span></legend>
						<input type="text" class="form-control no-padding" 
						style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
						name="firstname" placeholder="enter firstname" value="<?=$user->firstname;?>" />
						<?=form_error('firstname', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
					<fieldset class="m-b-30 col-sm-4">
						<legend class="font-14 m-b-00 no-border text-blue">Middle Name :</legend>
						<input type="text" class="form-control no-padding" style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
						name="middlename" placeholder="enter middlename" value="<?=$user->middlename;?>" />
						<?=form_error('middlename', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
					<fieldset class="m-b-30 col-sm-4">
						<legend class="font-14 m-b-00 no-border text-blue">Last Name : <span class="text-red bold">*</span></legend>
						<input type="text" class="form-control no-padding" style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
						name="lastname" placeholder="enter Lastname" value="<?=$user->lastname;?>" />
						<?=form_error('lastname', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
				</div>
				
				<div class="col-sm-12">
					<fieldset class="m-b-30 col-sm-4 p-l-00">
						<legend class="font-14 m-b-00 no-border text-blue">Email Address : <span class="text-red bold">*</span></legend>
						<input type="email" class="form-control no-padding" style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
						name="email" placeholder="enter email address" value="<?=$user->email;?>" />
						<?=form_error('email', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
					<fieldset class="m-b-30 col-sm-4">
						<legend class="font-14 m-b-00 no-border text-blue">Tel :</legend>
						<input type="tel" class="form-control no-padding" style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
						name="tel" placeholder="enter tel number" value="<?=$user->tel;?>" />
						<?=form_error('tel', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
					<fieldset class="m-b-30 col-sm-4">
						<legend class="font-14 m-b-00 no-border text-blue">Date of Birth : <span class="text-red bold">*</span></legend>
						<input type="date" class="form-control no-padding" style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
						name="dob" placeholder="enter date of birth" value="<?=date('Y-m-d', strtotime($user->dob));?>" />
						<?=form_error('dob', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
				</div>
				
				<div class="col-sm-12">
					<fieldset class="m-b-30 col-sm-4 p-l-00">
						<legend class="font-14 m-b-00 no-border text-blue">Naionality : <span class="text-red bold">*</span></legend>
						<?=form_dropdown('nationality', $countries, $user->nationality, array(
								'class' => 'form-control no-padding',
								'style' => "box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;",
						));?>
						<?=form_error('nationality', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
					
					<fieldset class="m-b-30 col-sm-4">
						<legend class="font-14 m-b-00 no-border text-blue">Gender :</legend>
						<?=form_dropdown('gender', array('1'=>'Male', '2'=>'Female'), $user->gender, array(
								'class' => 'form-control no-padding',
								'style' => "box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;",
						));?>
						<?=form_error('gender', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
					
					<fieldset class="m-b-30 col-sm-4">
						<legend class="font-14 m-b-00 no-border text-blue">Country of Residence : <span class="text-red bold">*</span></legend>
						<?=form_dropdown('cor', $countries, $user->country_of_residence, array(
								'class' => 'form-control no-padding',
								'style' => "box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;",
						));?>
						
						<?=form_error('cor', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
				</div>
				
				<div class="col-sm-12">
					<fieldset class="m-b-30 col-sm-12 p-l-00">
						<legend class="font-14 m-b-00 no-border text-blue">Address : <span class="text-red bold">*</span></legend>
						<textarea class="form-control no-padding" 
							style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
							name="address" placeholder="enter address"><?=($user->address !== NULL)?base64_decode($user->address):'';?></textarea>
						<?=form_error('address', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
				</div>
			</div>
			
			<div class="col-sm-12 padding-05 border-ash background-white-complete m-b-05">
				<h4 class="col-sm-12 m-b-20 text-blue">Interests</h4>
				<div class="col-sm-12">
					<fieldset class="m-b-30 col-sm-6 p-l-00">
						<legend class="font-14 m-b-00 no-border text-blue">Starting Period (Semester) : </legend>
						<?=form_dropdown('start_semester', $semesters, $user->start_semester, array(
								'class' => 'form-control no-padding',
								'style' => "box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;",
						));?>

						<?=form_error('start_semester', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
					<fieldset class="m-b-30 col-sm-6">
						<legend class="font-14 m-b-00 no-border text-blue">How would you be funded (Tuition, Accomodation, etc..) :</legend>
						<?=form_dropdown('payment_options', $payment_options, $user->payment_options, array(
								'class' => 'form-control no-padding',
								'style' => "box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;",
						));?>
						
						<?=form_error('payment_options', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
				</div>
			</div>
			
			<div class="col-sm-12 padding-05 border-ash background-white-complete m-b-05">
				<h4 class="col-sm-12 m-b-20 text-blue">Interests</h4>
				<div class="col-sm-12">
					<fieldset class="m-b-30 col-sm-6 p-l-00">
						<legend class="font-14 m-b-00 no-border text-blue">Highest Obtained Qualification : <span class="text-red bold">*</span></legend>
						<?=form_dropdown('highest_qualification', $highest_qualifications, $user->highest_qualification, array(
								'class' => 'form-control no-padding',
								'style' => "box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;",
						));?>
						
						<?=form_error('highest_qualification', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
					<fieldset class="m-b-30 col-sm-6">
						<legend class="font-14 m-b-00 no-border text-blue">What Country Did You Study? : <span class="text-red bold">*</span></legend>
						<?=form_dropdown('cos', $countries, $user->country_of_study, array(
								'class' => 'form-control no-padding',
								'style' => "box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;",
						));?>
						<?=form_error('cos', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
				</div>
				<div class="col-sm-12">
					<fieldset class="m-b-30 col-sm-6 p-l-00">
						<legend class="font-14 m-b-00 no-border text-blue">How Many Years of Work Expirence Have You? : </legend>
						<input type="number" class="form-control no-padding" style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
						name="yoe" placeholder="enter how many years of experience you have" value="<?=($user->years_of_expirence == NULL)?'0':$user->years_of_expirence;?>" />
						<?=form_error('yoe', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
					<fieldset class="m-b-30 col-sm-6">
						<legend class="font-14 m-b-00 no-border text-blue">English Proficiency :</legend>
						<?=form_dropdown('el', $englishLevels, $user->english_level, array(
								'class' => 'form-control no-padding',
								'style' => "box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;",
						));?>
						
						<?=form_error('el', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
				</div>
				<div class="col-sm-12">
					<fieldset class="m-b-30 col-sm-12 p-l-00">
						<legend class="font-14 m-b-00 no-border text-blue">Extra Notes (Accomplishments): : <span class="text-red bold">*</span></legend>
						<textarea class="form-control no-padding" 
							style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
							name="extra_notes" placeholder="enter extra details about yourself" ><?=($user->extra_notes !== NULL)?base64_decode($user->extra_notes):'None';?></textarea>
						<?=form_error('extra_notes', '<p class="text-red m-b-05 font-12">', '</p>');?>
					</fieldset>
				</div>
			</div>
			
			<div class="col-sm-12 padding-05 border-ash background-white-complete m-b-05">
				<h4 class="col-sm-12 m-b-20 text-blue">Supporting Documents</h4>
				<fieldset class="m-b-30 col-sm-12">
					<legend class="font-14 m-b-00 no-border text-blue">Documents : <span class="text-red bold">*</span></legend>
					<input type="file" class="form-control no-padding" id="file_upload" 
						style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;" 
						name="documents" placeholder="Select Documents to upload" />
				</fieldset>
				<fieldset class="m-b-30 col-sm-12">
					<legend class="font-14 m-b-10 no-border text-blue">Uploaded Documents :</legend>
					<div id="uploads">
						
							<table class="table table-stripped ">
								<?php $i=1; foreach ($user->documents as $document): ?>
								<tr>
									<td width="10%">
										<a href="<?=base_url('users/deleteDocument/'.$document->id);?>" class="">
											<i class="fa fa-minus-circle text-red deleteBtn" id="" ></i>
										</a>
									</td>
									<td width="70%">
										<a target="_blank" href="<?=base_url($document->url);?>">Document [<?=($i++);?>]</span>
									</td>
									<td width="" class="font-12">
										<?=date('dS, m Y ( h : i )', strtotime($document->date));?>
									</td>
								</tr>
								<?php endforeach; ?>
							</table>
						
					</div>
				</fieldset>
			</div>
			
			<div class="col-sm-12 padding-00 text-right">
				<input type="submit" class="btn btn-success btn-sm" value="save profile details" />
			</div>
			<?=form_close();?>
		</div>
	</div>
</div>
<script>
	
</script>