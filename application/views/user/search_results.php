		<div class="col-md-9 p-l-05">
			<div class="row m-l-00 m-t-05 p-t-05 p-b-05 p-r-05 p-l-05" style="border: 1px solid #DEDEDE; background-color: #FBFBFB;">
				
				<div class="col-md-12 p-l-00 p-r-00">
					<div class="col-md-8 p-l-05 p-r-05">
						<p class="m-b-00 m-t-10"><strong class="text-green" ng-bind="courses.length | number"></strong> results found</p>
					</div>
					
					<div class="col-md-4 text-right">
						<select class="selectpicker" id="search_select" 
							ng-model="search.search_order.selected" 
							ng-options="option.name for option in search.search_order.options track by option.value"></select>
					</div>
				</div>
			</div>
			
			
			
			<div class="row m-l-00 m-t-05 p-t-05 p-b-10 p-r-05 p-l-05 background-white-complete border-ash ash_hover" dir-paginate="course in courses = (search.courses | itemsPerPage:10 | mySearchFilter:search | filter: search.searchBar | orderBy: 'course_name': search.search_order.selected.value)">
				<div class="col-md-12 p-b-10 m-t-10 m-b-10">
					<h4 class="m-b-00 m-t-05" ng-bind="course.course_name"></h4>
					<small class="text-blue font-14" ng-bind="course.school_name"></small>
				</div>
				<div class="col-md-12 text-purple font-14 bold">
					<div class="col-sm-3 p-l-00 text-left">
						<span ng-bind="course.local | currency:'<?=NGN;?>   '"></span> (Local)
					</div>
					<div class="col-sm-3 p-l-00 text-left">
						<span ng-bind="course.intl | currency:'USD$   '"></span> (International)
					</div>
					<div class="col-sm-2 p-l-00 text-left">
						<i class="fa fa-clock-o"></i>
						<span ng-bind="course.duration"></span>
					</div>
					<div class="col-sm-2 p-l-00">
						<i class="fa fa-home"></i>
						<span ng-repeat="variant in course.variant_name track by $index">{{variant.name}}{{$last ? '':', '}}</span>
					</div>
				</div>
				<div class="col-md-12 p-t-20">
					<div class="col-sm-2 height-x-100" ng-style="{'background-repeat':'no-repeat', 'background-size':'contain', 'background-position':'center', 'background-image':'url({{course.school_logo}})', 'border-radius': '2px'}"></div>
					<div class="col-sm-10">
						<div class="font-13 col-sm-12 text-justify p-b-10">
							<span ng-bind-html="course.content"></span>
							<span ng-bind-html="course.description"></span>
						</div>
						<div class="col-sm-12 text-right">
							<a class="btn btn-success btn-sm right"  href="<?=base_url('users/discipline/');?>/{{course.id}}">read more..</a>
						</div>
						
					</div>
				</div>
				
			</div>
			<!-- pagination -->
			<dir-pagination-controls></dir-pagination-controls>
			
		</div>
	</div>
</div>