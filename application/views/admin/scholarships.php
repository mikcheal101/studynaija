		<div class="col-sm-10 p-r-00 p-l-05" ng-init="loadScholarships ();">
			<div class="col-sm-4 m-b-05 p-l-00 p-r-05">
				<div class="panel m-b-05">
					<h5 class="panel-heading m-b-00 m-t-00 text-600">Scholarships 
						<span ng-class="['label', 'label-success', 'float-right']" ng-bind="scholarships.length"></span></h5>
					<div class="panel-body">
						<ul class="list-group">
							<li class="list-group-item flex" dir-paginate="n in scholarships | itemsPerPage: 15" ng-click="openScholarship (n);">
								<!-- <img ng-src="{{n.image}}" class="img-responsive img-rounded img-fluid" width="50px" /> -->
								<div class="p-t-05 p-l-10 xs-p-t-00">
									<h5 class="m-t-00 m-b-05 bold font-13" ng-click="setScholarship (n);">
										<p class="text-uppercase text-blue p-b-05" ng-bind="n.name"></p>
										<small ng-bind-html="n.details | htmlToPlaintextTruncate:200" 
											class="font-12 text-600 text-black p-t-10"></small>
									</h5>
								</div>
								<i class="fa fa-times text-red flex m-l-auto"></i>
							</li>
						</ul>
					</div>
					<div class="panel-footer text-center p-b-00 p-t-00">
						<dir-pagination-controls></dir-pagination-controls>
					</div>
				</div>
				
			</div>
			
			<div class="col-sm-8 m-b-05 p-r-00 p-l-05 ">
				<form name="form" novalidate>
					<div class="panel m-b-00">
						<h5 class="panel-heading m-b-00 m-t-00 text-600">
							<button type="submit" class="btn btn-info text-600 btn-sm" ng-click="commitScholarship (form);" >
								commit changes
							</button>
							<span class="btn btn-danger btn-sm text-600" ng-click="clearScholarship ();" >
								clear
							</span>
						</h5>
						<div class="panel-body">
							<div class="col-sm-12 input-box m-b-10">
								<label for="name" class="text-green">Scholarship Title:</label><br>
								<input class="font-13" required name="name" type="text" placeholder="enter the scholarship title" 
									ng-model="selectedScholarship.name" />
								<div ng-show="form.$submitted">
									<small class="text-red" ng-show="form.name.$error.required">enter a title!</small>
								</div>
							</div>
							<div class="col-sm-12 input-box m-b-10">
								<label for="address" class="text-green">Description:</label><br>
								<input class="font-13 summernote2" />
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>