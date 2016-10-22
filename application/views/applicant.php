<div class="container">
	<div class="row">
		<div class="col-sm-12 m-t-05 padding-00">
			<div class="col-sm-3 p-l-00 p-r-05">
				
				<div class="col-sm-12 border-ash background-white-complete text-center padding-00">
					<img class="img-responsive img-fluid" style="position: relative;width: 100%;margin: 0px auto;" src="http://placekitten.com/300/300" />
				</div>
				
				<div class="col-sm-12 border-ash background-white-complete m-t-05">
					<h4 class="text-green m-t-10 m-b-10">Documents</h4>
					<ul style="list-style: none!important;" class="p-l-00">
						<li style="border-bottom: 1px solid #F9F9F9;" class="p-l-05 p-b-05 p-t-05">
							<i class="fa fa-history text-purple"> </i> &nbsp; &nbsp;
							<a href="<?=base_url('#');?>" class="m-b-10">Curriculum Vitea </a>	
						</li>
						<li style="border-bottom: 1px solid #F9F9F9;" class="p-l-05 p-b-05 p-t-05">
							<i class="fa fa-plus text-purple"> </i> &nbsp; &nbsp;
							<a href="<?=base_url('#');?>" class="m-b-10">Other Documents </a>	
						</li>
						
					</ul>
				</div>
				
				<div class="col-sm-12">
					<!-- ads -->
				</div>
			</div>
			
			<div class="col-sm-9 padding-00">
				<div class="col-sm-12 border-ash background-white-complete m-b-05 padding-05">
					<h3 class="text-green m-b-00 m-t-00"><?="Samuel L Jackson";?></h3>
				</div>
				
				<div class="col-sm-12 border-ash background-white-complete m-b-05 p-t-10 p-b-10">
					<h4 class="m-b-10 m-t-10 text-green">Personal Information</h4>
					
					<fieldset class="m-b-10">
						<legend class="font-14 m-b-00 only-bottom-border text-blue">Full Name :</legend>
						<p class="text-right">
							<?="James Samuel Samson";?>
						</p>
					</fieldset>
					
					<fieldset class="m-b-10">
						<legend class="font-14 m-b-00 only-bottom-border text-blue">Email Address :</legend>
						<p class="text-right">
							<a href="mailto:<?="sample@mail.com";?>"><?="sample@mail.com";?></a>
						</p>
					</fieldset>
					
					<fieldset class="m-b-10">
						<legend class="font-14 m-b-00 only-bottom-border text-blue">Gender :</legend>
						<p class="text-right">
							<?="Male";?>
						</p>
					</fieldset>
					
					<fieldset class="m-b-10">
						<legend class="font-14 m-b-00 only-bottom-border text-blue">Date of Birth :</legend>
						<p class="text-right">
							<?="19 / 03 / 1984";?>
						</p>
					</fieldset>
					
					<fieldset class="m-b-10">
						<legend class="font-14 m-b-00 only-bottom-border text-blue">Nationality :</legend>
						<p class="text-right">
							<?="Nigerian";?>
						</p>
					</fieldset>
					
					<fieldset class="m-b-10">
						<legend class="font-14 m-b-00 only-bottom-border text-blue">Tel Number :</legend>
						<p class="text-right">
							<?="09020464737";?>
						</p>
					</fieldset>
					
					<fieldset class="m-b-00">
						<legend class="font-14 m-b-00 only-bottom-border text-blue">Country of residence :</legend>
						<p class="text-right">
							<?="Nigeria";?>
						</p>
					</fieldset>
				</div>
				
				<div class="col-sm-12 border-ash background-white-complete m-b-05 p-t-10 p-b-10">
					<h4 class="text-green m-t-00 m-b-10">Interests</h4>
					
					<fieldset class="m-b-10">
						<legend class="font-14 m-b-00 only-bottom-border text-blue">Starting Period (Semester):</legend>
						<p class="text-right">
							<?="First";?>
						</p>
					</fieldset>
					
					<fieldset class="m-b-00">
						<legend class="font-14 m-b-00 only-bottom-border text-blue">Mode of funding (Tuition, Feeding, Accomodation, etc..):</legend>
						<p class="text-right">
							<?="Scholarship";?>
						</p>
					</fieldset>
				</div>
				
				<div class="col-sm-12 border-ash background-white-complete m-b-05 p-t-10 p-b-10">
					<h4 class="text-green m-t-00 m-b-10">Educational Background:</h4>
					
					<fieldset class="m-b-10">
						<legend class="font-14 m-b-00 only-bottom-border text-blue">Highest Obtained Qualification:</legend>
						<p class="text-right">
							<?="SSCE";?>
						</p>
					</fieldset>
					
					<fieldset class="m-b-10">
						<legend class="font-14 m-b-00 only-bottom-border text-blue">Country of Study?:</legend>
						<p class="text-right">
							<?="Ghana";?>
						</p>
					</fieldset>
					
					<fieldset class="m-b-10">
						<legend class="font-14 m-b-00 only-bottom-border text-blue">Years of Work Expirence:</legend>
						<p class="text-right">
							<?="2 Years";?>
						</p>
					</fieldset>
					
					<fieldset class="m-b-10">
						<legend class="font-14 m-b-00 only-bottom-border text-blue">English Proficiency:</legend>
						<p class="text-right">
							<?="Learner";?>
						</p>
					</fieldset>
					
					<fieldset class="m-b-00">
						<legend class="font-14 m-b-00 only-bottom-border text-blue">Extra Notes (Accomplishments):</legend>
						<p class="text-justify">
							<?="Nothing";?>
						</p>
					</fieldset>
				</div>
				
				<?php if ($msg_usr === "school"):?>
				<div class="col-sm-12 border-ash background-white-complete m-b-05 p-t-10 p-b-10">
					<span class="font-14 m-r-20">Application Status:</span>
					<span class="font-12 m-l-10"><input type="radio" name="application_status" id="status" value="0" /> Approved</span>
					<span class="font-12 m-l-10"><input type="radio" checked="checked" name="application_status" id="status" value="0" /> Ungoing</span>
					<span class="font-12 m-l-10"><input type="radio" name="application_status" id="status" value="0" /> Declined</span>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>