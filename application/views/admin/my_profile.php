
	<form name="profileForm" novalidate>
		<div class="col-sm-2 p-l-05 p-r-05" ng-init="getProfileDetails ();">
			<div class="panel p-b-05">
				<img class="width-200x img-fluid img-responsive align-center" ngf-thumbnail="profile.profile_image"/>				
				<div class="panel-body p-l-05 p-r-05 p-b-05">
					<ul class="list-group">
						<li class="list-group-item">
							<h4 class="m-t-00 m-b-00 text-600">
								email: <br>
								<small ng-bind="profile.email"></small>
							</h4>
						</li>
						<li class="list-group-item">
							<h4 class="m-t-00 m-b-00 text-600">
								username: <br>
								<small ng-bind="profile.username"></small>
							</h4>
						</li>
						<li class="list-group-item text-center ">
							<span class="btn btn-info btn-sm text-600 text-wrap" 
								ngf-max-total-size="10MB" ngf-select="upload.getImage ($files);" 
								ng-model="profile.profile_image" accept="image/*">
								select profile Image
							</span>
							<input type="hidden" name="image" ng-model="profile.profile_image" required />
							<div ng-show="profileForm.$submitted">
								<p class="text-danger font-12" 
									ng-show="profileForm.image.$error.required || profileForm.image.$error.minlength < 3">
									Select A Passport Photo
								</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-sm-8 m-t-00 p-l-05 p-r-00">
			<div class="col-sm-12 padding-00">
				<div class="panel m-b-10">
					<div class="panel-body">
						<p class="lead text-600 p-b-10 font-14 text-ash-01">Click on the blue button on the left to change / select a passport photo</p>
						
						<div class="col-sm-12 input-box m-b-10">
							<label for="email" class="text-green">Email Address:</label><br>
							<input class="font-13" required type="email" placeholder="enter email" 
								autocomplete="false" name="email" ng-model="profile.email" checkemail />
							
							<p class="text-danger font-12" ng-show="profileForm.email.$pending.checkemail">
								verifying email...
							</p>
							
							<p class="text-danger font-12" ng-show="profileForm.email.$error.checkemail">
								This Email Address is taken!
							</p>
							
							<p class="text-danger font-12" ng-show="profileForm.email.$error.required || profileForm.email.$error.minlength < 3">
								Enter an email address
							</p>
							<p class="text-danger font-12" ng-show="profileForm.email.$error.email">
								Enter a valid email address
							</p>
						</div>
						
						<div class="col-sm-12 input-box m-b-10">
							<label for="username" class="text-green">Username:</label><br>
							<input class="font-13" required type="text" placeholder="enter username" 
								autocomplete="false" name="username" ng-model="profile.username" checkusername />
							
							<p class="text-danger font-12" ng-show="profileForm.username.$pending.checkusername">
								verifying username...
							</p>
							<p class="text-danger font-12" ng-show="profileForm.username.$error.checkusername">
								This Username is taken!
							</p>
							
							<p class="text-danger font-12" ng-show="profileForm.username.$error.required || profileForm.username.$error.minlength < 8">
								Enter a username
							</p>
						</div>
						<div class="col-sm-12 input-box m-b-10">
							<label for="password" class="text-green">Password:</label><br>
							<input class="font-13" type="password" placeholder="enter password" name="password" 
								ng-model="profile.newpassword" />
						</div>
					</div>
					<div class="panel-footer text-right">
						<button type="submit" class="btn btn-sm btn-success text-600 " ng-click="upload.makeChanges (profileForm);">
							make changes
						</span>
					</div>
				</div>
				
			</div>
			
			<div class="col-sm-12 padding-00">
				<div class="panel">
					<h5 class="panel-heading m-b-00 m-t-00 text-600 text-lowercase">Activity Log</h5>
					<div class="panel-body">
						<table class="table font-12 text-600 table-responsive">
							<tr>
								<td class="text-info">
									Logged In
								</td>
								<td width="20%" class="text-right text-success">
									2 June, 2016 12: 45 pm 
								</td>
							</tr>
						</table>
					</div>
				</div>
				
			</div>
			
		</div>
		<?=form_close ();?>>
	</div>
</div>