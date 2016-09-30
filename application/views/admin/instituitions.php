
		<div class="col-sm-10 p-r-00 p-l-05">
			<form name="form"  enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate>
			<div class="col-sm-12 padding-00">
				<div class="panel m-b-05">
					<div class="panel-body">
						<div class="col-sm-12 padding-00 p-r-10">
							<div class="col-sm-6 input-box m-b-10">
								<label for="address" class="text-green">Instituition Address:</label><br>
								<input class="font-13 summernote" type="text" placeholder="enter the Address" 
									ng-model="selectedInstituition.address" />
								<div class="font-11 text-red" ng-bind="discipline_error"></div>
							</div>

							<div class="col-sm-4 col-sm-offset-1 padding30 height-x-200" >
								<img ngf-resize="{width:180, height: 180, quality:0.9}" ngf-as-background="false" 
									 ngf-thumbnail="selectedInstituition.logo_file" ng-class="['img-responsive', 'img-rounded', {'img-fluid' : selectedInstituition.logo_file !== ''}]">
								<img ng-show="selectedInstituition.logo_file === '' && selectedInstituition.logo !== ''"
									ng-src="<?=base_url();?>/{{selectedInstituition.logo}}"
									 ng-class="['img-responsive', 'img-rounded', 'img-fluid', 'height-x-150', 'width-150x']">
							</div>
						</div>
						<div class="col-sm-12 padding-00">
							<div class="col-sm-4 p-l-00 p-r-05">
								<div class="col-sm-12 input-box m-b-10">
								<label for="name" class="text-green">Instituition's Logo:</label><br>
								<input class="font-13" type="file" placeholder="enter the logo url" 
									ng-model="selectedInstituition.logo_file" ngf-select="getInstituitionLogo ($files);" ngf-max-total-size="10MB";" 
									accept="image/*"  />
								<div class="font-11 text-red" ng-bind="discipline_error"></div>
							</div>
							</div>
							
							<div class="p-r-05 col-sm-4 p-l-00">
								<div class=" input-box m-b-10">
									<label for="instname" class="text-green">Instituition's Name:</label><br>
									<input class="font-13" name="instname" type="text" placeholder="enter the Instituition's Name" 
										ng-model="selectedInstituition.name" checkinstsname required />
										
									<div ng-show="form.$submitted">
										<small ng-show="form.instname.$error.required" class="text-600 font-12 text-red">
											enter an institution name
										</small>
									</div>
									
									<small ng-show="form.instname.$error.checkinstsname" class="text-600 font-12 text-red">
										<span ng-bind="selectedInstituition.name"></span> already exists
									</small>
								</div>
							</div>
							<div class="p-l-00 col-sm-4 p-r-00">
								<div class="input-box m-b-10 p-l-05">
									<label for="" class="text-green">Instituition's Email:</label><br>
									<input class="font-13" type="email" placeholder="enter the Instituition's Email Address" 
										ng-model="selectedInstituition.email" />
									<div class="font-11 text-red" ng-bind="discipline_error"></div>
								</div>
							</div>

						</div>
					
						<div class="col-sm-12 padding-00">
							<div class="col-sm-4 p-l-00 p-r-05">
								<div class="col-sm-12 input-box m-b-10">
									<label for="url" class="text-green">Instituition's Url:</label><br>
									<input class="font-13" type="text" placeholder="enter the Instituition" 
										ng-model="selectedInstituition.url" />
									<div class="font-11 text-red" ng-bind="discipline_error"></div>
								</div>
							</div>
							
							<div class="col-sm-4 p-l-00 p-r-05">
								<div class="col-sm-12 input-box m-b-10">
									<label for="" class="text-green">Instituition's Year of Establishment:</label><br>
									<input class="font-13" type="month" placeholder="enter the Instituition's Year of Establishment" 
										ng-model="selectedInstituition.year_of_est" ng-value="selectedInstituition.year_of_est | myDate | date : 'yyyy-MM'" />
								</div>
							</div>
							
							<div class="col-sm-4 p-l-00 p-r-00">
								<div class="col-sm-12 input-box m-b-10">
									<label for="state" class="text-green">Instituition's State:</label><br>
									<select ng-model="selectedInstituition.state" ng-class="['ngselect']" 
										ng-init="loadStates ();" required name="state" 
										ng-options="state.name for state in states track by state.id">
										<option selected value="">--  Select State  --</option>
									</select>
								</div>
							</div>
						</div>
						
						<div class="col-sm-12 padding-00">
						
							<div class="col-sm-4 p-l-00 p-r-05">
								<div class="col-sm-12 input-box m-b-10">
									<label for="" class="text-green">Instituition's Username:</label><br>
									<input class="font-13" type="" placeholder="enter the Instituition's Username" 
										ng-model="selectedInstituition.user.username" />
									<div class="font-11 text-red" ng-bind="discipline_error"></div>
								</div>
							</div>
							
							<div class="col-sm-4 p-l-00 p-r-05">
								<div class="col-sm-12 input-box m-b-10">
									<label for="" class="text-green">Instituition's Password:</label><br>
									<input class="font-13" type="password" placeholder="enter the Instituition's Password" 
										ng-model="selectedInstituition.user.password" />
									<div class="font-11 text-red" ng-bind="discipline_error"></div>
								</div>
							</div>
							
							<div class="col-sm-4 p-l-00 p-r-00">
								<div class="col-sm-12 input-box m-b-10">
									<label for="" class="text-green">Instituition's Type:</label><br>
									<select class="text-600 ngselect"
										ng-options="option.name for option in InstituitionTypes track by option.id"
										ng-model="selectedInstituition.type">
										<option selected value="">--  Select Institution Type  --</option>
									</select>
								</div>
							</div>
						</div>

						<div class="col-sm-12 p-l-00 p-r-05 p-b-10 text-right btns-family">
							<button type="submit" ng-click="instituitionMakeChanges (form);" 
								class="btn btn-sm btn-success text-600">commit changes</button>
							<span class="btn btn-sm btn-default text-600" ng-click="resetInstituition ();">reset</span>
						</div>
					</div>
				</div>
				<?=form_close();?>
			</div>
			
			
			<div class="col-sm-12 m-t-05 padding-00" ng-init="loadInstituitions ();">
				<div class="panel">
					<div class="panel-heading text-ash-01 text-right p-b-10 flex">
						<input type="search" ng-model="search_instituitions" class="form-control text-black text-600 no-shadow no-radius" />
						<i class="btn fa fa-download"></i>
						<i class="btn fa fa-upload"></i>
						<i class="btn fa fa-print"></i>
						<div class="clearfix"></div>
					</div>
					<div class="panel-body">
						<table class="table table-responsive table-bordered text-600">
							<thead>
								<td width="5%" class="text-center"><i class="fa fa-photo"></i></td>
								<td width="" class="text-center font-14 text-600 text-uppercase">Institution's Name</td>
								<td width="" class="font-14 text-600 text-center text-uppercase">Institution's username</td>
								<td width="10%" class="font-14 text-600 text-center text-uppercase">Type</td>
								<td width="5%"  class="text-center"><i class="fa fa-cogs"></i></td>
							</thead>
							<tbody>
								<tr dir-paginate="inst in instituitions | filter:search_instituitions | itemsPerPage: 10 ">
									<td class="font-12" width="5%">
										<img ng-hide="inst.logo_file === ''"
											ng-class="['img-responsive', 'img-rounded', {'height-x-30' : inst.logo_file !== ''}]" 
											ngf-size="{width:250, height: 250, quality:0.9}" ngf-as-background="false" 
											ngf-thumbnail="inst.logo_file"
											/>
										<img ng-show="inst.logo_file === ''"
											ng-class="['img-responsive', 'img-fluid', 'img-rounded', 'height-x-30']" 
											alt="{{inst.name}}"
											ng-style="[{'max-height': '45px'}, {'min-height': '40px'}]"
											ng-src= "<?=base_url ();?>{{inst.logo}}"
											/>
									</td>
									<td class="font-14 text-left text-600 hand text-info text-underline" style="padding-top: 15px;" 
										ng-click="setInstitution (inst);">
										<span ng-bind="inst.name" ng-class="['text-capitalize']"></span>
									</td>
									<td class="font-14 text-right text-600 p-t-15"><span ng-bind="inst.user.username"></span></td>
									<td class="font-14 text-right text-600 p-t-15"><span ng-bind="inst.type.name"></span></td>
									<td class="font-12 text-right text-600 p-t-15">
										<i class="fa fa-times text-danger" ng-click="deleteInstituition ($index);"></i>
									</td>
								</tr>
							</tbody>
						</table>
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