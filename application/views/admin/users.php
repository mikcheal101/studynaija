		<div class="col-sm-10 p-r-00 p-l-05" data-ng-init="loadUsers ();">
			<div class="col-sm-4 m-b-05 p-l-00 p-r-05">
				<div class="panel m-b-05">
					<h5 class="panel-heading m-b-00 m-t-00 text-600">
						Applicants 
						<span ng-class="['label', 'label-success', 'float-right']" ng-bind="users.length"></span>
					</h5>
					<div class="panel-body">
						<ul class="list-group">
							<li class="list-group-item flex" dir-paginate="n in users | itemsPerPage: 5">
								<img ng-src="{{n.profile_image}}" class="img-responsive img-rounded img-fluid" width="50px" />
								<div class="p-t-05 p-l-10 ">
									<h5 class="m-t-00 m-b-05 text-600 text-black" ng-bind="n.fullname"></h5>
									<div class="font-12 text-ash-01" ng-bind="n.email"></div>
								</div>
							</li>
						</ul>
					</div>
					<div class="panel-footer text-center p-b-00 p-t-00">
						<dir-pagination-controls></dir-pagination-controls>
					</div>
				</div>
				
			</div>
			
			<div class="col-sm-8 m-b-05 p-r-00 p-l-05 ">
				<div class="panel m-b-05">
					<h5 class="panel-heading m-b-00 m-t-00 text-600"></h5>
					<div class="panel-body">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>