		<div class="col-sm-10 p-r-00 p-l-05" ng-init="loadWebAdmins ();">
			<div class="col-sm-4 m-b-05 p-l-00 p-r-05">
				<div class="panel m-b-05">
					<h5 class="panel-heading m-b-00 m-t-00 text-600">Web Administrators <span ng-class="['label', 'label-success', 'float-right']" ng-bind="webAdmins.length"></span></h5>
					<div class="panel-body">
						<ul class="list-group">
							<li class="list-group-item flex" dir-paginate="n in webAdmins | itemsPerPage: 5">
								<!-- <img ng-src="" ng-class="['img-responsive', 'img-rounded', 'img-fluid']" width="50px" /> -->
								<img ng-src="{{n.profile_image}}" ng-class="['img-responsive', 'img-rounded', 'img-fluid', 'height-x-50']" width="50px" />
								<div ng-class="['p-l-10', 'm-t-15', 'hand']" ng-bind="n.username" ng-click="setWebAdmin (n);"></div>
								<div class="clearfix"></div>
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
					<h5 class="panel-heading m-b-00 m-t-00 text-600">
						<span class="btn btn-default text-600 btn-sm" ng-click="clearWebAdmin ();" >
							add
						</span>
						<span class="btn btn-default btn-sm text-600" ng-click="deleteWebAdmin ();" ng-show="selectedWebAdmin.id != 0" >
							remove
						</span>
					</h5>
					<div class="panel-body">
						<div class="col-sm-12 padding-00">
							<div class="col-sm-8 padding-00">	
								<table class="table m-t-05">
									<tr>
										<td class="font-12 bold" width="30%">Email</td>
										<td ><code class="font-12" ng-bind="selectedWebAdmin.email"></code></td>
									</tr>
									<tr>
										<td class="font-12 bold" width="30%">Status:</td>
										<td >
											<?php if ((int)$this->session->user->usertype === SUPER_ADMIN) { ?>
											<select class="select" ng-model="selectedWebAdmin.status">
												<option value="1">Suspended</option>
												<option value="2">Deactivated</option>
												<option value="3" selected="selected">Activated</option>
												<option value="4">Pending</option>
											</select>
											<?php } else { ?>
												<code class="font-12" ng-bind="selectedWebAdmin.status | statusFilter"></code>
											<?php }?>
										</td>
									</tr>
								</table>
							</div>
							<div class="col-sm-4 text-right padding-00">
								<img ng-src="{{selectedWebAdmin.profile_image}}" class="img-thumbnail img img-responsive img-fluid height-x-100" height="150px" />
							</div>
						</div>
						<div class="col-sm-12 input-box m-t-10 m-b-05">
							<label for="username" class="text-green text-600">Username:</label><br>
							<input class="font-13 text-600" type="text" autocomplete="false" placeholder="enter username" ng-model="selectedWebAdmin.username" />
						</div>
						<div class="col-sm-12 input-box m-t-10 m-b-05">
							<label for="password" class="text-green text-600">Password:</label><br>
							<input class="font-13 text-600" type="password" autocomplete="false" placeholder="enter password" ng-model="selectedWebAdmin.password" />
						</div>
					</div>
					<div class="panel-footer text-right">
						<span class="btn btn-sm btn-success text-600" ng-click="commitChangesWebAdmin ();">commit changes</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>