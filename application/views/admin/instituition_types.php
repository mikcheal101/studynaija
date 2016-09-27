		<div class="col-sm-10 p-r-00 p-l-05" ng-init="load_inst_type ();">
			<div class="col-sm-6 p-l-00 p-r-05">
				<form name="form" novalidate>
					<div class="panel m-b-05">
						<div class="panel-body">
							<div class="col-sm-12 input-box m-b-10">
								<label for="name" class="text-green">Instituition Type Name:</label><br>
								<input class="font-13" required name="name" type="text" placeholder="enter the instituition type name" 
									ng-model="selectedInstType.name" checkinstname />
								<small class="text-red" ng-show="form.name.$error.checkinstname">Instituition Type name already exists!</small>
							</div>
							
							<div class="col-sm-12 p-l-00 p-r-05 p-b-10 text-right btns-family text-600">
								<button ng-class="['btn', 'btn-sm', 'btn-success', 'text-600']" type="submit" ng-click="inst_type_makeChanges (form);" >
									make changes
								</button>
								<span ng-class="['btn', 'btn-sm', 'btn-default', 'text-600']" ng-click="clear_inst_type ();" >clear</span>
							</div>
						</div>
					</div>
				<?=form_close();?>
			</div>
			
			
			<div class="col-sm-6 p-l-05 p-r-00">
				<div class="panel m-t-00">
					<div class="panel-body p-b-00 p-t-00">
						<table class="table table-list table-responsive m-b-00">
							<thead>
								<td width="90%" class="text-600 text-left">Name</td>
								<td width="10%" class="text-right"><i class="fa fa-cog"></i></td>
							</thead>
							<tbody>
								<tr dir-paginate="inst in InstituitionTypes | itemsPerPage:15 ">
									<td class="font-12 text-600 text-left">
										<h5 class="hand text-600 m-t-00 m-b-00" ng-click="set_inst_type (inst);">
											<p ng-bind="inst.name" class="p-b-05" ></p>
										</h5>
									</td>
									<td class="font-12 text-right">
										<i class="fa fa-times text-red" ng-click="delete_inst_type(inst);"></i>
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