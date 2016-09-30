
		<div class="col-sm-10 p-r-00 p-l-05" ng-init="loadDisciplines ();">
			<div class="col-sm-6 p-l-00 p-r-05">
				<form name="form" novalidate>
					<div class="panel m-b-05">
						<div class="panel-body">
							<div class="col-sm-12 input-box m-b-10">
								<label for="name" class="text-green">Discipline Name:</label><br>
								<input class="font-13" required name="name" type="text" placeholder="enter the discipline" 
									ng-model="selectedDiscipline.name" disciplinename />
								<small class="text-red" ng-show="form.name.$error.disciplinename">discipline name already exists!</small>
							</div>
							<div class="col-sm-12 input-box m-b-10">
								<label for="type" class="text-green">Discipline Type:</label><br>
								<select class="form-control ngselect text-600" ng-model="selectedDiscipline.type_brand"
									ng-options="option.name for option in disciplineTypes track by option.id">
									<option value="" disabled selected>Select Discipline type</option>
								</select>
							</div>
							<div class="col-sm-12 input-box m-b-10">
								<label for="faculty" class="text-green">Discipline Faculty:</label><br>
								<select class="form-control ngselect text-600" ng-model="selectedDiscipline.faculty"
									ng-options="option.name for option in faculties track by option.id">
									<option value="" disabled selected>Select Faculty</option>
								</select>
							</div>
							
							<div class="col-sm-12 p-l-00 p-r-05 p-b-10 text-right btns-family text-600">
								<button ng-class="['btn', 'btn-sm', 'btn-success', 'text-600']" type="submit" ng-click="discipline_makeChanges (form);" >
									make changes
								</button>
								<span ng-class="['btn', 'btn-sm', 'btn-default', 'text-600']" ng-click="clear_discipline ();" >clear</span>
							</div>
						</div>
					</div>
				</form>
			</div>
			
			<div class="col-sm-6 p-l-05 p-r-00">
				<div class="panel m-t-00">
					<div class="panel-heading text-ash-01 text-right p-b-10 flex">
						<input type="search" ng-model="search_discipline" class="form-control no-shadow no-radius text-600 text-black" />
						<i class="btn fa fa-download"></i>
						<i class="btn fa fa-upload" data-toggle="modal" data-target="#upload"></i>
						<i class="btn fa fa-print"></i>
						<div class="clearfix"></div>
					</div>
					<div class="panel-body p-b-00 p-t-00">
						<table class="table table-list table-responsive m-b-00">
							<thead>
								<td width="90%" class="text-600 text-left">Name</td>
								<td width="10%" class="text-right"><i class="fa fa-cog"></i></td>
							</thead>
							<tbody>
								<tr dir-paginate="discipline in disciplines | filter:search_discipline | itemsPerPage:15 ">
									<td class="font-12 text-600 text-left">
										<h5 class="hand text-600 m-t-00 m-b-00" ng-click="setDiscipline (discipline);">
											<p ng-bind="discipline.name" class="p-b-05" ></p>
											<p ng-bind="discipline.faculty.name" class="font-12 text-600 text-blue p-t-05" 
												ng-show="discipline.faculty.name.length > 0"></p>
											<p ng-bind="discipline.type_brand.name" class="font-12 text-600 p-t-05"></p>
										</h5>
									</td>
									<td class="font-12 text-right">
										<i class="fa fa-times text-red" ng-click="deleteDiscipline($index, discipline);"></i>
									</td>
								</tr>
								
							</tbody>
						</table>
						<dir-pagination-controls></dir-pagination-controls>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" role="dialog" id="upload"
	tabindex="-1"  aria-labelledby="LdialogLabel">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			
			<!-- header -->
			<div class="modal-header">
				<button class="close text-600" data-dismiss="modal" ng-click="disciplineUpload.clear ();">&times;</button>
				<h4 class="modal-title text-primary text-600">Upload Excel Sheet [Disciplines]</h4>
			</div>
			
			<!-- body -->
			<div class="modal-body text-center">
				
				<div ng-show="disciplineUpload.file.name.length > 0" class="m-b-10">
					Uploading... 
					<p ng-bind="disciplineUpload.file.name" class="text-600 text-success"></p>
					<p class="text-primary">
						<span ng-bind="disciplineUpload.file_size"></span> KB
					</p>
				</div>
				
				<span ng-hide="disciplineUpload.status === 100"
					class="btn btn-info btn-sm text-uppercase text-600 p-b-10" ng-click="disciplineUpload.upload ();"
					ngf-max-total-size="10MB" ngf-select="disciplineUpload.upload ($file);" 
					ng-model="disciplineUpload.file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, 
						application/vnd.ms-excel">
					select file to upload
				</span>
				
				<p class="p-t-10 p-b-10 text-red" ng-show="disciplineUpload.error" ng-bind="disciplineUpload.error"></p>
				
				<p class="p-t-10 p-b-10 text-success" ng-show="disciplineUpload.success" ng-bind="disciplineUpload.success"></p>
				
				<span ng-show="disciplineUpload.status === 100" ng-click="disciplineUpload.clear ();"
					class="btn btn-sm text-uppercase text-600" 
					ng-class="[{'btn-danger':disciplineUpload.error}, {'btn-success':disciplineUpload.success}]"
					data-dismiss="modal">
					close
				</span>
				<div class="progress m-t-10">
					<div class="progress-bar progress-bar-striped active" 
						ng-class="[
							{'progress-bar-danger':disciplineUpload.error}, 
							{'progress-bar-success':disciplineUpload.success}]"
						aria-valuenow="{{disciplineUpload.status}}" aria-valuemin="0" aria-valuemax="100" 
						role="progressbar" ng-style="{'width':disciplineUpload.status+'%'}">
						<span ng-bind="disciplineUpload.status"></span>%
					</div>
				</div>
			</div>
			
			<!-- footer 
			<div class="modal-footer">
				<span class="btn btn-sm btn-success text-600">commit changes</span>
			</div>
			-->
		</div>
	</div>
</div>