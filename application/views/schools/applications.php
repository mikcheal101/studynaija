
		<div class="col-sm-10 p-l-00 col-xs-12">
			<div class="col-sm-12 padding-00" ng-init="application.loadApplications();">
				
				<div class="col-sm-12 padding-00">
					<div class="panel m-t-00 m-b-05 p-t-00 p-b-00">
						<div class="panel-body">
							<div class="col-sm-12 padding-00 font-12">
								
								<div class="col-sm-4 font-14 p-l-00" >
									<button class="btn btn-default btn-sm btn-orange" data-toggle="modal" data-target="#saveModal">Create An Application</button>
								</div>
								
								<div class="text-right col-sm-4" style="padding-top:5px;">
									<input type="checkbox" name="pending" id="pending" class="" />
									<span class="m-r-10">Pending</span>
								
									<input type="checkbox" name="confirmed" id="confirmed" class="m-l-10" />
									<span class="">Approved / Confirmed</span>
								</div>
							
								<div class=" col-sm-4 p-r-00">
									<select class="form-control input-sm" name="asc_desc">
										<option value="">Order Ascending</option>
										<option value="">Order Descending</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			
				<div class="col-sm-12 padding-00">
					<div class="panel m-t-05 m-b-05 p-t-00 p-b-00">
						<div class="panel-body">
							<table class="table-stripped table table-responsive m-b-00">
								<thead>
									<th width="" class="text-left text-blue font-12">Session / Season</th>
									<th width="" class="text-right text-blue font-12">Application Deadline</th>
									<th width="15%" class="text-blue font-12 text-right">Courses Count</th>
									<th width="15%" class="text-blue font-12 text-right">Applications Count</th>
									<th width="5%" class="text-blue font-12 text-right"><i class="fa fa-cogs"></i></th>
								</thead>
								<tbody class="font-13">
									<tr dir-paginate="item in application.applications | itemsPerPage: 5" >
										<td class="text-left" ng-click="application.editApplication(application);">{{item.name}}</td>
										<td class="text-right">{{item.deadline | date: 'MMM dd, yyyy'}}</td>
										<td class="text-right">{{item.discipline.length}}</td>
										<td class="text-right">{{item.counter}}</td>
										<td class="text-right">
											<i class="btn btn-xs fa text-green fa-pencil" ng-click="application.editApplication(item)"></i>
										</td>
									</tr>
								</tbody>
								<tfoot> <dir-pagination-controls></dir-pagination-controls></tfoot>
							</table>
						</div>
					</div>
				</div>
				<form name="myForm">
				
					<div class="col-sm-12 padding-00" ng-show="application.editing" >
						<div class="panel m-t-05 m-b-05 p-t-00 p-b-00">
							<div class="panel-body p-b-00">
								<div class="col-sm-4 p-r-05 p-l-00 p-b-00">
									<div class="col-sm-12  input-box m-b-10">
										<label for="name" class="text-blue">Application Name : <span class="text-red bold">*</span></label><br>
										<input class="font-13" type="text" placeholder="enter application name" ng-model="application.editingItem.name" name="name" />
									</div>
								</div>
								
								<div class="col-sm-4 p-l-00 p-r-00 p-b-00">
									<div class="col-sm-12 input-box m-b-10">
										<label for="name" class="text-blue">Application Deadline : <span class="text-red bold">*</span></label><br>
										<input class="font-13" type="date" placeholder="select deadline" name="date" 
											ng-model="application.editingItem.deadline" min="<?=date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')+1, date('Y') ));?>" />
									</div>
								</div>
								
								<div class="col-sm-4 p-r-00 p-l-05 p-b-00">
									<div class="col-sm-12 input-box m-b-10">
										<label for="name" class="text-blue">Resumption Month : <span class="text-red bold">*</span></label><br>
										<input class="font-13" type="month" name="month" min="<?=date('Y-m', mktime(0, 0, 0, date('m')+1, date('d')+1, date('Y') ));?>" 
											placeholder="enter application deadline" ng-model="application.editingItem.resumption" />
									</div>
								</div>
									
							</div>
						</div>
					</div>
					
					<div class="col-sm-12 padding-00" ng-show="application.editing" >
						<div class="panel m-t-05 m-b-05 p-t-00 p-b-00">
							<div class="panel-body p-b-00">
							
								<div class="col-sm-12 ">
									<fieldset class="m-b-10 col-sm-12 p-l-00 p-r-00">
										<div class="col-sm-12 padding-00 m-t-00">
											<div class="input-group" >
												<input type="search" class="form-control no-padding" style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;"
													name="search" ng-model="application.disciplines.search" placeholder="search program"/>
												<span class="input-group-addon" style="background-color: transparent!important; border-top: 0px!important; border-right: 0px!important; border-radius:0px!important;" ><i class="glyphicon glyphicon-search"></i></span>
											</div>
										</div>
										<div class="col-sm-12 padding-00 m-t-10">
											<div class="col-sm-6 p-l-00 p-b-05 m-b-05" style="border-bottom: 1px solid #FCFCFC;" dir-paginate="course in application.editingItem.discipline | filter:application.disciplines.search | itemsPerPage: 10">
												<div class="checkbox">
													<label>
														<input type="checkbox" ng-model="course.checked" ng-true-value="'true'" ng-false-value="'false'" />
														<span>{{course.discipline_name}}</span>
													</label>
												</div>
											</div>
											<dir-pagination-controls></dir-pagination-controls>
										</div>
										<!-- <p class="text-red m-b-05 font-12">error part</p> -->
									</fieldset>
								</div>
							</div>
							<div class="panel-footer text-right">
								<div class="btn btn-danger btn-sm" ng-click="application.deleteApplication();">Delete Application</div>
								<div class="btn btn-info btn-sm" ng-click="application.updateApplication();">Update Changes</div>
							</div>
						</div>
					</div>
				</form>
				
				<!-- loop here -->
				<div class="col-sm-12 padding-00 m-t-05" dir-paginate="items in application.applicants | itemsPerPage: 20">
					<div class="col-sm-6 padding-00 p-r-05" ng-if="applicant.position === 0" ng-repeat="applciant in items">
						<div class="col-sm-12 border-ash background-white-complete text-center p-l-00 p-r-00">
							<a href="http://[::1]/ngschools/">
								<div class="padding-00 text-left col-sm-3">
									<img style="max-height: 200px;height: 85px;" ng-src="{{applicant.image}}" alt="{{applicant.firstname}} {{applicant.lastname}}">
								</div>
								<div class="col-sm-9 text-right">
									<h4 class="text-purple m-t-15 m-b-00">{{applicant.firstname}} {{applicant.lastname}}</h4>
									<p class="text-green p-t-05 p-b-00 m-b-00">{{applicant.course_applied}}</p>
									<p class="p-t-05 p-b-00">{{applicant.semester}} [{{applicant.delivery_mode_name}}]</p>	
								</div>
							</a>
						</div>
					</div>
				</div>
				<dir-pagination-controls></dir-pagination-controls>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="saveModal" tabindex="-1" role="dialog" ng-init="application.loadDisciplines()">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Create An Application</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid no-border">
					<form name="applicationForm">
						<div class="row">
							<div class="col-sm-12">
								
								<fieldset class="m-b-10 col-sm-6 p-l-00 p-r-05">
									<legend class="font-14 m-b-00 no-border text-blue" for="name">Application Name : <span class="text-red bold">*</span></legend>
									<input type="text" class="form-control no-padding" ng-model="application.name" 
									style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;"
										name="name" ng-required="true" placeholder="enter application name eg 2016 / 2017 summer admission" value="" />
									<!-- <p class="text-red m-b-05 font-12">error part</p> -->
								</fieldset>
							
								<fieldset class="m-b-10 col-sm-3 p-l-10 p-r-10">
									<legend class="font-14 m-b-00 no-border text-blue">Application Deadline: <span class="text-red bold">*</span></legend>
									<div class="input-group" >
										<input  ng-required="true" type="date" class="form-control no-padding" ng-model="application.deadline" 
											style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;"
											name="date" min="<?=date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')+1, date('Y') ));?>" placeholder="enter application deadline" value="<?=date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')+1, date('Y') ));?>" />
										<span class="input-group-addon" style="background-color: transparent!important; border-top: 0px!important; border-right: 0px!important; border-radius:0px!important;" ><i class="glyphicon glyphicon-calendar"></i></span>
									</div>
									<!-- <p class="text-red m-b-05 font-12">error part</p> -->
								</fieldset>
								
								<fieldset class="m-b-10 col-sm-3 p-l-05 p-r-00">
									<legend class="font-14 m-b-00 no-border text-blue" for="name">Resumption Month : <span class="text-red bold">*</span></legend>
									<div class="input-group" >
										<input ng-required="true" type="month" class="form-control no-padding" ng-model="application.resumption" 
											style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;"
											name="date" min="<?=date('Y-m', mktime(0, 0, 0, date('m')+1, date('d')+1, date('Y') ));?>" placeholder="enter application deadline" value="" />
										<span class="input-group-addon" style="background-color: transparent!important; border-top: 0px!important; border-right: 0px!important; border-radius:0px!important;" ><i class="fa fa-calendar-check-o"></i></span>
									</div>
									<!-- <p class="text-red m-b-05 font-12">error part</p> -->
								</fieldset>
								
							</div>
							
							<div class="col-sm-12">
								<fieldset class="m-b-10 col-sm-12 p-l-00 p-r-00">
									<legend class="font-14 m-b-00 no-border text-blue" for="name">Disciplines : <span class="text-red bold">*</span></legend>
									<div class="col-sm-12 padding-00 m-t-15">
										<div class="input-group" >
											<input type="search" class="form-control no-padding" style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;"
												name="search" ng-model="application.search" placeholder="search program"/>
											<span class="input-group-addon" style="background-color: transparent!important; border-top: 0px!important; border-right: 0px!important; border-radius:0px!important;" ><i class="glyphicon glyphicon-search"></i></span>
										</div>
									</div>
									<div class="col-sm-12 padding-00 m-t-10">
										<div class="col-sm-6 p-l-00 p-b-05 m-b-05" style="border-bottom: 1px solid #FCFCFC;" dir-paginate="course in application.disciplines | filter:application.search | itemsPerPage: 10">
											<div class="checkbox">
												<label>
													<input type="checkbox" value="{{course.id}}" ng-model="course.checked" />
													<span>{{course.discipline_name}}</span>		
												</label>
											</div>
										</div>
										<dir-pagination-controls></dir-pagination-controls>
									</div>
									<!-- <p class="text-red m-b-05 font-12">error part</p> -->
								</fieldset>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success btn-sm" ng-click="application.saveApplication();" ng-disabled="applicationForm.$invalid" >Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Update An Application</h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid no-border">
					<form name="applicationUpdateForm">
						<div class="row">
							<div class="col-sm-12">
								
								<fieldset class="m-b-10 col-sm-6 p-l-00 p-r-05">
									<legend class="font-14 m-b-00 no-border text-blue" for="name">Application Name : <span class="text-red bold">*</span></legend>
									<input type="text" class="form-control no-padding" ng-model="application.update.name" 
									style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;"
										name="name" ng-required="true" placeholder="enter application name eg 2016 / 2017 summer admission" value="" />
									<!-- <p class="text-red m-b-05 font-12">error part</p> -->
								</fieldset>
							
								<fieldset class="m-b-10 col-sm-3 p-l-10 p-r-10">
									<legend class="font-14 m-b-00 no-border text-blue">Application Deadline: <span class="text-red bold">*</span></legend>
									<div class="input-group" >
										<input  ng-required="true" type="date" class="form-control no-padding" ng-model="application.update.deadline" 
											style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;"
											name="date" min="<?=date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')+1, date('Y') ));?>" placeholder="enter application deadline" value="<?=date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')+1, date('Y') ));?>" />
										<span class="input-group-addon" style="background-color: transparent!important; border-top: 0px!important; border-right: 0px!important; border-radius:0px!important;" ><i class="glyphicon glyphicon-calendar"></i></span>
									</div>
									<!-- <p class="text-red m-b-05 font-12">error part</p> -->
								</fieldset>
								
								<fieldset class="m-b-10 col-sm-3 p-l-05 p-r-00">
									<legend class="font-14 m-b-00 no-border text-blue" for="name">Resumption Month : <span class="text-red bold">*</span></legend>
									<div class="input-group" >
										<input ng-required="true" type="month" class="form-control no-padding" ng-model="application.update.resumption" 
											style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;"
											name="date" min="<?=date('Y-m', mktime(0, 0, 0, date('m')+1, date('d')+1, date('Y') ));?>" placeholder="enter application deadline" value="" />
										<span class="input-group-addon" style="background-color: transparent!important; border-top: 0px!important; border-right: 0px!important; border-radius:0px!important;" ><i class="fa fa-calendar-check-o"></i></span>
									</div>
									<!-- <p class="text-red m-b-05 font-12">error part</p> -->
								</fieldset>
								
							</div>
							
							<div class="col-sm-12">
								<fieldset class="m-b-10 col-sm-12 p-l-00 p-r-00">
									<legend class="font-14 m-b-00 no-border text-blue" for="name">Disciplines : <span class="text-red bold">*</span></legend>
									<div class="col-sm-12 padding-00 m-t-15">
										<div class="input-group" >
											<input type="search" class="form-control no-padding" style="box-shadow: none; border-radius: 0px; border-bottom: 1px solid #dedede; border-top:0; border-left:0; border-right:0;"
												name="search" ng-model="application.search" placeholder="search program"/>
											<span class="input-group-addon" style="background-color: transparent!important; border-top: 0px!important; border-right: 0px!important; border-radius:0px!important;" ><i class="glyphicon glyphicon-search"></i></span>
										</div>
									</div>
									<div class="col-sm-12 padding-00 m-t-10">
										<div class="col-sm-6 p-l-00 p-b-05 m-b-05" style="border-bottom: 1px solid #FCFCFC;" dir-paginate="course in application.update.disciplines | filter:application.search | itemsPerPage: 10">
											<div class="checkbox">
												<label>
													<input type="checkbox" value="{{course.id}}" ng-model="course.checked" />
													<span>{{course.discipline_name}}</span>		
												</label>
											</div>
										</div>
										<dir-pagination-controls></dir-pagination-controls>
									</div>
									<!-- <p class="text-red m-b-05 font-12">error part</p> -->
								</fieldset>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success btn-sm" ng-click="application.update.updateApplication();" ng-disabled="applicationUpdateForm.$invalid" >Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

