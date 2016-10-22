		<div class="col-sm-10 p-r-00 p-l-05" ng-app="test" ng-controller="ts" ng-init="init ();">
			
			<div class="col-sm-12 padding-00">
				<div class="panel panel-info m-b-10">
					<div class="panel-body">
					{{disciplineDisplay}}
					</div>
				</div>
			</div>
			
			<div class="col-sm-12 padding-00">
				<div class="panel panel-info m-b-10">
					<div class="panel-body">
					{{disciplineDisplay.course.schools}}
					</div>
				</div>
			</div>
			
			<div class="col-sm-12 padding-00">
				<div class="panel m-b-10">
					<div class="panel-body">
						<div ng-class="['col-sm-3']" ng-repeat="c in courses">
							<input type="radio" name="lemons" ng-value="c" ng-model="disciplineDisplay.course"  />
							<p ng-bind="c.name"></p>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-sm-12 padding-00">
				<div class="panel panel-danger m-b-10">
					<div class="panel-body">
						<div ng-class="['col-sm-3']" ng-repeat="s in schools track by $index">
							<input type="checkbox" name="schools" checklist-model="disciplineDisplay.course.schools" checklist-value="s" />
							<p ng-bind="s.name"></p>
						</div>
						
					</div>
				</div>
			</div>
			
			<div class="col-sm-12 padding-00">
				<div class="panel m-b-10">
					<div class="panel-body">
						{{formData}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>