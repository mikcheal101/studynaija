
		<div class="col-sm-10 p-l-00 col-xs-12">
			
			<div class="col-sm-12 p-l-00 p-r-00">
				<div class="panel m-t-00 m-b-10">
					<div class="panel-body">
						<div class="col-sm-12 padding-00 m-b-10 p-b-10" style="border-bottom: 1px solid #FCFCFC;">
							<div class="col-sm-3 p-r-00">
								<label class="checkbox-inline text-blue"><input class="options" type="checkbox" ng-change="toogleAll();" ng-model="searchChecks.sos.value">Social Mgmt. Sciences</label>
							</div>
							<div class="col-sm-3">
								<label class="checkbox-inline text-blue"><input class="options" type="checkbox" ng-change="toogleAll();" ng-model="searchChecks.admin.value">Administration</label>
							</div>
							<div class="col-sm-3">
								<label class="checkbox-inline text-blue"><input class="options" type="checkbox" ng-change="toogleAll();" ng-model="searchChecks.agric.value">Agriculture</label>
							</div>
							<div class="col-sm-3">
								<label class="checkbox-inline text-blue"><input class="options" type="checkbox" ng-change="toogleAll();" ng-model="searchChecks.arts.value">Arts & Humanities</label>
							</div>
						</div>
						
						<div class="col-sm-12 padding-00 m-b-10 p-b-10" style="border-bottom: 1px solid #FCFCFC;">
							<div class="col-sm-3">
								<label class="checkbox-inline text-blue"><input class="options" type="checkbox" ng-change="toogleAll();" ng-model="searchChecks.edu.value">Education</label>
							</div>
							<div class="col-sm-3">
								<label class="checkbox-inline text-blue"><input class="options" type="checkbox" ng-change="toogleAll();" ng-model="searchChecks.sci.value">Sciences</label>
							</div>
							<div class="col-sm-3">
								<label class="checkbox-inline text-blue"><input class="options" type="checkbox" ng-change="toogleAll();" ng-model="searchChecks.law.value">Law</label>
							</div>
							<div class="col-sm-3">
								<label class="checkbox-inline text-blue"><input class="options" type="checkbox" ng-change="toogleAll();" ng-model="searchChecks.others.value">Others</label>
							</div>
						</div>
				
						<div class="col-sm-12 padding-00 m-b-10 p-b-10" style="border-bottom: 1px solid #FCFCFC;">
							<div class="col-sm-6">
								<label class="checkbox-inline text-blue"><input class="options" type="checkbox" ng-change="toogleAll();" ng-model="searchChecks.eng.value">Engineering, Enviroment & Technology</label>
							</div>
							<div class="col-sm-6">
								<label class="checkbox-inline text-blue"><input class="options" type="checkbox" ng-change="toogleAll();" ng-model="searchChecks.med.value">Medical, Pharmaceutical & Health Sciences</label>
							</div>
						</div>
						
						<div class="col-sm-12 padding-00">
							<div class="col-sm-3 col-sm-offset-3">
								<label class="checkbox-inline text-blue"><input class="options" type="checkbox" ng-click="checkAll();" ng-model="searchChecks.all.value">All</label>
							</div>
							<div class="col-sm-3">
								<label class="checkbox-inline text-blue"><input class="options" type="checkbox" ng-change="swapUnsorted();" ng-model="searchChecks.unsorted.value">Unsorted</label>
							</div>
							<div class="col-sm-3">
								<label class="checkbox-inline text-blue"><input class="options" type="checkbox" ng-change="swapSorted();" ng-model="searchChecks.sorted.value">My Programes</label>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-12 padding-00 ">
				<div class="panel">
				{{courses}}
					<table class="table table-responsive">
						<tr dir-paginate="course in courses | filter:search.searchBar | mySearchFilter:searchChecks | itemsPerPage: 10">
							<td width="40%">
								<h4 class="text-green m-t-05 m-b-00">Sample Name</h4>
							</td>
							<td width="" class="text-right">
								<select class="form-control select" id="select_{{$index}}" style="">
									<option value="{{faculty.id}}" ng-selected="(course.faculty === faculty.id)" 
										ng-repeat="faculty in faculties">{{faculty.name}}
									</option>
								</select>
							</td>
							<td width="15%" class="text-right">								
								<a ng-href="<?=base_url('school/discipline/');?>/{{course.id}}" 
									ng-class="['btn', 'btn-default', 'btn-sm', 'm-t-00']">
									View
								</a>
								<div ng-if="course.faculty !== null" ng-class="['btn', 'btn-primary', 'btn-sm', 'm-t-00']" 
									ng-click="updateDiscipline($event, course);" id="confirmBtn">
									Update
								</div>
								<div ng-show="course.faculty === null" ng-class="['btn', 'btn-success', 'btn-sm', 'm-t-00']" 
									ng-click="saveDiscipline($event, course);">
									Save
								</div>
							</td>
						</tr>
						
					</table>
					<dir-pagination-controls></dir-pagination-controls>
				</div>
				
			</div>
		</div>
	</div>
</div>
