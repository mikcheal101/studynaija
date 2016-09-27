<div class="container p-t-05 p-b-00 p-l-00 p-r-00" ng-init="schools.loadSchools();">
	<!-- repeat n/4 times -->
	<div class="row m-b-00" dir-paginate="item in schools.schools | itemsPerPage:50">
		
		<div class="col-sm-12 padding-00 p-l-10 p-r-05">
			<!-- repeat 4 times -->
			<a href="<?=base_url('users/searchResults?school={{school.name}}');?>" ng-class="{'col-sm-3':normal, 'col-sm-3 p-l-05':left , 'col-sm-3 p-r-05':right}" ng-repeat="school in item track by $index" ng-init="(left = ($index === 0)); (right = ($index==3)); (normal = ($index > 0 && $index < 3))" >
				<div class="panel panel-default bootcards-media">
					<div class="panel-heading" style="background-color: #FFF;">
				    	<h3 class="panel-title text-center" ng-bind="school.name"></h3>
				  	</div>
				  	<img ng-src="<?=base_url();?>/{{school.logo}}" class="img-responsive padding-20" ng-style="{'height': '100px', 'display':'block', 'margin-left':'auto', 'margin-right':'auto'}"/>
				</div>
			</a>

			<!-- /repeat 4 times -->
		</div>
		<!-- pagination -->
		<dir-pagination-controls></dir-pagination-controls>
	</div>
	<!-- /repeat n/4 times -->
	
	
</div>


