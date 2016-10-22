		<div class="col-sm-10 p-r-00 p-l-05" ng-init="init ();">
			
			<div class="col-sm-6 p-l-00 p-r-05">
				<div class="panel m-b-10">
					<div class="panel-body">
						<style>
							span > ul.pagination { margin-top: -10px!important; margin-bottom: 5px!important;}
						</style>
						<div class="col-sm-12 input-box m-b-00">
							<label for="name" class="text-green m-b-10 col-sm-12 no-padding">
								Discipline(s):
								<input type="search" ng-model="dSearch" class="text-600 font-12 text-black p-l-05 p-r-05" placeholder="enter discipline to search for..." />
							</label>
						</div>
						<div class="col-sm-12 no-padding">
						<style>
							.no-border-top {
								border-top: 0px!important;
							}
						</style>
							<table class="table table-responsive table-fluid font-12 text-600 m-b-00 table-condensed">
								<tr dir-paginate="d in disciplines | filter: dSearch | itemsPerPage: 10" pagination-id = 'searchDiscipline'>
									<td ng-class="{'no-border-top': $index===0}">
										<div class="radio m-b-00 m-t-05">
											<label class="text-600">
												<input type="radio" ng-value="{{d}}" name="discipline" ng-model="assign.selectedDiscipline" />
												<p ng-bind="d.name"></p>
											</label>
										</div>
									</td>
								</tr>
							</table>
							<dir-pagination-controls pagination-id='searchDiscipline'></dir-pagination-controls>
						</div>
						
					</div>
				</div>
			</div>
			
			<div class="col-sm-6 p-l-05 p-r-00">
				<div class="panel m-b-10">
					<div class="panel-body">
						<div class="col-sm-12 input-box m-b-00">
							<label for="name" class="text-green m-b-10 col-sm-12 no-padding">
								Instituition(s):
								<input type="search" ng-model="iSearch" class="text-600 font-12 text-black p-l-05 p-r-05" placeholder="enter instituition to search for..." />
							</label>
						</div>
						<div class="col-sm-12 no-padding">
							<table class="table table-responsive table-fluid font-12 text-600 m-b-00 table-condensed">
								<tr dir-paginate="inst in instituitions | filter: iSearch | itemsPerPage: 10" pagination-id = 'displayInstituitions' >
									<td>
										<div class="checkbox p-b-00 p-t-00">
											<label class="text-600">
												<input type="checkbox" checklist-model="config.insts" checklist-value="inst" />
												<p ng-bind="inst.name" ng-class="['text-capitalize']"></p>
											</label>
										</div>
									</td>
								</tr>
							</table>
							<dir-pagination-controls pagination-id='displayInstituitions'></dir-pagination-controls>
						</div>
						
						
					</div>
				</div>
			</div>
			
			<div class="col-sm-12 padding-00">
				<div class="panel">
					<div class="panel-body">
						<div class="col-sm-12 padding-00 text-right btns-family">
							<span ng-class="['btn', 'btn-sm', 'btn-success']" ng-click="discipline_makeChanges ();" >make changes</span>
							<span ng-class="['btn', 'btn-sm', 'btn-default']" ng-click="clear_discipline ();" >clear</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>