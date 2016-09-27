
		<div class="col-sm-10 p-r-00 p-l-05">
			<div class="col-sm-12 padding-00">
				<form name="form" method="POST" novalidate>
					<div class="panel m-b-05">
						<div class="panel-body">
							selectedDisciplineType
							<div class="col-sm-6 p-l-00 p-r-05">
								<div class="col-sm-12 input-box m-b-10">
									<label for="name" class="text-green">Name: <small class="text-ash-01">eg. Undergraduate, Masters</small></label><br>
									<input class="font-13" type="text" placeholder="enter the discipline" ng-model="selectedDiscipline.name" />
								</div>
							</div>
							<div class="col-sm-6 p-l-00 p-r-05">
								<div class="col-sm-12 input-box m-b-10">
									<label for="name" class="text-green">Abbreviation:</label><br>
									<input class="font-13" type="text" placeholder="enter the discipline" ng-model="selectedDiscipline.name" />
								</div>
							</div>

						</div>
						<div class="panel-footer m-b-00 p-b-00 m-t-00 p-t-00">
							<span class="btn btn-success btn-sm" ng-click="commitDisciplineType ();">commit changes</span>
						</div>
					</div>
				</form>
			</div>
			
			<div class="col-sm-12 padding-00" ng-init="loadDisciplineTypes ();">
				<div class="panel m-b-05">
					<div class="panel-body">
						<ul class="list-group">
							<li class="list-group-item text-600" ng-click="selectDisciplineType ($index);" ng-repeat="i in disciplineTypes track by i.id">
								<h4>
									<span ng-bind="i.name"></span>
									<small ng-bind="i.abbrv"></small>
								</h4>
							</li>
						</ul>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>