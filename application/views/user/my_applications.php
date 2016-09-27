		<div class="col-sm-9 p-r-00" ng-init="application.getMyApplications();">
			<div class="panel">
				<h4 class="panel-heading m-b-00 m-t-00">My Applications</h4>
				<div class="">
					<table class="table table-stripped table-responsive">
						<thead>
							<tr class="font-14">
								<td width="35%" class="p-l-15">School</td>
								<td width="35%">Course</td>
								<td width="15%">Status</td>
								<td width="15%">Date</td>
							</tr>
						</thead>
						<tbody>
							<tr class="font-12" dir-paginate="app in application.myApplications | itemsPerPage:50">
								<td class="p-l-15">
									<span ng-bind="app.school_name"></span>	
								</td>
								<td>
									<span ng-bind="app.course_name"></span>
								</td>
								<td>
									<code ng-bind="application.getStatus(app.app_status);"></code>
								</td>
								<td>
									<span ng-bind="app.app_submission | date: 'MMM dd, yyyy'"></span>
								</td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<dir-pagination-controls></dir-pagination-controls>
				</div>
			</div>	
		</div>
		
	</div>
</div>