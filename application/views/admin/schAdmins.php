		<div class="col-sm-10 p-r-00 p-l-05" ng-init="loadSchAdmins ();">
			<div class="col-sm-6 m-b-05 p-r-05 p-l-00 ">
				<div class="panel m-b-05">
					<h5 class="panel-heading m-b-00 m-t-00 text-600"></h5>
					<div class="panel-body">
						<div class="col-sm-12 input-box m-b-10">
							<label for="username" class="text-green">Profile Image:</label><br>
							<img />
						</div>
						<div class="col-sm-12 input-box m-b-10">
							<label for="username" class="text-green">Upload Image:</label><br>
							<input class="font-13" required name="passport" type="file" placeholder="select profile image" 
								ng-model="selectedSchAdmin.profile_image"  />
						</div>
						<div class="col-sm-12 input-box m-b-10">
							<label for="username" class="text-green">Username:</label><br>
							<input class="font-13" required name="username" type="text" placeholder="enter username" 
								ng-model="selectedSchAdmin.name" disciplinename />
							<small class="text-red" ng-show="form.username.$error.required">username name already exists!</small>
						</div>
						<div class="col-sm-12 input-box m-b-10">
							<label for="pwd" class="text-green">Password:</label><br>
							<input class="font-13" required name="username" type="text" placeholder="enter password" 
								ng-model="selectedSchAdmin.password_n" disciplinename />
							<small class="text-red" ng-show="form.username.$error.required">discipline name already exists!</small>
						</div>
						<div class="col-sm-12 input-box m-b-10">
							<label for="usertype" class="text-green">Usertype:</label><br>
							<select class="ngselect" 
								ng-options="option.name for option in schoolusertypes track by option.id"
								ng-model="selectedSchAdmin.usertype">
								<option selected value="">-- Select A Usertype --</option>
							</select>
							<small class="text-red" ng-show="form.username.$error.required">discipline name already exists!</small>
						</div>
						<div>
							<button type="submit" class="btn btn-sm text-600 btn-success">commit changes</button>
							<span class="btn btn-danger btn-sm text-600">clear</span>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-sm-6 m-b-05 p-l-05 p-r-00">
				<div class="panel m-b-05">
					<h5 class="panel-heading m-b-00 m-t-00 text-600">
						School Administrators 
						<span ng-class="['label', 'label-success', 'float-right']" ng-bind="schAdmins.length"></span>
					</h5>
					<div class="panel-body">
						<ul class="list-group">
							<li class="list-group-item flex" dir-paginate="n in schAdmins | itemsPerPage: 5">
								
								<img ng-src="{{n.profile_image}}" class="img-responsive img-rounded height-x-50" width="50px" />
								<div class="p-t-05 p-l-10 " ng-click="setSchAdmin (n);">
									<h5 class="m-t-00 m-b-05 hand" >
										<p class="text-info text-600 p-b-10" ng-bind="n.username"></p>
										<small class="font-12 text-600 text-ash text-capitalize" ng-bind="n.school.name"></small>
									</h5>
								</div>
								<span class="fa fa-times text-red m-l-auto m-t-20"></span>
							</li>
						</ul>
					</div>
					<div class="panel-footer text-center p-b-00 p-t-00">
						<dir-pagination-controls></dir-pagination-controls>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>